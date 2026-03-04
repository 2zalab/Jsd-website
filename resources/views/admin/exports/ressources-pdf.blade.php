<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; margin: 0; }
h1 { font-size: 18px; font-weight: 800; color: #7c3aed; margin-bottom: 4px; }
.sub { font-size: 11px; color: #94a3b8; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; }
thead th { background: #7c3aed; color: #fff; padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: .05em; }
tbody tr:nth-child(even) { background: #f8fafc; }
tbody tr:nth-child(odd)  { background: #fff; }
td { padding: 7px 10px; border-bottom: 1px solid #f1f5f9; }
.badge-photo { background: #eff6ff; color: #1d4ed8; padding: 2px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; }
.badge-doc   { background: #fff7ed; color: #c2410c; padding: 2px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; }
.badge-23 { color: #1d4ed8; font-weight: 700; }
.badge-26 { color: #16a34a; font-weight: 700; }
.footer { margin-top: 20px; font-size: 10px; color: #94a3b8; text-align: right; }
</style>
</head>
<body>
<h1>Ressources — JSD'26</h1>
<p class="sub">Exporté le {{ now()->format('d/m/Y à H:i') }} · {{ $ressources->count() }} ressource(s)</p>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Type</th>
            <th>Édition</th>
            <th>Catégorie</th>
            <th>Ordre</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ressources as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td><strong>{{ $r->titre }}</strong>@if($r->description)<br><small style="color:#94a3b8">{{ Str::limit($r->description, 60) }}</small>@endif</td>
            <td><span class="{{ $r->type === 'photo' ? 'badge-photo' : 'badge-doc' }}">{{ $r->type === 'photo' ? 'Photo' : 'Document' }}</span></td>
            <td><span class="{{ $r->edition === 'JSD23' ? 'badge-23' : 'badge-26' }}">{{ $r->edition === 'JSD23' ? "JSD'23" : "JSD'26" }}</span></td>
            <td>{{ $r->categorie ?? '—' }}</td>
            <td>{{ $r->ordre }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p class="footer">Journées Sahel Digital 2026 — Export confidentiel</p>
</body>
</html>
