@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Inscription aux Concours</h1>

    <!-- Boîte de dialogue -->
     <!-- La boîte de dialogue sera insérée ici dynamiquement -->
     <div id="messageCardContainer"></div>

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


    <form id="inscriptionForm" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('concours.submit') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
                Nom
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom') border-red-500 @enderror" id="nom" type="text" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="prenom">
                Prénom
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('prenom') border-red-500 @enderror" id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" required>
            @error('prenom')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                Téléphone
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telephone') border-red-500 @enderror" id="telephone" type="tel" name="telephone" value="{{ old('telephone') }}" required>
            @error('telephone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="type_concours">
                Type de Concours
            </label>
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
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="motivation">
                Motivation (10-500 caractères)
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('motivation') border-red-500 @enderror" id="motivation" name="motivation" rows="4" required>{{ old('motivation') }}</textarea>
            @error('motivation')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="submit">
                S'inscrire
            </button>
        </div>
    </form>
</div>

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

