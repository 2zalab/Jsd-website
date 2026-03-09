@extends('dashboard._layout')
@php $pageTitle = 'Vue d\'ensemble'; $activeNav = 'home'; @endphp

@push('styles')
<style>
/* ── KPI cards ── */
.kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.75rem}
.kpi-card{
    background:#fff;border-radius:14px;border:1px solid #e8ecf0;
    padding:1.25rem;display:flex;align-items:center;gap:1rem;
    box-shadow:0 1px 3px rgba(0,0,0,.04);
}
.kpi-icon{
    width:46px;height:46px;border-radius:12px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-size:1.1rem;
}
.kpi-num{font-size:1.85rem;font-weight:900;color:#0f172a;line-height:1}
.kpi-lbl{font-size:.75rem;color:#94a3b8;margin-top:.2rem;font-weight:500}

/* ── Quick actions ── */
.qa-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.875rem;margin-bottom:1.75rem}
.qa-btn{
    display:flex;align-items:center;gap:.875rem;
    background:#fff;border:1px solid #e8ecf0;border-radius:14px;
    padding:1rem 1.25rem;text-decoration:none;color:#374151;
    font-size:.875rem;font-weight:600;
    box-shadow:0 1px 3px rgba(0,0,0,.04);transition:all .15s;
}
.qa-btn:hover{border-color:#6366f1;color:#4f46e5;transform:translateY(-1px);box-shadow:0 4px 12px rgba(99,102,241,.12)}
.qa-btn .qa-icon{
    width:38px;height:38px;border-radius:10px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-size:1rem;
}

/* ── Section card ── */
.ds-card{background:#fff;border-radius:16px;border:1px solid #e8ecf0;overflow:hidden;margin-bottom:1.5rem;box-shadow:0 1px 3px rgba(0,0,0,.04)}
.ds-card-head{
    padding:1.1rem 1.5rem;border-bottom:1px solid #f1f5f9;
    display:flex;justify-content:space-between;align-items:center;
}
.ds-card-title{font-size:.95rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.5rem}
.ds-card-link{font-size:.8rem;color:#6366f1;font-weight:600;text-decoration:none}
.ds-card-link:hover{text-decoration:underline}

/* ── Filter tabs ── */
.filter-tabs{display:flex;gap:.375rem;flex-wrap:wrap;padding:1rem 1.5rem;border-bottom:1px solid #f1f5f9}
.filter-tab{
    padding:.375rem .875rem;border-radius:999px;font-size:.78rem;font-weight:600;
    border:1px solid #e2e8f0;background:#fff;color:#64748b;cursor:pointer;
    transition:all .15s;
}
.filter-tab.active,.filter-tab:hover{background:#6366f1;color:#fff;border-color:#6366f1}

/* ── Inscriptions table ── */
.insc-table{width:100%;border-collapse:collapse}
.insc-table th{
    text-align:left;padding:.75rem 1.5rem;font-size:.72rem;
    font-weight:700;letter-spacing:.07em;text-transform:uppercase;
    color:#94a3b8;background:#fafbfc;border-bottom:1px solid #f1f5f9;
}
.insc-table td{padding:.95rem 1.5rem;border-bottom:1px solid #f8fafc;font-size:.875rem;color:#374151;vertical-align:middle}
.insc-table tr:last-child td{border-bottom:none}
.insc-table tr:hover td{background:#fafbfe}
.insc-type-icon{
    width:34px;height:34px;border-radius:9px;
    display:inline-flex;align-items:center;justify-content:center;
    font-size:.85rem;flex-shrink:0;margin-right:.625rem;
}

/* ── Status badges ── */
.badge{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .7rem;border-radius:999px;font-size:.73rem;font-weight:700}
.badge-pending{background:#fffbeb;color:#92400e}
.badge-approved{background:#f0fdf4;color:#065f46}
.badge-rejected{background:#fef2f2;color:#991b1b}

/* ── Notifications ── */
.notif-row{
    display:flex;align-items:flex-start;gap:.875rem;
    padding:.875rem 1.5rem;border-bottom:1px solid #f8fafc;
    transition:background .15s;
}
.notif-row:last-child{border-bottom:none}
.notif-row.unread{background:#f8faff}
.notif-row:hover{background:#f8faff}
.notif-dot-icon{
    width:34px;height:34px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-size:.85rem;
}
.notif-body{flex:1;min-width:0}
.notif-title{font-size:.875rem;font-weight:600;color:#0f172a;margin-bottom:.15rem}
.notif-msg{font-size:.8rem;color:#64748b;line-height:1.5}
.notif-time{font-size:.72rem;color:#94a3b8;margin-top:.25rem}
.unread-indicator{width:8px;height:8px;border-radius:50%;background:#6366f1;flex-shrink:0;margin-top:.5rem}

/* ── Empty state ── */
.empty-box{text-align:center;padding:3rem 2rem}
.empty-box i{font-size:2.75rem;color:#cbd5e1;margin-bottom:.875rem;display:block}
.empty-box p{color:#94a3b8;margin-bottom:1.25rem;font-size:.9rem}

/* ── Welcome banner ── */
.welcome-banner{
    background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);
    border-radius:16px;padding:1.5rem 2rem;
    display:flex;justify-content:space-between;align-items:center;
    margin-bottom:1.75rem;color:#fff;gap:1rem;flex-wrap:wrap;
}
.welcome-banner h1{font-size:1.4rem;font-weight:800;margin:0 0 .3rem}
.welcome-banner p{font-size:.85rem;opacity:.85;margin:0}
.btn-white{
    display:inline-flex;align-items:center;gap:.5rem;
    background:#fff;color:#4f46e5;border:none;border-radius:10px;
    padding:.65rem 1.25rem;font-size:.85rem;font-weight:700;
    text-decoration:none;cursor:pointer;white-space:nowrap;
    transition:all .15s;box-shadow:0 2px 8px rgba(0,0,0,.12);
}
.btn-white:hover{background:#f8f7ff;transform:translateY(-1px)}

@@media(max-width:900px){.kpi-grid{grid-template-columns:repeat(2,1fr)}}
@@media(max-width:640px){
    .kpi-grid{grid-template-columns:repeat(2,1fr)}
    .qa-grid{grid-template-columns:1fr}
    .welcome-banner{padding:1.25rem}
    .insc-table th,.insc-table td{padding:.75rem 1rem}
}
</style>
@endpush

@section('content')

{{-- ── Welcome banner ── --}}
<div class="welcome-banner">
    <div>
        <h1>Bonjour, {{ explode(' ', $user->name)[0] }} 👋</h1>
        <p>Bienvenue sur votre espace personnel JSD'24 — {{ now()->format('l d F Y') }}</p>
    </div>
    <button onclick="openInscModal(event)" class="btn-white">
        <i class="fas fa-plus"></i> Nouvelle inscription
    </button>
</div>

{{-- ── Success flash ── --}}
@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #86efac;border-radius:12px;padding:.875rem 1.25rem;color:#166534;font-size:.875rem;display:flex;align-items:center;gap:.625rem;margin-bottom:1.25rem">
    <i class="fas fa-check-circle" style="color:#22c55e;font-size:1rem;flex-shrink:0"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

{{-- ── KPI cards ── --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#eff6ff;color:#3b82f6"><i class="fas fa-clipboard-list"></i></div>
        <div><div class="kpi-num">{{ $stats['total'] }}</div><div class="kpi-lbl">Total inscriptions</div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#fffbeb;color:#f59e0b"><i class="fas fa-clock"></i></div>
        <div><div class="kpi-num">{{ $stats['pending'] }}</div><div class="kpi-lbl">En attente</div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#f0fdf4;color:#10b981"><i class="fas fa-check-circle"></i></div>
        <div><div class="kpi-num">{{ $stats['approved'] }}</div><div class="kpi-lbl">Acceptées</div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#fef2f2;color:#ef4444"><i class="fas fa-times-circle"></i></div>
        <div><div class="kpi-num">{{ $stats['rejected'] }}</div><div class="kpi-lbl">Refusées</div></div>
    </div>
</div>

{{-- ── Quick actions ── --}}
<div class="qa-grid">
    <button onclick="openFormPanel('programmeur')" class="qa-btn" style="font-family:inherit;cursor:pointer;font-size:.875rem">
        <div class="qa-icon" style="background:#eff6ff;color:#3b82f6"><i class="fas fa-code"></i></div>
        <div><div>Concours Programmeur</div><div style="font-size:.73rem;color:#94a3b8;font-weight:400;margin-top:2px">CMPL / CMPS</div></div>
    </button>
    <button onclick="openFormPanel('projet-digital')" class="qa-btn" style="font-family:inherit;cursor:pointer;font-size:.875rem">
        <div class="qa-icon" style="background:#f0fdf4;color:#10b981"><i class="fas fa-laptop-code"></i></div>
        <div><div>Projet Digital</div><div style="font-size:.73rem;color:#94a3b8;font-weight:400;margin-top:2px">CMPDL / CMPDS</div></div>
    </button>
    <button onclick="openFormPanel('hackathon')" class="qa-btn" style="font-family:inherit;cursor:pointer;font-size:.875rem">
        <div class="qa-icon" style="background:#fdf4ff;color:#a855f7"><i class="fas fa-rocket"></i></div>
        <div><div>Hackathon JSD</div><div style="font-size:.73rem;color:#94a3b8;font-weight:400;margin-top:2px">Lycée / Supérieur</div></div>
    </button>
</div>

{{-- ── Inscriptions ── --}}
<div class="ds-card" id="inscriptions">
    <div class="ds-card-head">
        <div class="ds-card-title"><i class="fas fa-list-check" style="color:#6366f1"></i> Mes inscriptions</div>
    </div>

    @if(count($inscriptions) === 0)
        <div class="empty-box">
            <i class="fas fa-inbox"></i>
            <p>Vous n'avez aucune inscription pour le moment.</p>
            <button onclick="openInscModal(event)" class="btn btn-primary" style="font-size:.875rem;font-family:inherit;cursor:pointer"><i class="fas fa-plus"></i> S'inscrire à un concours</button>
        </div>
    @else
        {{-- Type filter --}}
        <div class="filter-tabs" id="filter-bar">
            <button class="filter-tab active" data-filter="all">Tous ({{ count($inscriptions) }})</button>
            @php
                $types = collect($inscriptions)->groupBy('type')->keys();
                $typeIcons = [
                    'Concours Programmeur' => 'fa-code',
                    'Projet Digital'       => 'fa-laptop-code',
                    'Hackathon'            => 'fa-rocket',
                    'Stand'                => 'fa-store',
                ];
            @endphp
            @foreach($types as $t)
            <button class="filter-tab" data-filter="{{ Str::slug($t) }}">
                {{ $t }} ({{ collect($inscriptions)->where('type', $t)->count() }})
            </button>
            @endforeach
        </div>

        <div style="overflow-x:auto">
            <table class="insc-table" id="insc-table">
                <thead>
                    <tr>
                        <th>Concours</th>
                        <th>Nom / Équipe</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inscriptions as $insc)
                    @php
                        $slug = Str::slug($insc['type']);
                        $iconMap = ['concours-programmeur'=>['fa-code','#eff6ff','#3b82f6'],'projet-digital'=>['fa-laptop-code','#f0fdf4','#10b981'],'hackathon'=>['fa-rocket','#fdf4ff','#a855f7'],'stand'=>['fa-store','#fffbeb','#f59e0b']];
                        [$ico, $bg, $fg] = $iconMap[$slug] ?? ['fa-file','#f1f5f9','#64748b'];
                    @endphp
                    <tr data-type="{{ $slug }}">
                        <td>
                            <div style="display:flex;align-items:center">
                                <div class="insc-type-icon" style="background:{{ $bg }};color:{{ $fg }}">
                                    <i class="fas {{ $ico }}"></i>
                                </div>
                                <div>
                                    <div style="font-weight:600;color:#0f172a;font-size:.875rem">{{ $insc['type'] }}</div>
                                    <div style="font-size:.75rem;color:#94a3b8;margin-top:1px">{{ $insc['label'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-weight:500">{{ $insc['name'] }}</td>
                        <td style="color:#94a3b8;white-space:nowrap">{{ $insc['date']->format('d/m/Y') }}</td>
                        <td>
                            @if($insc['status'] === 'approved')
                                <span class="badge badge-approved"><i class="fas fa-check"></i> Acceptée</span>
                            @elseif($insc['status'] === 'rejected')
                                <span class="badge badge-rejected"><i class="fas fa-times"></i> Refusée</span>
                            @else
                                <span class="badge badge-pending"><i class="fas fa-clock"></i> En attente</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- ── Recent notifications ── --}}
<div class="ds-card">
    <div class="ds-card-head">
        <div class="ds-card-title">
            <i class="fas fa-bell" style="color:#6366f1"></i> Notifications récentes
            @if($unread > 0)<span class="ds-badge" style="margin-left:.25rem;position:static">{{ $unread }}</span>@endif
        </div>
        <a href="{{ route('dashboard.notifications') }}" class="ds-card-link">Tout voir →</a>
    </div>

    @if($notifications->isEmpty())
        <div class="empty-box" style="padding:2rem">
            <i class="fas fa-bell-slash" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:.75rem"></i>
            <p style="color:#94a3b8;font-size:.85rem;margin:0">Aucune notification.</p>
        </div>
    @else
        @foreach($notifications as $notif)
        @php
            $colors = ['success'=>['#f0fdf4','#10b981'],'error'=>['#fef2f2','#ef4444'],'warning'=>['#fffbeb','#f59e0b'],'info'=>['#eff6ff','#3b82f6']];
            [$nbg, $nfg] = $colors[$notif->type] ?? ['#f8fafc','#64748b'];
        @endphp
        <div class="notif-row {{ $notif->isRead() ? '' : 'unread' }}">
            <div class="notif-dot-icon" style="background:{{ $nbg }};color:{{ $nfg }}">
                <i class="fas {{ $notif->icon ?? 'fa-info-circle' }}"></i>
            </div>
            <div class="notif-body">
                <div class="notif-title">{{ $notif->title }}</div>
                <div class="notif-msg">{{ Str::limit($notif->message, 90) }}</div>
                <div class="notif-time"><i class="fas fa-clock" style="font-size:.68rem"></i> {{ $notif->created_at->diffForHumans() }}</div>
            </div>
            @if(!$notif->isRead())<div class="unread-indicator"></div>@endif
        </div>
        @endforeach
        <div style="padding:.875rem 1.5rem;border-top:1px solid #f1f5f9;text-align:center">
            <a href="{{ route('dashboard.notifications') }}" class="ds-card-link" style="font-size:.82rem">
                Voir toutes les notifications →
            </a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
/* ── Inscription filter ── */
document.querySelectorAll('#filter-bar .filter-tab').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('#filter-bar .filter-tab').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('#insc-table tbody tr').forEach(row => {
            row.style.display = (filter === 'all' || row.dataset.type === filter) ? '' : 'none';
        });
    });
});
</script>
@endpush
