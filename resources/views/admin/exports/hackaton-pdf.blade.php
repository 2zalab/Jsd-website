<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Journées Sahel Digital - Hackathon</title>

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

@php
        $type = $hackathons->first()?->niveau_etudes;

        $categorie = match($type) {
            'secondaire' => 'Niveau Lycée',
            'superieur' => 'Niveau Supérieur',
            default => 'Toutes catégories'
        };
@endphp

<img src="{{ public_path('images/logo_jsd.png') }}" class="logo">

<h1>Journées Sahel Digital</h1>
<h2>Liste officielle des équipes – Hackathon</h2>
<h2>Categorie : ({{ $categorie }})</h2>

</div>

<p>
<strong>Date de génération :</strong> {{ date('d/m/Y H:i') }} <br>
<strong>Nombre total d'équipes :</strong> {{ $hackathons->count() }}
</p>

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

@foreach($hackathons as $h)

<tr>

<td>{{ $h->id }}</td>

<td>{{ $h->nom_equipe }}</td>

<td>{{ $h->nom_chef_equipe }}</td>

<td>{{ $h->nombre_participants }}</td>

<td>{{ $h->etablissement }}</td>

<td>

@if(is_array($h->membres))
{{ implode(', ', $h->membres) }}
@endif

</td>

</tr>

@endforeach

</tbody>

</table>

<div class="footer">
Document généré automatiquement par la plateforme d'organisation des Journées Sahel Digital
</div>

</body>
</html>
