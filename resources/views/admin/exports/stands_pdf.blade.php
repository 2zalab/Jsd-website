<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Journées Sahel Digital - Liste des stands</title>

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
    <h2>Liste officielle des entreprises exposantes</h2>

</div>

<p>
<strong>Date de génération :</strong> {{ date('d/m/Y H:i') }} <br>
<strong>Nombre total de stands :</strong> {{ $stands->count() }}
</p>

<table>

<thead>
<tr>
    <th>#</th>
    <th>Entreprise</th>
    <th>Secteur</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Taille</th>
    <th>Statut</th>
</tr>
</thead>

<tbody>

@foreach($stands as $stand)
<tr>
    <td>{{ $stand->id }}</td>
    <td>{{ $stand->nom_entreprise }}</td>
    <td>{{ $stand->secteur_activite }}</td>
    <td>{{ $stand->email_contact }}</td>
    <td>{{ $stand->telephone_contact }}</td>
    <td>{{ $stand->taille_stand }}</td>
    <td>{{ $stand->status }}</td>
</tr>
@endforeach

</tbody>

</table>

<div class="footer">
Document généré automatiquement par la plateforme d'organisation des Journées Sahel Digital
</div>

</body>
</html>
