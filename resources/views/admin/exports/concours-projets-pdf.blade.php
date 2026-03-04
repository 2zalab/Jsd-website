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
    tbody td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; }
    .footer { margin-top: 20px; font-size: 9px; color: #94a3b8; }
</style>
</head>
<body>
<h1>{{ $titre }}</h1>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom équipe</th>
            <th>Chef d'équipe</th>
            <th>Email</th>
            <th>Établissement</th>
            <th>Nom du projet</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projets as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->nom_equipe }}</td>
            <td>{{ $p->chef_equipe }}</td>
            <td>{{ $p->email_chef_equipe }}</td>
            <td>{{ $p->etablissement }}</td>
            <td>{{ $p->nom_projet }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:16px;">Aucun projet</td></tr>
        @endforelse
    </tbody>
</table>
<div class="footer">Généré le {{ now()->format('d/m/Y H:i') }} — Total : {{ count($projets) }} projet(s)</div>
</body>
</html>
