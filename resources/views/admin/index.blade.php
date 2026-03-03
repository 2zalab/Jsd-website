<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JSD-Admin Dashboard</title>
    <link href="{{ asset('css/admin-nav.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom styles for scrollable sidebar and submenus */
        .sidebar-scroll {
            max-height: calc(100vh - 5rem); /* Adjust based on your header height */
            overflow-y: auto;
        }
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        .submenu {
            background-color: #dde; /* Light green background */
            padding-left: 2.5rem; /* Align submenu items with menu text */
        }
        .menu-icon {
            width: 1.5rem; /* Fixed width for icons */
            text-align: center;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Scrollable Sidebar Menu -->
        <div class="hidden md:flex flex-col w-64 bg-gray-900">
            <div class="flex items-center justify-left h-20 bg-gray-800 shadow-lg px-4">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <h2 class="text-xl font-bold text-white">Dashboard</h2>
                </a>
            </div>
            <div class="sidebar-scroll">
                <ul class="flex flex-col py-2">
                    <!-- Menu Items -->
                    <li class="group">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-chart-bar"></i></span>
                            <span class="text-sm font-medium">Statistiques</span>
                        </a>
                    </li>

                    <li class="group">
                        <a href="{{ route('admin.messages') }}" class="menu-link flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-envelope"></i></span>
                            <span class="text-sm font-medium">Messages</span>
                        </a>
                    </li>

                    <!-- Menu with Submenu -->
                    <li class="group">
                        <a href="#" class="flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-code"></i></span>
                            <span class="text-sm font-medium">Hackaton</span>
                        </a>
                        <!-- Submenu -->
                        <ul class="submenu mt-1 hidden text-gray-600 space-y-2">
                            <li><a href="{{ route('hackathons.lycee') }}" class="menu-link block py-1 hover:text-blue-400">Hackathon Lycée</a></li>
                            <li><a href="{{ route('hackathons.superieur') }}" class="menu-link block py-1 hover:text-blue-400">Hackathon senior</a></li>
                        </ul>
                    </li>

                    <!-- Additional Menus -->
                    <li class="group">
                        <a href="#" class="flex items-center h-12 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-trophy"></i></span>
                            <span class="text-sm font-medium">Concours meilleurs programmeurs</span>
                        </a>
                        <ul class="submenu mt-1 hidden text-gray-600 space-y-2">
                            <li><a href="{{ route('concours.cmpl') }}" class="menu-link block py-1 hover:text-blue-400">Meilleur programmeur lycée</a></li>
                            <li><a href="{{ route('concours.cmps') }}" class="menu-link block py-1 hover:text-blue-400">Meilleur programmeur senior</a></li>
                        </ul>
                    </li>

                    <li class="group">
                        <a href="#" class="flex items-center h-12 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-laptop"></i></span>
                            <span class="text-sm font-medium">Concours meilleurs projets digitaux</span>
                        </a>
                        <ul class="submenu mt-1 hidden text-gray-600 space-y-2">
                            <li><a href="{{ route('concours.cmpdl') }}" class="menu-link block py-1 hover:text-blue-400">Meilleur projet Lycée </a></li>
                            <li><a href="{{ route('concours.cmpds') }}" class="menu-link block py-1 hover:text-blue-400">Meilleur projet senior</a></li>
                        </ul>
                    </li>

                    <!-- Single Menu Items -->
                    <li>
                        <a href="{{ route('admin.stands') }}" class="menu-link flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-store"></i></span>
                            <span class="text-sm font-medium">Réservation stand</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.sponsors') }}" class="menu-link flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <span class="text-sm font-medium">Sponsoring</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.newsletter') }}" class="menu-link flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-envelope"></i></span>
                            <span class="text-sm font-medium">Newsletter</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('register') }}" class="menu-link flex items-center h-10 px-4 text-gray-400 hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-200">
                            <span class="menu-icon"><i class="fas fa-user-plus"></i></span>
                            <span class="text-sm font-medium">Ajouter un administrateur</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mt-auto pb-4">
                <hr class="border-gray-700" />
                <a href="https://2zalab.com" target="_blank" class="flex items-center justify-center mt-4 text-gray-400 hover:text-indigo-400 transition-all ease-in-out duration-200">
                    <span class="text-sm">Designed by 2zalab</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="flex justify-between items-center p-4 bg-white shadow-md">
                <h2 class="text-xl font-semibold">Admin</h2>
                <div class="flex items-center">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('images/user.png') }}" alt="User avatar">
                    <form action="{{ route('logout') }}" method="POST" class="ml-4">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div id="main-content" class="container mx-auto px-4 py-4">
                    <!-- Le contenu sera chargé dynamiquement ici -->
                </div>
            </main>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

         // Function to handle form submissions
    function handleFormSubmit(e) {
        e.preventDefault();
        var form = e.target;
        //var url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();
        //loadContent(url);
        var url = form.action;
        var method = form.method;

        if (form.id === 'search-form') {
            // Gestion de la recherche
            url = url + '?' + new URLSearchParams(new FormData(form)).toString();
            loadContent(url);
        } else if (form.classList.contains('delete-message-form')) {
            // Gestion de la suppression
            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recharger la page des messages
                    loadContent('{{ route("admin.messages") }}');
                } else {
                    console.error('Erreur lors de la suppression du message');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        }
    }

    // Function to attach event listeners to dynamically loaded content
    function attachEventListeners() {
        var searchForm = document.getElementById('search-form');
        if (searchForm) {
            searchForm.removeEventListener('submit', handleFormSubmit);
            searchForm.addEventListener('submit', handleFormSubmit);
        }

        var deleteForms = document.querySelectorAll('.delete-message-form');
        deleteForms.forEach(form => {
            form.removeEventListener('submit', handleFormSubmit);
            form.addEventListener('submit', handleFormSubmit);
        });
    }

        // Fonction pour charger le contenu dans main-content
        function loadContent(url) {
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('main-content').innerHTML = data;
                attachEventListeners();
            })
            .catch(error => {
                console.error('Erreur lors du chargement du contenu:', error);
            });
        }

        // Gestion des clics sur les liens du menu
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var url = this.getAttribute('href');
                loadContent(url);
            });
        });

        // Gestion des sous-menus
        document.querySelectorAll('.group > a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var submenu = this.nextElementSibling;
                if (submenu && submenu.classList.contains('submenu')) {
                    submenu.classList.toggle('hidden');
                }
            });
        });

        // Charger le contenu initial (statistiques)
        loadContent('{{ route("admin.dashboard") }}');
    });


    </script>

    <script>
        // Récupération des données des projets depuis l'attribut data
        const projetsData = document.getElementById('projectsData');
        const projets = JSON.parse(projetsData.dataset.projects);

        function openModal(projectId) {
            const projet = projets.find(p => p.id == projectId);
            if (projet) {
                document.getElementById('modalTitle').textContent = projet.nom_projet;
                document.getElementById('modalContent').innerHTML = `
                    <p class="text-sm text-gray-700 mb-2"><strong>Équipe:</strong> ${projet.nom_equipe}</p>
                    <p class="text-sm text-gray-700 mb-2"><strong>Chef d'équipe:</strong> ${projet.chef_equipe}</p>
                    <p class="text-sm text-gray-700 mb-2"><strong>Email:</strong> ${projet.email_chef_equipe}</p>
                    <p class="text-sm text-gray-700 mb-2"><strong>Établissement:</strong> ${projet.etablissement}</p>
                    <p class="text-sm text-gray-700 mb-4"><strong>Description:</strong> ${projet.description || 'Non disponible'}</p>
                    <a href="${projet.lien_youtube}" target="_blank" class="text-blue-600 hover:text-blue-800">Voir la vidéo YouTube</a>
                `;
                document.getElementById('projectModal').classList.remove('hidden');
            } else {
                alert('Projet non trouvé');
            }
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('projectModal').classList.add('hidden');
        });

        document.addEventListener('DOMContentLoaded', function () {
            const modalButtons = document.querySelectorAll('.open-modal-btn');

            modalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const projectId = this.getAttribute('data-id');
                    openModal(projectId);  // Appel de la fonction openModal avec l'ID du projet
                });
            });
        });

        function deleteProject(projectId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
                // Ici, vous devriez faire une requête AJAX pour supprimer le projet
                console.log('Projet supprimé:', projectId);
                alert('Le projet a été supprimé (simulation)');
                // Recharger la page ou mettre à jour la liste des projets
            }
        }

        document.getElementById('search').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        function downloadPDF() {
            // Simuler le téléchargement d'un PDF
            alert('Téléchargement du PDF en cours (simulation)');
            // Ici, vous devriez implémenter la logique réelle pour générer et télécharger le PDF
        }
    </script>

</body>
</html>
