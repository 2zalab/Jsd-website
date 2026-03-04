<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; margin: 0; }
h1 { font-size: 18px; font-weight: 800; color: #4f46e5; margin-bottom: 4px; }
.sub { font-size: 11px; color: #94a3b8; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; }
thead th { background: #4f46e5; color: #fff; padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: .05em; }
tbody tr:nth-child(even) { background: #f8fafc; }
tbody tr:nth-child(odd)  { background: #fff; }
td { padding: 7px 10px; border-bottom: 1px solid #f1f5f9; }
.badge-admin { background: #ede9fe; color: #5b21b6; padding: 2px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; }
.badge-user  { background: #eff6ff; color: #1d4ed8; padding: 2px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; }
.footer { margin-top: 20px; font-size: 10px; color: #94a3b8; text-align: right; }
</style>
</head>
<body>
<h1>Gestion des Utilisateurs — JSD'26</h1>
<p class="sub">Exporté le {{ now()->format('d/m/Y à H:i') }} · {{ $users->count() }} utilisateur(s)</p>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
            <th>Inscrit le</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td><strong>{{ $u->name }}</strong></td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->phone ?? '—' }}</td>
            <td><span class="{{ $u->role === 'admin' ? 'badge-admin' : 'badge-user' }}">{{ $u->role === 'admin' ? 'Admin' : 'Utilisateur' }}</span></td>
            <td>{{ $u->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p class="footer">Journées Sahel Digital 2026 — Export confidentiel</p>
</body>
</html>
