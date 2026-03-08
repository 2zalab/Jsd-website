<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #1e293b; }

    /* ── Header ── */
    .header { text-align: center; padding-bottom: 14px; border-bottom: 2px solid #e2e8f0; margin-bottom: 14px; }
    .logo-wrap { margin: 0 auto 8px; display: table; }
    .logo-bars { display: table-cell; vertical-align: middle; padding-right: 10px; }
    .logo-bar  { width: 36px; height: 5px; border-radius: 2px; margin-bottom: 4px; }
    .logo-bar:last-child { margin-bottom: 0; }
    .logo-bar-1 { background: #4f46e5; }
    .logo-bar-2 { background: #10b981; }
    .logo-bar-3 { background: #f59e0b; }
    .logo-name  { display: table-cell; vertical-align: middle; font-size: 26px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px; }
    .logo-name span { color: #4f46e5; }
    .doc-main-title { font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 3px; }
    .doc-sub-title  { font-size: 11px; color: #64748b; }

    /* ── Meta ── */
    .meta { text-align: left; margin: 12px 0 16px; font-size: 10px; color: #374151; line-height: 1.8; }
    .meta strong { color: #0f172a; }

    /* ── Stats ── */
    .stats-bar { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    .stats-bar td { width: 25%; text-align: center; padding: 8px 6px; background: #f8fafc; border: 1px solid #e2e8f0; }
    .stat-num { font-size: 17px; font-weight: 800; color: #4f46e5; }
    .stat-lbl { font-size: 8px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 2px; }

    /* ── Table ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #3730a3; color: #fff; }
    .data-table thead th { padding: 9px 10px; text-align: left; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; border: none; }
    .data-table tbody tr { border-bottom: 1px solid #f1f5f9; }
    .data-table tbody tr:nth-child(even) { background: #f8fafc; }
    .data-table tbody td { padding: 7px 10px; vertical-align: top; font-size: 10px; color: #374151; }
    .data-table tbody td:first-child { font-weight: 700; color: #4f46e5; text-align: center; width: 4%; }
    .members-list { color: #64748b; font-size: 9px; }
    .empty-row td { text-align: center; padding: 20px; color: #94a3b8; font-style: italic; }

    /* ── Footer ── */
    .footer { margin-top: 22px; text-align: center; font-size: 9px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
</style>
</head>
<body>

<div class="header">
    <table class="logo-wrap"><tr>
        <td class="logo-bars">
            <div class="logo-bar logo-bar-1"></div>
            <div class="logo-bar logo-bar-2"></div>
            <div class="logo-bar logo-bar-3"></div>
        </td>
        <td class="logo-name">JSD <span>'{{ \App\Models\Edition::courante()?->annee ?? now()->year }}</span></td>
    </tr></table>
    <div class="doc-main-title">Journées Sahel Digital</div>
    <div class="doc-sub-title">{{ $titre }}</div>
</div>

@php
    $totalParticipants  = $hackathons->sum('nombre_participants');
    $totalEtablissements = $hackathons->pluck('etablissement')->unique()->count();
    $moy = $hackathons->count() ? round($hackathons->avg('nombre_participants'), 1) : 0;
@endphp

<div class="meta">
    <strong>Date de génération :</strong> {{ now()->format('d/m/Y H:i') }}<br>
    <strong>Nombre total d'équipes :</strong> {{ $hackathons->count() }}
</div>

<table class="stats-bar">
    <tr>
        <td><div class="stat-num">{{ $hackathons->count() }}</div><div class="stat-lbl">Équipes</div></td>
        <td><div class="stat-num">{{ $totalParticipants }}</div><div class="stat-lbl">Participants</div></td>
        <td><div class="stat-num">{{ $totalEtablissements }}</div><div class="stat-lbl">Établissements</div></td>
        <td><div class="stat-num">{{ $moy }}</div><div class="stat-lbl">Moy. / équipe</div></td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th style="width:4%">#</th>
            <th style="width:18%">Nom de l'équipe</th>
            <th style="width:17%">Chef d'équipe</th>
            <th style="width:7%">Nb</th>
            <th style="width:19%">Établissement</th>
            <th>Membres</th>
        </tr>
    </thead>
    <tbody>
        @forelse($hackathons as $i => $h)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $h->nom_equipe }}</td>
            <td>{{ $h->nom_chef_equipe }}</td>
            <td style="text-align:center">{{ $h->nombre_participants }}</td>
            <td>{{ $h->etablissement }}</td>
            <td class="members-list">{{ implode(' · ', array_filter(is_array($h->membres) ? $h->membres : [])) }}</td>
        </tr>
        @empty
        <tr class="empty-row"><td colspan="6">Aucune équipe inscrite pour cette catégorie.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Document généré automatiquement par la plateforme d'organisation des Journées Sahel Digital
</div>

</body>
</html>
