<?php

namespace App\Http\Controllers;

use App\Mail\DonationConfirmation;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    protected string $campayBaseUrl;
    protected string $campayUsername;
    protected string $campayPassword;
    protected string $campayToken;

    public function __construct()
    {
        $this->campayBaseUrl = rtrim(config('campay.base_url', 'https://demo.campay.net/api'), '/');
        $this->campayUsername = config('campay.app_username', '');
        $this->campayPassword = config('campay.app_password', '');
        $this->campayToken    = config('campay.token', '');
    }

    // ─── Page du formulaire de don ────────────────────────────────────────────
    public function index()
    {
        return view('donate.index');
    }

    // ─── Initiation du paiement ───────────────────────────────────────────────
    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'email'  => 'nullable|email|max:150',
            'phone'  => ['required', 'string', 'regex:/^[6][5-9][0-9]{7}$/'],
            'amount' => 'required|integer|min:100|max:1000000',
        ], [
            'phone.regex'  => 'Numéro invalide. Format: 6XXXXXXXX (9 chiffres, sans le 237)',
            'amount.min'   => 'Le montant minimum est de 100 FCFA.',
            'amount.max'   => 'Le montant maximum est de 1 000 000 FCFA.',
        ]);

        $externalRef   = 'JSD-' . strtoupper(Str::random(8)) . '-' . time();
        $phoneWithCode = '237' . $validated['phone'];

        // Détecter l'opérateur selon le préfixe du numéro
        $prefix        = substr($validated['phone'], 0, 2);
        $paymentMethod = match (true) {
            in_array($prefix, ['67', '68', '50', '51', '52', '53', '54', '65']) => 'mtn_momo',
            in_array($prefix, ['69', '55', '56', '57', '58', '59'])             => 'orange_money',
            default                                                              => 'other',
        };
        $operator = str_starts_with($paymentMethod, 'mtn') ? 'MTN' : (str_starts_with($paymentMethod, 'orange') ? 'ORANGE' : null);

        $donation = Donation::create([
            'external_reference' => $externalRef,
            'name'               => $validated['name'],
            'email'              => $validated['email'] ?? null,
            'phone'              => $validated['phone'],
            'amount'             => (int) $validated['amount'],
            'currency'           => 'XAF',
            'payment_method'     => $paymentMethod,
            'operator'           => $operator,
            'description'        => 'Don pour les Journées Sahel Digital',
            'status'             => 'pending',
        ]);

        try {
            $token = $this->getCampayToken();

            Log::info('CamPay token debug', [
                'token_obtained' => !empty($token),
                'base_url'       => $this->campayBaseUrl,
                'using_method'   => !empty($this->campayToken) ? 'permanent' : 'username_password',
            ]);

            if (!$token) {
                $donation->update(['status' => 'failed']);
                return back()->withInput()->with('error', 'Service de paiement temporairement indisponible. Veuillez réessayer.');
            }

            $response = Http::withHeaders([
                'Authorization' => "Token {$token}",
                'Content-Type'  => 'application/json',
            ])->post("{$this->campayBaseUrl}/collect/", [
                'amount'             => (string) $validated['amount'],
                'currency'           => 'XAF',
                'from'               => $phoneWithCode,
                'description'        => 'Don pour les Journées Sahel Digital (JSD)',
                'external_reference' => $externalRef,
            ]);

            Log::info('CamPay collect response', [
                'status' => $response->status(),
                'body'   => $response->json(),
                'ref'    => $externalRef,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $donation->update([
                    'campay_reference' => $data['reference'] ?? null,
                    'campay_data'      => $data,
                ]);

                session([
                    'donation_id'    => $donation->id,
                    'donation_phone' => $validated['phone'],
                ]);

                return redirect()->route('donate.pending')
                    ->with('success', 'Demande envoyée ! Confirmez le paiement sur votre téléphone.');
            }

            $errorMsg = $response->json('message') ?? $response->json('detail') ?? 'Erreur lors de l\'initiation du paiement.';
            Log::error('CamPay collect failed', ['body' => $response->json(), 'ref' => $externalRef]);
            $donation->update(['status' => 'failed']);

            return back()->withInput()->with('error', $errorMsg);

        } catch (\Exception $e) {
            Log::error('CamPay exception', ['message' => $e->getMessage(), 'ref' => $externalRef]);
            $donation->update(['status' => 'failed']);
            return back()->withInput()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }

    // ─── Page d'attente ───────────────────────────────────────────────────────
    public function pending()
    {
        $donationId = session('donation_id');
        if (!$donationId) {
            return redirect()->route('donate.index');
        }
        $donation = Donation::findOrFail($donationId);
        return view('donate.pending', compact('donation'));
    }

    // ─── Vérification du statut (polling AJAX) ────────────────────────────────
    public function checkStatus(Request $request)
    {
        $donationId = session('donation_id');
        if (!$donationId) {
            return response()->json(['status' => 'not_found']);
        }

        $donation = Donation::find($donationId);
        if (!$donation) {
            return response()->json(['status' => 'not_found']);
        }

        // Déjà terminé
        if (in_array($donation->status, ['successful', 'failed', 'cancelled'])) {
            if ($donation->status !== 'successful') {
                session(['last_failed_donation_id' => $donation->id]);
            }
            return response()->json([
                'status'   => $donation->status,
                'redirect' => $donation->status === 'successful'
                    ? route('donate.success')
                    : route('donate.failure'),
            ]);
        }

        // Interroger CamPay
        if ($donation->campay_reference) {
            try {
                $token = $this->getCampayToken();
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => "Token {$token}",
                    ])->get("{$this->campayBaseUrl}/transaction/{$donation->campay_reference}/");

                    Log::info('CamPay status check', [
                        'reference'   => $donation->campay_reference,
                        'status_code' => $response->status(),
                        'body'        => $response->json(),
                    ]);

                    if ($response->successful()) {
                        $campayStatus = strtoupper($response->json('status', 'PENDING'));

                        if ($campayStatus === 'SUCCESSFUL') {
                            $donation->update([
                                'status'  => 'successful',
                                'paid_at' => now(),
                            ]);
                            $this->sendConfirmationEmail($donation);
                            session()->forget(['donation_id', 'donation_phone']);
                            session(['last_successful_donation_id' => $donation->id]);

                            return response()->json([
                                'status'   => 'successful',
                                'redirect' => route('donate.success'),
                            ]);
                        }

                        if ($campayStatus === 'FAILED') {
                            $donation->update(['status' => 'failed']);
                            session(['last_failed_donation_id' => $donation->id]);
                            session()->forget(['donation_id', 'donation_phone']);

                            return response()->json([
                                'status'   => 'failed',
                                'redirect' => route('donate.failure'),
                            ]);
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('CamPay status check error', ['error' => $e->getMessage()]);
            }
        } else {
            Log::warning('No campay_reference for donation', ['id' => $donation->id]);
        }

        return response()->json(['status' => 'pending']);
    }

    // ─── Annulation ───────────────────────────────────────────────────────────
    public function cancel()
    {
        $donationId = session('donation_id');
        if ($donationId) {
            $donation = Donation::find($donationId);
            if ($donation && $donation->status === 'pending') {
                $donation->update(['status' => 'cancelled']);
            }
            session()->forget(['donation_id', 'donation_phone']);
        }
        return redirect()->route('donate.index')->with('info', 'Don annulé.');
    }

    // ─── Webhook CamPay (notification serveur-à-serveur) ──────────────────────
    public function webhook(Request $request)
    {
        $data = $request->all();
        Log::info('CamPay webhook received', $data);

        $externalRef = $data['external_reference'] ?? null;
        if (!$externalRef) {
            return response()->json(['status' => 'error', 'message' => 'No external_reference'], 400);
        }

        $donation = Donation::where('external_reference', $externalRef)
            ->orWhere('campay_reference', $data['reference'] ?? null)
            ->first();

        if (!$donation) {
            return response()->json(['status' => 'error', 'message' => 'Donation not found'], 404);
        }

        $campayStatus = strtoupper($data['status'] ?? '');

        if ($campayStatus === 'SUCCESSFUL' && $donation->isPending()) {
            $donation->update([
                'status'           => 'successful',
                'paid_at'          => now(),
                'campay_reference' => $data['reference'] ?? $donation->campay_reference,
                'campay_data'      => $data,
            ]);
            $this->sendConfirmationEmail($donation);
            session(['last_successful_donation_id' => $donation->id]);
        } elseif ($campayStatus === 'FAILED' && $donation->isPending()) {
            $donation->update(['status' => 'failed', 'campay_data' => $data]);
        }

        return response()->json(['status' => 'ok']);
    }

    // ─── Page de succès ───────────────────────────────────────────────────────
    public function success()
    {
        // Récupérer la dernière donation réussie depuis la session ou l'historique
        $donationId = session('last_successful_donation_id');
        $donation   = $donationId ? Donation::find($donationId) : null;
        return view('donate.success', compact('donation'));
    }

    // ─── Page d'échec ─────────────────────────────────────────────────────────
    public function failure()
    {
        $donationId = session('last_failed_donation_id');
        $donation   = $donationId ? Donation::find($donationId) : null;
        return view('donate.failure', compact('donation'));
    }

    // ─── Token CamPay ─────────────────────────────────────────────────────────
    // Méthode 1 : token permanent (CAMPAY_TOKEN) — prioritaire
    // Méthode 2 : username + password via /token/
    protected function getCampayToken(): ?string
    {
        if (!empty($this->campayToken)) {
            return $this->campayToken;
        }

        try {
            $response = Http::asJson()->post("{$this->campayBaseUrl}/token/", [
                'username' => $this->campayUsername,
                'password' => $this->campayPassword,
            ]);

            Log::info('CamPay token response', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            if ($response->successful() && isset($response->json()['token'])) {
                return $response->json()['token'];
            }

            return null;
        } catch (\Exception $e) {
            Log::error('CamPay token error', ['message' => $e->getMessage()]);
            return null;
        }
    }

    // ─── Envoi du mail de confirmation ────────────────────────────────────────
    protected function sendConfirmationEmail(Donation $donation): void
    {
        if (empty($donation->email) || $donation->email_sent) {
            return;
        }
        try {
            Mail::to($donation->email)->send(new DonationConfirmation($donation));
            $donation->update(['email_sent' => true]);
        } catch (\Exception $e) {
            Log::warning('Mail donation confirmation failed', ['error' => $e->getMessage()]);
        }
    }
}
