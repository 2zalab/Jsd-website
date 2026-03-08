<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDonationController extends Controller
{
    public function index(Request $request)
    {
        // Navigation directe (non-AJAX) → redirige vers le shell admin
        if (! $request->ajax()) {
            return redirect()->route('admin.index');
        }

        // ── Filtres ──────────────────────────────────────────────────────────
        $status  = $request->get('status', 'all');
        $search  = $request->get('search', '');
        $method  = $request->get('method', 'all');
        $period  = $request->get('period', '30');

        // ── Statistiques globales ─────────────────────────────────────────
        $totalDons       = Donation::count();
        $donsReussis     = Donation::where('status', 'successful')->count();
        $donsPendants    = Donation::where('status', 'pending')->count();
        $donsEchoues     = Donation::whereIn('status', ['failed', 'cancelled'])->count();
        $montantTotal    = Donation::where('status', 'successful')->sum('amount');
        $montantMoyen    = $donsReussis > 0
            ? Donation::where('status', 'successful')->avg('amount')
            : 0;

        // ── Dons par opérateur (pour chart donut) ─────────────────────────
        $donsByOperator = Donation::where('status', 'successful')
            ->select('payment_method', DB::raw('count(*) as total'), DB::raw('sum(amount) as montant'))
            ->groupBy('payment_method')
            ->get();

        // ── Evolution des dons (30 / 90 / 365 derniers jours) ─────────────
        $days = in_array((int) $period, [7, 30, 90, 365]) ? (int) $period : 30;

        $evolutionDons = Donation::where('status', 'successful')
            ->where('paid_at', '>=', now()->subDays($days))
            ->select(
                DB::raw("DATE(paid_at) as date"),
                DB::raw('count(*) as nb_dons'),
                DB::raw('sum(amount) as montant')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // ── Dons par mois (12 derniers mois, pour bar chart) ──────────────
        $donsByMonth = Donation::where('status', 'successful')
            ->where('paid_at', '>=', now()->subMonths(12))
            ->select(
                DB::raw("DATE_FORMAT(paid_at, '%Y-%m') as mois"),
                DB::raw('count(*) as nb_dons'),
                DB::raw('sum(amount) as montant')
            )
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // ── Répartition par tranche de montant ────────────────────────────
        $donsByTranche = [
            '< 1 000 FCFA'           => Donation::where('status', 'successful')->where('amount', '<', 1000)->count(),
            '1 000 - 5 000 FCFA'     => Donation::where('status', 'successful')->whereBetween('amount', [1000, 4999])->count(),
            '5 000 - 20 000 FCFA'    => Donation::where('status', 'successful')->whereBetween('amount', [5000, 19999])->count(),
            '20 000 - 50 000 FCFA'   => Donation::where('status', 'successful')->whereBetween('amount', [20000, 49999])->count(),
            '50 000 FCFA et plus'    => Donation::where('status', 'successful')->where('amount', '>=', 50000)->count(),
        ];

        // ── Données JS pré-calculées (évite les closures dans @json Blade) ──
        $moisLabels = $donsByMonth->map(function ($row) {
            try {
                return \Carbon\Carbon::createFromFormat('Y-m', $row->mois)->locale('fr')->isoFormat('MMM YY');
            } catch (\Exception $e) {
                return $row->mois;
            }
        })->values()->toArray();

        $operateursData = $donsByOperator->map(function ($o) {
            $pm = $o->payment_method;
            return [
                'label'   => $pm === 'mtn_momo' ? 'MTN MoMo' : ($pm === 'orange_money' ? 'Orange Money' : ucfirst($pm ?? 'Autre')),
                'total'   => $o->total,
                'montant' => $o->montant,
                'color'   => $pm === 'mtn_momo' ? '#f59e0b' : ($pm === 'orange_money' ? '#f97316' : '#6366f1'),
            ];
        })->values()->toArray();

        // ── Liste des dons (avec filtres) ─────────────────────────────────
        $query = Donation::query()->orderByDesc('created_at');

        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($method !== 'all') {
            $query->where('payment_method', $method);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('external_reference', 'like', "%{$search}%");
            });
        }

        $donations = $query->paginate(20)->withQueryString();

        // ── Top donateurs ─────────────────────────────────────────────────
        $topDonateurs = Donation::where('status', 'successful')
            ->select('name', 'email', DB::raw('count(*) as nb_dons'), DB::raw('sum(amount) as total_donne'))
            ->groupBy('name', 'email')
            ->orderByDesc('total_donne')
            ->limit(5)
            ->get();

        return view('admin.donations.index', compact(
            'totalDons', 'donsReussis', 'donsPendants', 'donsEchoues',
            'montantTotal', 'montantMoyen',
            'donsByOperator', 'evolutionDons', 'donsByMonth', 'donsByTranche',
            'moisLabels', 'operateursData',
            'donations', 'topDonateurs',
            'status', 'search', 'method', 'period', 'days'
        ));
    }

    public function show(Donation $donation)
    {
        return response()->json($donation);
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate(['status' => 'required|in:pending,successful,failed,cancelled']);
        $donation->update(['status' => $request->status]);

        return response()->json(['success' => true, 'status' => $donation->status]);
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.donations.index')->with('success', 'Don supprimé.');
    }

    public function exportCsv()
    {
        $donations = Donation::orderByDesc('created_at')->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="dons_jsd_' . now()->format('Ymd_Hi') . '.csv"',
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($file, ['ID', 'Référence', 'Nom', 'Email', 'Téléphone', 'Montant (FCFA)', 'Opérateur', 'Statut', 'Date']);
            foreach ($donations as $d) {
                fputcsv($file, [
                    $d->id,
                    $d->external_reference,
                    $d->name,
                    $d->email ?? '—',
                    $d->phone,
                    $d->amount,
                    $d->operator_label,
                    $d->status,
                    $d->created_at->format('d/m/Y H:i'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
