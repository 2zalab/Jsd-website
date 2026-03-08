<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Journées Sahel Digital - Sponsoring</title>

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

.notice{
    background:#fff3cd;
    border:1px solid #ffeeba;
    padding:8px;
    font-size:11px;
    text-align:center;
    margin-bottom:15px;
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
<h2>Liste officielle des demandes de sponsoring</h2>

</div>

<div class="notice">
⚠ Document confidentiel – Réservé au comité d'organisation
</div>

<p>
<strong>Date de génération :</strong> {{ date('d/m/Y H:i') }} <br>
<strong>Nombre total de demandes :</strong> {{ $sponsors->count() }}
</p>

<table>

<thead>
<tr>
    <th>#</th>
    <th>Nom / Entreprise</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Adresse</th>
    <th>Motivation</th>
</tr>
</thead>

<tbody>

@foreach($sponsors as $s)

<tr>

<td>{{ $s->id }}</td>

<td>{{ $s->nom }}</td>

<td>{{ $s->email }}</td>

<td>{{ $s->telephone }}</td>

<td>{{ $s->adresse }}</td>

<td>
{{ \Illuminate\Support\Str::limit($s->motivation,120) }}
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
