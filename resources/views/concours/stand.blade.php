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

    <h1 class="text-3xl font-bold mb-8 text-center text-yellow-600">Réservation de Stand d'Exposition</h1>

    <form id="standReservationForm" class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('concours.stand.submit') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_entreprise">Nom de l'entreprise</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom_entreprise') border-red-500 @enderror" id="nom_entreprise" type="text" name="nom_entreprise" value="{{ old('nom_entreprise') }}" required>
            @error('nom_entreprise')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="secteur_activite">Secteur d'activité</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('secteur_activite') border-red-500 @enderror" id="secteur_activite" type="text" name="secteur_activite" value="{{ old('secteur_activite') }}" required>
            @error('secteur_activite')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="adresse">Adresse</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('adresse') border-red-500 @enderror" id="adresse" type="text" name="adresse" value="{{ old('adresse') }}" required>
            @error('adresse')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email_contact">Email de contact</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email_contact') border-red-500 @enderror" id="email_contact" type="email" name="email_contact" value="{{ old('email_contact') }}" required>
            @error('email_contact')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone_contact">Téléphone de contact</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telephone_contact') border-red-500 @enderror" id="telephone_contact" type="tel" name="telephone_contact" value="{{ old('telephone_contact') }}" required>
            @error('telephone_contact')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="taille_stand">Taille du stand souhaitée</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('taille_stand') border-red-500 @enderror" id="taille_stand" name="taille_stand" required>
                <option value="">Sélectionnez une taille</option>
                <option value="petit">Petit (3m x 3m)</option>
                <option value="moyen">Moyen (4m x 4m)</option>
                <option value="grand">Grand (5m x 5m)</option>
            </select>
            @error('taille_stand')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="besoins_specifiques">Besoins spécifiques</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('besoins_specifiques') border-red-500 @enderror" id="besoins_specifiques" name="besoins_specifiques" rows="4" placeholder="Électricité, mobilier, etc.">{{ old('besoins_specifiques') }}</textarea>
            @error('besoins_specifiques')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-center mt-6">
            <button class=" w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105" type="submit">
                Réserver le stand
            </button>
        </div>
    </form>
</div>

<div id="messageCardContainer"></div>

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

</script>
@endsection
