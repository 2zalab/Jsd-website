<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Journées Sahel Digital - Concours Meilleur Projet Digital</title>

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

<img src="{{ public_path('images/logo_jsd.png') }}" class="logo">

<h1>Journées Sahel Digital</h1>
<h2>Liste officielle des participants – Concours Meilleur Projet Digital</h2>

</div>

<p>
<strong>Date de génération :</strong> {{ date('d/m/Y H:i') }} <br>
<strong>Nombre total de projets :</strong> {{ $projets->count() }}
</p>

<table>

<thead>
<tr>
    <th>#</th>
    <th>Nom de l'équipe</th>
    <th>Chef d'équipe</th>
    <th>Email</th>
    <th>Établissement</th>
    <th>Type</th>
    <th>Nom du projet</th>
</tr>
</thead>

<tbody>

@foreach($projets as $p)

<tr>
    <td>{{ $p->id }}</td>

    <td>{{ $p->nom_equipe }}</td>

    <td>{{ $p->chef_equipe }}</td>

    <td>{{ $p->email_chef_equipe }}</td>

    <td>{{ $p->etablissement }}</td>

    <td>
        {{ $p->type_concours == 'CMPDL' ? 'Lycée' : 'Supérieur' }}
    </td>

    <td>{{ $p->nom_projet }}</td>

</tr>

@endforeach

</tbody>

</table>

<div class="footer">
Document généré automatiquement par la plateforme d'organisation des Journées Sahel Digital
</div>

</body>
</html>
