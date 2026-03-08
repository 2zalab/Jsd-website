<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 10.5px; color: #1e293b; }

    .header { border-bottom: 3px solid #10b981; padding-bottom: 12px; margin-bottom: 18px; }
    .header-top { display: flex; align-items: flex-start; justify-content: space-between; }
    .logo { font-size: 22px; font-weight: 800; color: #4f46e5; letter-spacing: -0.5px; }
    .logo span { color: #10b981; }
    .header-event { text-align: right; }
    .header-event-name { font-size: 13px; font-weight: 700; color: #0f172a; }
    .header-event-sub { font-size: 9.5px; color: #64748b; margin-top: 2px; }
    .header-divider { height: 1px; background: #e2e8f0; margin: 10px 0 8px; }
    .header-meta { display: flex; justify-content: space-between; align-items: center; }
    .doc-title { font-size: 15px; font-weight: 700; color: #059669; }
    .doc-badge { background: #dcfce7; color: #166534; font-size: 9px; font-weight: 700; padding: 3px 10px; border-radius: 999px; }

    .stats-bar { display: flex; gap: 14px; margin-bottom: 16px; }
    .stat-box { flex: 1; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px; text-align: center; }
    .stat-num { font-size: 17px; font-weight: 800; color: #059669; }
    .stat-lbl { font-size: 8.5px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 1px; }

    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #059669; color: #fff; }
    thead th { padding: 8px 10px; text-align: left; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; }
    tbody tr { border-bottom: 1px solid #f1f5f9; }
    tbody tr:nth-child(even) { background: #f0fdf4; }
    tbody td { padding: 7px 10px; vertical-align: middle; font-size: 10px; color: #374151; }
    tbody td:first-child { font-weight: 700; color: #059669; text-align: center; }
    .empty-row td { text-align: center; padding: 20px; color: #94a3b8; font-style: italic; }

    .footer { margin-top: 22px; padding-top: 10px; border-top: 2px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-end; }
    .footer-left { font-size: 8.5px; color: #94a3b8; line-height: 1.5; }
    .footer-right { font-size: 8.5px; color: #94a3b8; text-align: right; line-height: 1.5; }
    .footer-brand { font-weight: 700; color: #4f46e5; font-size: 9.5px; }
</style>
</head>
<body>

<div class="header">
    <div class="header-top">
        <div class="logo">JSD<span>'</span>{{ now()->year }}</div>
        <div class="header-event">
            <div class="header-event-name">Journées Sahel Digital</div>
            <div class="header-event-sub">ENSPM · Université de Maroua · Département INFOTEL</div>
            <div class="header-event-sub">Maroua, Cameroun &nbsp;·&nbsp; {{ now()->isoFormat('D MMMM YYYY') }}</div>
        </div>
    </div>
    <div class="header-divider"></div>
    <div class="header-meta">
        <div class="doc-title">Meilleur Projet Digital — Liste des participants</div>
        <div class="doc-badge">{{ count($projets) }} projet(s)</div>
    </div>
</div>

@php
    $lycee = collect($projets)->where('type_concours','CMPDL')->count();
    $sup   = collect($projets)->where('type_concours','CMPDS')->count();
    $etablissements = collect($projets)->pluck('etablissement')->unique()->count();
@endphp
<div class="stats-bar">
    <div class="stat-box">
        <div class="stat-num">{{ count($projets) }}</div>
        <div class="stat-lbl">Projets</div>
    </div>
    @if($lycee > 0)
    <div class="stat-box">
        <div class="stat-num">{{ $lycee }}</div>
        <div class="stat-lbl">Niveau lycée</div>
    </div>
    @endif
    @if($sup > 0)
    <div class="stat-box">
        <div class="stat-num">{{ $sup }}</div>
        <div class="stat-lbl">Niveau supérieur</div>
    </div>
    @endif
    <div class="stat-box">
        <div class="stat-num">{{ $etablissements }}</div>
        <div class="stat-lbl">Établissements</div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width:4%">#</th>
            <th style="width:16%">Nom de l'équipe</th>
            <th style="width:16%">Chef d'équipe</th>
            <th style="width:18%">Email</th>
            <th style="width:16%">Établissement</th>
            <th style="width:10%">Type</th>
            <th>Nom du projet</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projets as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->nom_equipe }}</td>
            <td>{{ $p->chef_equipe }}</td>
            <td style="font-size:9px">{{ $p->email_chef_equipe }}</td>
            <td>{{ $p->etablissement }}</td>
            <td style="text-align:center">
                <span style="background:{{ $p->type_concours==='CMPDL' ? '#fef3c7' : '#eff6ff' }};color:{{ $p->type_concours==='CMPDL' ? '#92400e' : '#1d4ed8' }};padding:2px 6px;border-radius:4px;font-size:8.5px;font-weight:700">
                    {{ $p->type_concours === 'CMPDL' ? 'Lycée' : 'Supérieur' }}
                </span>
            </td>
            <td style="font-weight:600">{{ $p->nom_projet }}</td>
        </tr>
        @empty
        <tr class="empty-row"><td colspan="7">Aucun projet enregistré.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    <div class="footer-left">
        <span class="footer-brand">Journées Sahel Digital</span><br>
        Document officiel — usage interne &amp; jury uniquement<br>
        ENSPM · Université de Maroua
    </div>
    <div class="footer-right">
        {{ count($projets) }} projet(s) inscrit(s)<br>
        Généré le {{ now()->format('d/m/Y') }} à {{ now()->format('H:i') }}
    </div>
</div>

</body>
</html>
