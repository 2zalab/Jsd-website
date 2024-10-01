@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

        <div id="messageCardContainer"></div>

        <!-- Messages d'alerte -->
         <!--
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



    <h1 class="text-3xl font-bold mb-8 text-center text-blue-600">Inscription au Concours de Meilleur Programmeur</h1>

    <form id="programmeurForm" class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('concours.programmeur.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">Nom</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom') border-red-500 @enderror" id="nom" type="text" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">Téléphone</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telephone') border-red-500 @enderror" id="telephone" type="tel" name="telephone" value="{{ old('telephone') }}" required>
            @error('telephone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="niveau_etude">Niveau d'études</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('niveau_etude') border-red-500 @enderror" id="niveau_etude" name="niveau_etude" required>
                <option value="">Sélectionnez votre niveau</option>
                <option value="secondaire" {{ old('niveau_etude') == 'secondaire' ? 'selected' : '' }}>Secondaire</option>
                <option value="superieur" {{ old('niveau_etude') == 'superieur' ? 'selected' : '' }}>Supérieur</option>
            </select>
            @error('niveau_etude')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="classe">Classe</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('classe') border-red-500 @enderror" id="classe" name="classe" required>
                <option value="">Sélectionnez votre classe</option>
            </select>
            @error('classe')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="etablissement">Etablissement</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('etablissement') border-red-500 @enderror" id="etablissement" type="text" name="etablissement" value="{{ old('etablissement') }}" required>
            @error('etablissement')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="type_concours">Type de Concours</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('type_concours') border-red-500 @enderror" id="type_concours" name="type_concours" required>
                <option value="">Sélectionnez un concours</option>
                @foreach($typesConcours as $value => $label)
                    <option value="{{ $value }}" {{ old('type_concours') == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('type_concours')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Langages de programmation maîtrisés</label>
            <div class="grid grid-cols-2 gap-2 max-h-60 overflow-y-auto">
                @foreach($langagesProgrammation as $langage)
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="langages[]" value="{{ $langage }}" {{ in_array($langage, old('langages', [])) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $langage }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('langages')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class=" w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105" type="submit">
                S'inscrire au Concours
            </button>
        </div>
    </form>
</div>

<div id="messageCardContainer"></div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('programmeurForm');
    const niveauEtude = document.getElementById('niveau_etude');
    const classe = document.getElementById('classe');
    const typeConcours = document.getElementById('type_concours');


    const classesSecondaire = ['6ème', '5ème', '4ème', '3ème', '2nde', '1ère', 'Tle'];
    const classesSuperieur = ['1ère année', '2ème année', '3ème année', '4ème année', '5ème année'];

    function updateClasses() {
        classe.innerHTML = '<option value="">Sélectionnez votre classe</option>';
        let classes = [];

        if (niveauEtude.value === 'secondaire') {
            classes = classesSecondaire;
            typeConcours.value = 'CMPL';
        } else if (niveauEtude.value === 'superieur') {
            classes = classesSuperieur;
            typeConcours.value = 'CMPS';
        }

        typeConcours.addEventListener('change', function() {
            const selectedNiveau = niveauEtude.value;
            if (selectedNiveau === 'secondaire' && this.value !== 'CMPL') {
                this.value = 'CMPL';
            } else if (selectedNiveau === 'superieur' && this.value !== 'CMPS') {
                this.value = 'CMPS';
            }
        });


        classes.forEach(c => {
            const option = document.createElement('option');
            option.value = c;
            option.textContent = c;
            classe.appendChild(option);
        });
    }

    niveauEtude.addEventListener('change', updateClasses);

    // Initial update of classes
    updateClasses();

    form.addEventListener('submit', function(e) {
        const checkedLanguages = document.querySelectorAll('input[name="langages[]"]:checked');
        if (checkedLanguages.length === 0) {
            e.preventDefault();
            showMessageCard('error', "Veuillez sélectionner au moins un langage de programmation.");
            //alert('Veuillez sélectionner au moins un langage de programmation.');
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
