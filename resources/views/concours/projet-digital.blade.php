@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-4">

    <div id="messageCardContainer"></div>

    <!-- Messages d'alerte --
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

    <h1 class="text-3xl font-bold mb-8 text-center text-green-600">Inscription au Concours de Projet Digital</h1>

    <form id="projetDigitalForm" class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('concours.projet-digital.submit') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type_concours" value="CMPDL"> <!-- ou CMPDS selon le cas -->

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_equipe">Nom de l'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom_equipe') border-red-500 @enderror" id="nom_equipe" type="text" name="nom_equipe" value="{{ old('nom_equipe') }}" required>
            @error('nom_equipe')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="chef_equipe">Chef d'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('chef_equipe') border-red-500 @enderror" id="chef_equipe" type="text" name="chef_equipe" value="{{ old('chef_equipe') }}" required>
            @error('chef_equipe')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email_chef_equipe">Email du chef d'équipe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email_chef_equipe') border-red-500 @enderror" id="email_chef_equipe" type="email" name="email_chef_equipe" value="{{ old('email_chef_equipe') }}" required>
            @error('email_chef_equipe')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="etablissement">Établissement</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('etablissement') border-red-500 @enderror" id="etablissement" type="text" name="etablissement" value="{{ old('etablissement') }}" required>
            @error('etablissement')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="niveau_etude">Niveau d'études</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="niveau_etude" name="niveau_etude" required>
                <option value="">Sélectionnez votre niveau</option>
                <option value="secondaire">Secondaire</option>
                <option value="superieur">Supérieur</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="classe">Classe</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="classe" name="classe" required>
                <option value="">Sélectionnez votre classe</option>
                <!-- Les options seront remplies dynamiquement par JavaScript -->
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="type_concours">Type de concours</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type_concours" name="type_concours" required>
                <option value="">Sélectionnez le type de concours</option>
                <option value="CMPDL">Concours de Meilleur Projet Digital Lycéen (CMPDL)</option>
                <option value="CMPDS">Concours de Meilleur Projet Digital Senior (CMPDS)</option>
            </select>
        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_projet">Nom du projet</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom_projet') border-red-500 @enderror" id="nom_projet" type="text" name="nom_projet" value="{{ old('nom_projet') }}" required>
            @error('nom_projet')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description_projet">Description du projet</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description_projet') border-red-500 @enderror" id="description_projet" name="description_projet" rows="4" required>{{ old('description_projet') }}</textarea>
            @error('description_projet')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="livre_projet">Livre projet (PDF)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('livre_projet') border-red-500 @enderror" id="livre_projet" type="file" name="livre_projet" accept=".pdf">
            @error('livre_projet')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="certificat_scolarite">Certificat de scolarité (PDF)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('certificat_scolarite') border-red-500 @enderror" id="certificat_scolarite" type="file" name="certificat_scolarite" accept=".pdf">
            @error('certificat_scolarite')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="lien_youtube">Lien YouTube de présentation du projet</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lien_youtube') border-red-500 @enderror" id="lien_youtube" type="url" name="lien_youtube" value="{{ old('lien_youtube') }}">
            @error('lien_youtube')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="business_plan">Business plan (PDF)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('business_plan') border-red-500 @enderror" id="business_plan" type="file" name="business_plan" accept=".pdf">
            @error('business_plan')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class=" w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105" type="submit">
                Soumettre le projet
            </button>
        </div>
    </form>
</div>

<div id="messageCardContainer"></div>

@endsection

@section('scripts')
<script>

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

function closeMessageCard() {
    const container = document.getElementById('messageCardContainer');
    container.innerHTML = '';
}

document.addEventListener('DOMContentLoaded', function() {
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

document.addEventListener('DOMContentLoaded', function() {
    const niveauEtude = document.getElementById('niveau_etude');
    const classeSelect = document.getElementById('classe');
    const typeConcours = document.getElementById('type_concours');


    const classesSecondaire = ['6ème', '5ème', '4ème', '3ème', '2nde', '1ère', 'Terminale'];
    const classesSuperieur = ['1ère année', '2ème année', '3ème année', '4ème année', '5ème année'];

    niveauEtude.addEventListener('change', function() {
        classeSelect.innerHTML = '<option value="">Sélectionnez votre classe</option>';
        let options;

        if (this.value === 'secondaire') {
            options = classesSecondaire;
            typeConcours.value = 'CMPDL';
        } else if (this.value === 'superieur') {
            options = classesSuperieur;
            typeConcours.value = 'CMPDS';
        }

            // Prevent manual changes to type_concours
        typeConcours.addEventListener('change', function() {
            const selectedNiveau = niveauEtude.value;
            if (selectedNiveau === 'secondaire' && this.value !== 'CMPDL') {
                this.value = 'CMPDL';
            } else if (selectedNiveau === 'superieur' && this.value !== 'CMPDS') {
                this.value = 'CMPDS';
            }
        });

        if (options) {
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                classeSelect.appendChild(optionElement);
            });
        }
    });


    // Le reste du script pour afficher et fermer les messages reste le même que dans votre code original
});
</script>
@endsection
