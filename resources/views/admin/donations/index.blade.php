<div class="p-6 space-y-6">

    {{-- ── Header ──────────────────────────────────────────────────────────────── --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Gestion des Dons</h2>
            <p class="text-sm text-gray-500 mt-1">Suivi complet des donations reçues via CamPay</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.donations.export-csv') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-file-csv"></i> Exporter CSV
            </a>
        </div>
    </div>

    {{-- ── KPI Cards ────────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Dons</span>
                <span class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-heart text-indigo-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalDons }}</p>
            <p class="text-xs text-gray-400">transactions</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Réussis</span>
                <span class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-green-600">{{ $donsReussis }}</p>
            <p class="text-xs text-gray-400">confirmés</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">En attente</span>
                <span class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-yellow-600">{{ $donsPendants }}</p>
            <p class="text-xs text-gray-400">en cours</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Échoués</span>
                <span class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-500 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-red-500">{{ $donsEchoues }}</p>
            <p class="text-xs text-gray-400">annulés / échoués</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 xl:col-span-2">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Montant Total</span>
                <span class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-coins text-purple-600 text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-purple-600">{{ number_format($montantTotal, 0, ',', ' ') }} <span class="text-sm font-medium">FCFA</span></p>
            <p class="text-xs text-gray-400">Moy. {{ number_format($montantMoyen, 0, ',', ' ') }} FCFA / don</p>
        </div>

    </div>

    {{-- ── Charts Row 1 ─────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Courbe evolution dons --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700">Evolution des dons reçus</h3>
                <div class="flex gap-2">
                    @foreach([7 => '7j', 30 => '30j', 90 => '90j', 365 => '1an'] as $p => $label)
                    <a href="{{ request()->fullUrlWithQuery(['period' => $p]) }}"
                       class="px-2 py-1 text-xs rounded-md font-medium transition
                              {{ (int)$period === $p ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-indigo-50' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="relative" style="height:260px">
                <canvas id="chartEvolution"></canvas>
            </div>
        </div>

        {{-- Donut opérateurs --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Répartition par opérateur</h3>
            <div class="relative" style="height:200px">
                <canvas id="chartOperateur"></canvas>
            </div>
            <div class="mt-4 space-y-2">
                @foreach($donsByOperator as $op)
                <div class="flex items-center justify-between text-xs">
                    <span class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full inline-block"
                              style="background: {{ $op->payment_method === 'mtn_momo' ? '#f59e0b' : ($op->payment_method === 'orange_money' ? '#f97316' : '#6366f1') }}"></span>
                        {{ $op->payment_method === 'mtn_momo' ? 'MTN MoMo' : ($op->payment_method === 'orange_money' ? 'Orange Money' : ucfirst($op->payment_method ?? 'Autre')) }}
                    </span>
                    <span class="font-semibold text-gray-700">{{ $op->total }} dons</span>
                </div>
                @endforeach
                @if($donsByOperator->isEmpty())
                <p class="text-xs text-gray-400 text-center mt-4">Aucune donnée disponible</p>
                @endif
            </div>
        </div>

    </div>

    {{-- ── Charts Row 2 ─────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Bar chart montants par mois --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Montants collectés par mois (12 derniers mois)</h3>
            <div class="relative" style="height:240px">
                <canvas id="chartMois"></canvas>
            </div>
        </div>

        {{-- Répartition par tranche --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Répartition par tranche de montant</h3>
            <div class="relative" style="height:240px">
                <canvas id="chartTranche"></canvas>
            </div>
        </div>

    </div>

    {{-- ── Top Donateurs ────────────────────────────────────────────────────────── --}}
    @if($topDonateurs->isNotEmpty())
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Top 5 donateurs</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-2 pr-4">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-2 pr-4">Nom</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-2 pr-4">Email</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase py-2 pr-4">Nb dons</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase py-2">Total donné</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topDonateurs as $i => $d)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-3 pr-4">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold
                                {{ $i === 0 ? 'bg-yellow-100 text-yellow-700' : ($i === 1 ? 'bg-gray-100 text-gray-600' : 'bg-orange-50 text-orange-500') }}">
                                {{ $i + 1 }}
                            </span>
                        </td>
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $d->name }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $d->email ?? '—' }}</td>
                        <td class="py-3 pr-4 text-right text-gray-700">{{ $d->nb_dons }}</td>
                        <td class="py-3 text-right font-semibold text-purple-700">{{ number_format($d->total_donne, 0, ',', ' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- ── Filtres & Table ─────────────────────────────────────────────────────── --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
            <h3 class="text-sm font-semibold text-gray-700">Liste des transactions</h3>

            <form id="donation-filter-form" method="GET" action="{{ route('admin.donations.index') }}"
                  class="flex flex-wrap gap-3 items-center">
                {{-- Recherche --}}
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Nom, email, téléphone, réf…"
                           class="pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-400 w-52">
                    <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
                {{-- Statut --}}
                <select name="status" class="py-2 px-3 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-400">
                    <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Tous les statuts</option>
                    <option value="successful" {{ $status === 'successful' ? 'selected' : '' }}>Réussis</option>
                    <option value="pending"    {{ $status === 'pending'    ? 'selected' : '' }}>En attente</option>
                    <option value="failed"     {{ $status === 'failed'     ? 'selected' : '' }}>Échoués</option>
                    <option value="cancelled"  {{ $status === 'cancelled'  ? 'selected' : '' }}>Annulés</option>
                </select>
                {{-- Opérateur --}}
                <select name="method" class="py-2 px-3 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-400">
                    <option value="all" {{ $method === 'all' ? 'selected' : '' }}>Tous opérateurs</option>
                    <option value="mtn_momo"     {{ $method === 'mtn_momo'     ? 'selected' : '' }}>MTN MoMo</option>
                    <option value="orange_money" {{ $method === 'orange_money' ? 'selected' : '' }}>Orange Money</option>
                </select>
                {{-- Period caché --}}
                <input type="hidden" name="period" value="{{ $period }}">
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                    Filtrer
                </button>
                @if($search || $status !== 'all' || $method !== 'all')
                <a href="{{ route('admin.donations.index') }}"
                   class="px-3 py-2 text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Référence</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Donateur</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Téléphone</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Montant</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Opérateur</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Statut</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 pr-3">Date</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $don)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition" data-id="{{ $don->id }}">

                        <td class="py-3 pr-3">
                            <span class="font-mono text-xs text-gray-500">{{ substr($don->external_reference, 0, 16) }}…</span>
                        </td>

                        <td class="py-3 pr-3">
                            <div class="font-medium text-gray-800">{{ $don->name }}</div>
                            @if($don->email)
                            <div class="text-xs text-gray-400">{{ $don->email }}</div>
                            @endif
                        </td>

                        <td class="py-3 pr-3 text-gray-600">{{ $don->phone }}</td>

                        <td class="py-3 pr-3 text-right font-semibold text-gray-800">
                            {{ number_format($don->amount, 0, ',', ' ') }} <span class="text-xs text-gray-400">FCFA</span>
                        </td>

                        <td class="py-3 pr-3">
                            @if($don->payment_method === 'mtn_momo')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-mobile-alt text-xs"></i> MTN
                                </span>
                            @elseif($don->payment_method === 'orange_money')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    <i class="fas fa-mobile-alt text-xs"></i> Orange
                                </span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>

                        <td class="py-3 pr-3 text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold
                                {{ $don->status === 'successful' ? 'bg-green-100 text-green-700'
                                   : ($don->status === 'pending' ? 'bg-yellow-100 text-yellow-700'
                                   : ($don->status === 'failed' ? 'bg-red-100 text-red-700'
                                   : 'bg-gray-100 text-gray-600')) }}">
                                @if($don->status === 'successful') <i class="fas fa-check text-xs"></i> Réussi
                                @elseif($don->status === 'pending') <i class="fas fa-clock text-xs"></i> En attente
                                @elseif($don->status === 'failed') <i class="fas fa-times text-xs"></i> Échoué
                                @else <i class="fas fa-ban text-xs"></i> Annulé
                                @endif
                            </span>
                        </td>

                        <td class="py-3 pr-3">
                            <div class="text-gray-700">{{ $don->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $don->created_at->format('H:i') }}</div>
                        </td>

                        <td class="py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="showDonDetails({{ $don->id }})"
                                        class="p-1.5 rounded-lg text-indigo-500 hover:bg-indigo-50 transition" title="Détails">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                <button onclick="deleteDon({{ $don->id }}, this)"
                                        class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Supprimer">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-gray-400">
                            <i class="fas fa-heart-broken text-3xl mb-3 block"></i>
                            Aucun don trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($donations->hasPages())
        <div class="mt-5 flex items-center justify-between">
            <p class="text-xs text-gray-500">{{ $donations->total() }} résultat(s)</p>
            {{ $donations->links() }}
        </div>
        @endif

    </div>

</div>

{{-- ── Modal Détails ────────────────────────────────────────────────────────── --}}
<div id="don-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4"
     style="background:rgba(0,0,0,.45)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-screen overflow-y-auto">
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-800" id="modal-title">Détails du don</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-700 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-5 space-y-3" id="modal-body">
            <div class="flex items-center justify-center py-8">
                <div class="w-8 h-8 border-2 border-indigo-600 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {

    /* ── Données pour les graphiques ── */
    const evolutionDates   = @json($evolutionDons->pluck('date'));
    const evolutionNb      = @json($evolutionDons->pluck('nb_dons'));
    const evolutionMontant = @json($evolutionDons->pluck('montant'));

    const moisLabels  = @json($moisLabels);
    const moisNb      = @json($donsByMonth->pluck('nb_dons'));
    const moisMontant = @json($donsByMonth->pluck('montant'));

    const operateurs    = @json($operateursData);
    const trancheLabels = @json(array_keys($donsByTranche));
    const trancheValues = @json(array_values($donsByTranche));

    function drawCharts() {

        /* 1. Courbe évolution des dons (Line) */
        new Chart(document.getElementById('chartEvolution'), {
            type: 'line',
            data: {
                labels: evolutionDates,
                datasets: [
                    {
                        label: 'Nb de dons',
                        data: evolutionNb,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,.08)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        yAxisID: 'yNb',
                    },
                    {
                        label: 'Montant (FCFA)',
                        data: evolutionMontant,
                        borderColor: '#22c55e',
                        backgroundColor: 'rgba(34,197,94,.06)',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        borderDash: [4, 3],
                        yAxisID: 'yMontant',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } },
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.dataset.yAxisID === 'yMontant'
                                ? ` ${Number(ctx.raw).toLocaleString('fr-FR')} FCFA`
                                : ` ${ctx.raw} don(s)`
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 }, maxTicksLimit: 10 } },
                    yNb: {
                        beginAtZero: true, position: 'left',
                        ticks: { precision: 0, font: { size: 10 } },
                        grid: { color: '#f1f5f9' },
                        title: { display: true, text: 'Nb dons', font: { size: 10 } }
                    },
                    yMontant: {
                        beginAtZero: true, position: 'right',
                        ticks: { font: { size: 10 }, callback: v => (v >= 1000 ? (v/1000)+'k' : v) + ' FCFA' },
                        grid: { display: false },
                        title: { display: true, text: 'Montant', font: { size: 10 } }
                    }
                }
            }
        });

        /* 2. Donut opérateurs */
        if (operateurs.length > 0) {
            new Chart(document.getElementById('chartOperateur'), {
                type: 'doughnut',
                data: {
                    labels: operateurs.map(o => o.label),
                    datasets: [{
                        data: operateurs.map(o => o.total),
                        backgroundColor: operateurs.map(o => o.color),
                        borderWidth: 2,
                        borderColor: '#fff',
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${ctx.raw} don(s)` } }
                    }
                }
            });
        } else {
            const canvas = document.getElementById('chartOperateur');
            const ctx2 = canvas.getContext('2d');
            ctx2.fillStyle = '#e2e8f0';
            ctx2.font = '14px Inter';
            ctx2.textAlign = 'center';
            ctx2.fillText('Aucune donnée', canvas.width / 2, canvas.height / 2);
        }

        /* 3. Bar chart mois */
        new Chart(document.getElementById('chartMois'), {
            type: 'bar',
            data: {
                labels: moisLabels,
                datasets: [
                    {
                        label: 'Montant (FCFA)',
                        data: moisMontant,
                        backgroundColor: 'rgba(99,102,241,.75)',
                        borderRadius: 5,
                        yAxisID: 'yMontant',
                    },
                    {
                        label: 'Nb dons',
                        data: moisNb,
                        backgroundColor: 'rgba(34,197,94,.75)',
                        borderRadius: 5,
                        yAxisID: 'yNb',
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 } } },
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.dataset.yAxisID === 'yMontant'
                                ? ` ${Number(ctx.raw).toLocaleString('fr-FR')} FCFA`
                                : ` ${ctx.raw} don(s)`
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                    yMontant: {
                        beginAtZero: true, position: 'left',
                        ticks: { font: { size: 10 }, callback: v => v >= 1000 ? (v/1000)+'k' : v },
                        grid: { color: '#f1f5f9' }
                    },
                    yNb: {
                        beginAtZero: true, position: 'right',
                        ticks: { precision: 0, font: { size: 10 } },
                        grid: { display: false }
                    }
                }
            }
        });

        /* 4. Bar horizontal tranches */
        new Chart(document.getElementById('chartTranche'), {
            type: 'bar',
            data: {
                labels: trancheLabels,
                datasets: [{
                    label: 'Nombre de dons',
                    data: trancheValues,
                    backgroundColor: [
                        'rgba(99,102,241,.8)',
                        'rgba(59,130,246,.8)',
                        'rgba(168,85,247,.8)',
                        'rgba(34,197,94,.8)',
                        'rgba(245,158,11,.8)',
                    ],
                    borderRadius: 5,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: ctx => ` ${ctx.raw} don(s)` } }
                },
                scales: {
                    x: { beginAtZero: true, ticks: { precision: 0, font: { size: 10 } }, grid: { color: '#f1f5f9' } },
                    y: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    }

    if (window.Chart) {
        drawCharts();
    } else {
        const s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js';
        s.onload = drawCharts;
        document.head.appendChild(s);
    }

    /* ── Modal Détails ── */
    window.showDonDetails = function(id) {
        document.getElementById('don-modal').classList.remove('hidden');
        document.getElementById('don-modal').style.display = 'flex';
        document.getElementById('modal-body').innerHTML = `
            <div class="flex items-center justify-center py-8">
                <div class="w-8 h-8 border-2 border-indigo-600 border-t-transparent rounded-full animate-spin"></div>
            </div>`;

        fetch(`/admin/donations/${id}/json`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(d => {
            const statusColors = {
                successful: 'bg-green-100 text-green-700',
                pending:    'bg-yellow-100 text-yellow-700',
                failed:     'bg-red-100 text-red-700',
                cancelled:  'bg-gray-100 text-gray-600',
            };
            const statusLabels = {
                successful: 'Réussi', pending: 'En attente', failed: 'Échoué', cancelled: 'Annulé'
            };
            const opLabel = d.payment_method === 'mtn_momo' ? 'MTN MoMo'
                : (d.payment_method === 'orange_money' ? 'Orange Money' : d.payment_method ?? '—');

            document.getElementById('modal-title').textContent = `Don #${d.id} — ${d.name}`;
            document.getElementById('modal-body').innerHTML = `
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><p class="text-xs text-gray-400 mb-0.5">Référence</p><p class="font-mono text-xs text-gray-700 break-all">${d.external_reference}</p></div>
                    <div><p class="text-xs text-gray-400 mb-0.5">Statut</p>
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold ${statusColors[d.status] || 'bg-gray-100 text-gray-600'}">
                            ${statusLabels[d.status] || d.status}
                        </span>
                    </div>
                    <div><p class="text-xs text-gray-400 mb-0.5">Nom</p><p class="font-semibold text-gray-800">${d.name}</p></div>
                    <div><p class="text-xs text-gray-400 mb-0.5">Email</p><p class="text-gray-700">${d.email || '—'}</p></div>
                    <div><p class="text-xs text-gray-400 mb-0.5">Téléphone</p><p class="text-gray-700">${d.phone}</p></div>
                    <div><p class="text-xs text-gray-400 mb-0.5">Opérateur</p><p class="text-gray-700">${opLabel}</p></div>
                    <div class="col-span-2 bg-indigo-50 rounded-xl p-3 text-center">
                        <p class="text-xs text-indigo-500 mb-1">Montant</p>
                        <p class="text-2xl font-bold text-indigo-700">${Number(d.amount).toLocaleString('fr-FR')} FCFA</p>
                    </div>
                    ${d.message ? `<div class="col-span-2"><p class="text-xs text-gray-400 mb-0.5">Message</p><p class="text-gray-700 italic">"${d.message}"</p></div>` : ''}
                    <div><p class="text-xs text-gray-400 mb-0.5">Créé le</p><p class="text-gray-700">${new Date(d.created_at).toLocaleString('fr-FR')}</p></div>
                    ${d.paid_at ? `<div><p class="text-xs text-gray-400 mb-0.5">Payé le</p><p class="text-gray-700">${new Date(d.paid_at).toLocaleString('fr-FR')}</p></div>` : ''}
                </div>`;
        })
        .catch(() => {
            document.getElementById('modal-body').innerHTML = '<p class="text-red-500 text-sm text-center py-4">Erreur de chargement.</p>';
        });
    };

    window.closeModal = function() {
        document.getElementById('don-modal').classList.add('hidden');
        document.getElementById('don-modal').style.display = 'none';
    };

    /* Close on backdrop click */
    document.getElementById('don-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    /* ── Suppression ── */
    window.deleteDon = function(id, btn) {
        if (!confirm('Supprimer ce don ? Cette action est irréversible.')) return;
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(`/admin/donations/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                const row = btn.closest('tr');
                row.style.transition = 'opacity .3s';
                row.style.opacity = '0';
                setTimeout(() => row.remove(), 300);
            }
        })
        .catch(() => alert('Erreur lors de la suppression.'));
    };

})();
</script>
