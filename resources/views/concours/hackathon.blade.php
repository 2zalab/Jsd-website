@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-4">

<div id="messageCardContainer"></div>

    <!-- Messages d'alerte
    @if (session('success'))
        <div class="message-container2 message-success">
            <div class="message-content2">
            <div class="message-icon">
                <i class="fas fa-check-circle"></i>
            </div>
                <p class="message-text">{{ session('success') }}</p>
            </div>
            <button class="message-close-button" aria-label="Fermer">
                <i class="fas fa-times"></i>
             </button>
        </div>
    @endif
    <-->

    @if ($errors->any())
        <div class="message-container2 message-error">
            <div class="message-content2">
            <div class="message-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
                <ul class="message-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button class="message-close-button" aria-label="Fermer">
            <i class="fas fa-times"></i>
        </button>
        </div>
    @endif

   @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold mb-8 text-center text-purple-600">Inscription au Hackathon</h1>

    <form id="concoursForm" class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('concours.hackathon.submit') }}">
        @csrf
        <input type="hidden" name="type_concours" value="hackathon">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_equipe">Nom de l'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom_equipe" type="text" name="nom_equipe" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre_participants">Nombre de participants</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre_participants" name="nombre_participants" required>
                <option value="">Sélectionnez le nombre</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_chef_equipe">Nom du chef d'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom_chef_equipe" type="text" name="nom_chef_equipe" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone_chef_equipe">Téléphone du chef d'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone_chef_equipe" type="tel" name="telephone_chef_equipe" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email_chef_equipe">Email du chef d'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email_chef_equipe" type="email" name="email_chef_equipe" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="etablissement">Établissement</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="etablissement" type="text" name="etablissement" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="niveau_etudes">Niveau d'études</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="niveau_etudes" name="niveau_etudes" required>
                <option value="">Sélectionnez le niveau</option>
                <option value="secondaire">Secondaire</option>
                <option value="superieur">Supérieur</option>
            </select>
        </div>

        <div id="classe_container" class="mb-4" style="display: none;">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="classe">Classe</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="classe" name="classe" required>
                <!-- Options will be dynamically populated by JavaScript -->
            </select>
        </div>

        <div id="membres_container">
            <!-- Les champs pour les membres seront ajoutés dynamiquement ici -->
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class="w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105" type="submit">
                S'inscrire au Hackathon
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const niveauEtudes = document.getElementById('niveau_etudes');
    const classeContainer = document.getElementById('classe_container');
    const classeSelect = document.getElementById('classe');
    const nombreParticipants = document.getElementById('nombre_participants');
    const membresContainer = document.getElementById('membres_container');

    const classesSecondaire = ['6ème', '5ème', '4ème', '3ème', '2nde', '1ère', 'Tle'];
    const classesSuperieur = ['1ère année', '2ème année', '3ème année', '4ème année', '5ème année'];

    niveauEtudes.addEventListener('change', function() {
        classeSelect.innerHTML = ''; // Clear previous options
        let options;

        if (this.value === 'secondaire') {
            options = classesSecondaire;
        } else if (this.value === 'superieur') {
            options = classesSuperieur;
        }

        if (options) {
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                classeSelect.appendChild(optionElement);
            });
            classeContainer.style.display = 'block';
        } else {
            classeContainer.style.display = 'none';
        }
    });

    nombreParticipants.addEventListener('change', function() {
        const count = parseInt(this.value);
        membresContainer.innerHTML = ''; // Réinitialiser le conteneur

        for (let i = 2; i <= count; i++) {
            const membreDiv = document.createElement('div');
            membreDiv.className = 'mb-4';
            membreDiv.innerHTML = `
                <label class="block text-gray-700 text-sm font-bold mb-2" for="membre_${i}">Nom du membre ${i}</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="membre_${i}" type="text" name="membres[]" required>
            `;
            membresContainer.appendChild(membreDiv);
        }
    });
});

function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const iconSVG = type === 'success'
        ? '<svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
        : '<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>';

    const cardHTML = `
        <div id="messageCard" class="dialog-overlay">
            <div class="dialog-content">
                <div class="dialog-header">
                    <h3 class="dialog-title">${type === 'success' ? 'Succès' : 'Erreur'}</h3>
                    <button onclick="closeMessageCard()" class="dialog-close-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="dialog-body">
                    <div class="dialog-icon">${iconSVG}</div>
                    <p class="dialog-message">${message}</p>
                </div>
                <div class="dialog-footer">
                    <button onclick="closeMessageCard()" class="dialog-button">Fermer</button>
                </div>
            </div>
        </div>
    `;
    container.innerHTML = cardHTML;
}

// Remplacer l'entrée d'historique actuelle
    if (history.replaceState) {
        history.replaceState(null, '', window.location.href);
    }

function closeMessageCard() {
    const container = document.getElementById('messageCardContainer');
    container.innerHTML = '';
}

document.addEventListener('DOMContentLoaded', function() {

    if (sessionStorage.getItem('messageShown')) {
        // Si le message a déjà été affiché, ne pas le réafficher
        sessionStorage.removeItem('messageShown');
        return;
    }

    @if (session('success'))
        showMessageCard('success', "{{ session('success') }}");
    @endif

    @if (session('error'))
        showMessageCard('error', "{{ session('error') }}");
    @endif
});

document.addEventListener('DOMContentLoaded', function() {
    const closeButtons = document.querySelectorAll('.message-close-button');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.message-container2').style.display = 'none';
        });
    });
});

</script>
@endsection
