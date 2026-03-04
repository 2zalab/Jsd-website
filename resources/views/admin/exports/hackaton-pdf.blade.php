<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; }
    h1 { font-size: 16px; margin-bottom: 16px; color: #4f46e5; }
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #4f46e5; color: #fff; }
    thead th { padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 0.05em; }
    tbody tr:nth-child(even) { background: #f1f5f9; }
    tbody td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }
    .footer { margin-top: 20px; font-size: 9px; color: #94a3b8; }
</style>
</head>
<body>
<h1>{{ $titre }}</h1>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom de l'équipe</th>
            <th>Chef d'équipe</th>
            <th>Participants</th>
            <th>Établissement</th>
            <th>Membres</th>
        </tr>
    </thead>
    <tbody>
        @forelse($hackathons as $i => $h)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $h->nom_equipe }}</td>
            <td>{{ $h->nom_chef_equipe }}</td>
            <td>{{ $h->nombre_participants }}</td>
            <td>{{ $h->etablissement }}</td>
            <td>
                {{ implode(', ', is_array($h->membres) ? $h->membres : []) }}
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:16px;">Aucune équipe</td></tr>
        @endforelse
    </tbody>
</table>
<div class="footer">Généré le {{ now()->format('d/m/Y H:i') }} — Total : {{ count($hackathons) }} équipe(s)</div>
</body>
</html>
