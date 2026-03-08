<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Journées Sahel Digital - Concours Programmeurs</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
    color:#333;
}

.header{
    text-align:center;
    margin-bottom:20px;
}

.logo{
    width:120px;
    margin-bottom:10px;
}

h1{
    font-size:20px;
    margin:0;
}

h2{
    font-size:14px;
    margin:5px 0 15px 0;
    color:#666;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th, td{
    border:1px solid #ddd;
    padding:8px;
}

th{
    background:#000B9A;
    color:white;
    text-align:left;
}

tr:nth-child(even){
    background:#f7f7f7;
}

.badge{
    padding:2px 6px;
    border-radius:4px;
    font-size:10px;
}

.badge-lycee{
    background:#fef3c7;
    color:#92400e;
}

.badge-sup{
    background:#eff6ff;
    color:#1d4ed8;
}

.footer{
    margin-top:20px;
    font-size:10px;
    text-align:center;
    color:#777;
}
</style>
</head>

<body>

<div class="header">

    <img src="{{ public_path('images/logo_jsd.png') }}" class="logo">

    <h1>Journées Sahel Digital</h1>
    <h2>Liste officielle des participants – Concours Programmeurs</h2>

</div>

<p>
<strong>Date de génération :</strong> {{ date('d/m/Y H:i') }} <br>
<strong>Nombre total de participants :</strong> {{ $programmeurs->count() }}
</p>

<table>

<thead>
<tr>
    <th>#</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Établissement</th>
    <th>Langages</th>
    <th>Niveau</th>
    <th>Statut</th>
</tr>
</thead>

<tbody>

@foreach($programmeurs as $p)
<tr>
    <td>{{ $p->id }}</td>

    <td>{{ $p->nom }}</td>

    <td>{{ $p->email }}</td>

    <td>
        @if(is_array($p->telephone))
            {{ implode(', ', $p->telephone) }}
        @else
            {{ $p->telephone }}
        @endif
    </td>

    <td>{{ $p->etablissement }}</td>

    <td>
        @if(is_array($p->langages))
            {{ implode(', ', $p->langages) }}
        @else
            {{ $p->langages }}
        @endif
    </td>

    <td>
        @if($p->type_concours == 'CMPL')
            <span class="badge badge-lycee">Lycée</span>
        @else
            <span class="badge badge-sup">Supérieur</span>
        @endif
    </td>

    <td>{{ $p->status }}</td>

</tr>
@endforeach

</tbody>

</table>

<div class="footer">
Document généré automatiquement par la plateforme d'organisation des Journées Sahel Digital
</div>

</body>
</html>
