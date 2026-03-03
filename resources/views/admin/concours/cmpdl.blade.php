<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets CMPDL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold mb-6">Projets CMPDL</h1>

        <!-- Barre de recherche, nombre de projets et bouton PDF -->
        <div class="flex justify-between items-center mb-6">
            <div class="w-1/2">
                <input type="text" id="search" placeholder="Rechercher un projet..." class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="downloadPDF()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-file-pdf mr-2"></i>Télécharger PDF
                </button>
                <div class="text-gray-600">
                    Nombre total de projets : <span class="font-bold">{{ count($cmpdl) }}</span>
                </div>
            </div>
        </div>

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
                    @foreach ($cmpdl as $projet)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $projet->nom_equipe }}</td>
                            <td class="py-3 px-4">{{ $projet->chef_equipe }}</td>
                            <td class="py-3 px-4">{{ $projet->email_chef_equipe }}</td>
                            <td class="py-3 px-4">{{ $projet->etablissement }}</td>
                            <td class="py-3 px-4">{{ $projet->nom_projet }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <button data-id="{{ $projet->id }}" class="open-modal-btn text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="deleteProject('{{ $projet->id }}')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="projectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle"></h3>
                <div class="mt-2 px-7 py-3" id="modalContent">
                    <!-- Le contenu du modal sera injecté ici -->
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Élément avec les données des projets -->
    <div id="projectsData" data-projects="{{ json_encode($cmpdl) }}"></div>

    
</body>
</html>
