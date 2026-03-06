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
    // ─── Page d'accueil du formulaire de don ──────────────────────────────────
    public function index()
    {
        return view('donate.index');
    }

    // ─── Initiation du paiement via CamPay ────────────────────────────────────
    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'email'  => 'required|email|max:150',
            'phone'  => ['required', 'string', 'regex:/^(6[5-9]\d{7}|237[6][5-9]\d{7})$/'],
            'amount' => 'required|integer|min:100|max:1000000',
        ], [
            'phone.regex'  => 'Numéro invalide. Format attendu: 6XXXXXXXX ou 2376XXXXXXXX',
            'amount.min'   => 'Le montant minimum est de 100 FCFA.',
            'amount.max'   => 'Le montant maximum est de 1 000 000 FCFA.',
        ]);

        // Normaliser le numéro de téléphone (ajouter 237 si absent)
        $phone = $validated['phone'];
        if (!str_starts_with($phone, '237')) {
            $phone = '237' . $phone;
        }

        // Créer une référence externe unique
        $externalRef = 'JSD-' . strtoupper(Str::random(8)) . '-' . time();

        // Enregistrer le don en statut "pending"
        $donation = Donation::create([
            'external_reference' => $externalRef,
            'name'               => $validated['name'],
            'email'              => $validated['email'],
            'phone'              => $phone,
            'amount'             => (int) $validated['amount'],
            'currency'           => 'XAF',
            'description'        => 'Don pour les Journées Sahel Digital',
            'status'             => 'pending',
        ]);

        // Appeler l'API CamPay
        try {
            $token = $this->getCamPayToken();

            if (!$token) {
                return back()->withInput()->with('error', 'Service de paiement temporairement indisponible. Veuillez réessayer.');
            }

            $response = Http::withToken($token)
                ->post(config('campay.base_url') . 'collect/', [
                    'amount'             => (string) $validated['amount'],
                    'currency'           => 'XAF',
                    'from'               => $phone,
                    'description'        => 'Don pour les Journées Sahel Digital (JSD)',
                    'external_reference' => $externalRef,
                    'redirect_url'       => route('donate.callback', ['ref' => $externalRef]),
                ]);

            $data = $response->json();
            Log::info('CamPay collect response', ['data' => $data, 'ref' => $externalRef]);

            if ($response->successful() && isset($data['reference'])) {
                // Mettre à jour le don avec la référence CamPay
                $donation->update([
                    'campay_reference' => $data['reference'],
                    'operator'         => $data['operator'] ?? null,
                    'campay_data'      => $data,
                ]);

                // Rediriger vers la page d'attente
                return redirect()->route('donate.pending', ['ref' => $externalRef])
                    ->with('success', 'Demande de paiement envoyée ! Veuillez confirmer sur votre téléphone.');
            }

            // Erreur CamPay
            $errorMsg = $data['detail'] ?? $data['message'] ?? 'Erreur lors de l\'initiation du paiement.';
            Log::error('CamPay collect failed', ['data' => $data, 'ref' => $externalRef]);
            $donation->update(['status' => 'failed']);

            return back()->withInput()->with('error', $errorMsg);

        } catch (\Exception $e) {
            Log::error('CamPay exception', ['message' => $e->getMessage(), 'ref' => $externalRef]);
            $donation->update(['status' => 'failed']);
            return back()->withInput()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }

    // ─── Page d'attente de confirmation ───────────────────────────────────────
    public function pending(Request $request)
    {
        $donation = Donation::where('external_reference', $request->query('ref'))->firstOrFail();
        return view('donate.pending', compact('donation'));
    }

    // ─── Vérification du statut (polling AJAX) ────────────────────────────────
    public function checkStatus(Request $request)
    {
        $donation = Donation::where('external_reference', $request->query('ref'))->firstOrFail();

        // Si déjà terminé, retourner le statut actuel
        if (!$donation->isPending()) {
            return response()->json([
                'status'   => $donation->status,
                'redirect' => $donation->isSuccessful()
                    ? route('donate.success', ['ref' => $donation->external_reference])
                    : route('donate.failure', ['ref' => $donation->external_reference]),
            ]);
        }

        // Interroger CamPay si on a une référence
        if ($donation->campay_reference) {
            try {
                $token = $this->getCamPayToken();
                if ($token) {
                    $response = Http::withToken($token)
                        ->get(config('campay.base_url') . 'transaction/' . $donation->campay_reference . '/');

                    $data = $response->json();
                    Log::info('CamPay status check', ['data' => $data, 'ref' => $donation->external_reference]);

                    if ($response->successful()) {
                        $campayStatus = strtoupper($data['status'] ?? '');

                        if ($campayStatus === 'SUCCESSFUL') {
                            $donation->update([
                                'status'      => 'successful',
                                'campay_data' => $data,
                            ]);

                            // Envoyer mail de confirmation
                            try {
                                Mail::to($donation->email)->send(new DonationConfirmation($donation));
                            } catch (\Exception $e) {
                                Log::warning('Mail donation failed', ['error' => $e->getMessage()]);
                            }

                            return response()->json([
                                'status'   => 'successful',
                                'redirect' => route('donate.success', ['ref' => $donation->external_reference]),
                            ]);
                        }

                        if ($campayStatus === 'FAILED') {
                            $donation->update([
                                'status'      => 'failed',
                                'campay_data' => $data,
                            ]);
                            return response()->json([
                                'status'   => 'failed',
                                'redirect' => route('donate.failure', ['ref' => $donation->external_reference]),
                            ]);
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('CamPay status check error', ['error' => $e->getMessage()]);
            }
        }

        return response()->json(['status' => 'pending']);
    }

    // ─── Callback CamPay (redirect après paiement) ────────────────────────────
    public function callback(Request $request)
    {
        $donation = Donation::where('external_reference', $request->query('ref'))->first();

        if (!$donation) {
            return redirect()->route('donate.index');
        }

        if ($donation->isSuccessful()) {
            return redirect()->route('donate.success', ['ref' => $donation->external_reference]);
        }

        if ($donation->isFailed()) {
            return redirect()->route('donate.failure', ['ref' => $donation->external_reference]);
        }

        // Toujours en attente : vérifier une dernière fois
        return redirect()->route('donate.pending', ['ref' => $donation->external_reference]);
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

        $donation = Donation::where('external_reference', $externalRef)->first();
        if (!$donation) {
            return response()->json(['status' => 'error', 'message' => 'Donation not found'], 404);
        }

        $campayStatus = strtoupper($data['status'] ?? '');

        if ($campayStatus === 'SUCCESSFUL' && $donation->isPending()) {
            $donation->update([
                'status'           => 'successful',
                'campay_reference' => $data['reference'] ?? $donation->campay_reference,
                'operator'         => $data['operator'] ?? $donation->operator,
                'campay_data'      => $data,
            ]);

            try {
                Mail::to($donation->email)->send(new DonationConfirmation($donation));
            } catch (\Exception $e) {
                Log::warning('Mail donation confirmation failed', ['error' => $e->getMessage()]);
            }
        } elseif ($campayStatus === 'FAILED' && $donation->isPending()) {
            $donation->update([
                'status'      => 'failed',
                'campay_data' => $data,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }

    // ─── Page de succès ───────────────────────────────────────────────────────
    public function success(Request $request)
    {
        $donation = Donation::where('external_reference', $request->query('ref'))->firstOrFail();
        return view('donate.success', compact('donation'));
    }

    // ─── Page d'échec ─────────────────────────────────────────────────────────
    public function failure(Request $request)
    {
        $donation = Donation::where('external_reference', $request->query('ref'))->firstOrFail();
        return view('donate.failure', compact('donation'));
    }

    // ─── Obtenir le token CamPay ──────────────────────────────────────────────
    private function getCamPayToken(): ?string
    {
        try {
            $response = Http::post(config('campay.base_url') . 'token/', [
                'username' => config('campay.app_username'),
                'password' => config('campay.app_password'),
            ]);

            if ($response->successful()) {
                return $response->json('token');
            }

            Log::error('CamPay token error', ['response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('CamPay token exception', ['message' => $e->getMessage()]);
            return null;
        }
    }
}
