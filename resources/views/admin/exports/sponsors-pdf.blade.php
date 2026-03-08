<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #1e293b; }

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

    .confidential { background: #fef3c7; border: 1px solid #fbbf24; padding: 5px 12px; border-radius: 4px; font-size: 9px; font-weight: 700; color: #92400e; margin: 10px 0 14px; text-align: center; }

    .meta { text-align: left; margin: 12px 0 16px; font-size: 10px; color: #374151; line-height: 1.8; }
    .meta strong { color: #0f172a; }

    .stats-bar { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    .stats-bar td { text-align: center; padding: 8px 6px; background: #f8fafc; border: 1px solid #e2e8f0; }
    .stat-num { font-size: 17px; font-weight: 800; color: #3730a3; }
    .stat-lbl { font-size: 8px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 2px; }

    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #3730a3; color: #fff; }
    .data-table thead th { padding: 9px 10px; text-align: left; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; border: none; }
    .data-table tbody tr { border-bottom: 1px solid #f1f5f9; }
    .data-table tbody tr:nth-child(even) { background: #f8fafc; }
    .data-table tbody td { padding: 7px 10px; vertical-align: top; font-size: 10px; color: #374151; }
    .data-table tbody td:first-child { font-weight: 700; color: #4f46e5; text-align: center; width: 4%; }
    .motivation-text { font-size: 9px; color: #64748b; font-style: italic; }
    .empty-row td { text-align: center; padding: 20px; color: #94a3b8; font-style: italic; }

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
    <div class="doc-sub-title">Liste des demandes de sponsoring</div>
</div>

<div class="confidential">⚠ CONFIDENTIEL — Réservé à l'équipe de direction et au comité d'organisation</div>

@php $villes = collect($sponsors)->pluck('adresse')->unique()->filter()->count(); @endphp

<div class="meta">
    <strong>Date de génération :</strong> {{ now()->format('d/m/Y H:i') }}<br>
    <strong>Nombre total de demandes :</strong> {{ count($sponsors) }}
</div>

<table class="stats-bar">
    <tr>
        <td><div class="stat-num">{{ count($sponsors) }}</div><div class="stat-lbl">Demandes reçues</div></td>
        <td><div class="stat-num">{{ $villes }}</div><div class="stat-lbl">Localités</div></td>
        <td><div class="stat-num">{{ now()->format('Y') }}</div><div class="stat-lbl">Édition</div></td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th style="width:4%">#</th>
            <th style="width:18%">Nom / Entreprise</th>
            <th style="width:19%">Email</th>
            <th style="width:13%">Téléphone</th>
            <th style="width:14%">Adresse</th>
            <th>Motivation</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sponsors as $i => $s)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td style="font-weight:700">{{ $s->nom }}</td>
            <td style="font-size:9px">{{ $s->email }}</td>
            <td>{{ $s->telephone }}</td>
            <td>{{ $s->adresse }}</td>
            <td class="motivation-text">{{ \Illuminate\Support\Str::limit($s->motivation, 120) }}</td>
        </tr>
        @empty
        <tr class="empty-row"><td colspan="6">Aucune demande de sponsoring enregistrée.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Document généré automatiquement par la plateforme d'organisation des Journées Sahel Digital
</div>

</body>
</html>
