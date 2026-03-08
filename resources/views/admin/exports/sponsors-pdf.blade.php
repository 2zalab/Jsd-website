<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 10.5px; color: #1e293b; }

    .header { border-bottom: 3px solid #8b5cf6; padding-bottom: 12px; margin-bottom: 18px; }
    .header-top { display: flex; align-items: flex-start; justify-content: space-between; }
    .logo { font-size: 22px; font-weight: 800; color: #4f46e5; letter-spacing: -0.5px; }
    .logo span { color: #10b981; }
    .header-event { text-align: right; }
    .header-event-name { font-size: 13px; font-weight: 700; color: #0f172a; }
    .header-event-sub { font-size: 9.5px; color: #64748b; margin-top: 2px; }
    .header-divider { height: 1px; background: #e2e8f0; margin: 10px 0 8px; }
    .header-meta { display: flex; justify-content: space-between; align-items: center; }
    .doc-title { font-size: 15px; font-weight: 700; color: #7c3aed; }
    .doc-badge { background: #ede9fe; color: #5b21b6; font-size: 9px; font-weight: 700; padding: 3px 10px; border-radius: 999px; }

    .stats-bar { display: flex; gap: 14px; margin-bottom: 16px; }
    .stat-box { flex: 1; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px; text-align: center; }
    .stat-num { font-size: 17px; font-weight: 800; color: #7c3aed; }
    .stat-lbl { font-size: 8.5px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 1px; }

    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #7c3aed; color: #fff; }
    thead th { padding: 8px 10px; text-align: left; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; }
    tbody tr { border-bottom: 1px solid #f1f5f9; }
    tbody tr:nth-child(even) { background: #faf5ff; }
    tbody td { padding: 7px 10px; vertical-align: top; font-size: 10px; color: #374151; }
    tbody td:first-child { font-weight: 700; color: #7c3aed; text-align: center; }
    .motivation-text { font-size: 9px; color: #64748b; font-style: italic; }
    .empty-row td { text-align: center; padding: 20px; color: #94a3b8; font-style: italic; }

    .footer { margin-top: 22px; padding-top: 10px; border-top: 2px solid #e2e8f0; display: flex; justify-content: space-between; align-items: flex-end; }
    .footer-left { font-size: 8.5px; color: #94a3b8; line-height: 1.5; }
    .footer-right { font-size: 8.5px; color: #94a3b8; text-align: right; line-height: 1.5; }
    .footer-brand { font-weight: 700; color: #4f46e5; font-size: 9.5px; }
    .confidential { background: #fef3c7; border: 1px solid #fbbf24; padding: 5px 10px; border-radius: 5px; font-size: 9px; font-weight: 700; color: #92400e; margin-bottom: 14px; text-align: center; }
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
        <div class="doc-title">Demandes de Sponsoring</div>
        <div class="doc-badge">{{ count($sponsors) }} demande(s)</div>
    </div>
</div>

<div class="confidential">⚠ CONFIDENTIEL — Réservé à l'équipe de direction et au comité d'organisation</div>

<div class="stats-bar">
    <div class="stat-box">
        <div class="stat-num">{{ count($sponsors) }}</div>
        <div class="stat-lbl">Demandes reçues</div>
    </div>
    @php $villes = collect($sponsors)->pluck('adresse')->unique()->filter()->count(); @endphp
    <div class="stat-box">
        <div class="stat-num">{{ $villes }}</div>
        <div class="stat-lbl">Localités</div>
    </div>
    <div class="stat-box">
        <div class="stat-num">{{ now()->format('Y') }}</div>
        <div class="stat-lbl">Édition</div>
    </div>
</div>

<table>
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
    <div class="footer-left">
        <span class="footer-brand">Journées Sahel Digital</span><br>
        Document confidentiel — usage interne seulement<br>
        ENSPM · Université de Maroua
    </div>
    <div class="footer-right">
        {{ count($sponsors) }} demande(s) de sponsoring<br>
        Généré le {{ now()->format('d/m/Y') }} à {{ now()->format('H:i') }}
    </div>
</div>

</body>
</html>
