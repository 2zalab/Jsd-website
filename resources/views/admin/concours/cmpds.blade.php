<!-- resources/views/admin/concours/cmpds.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets CMPDS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Projets CMPDS</h1>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
            <table class="min-w-full bg-white">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-medium">Nom de l'équipe</th>
                        <th class="py-3 px-4 text-left text-sm font-medium">Chef d'équipe</th>
                        <th class="py-3 px-4 text-left text-sm font-medium">E-mail</th>
                        <th class="py-3 px-4 text-left text-sm font-medium">Établissement</th>
                        <th class="py-3 px-4 text-left text-sm font-medium">Nom du projet</th>
                        <th class="py-3 px-4 text-left text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cmpds as $projet)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $projet->nom_equipe }}</td>
                            <td class="py-3 px-4">{{ $projet->chef_equipe }}</td>
                            <td class="py-3 px-4">{{ $projet->email_chef_equipe }}</td>
                            <td class="py-3 px-4">{{ $projet->etablissement }}</td>
                            <td class="py-3 px-4">{{ $projet->nom_projet }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ $projet->lien_youtube }}" class="text-indigo-600 hover:text-indigo-800">Voir</a>
                                <!-- Ajoute d'autres actions si nécessaire -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
