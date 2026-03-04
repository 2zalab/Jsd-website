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
<h1>Demandes de Sponsoring</h1>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Motivation</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sponsors as $i => $s)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->nom }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->telephone }}</td>
            <td>{{ $s->adresse }}</td>
            <td>{{ \Illuminate\Support\Str::limit($s->motivation, 80) }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:16px;">Aucune demande</td></tr>
        @endforelse
    </tbody>
</table>
<div class="footer">Généré le {{ now()->format('d/m/Y H:i') }} — Total : {{ count($sponsors) }} demande(s)</div>
</body>
</html>
