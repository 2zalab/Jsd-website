<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>
            <p class="text-sm text-gray-500 mt-1">Vue d'ensemble des inscriptions et activités</p>
        </div>
        <span class="text-xs text-gray-400">Mis à jour : {{ now()->format('d/m/Y H:i') }}</span>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">

        <button type="button" onclick="loadContent('{{ route('admin.inscriptions') }}', 'Inscriptions')"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 text-left hover:border-indigo-300 hover:shadow-md transition cursor-pointer w-full">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Hackaton Lycée</span>
                <span class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-code text-indigo-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-indigo-600">{{ $participantsLycee }}</p>
            <p class="text-xs text-gray-400">participants</p>
        </button>

        <button type="button" onclick="loadContent('{{ route('admin.inscriptions') }}', 'Inscriptions')"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 text-left hover:border-blue-300 hover:shadow-md transition cursor-pointer w-full">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Hackaton Sup.</span>
                <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-laptop-code text-blue-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-blue-600">{{ $participantsSuperieur }}</p>
            <p class="text-xs text-gray-400">participants</p>
        </button>

        <button type="button" onclick="loadContent('{{ route('admin.stands') }}', 'Stands')"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 text-left hover:border-green-300 hover:shadow-md transition cursor-pointer w-full">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Stands</span>
                <span class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                    <i class="fas fa-store text-green-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-green-600">{{ $nombreReservationsStand }}</p>
            <p class="text-xs text-gray-400">réservations</p>
        </button>

        <button type="button" onclick="loadContent('{{ route('admin.sponsors') }}', 'Sponsors')"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 text-left hover:border-yellow-300 hover:shadow-md transition cursor-pointer w-full">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sponsors</span>
                <span class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-handshake text-yellow-600 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-yellow-600">{{ $nombreDemandesSponsor }}</p>
            <p class="text-xs text-gray-400">demandes</p>
        </button>

        <button type="button" onclick="loadContent('{{ route('admin.inscriptions') }}', 'Concours')"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 text-left hover:border-red-300 hover:shadow-md transition cursor-pointer w-full">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Programmeurs</span>
                <span class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                    <i class="fas fa-trophy text-red-500 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-red-500">{{ $participantsConcoursLycee + $participantsConcoursSenior }}</p>
            <p class="text-xs text-gray-400">inscrits concours</p>
        </button>

        <button type="button" onclick="loadContent('{{ route('admin.newsletter') }}', 'Newsletter')"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col gap-2 text-left hover:border-pink-300 hover:shadow-md transition cursor-pointer w-full">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Newsletter</span>
                <span class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                    <i class="fas fa-envelope text-pink-500 text-sm"></i>
                </span>
            </div>
            <p class="text-3xl font-bold text-pink-500">{{ $nombreNewsletters }}</p>
            <p class="text-xs text-gray-400">abonnés</p>
        </button>

    </div>

    {{-- ── Donation Summary Card ───────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <a href="javascript:void(0)" onclick="loadContent('{{ route('admin.donations.index') }}', 'Dons')"
           class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl shadow-sm p-5 flex items-center gap-4 cursor-pointer hover:shadow-md transition text-white no-underline">
            <span class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
            </span>
            <div>
                <p class="text-xs font-semibold text-white/70 uppercase tracking-wide">Dons reçus</p>
                <p class="text-3xl font-bold text-white">{{ $donsReussis }}</p>
                <p class="text-xs text-white/70 mt-0.5">{{ number_format($montantTotal, 0, ',', ' ') }} FCFA collectés</p>
            </div>
        </a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4 md:col-span-2">
            <div class="w-full">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-semibold text-gray-700">Progression des dons</span>
                    <a href="javascript:void(0)" onclick="loadContent('{{ route('admin.donations.index') }}', 'Dons')"
                       class="text-xs text-indigo-600 hover:underline font-medium">Voir tout &rarr;</a>
                </div>
                @php
                    $txReussite = $totalDons > 0 ? round($donsReussis / $totalDons * 100) : 0;
                @endphp
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full transition-all"
                             style="width: {{ $txReussite }}%"></div>
                    </div>
                    <span class="text-sm font-bold text-indigo-700">{{ $txReussite }}%</span>
                </div>
                <div class="flex gap-4 mt-3 text-xs text-gray-500">
                    <span><span class="font-semibold text-green-600">{{ $donsReussis }}</span> réussis</span>
                    <span><span class="font-semibold text-gray-800">{{ $totalDons }}</span> total</span>
                    <span><span class="font-semibold text-purple-600">{{ number_format($montantTotal, 0, ',', ' ') }}</span> FCFA</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Répartition par catégorie (Donut) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Répartition des inscriptions</h3>
            <div class="relative" style="height:260px">
                <canvas id="chartDonut"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-indigo-500 inline-block"></span>Hackaton Lycée</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-blue-500 inline-block"></span>Hackaton Sup.</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span>Stands</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-yellow-500 inline-block"></span>Sponsors</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-400 inline-block"></span>Concours prog.</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-pink-400 inline-block"></span>Newsletter</span>
            </div>
        </div>

        <!-- Concours & Projets (Bar) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Concours & Projets digitaux</h3>
            <div class="relative" style="height:260px">
                <canvas id="chartBar"></canvas>
            </div>
        </div>

    </div>

    <!-- Hackaton comparison + Projets row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Hackaton Lycée vs Supérieur (Horizontal bar) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Hackaton — Lycée vs Supérieur</h3>
            <div class="relative" style="height:200px">
                <canvas id="chartHackaton"></canvas>
            </div>
        </div>

        <!-- Summary cards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between gap-4">
            <h3 class="text-sm font-semibold text-gray-700">Projets digitaux</h3>

            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-xl">
                <span class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-graduation-cap text-purple-600"></i>
                </span>
                <div>
                    <p class="text-xs text-purple-500 font-medium">Niveau Lycée (CMPDL)</p>
                    <p class="text-2xl font-bold text-purple-700">{{ $projetsLycee }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 bg-violet-50 rounded-xl">
                <span class="w-10 h-10 rounded-lg bg-violet-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-university text-violet-600"></i>
                </span>
                <div>
                    <p class="text-xs text-violet-500 font-medium">Niveau Senior (CMPDS)</p>
                    <p class="text-2xl font-bold text-violet-700">{{ $projetsSenior }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                <span class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center shrink-0">
                    <i class="fas fa-layer-group text-gray-600"></i>
                </span>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total projets</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $projetsLycee + $projetsSenior }}</p>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
(function () {
    /* Shared data from Blade */
    const data = {
        hackatonLycee:      {{ $participantsLycee }},
        hackatonSup:        {{ $participantsSuperieur }},
        stands:             {{ $nombreReservationsStand }},
        sponsors:           {{ $nombreDemandesSponsor }},
        concoursLycee:      {{ $participantsConcoursLycee }},
        concoursSenior:     {{ $participantsConcoursSenior }},
        projetsLycee:       {{ $projetsLycee }},
        projetsSenior:      {{ $projetsSenior }},
        newsletter:         {{ $nombreNewsletters }},
    };

    /* ── Load Chart.js then draw ── */
    function drawCharts() {
        /* Donut — répartition globale */
        new Chart(document.getElementById('chartDonut'), {
            type: 'doughnut',
            data: {
                labels: ['Hackaton Lycée','Hackaton Sup.','Stands','Sponsors','Concours prog.','Newsletter'],
                datasets: [{
                    data: [
                        data.hackatonLycee, data.hackatonSup, data.stands,
                        data.sponsors, data.concoursLycee + data.concoursSenior, data.newsletter
                    ],
                    backgroundColor: ['#6366f1','#3b82f6','#22c55e','#eab308','#f87171','#ec4899'],
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '65%',
                plugins: { legend: { display: false } }
            }
        });

        /* Bar — concours & projets */
        new Chart(document.getElementById('chartBar'), {
            type: 'bar',
            data: {
                labels: ['CMPL\nLycée','CMPS\nSenior','CMPDL\nLycée','CMPDS\nSenior'],
                datasets: [{
                    label: 'Programmeurs',
                    data: [data.concoursLycee, data.concoursSenior, 0, 0],
                    backgroundColor: '#f87171',
                    borderRadius: 6,
                },{
                    label: 'Projets',
                    data: [0, 0, data.projetsLycee, data.projetsSenior],
                    backgroundColor: '#a855f7',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                    y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 } }, grid: { color: '#f1f5f9' } }
                }
            }
        });

        /* Horizontal bar — hackaton comparison */
        new Chart(document.getElementById('chartHackaton'), {
            type: 'bar',
            data: {
                labels: ['Participants'],
                datasets: [
                    { label: 'Lycée',    data: [data.hackatonLycee],   backgroundColor: '#6366f1', borderRadius: 6 },
                    { label: 'Supérieur',data: [data.hackatonSup],     backgroundColor: '#3b82f6', borderRadius: 6 },
                ]
            },
            options: {
                indexAxis: 'y',
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                },
                scales: {
                    x: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f1f5f9' } },
                    y: { grid: { display: false } }
                }
            }
        });
    }

    /* Inject Chart.js if not already loaded */
    if (window.Chart) {
        drawCharts();
    } else {
        const s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js';
        s.onload = drawCharts;
        document.head.appendChild(s);
    }
})();
</script>
