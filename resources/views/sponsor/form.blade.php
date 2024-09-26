@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Devenir Sponsor</h1>

     <!-- La boîte de dialogue sera insérée ici dynamiquement -->
     <div id="messageCardContainer"></div>

    <!-- Messages d'alerte -->
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

   @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form id="sponsorForm" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('sponsor.submit') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
                Nom de la structure
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom" type="text" name="nom" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="logo">
                Logo
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="logo" type="file" name="logo" accept="image/*" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="adresse">
                Adresse complète
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="adresse" name="adresse" rows="3" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                Téléphone
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" type="tel" name="telephone" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="motivation">
                Pourquoi devenir sponsor ? (4 lignes max)
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="motivation" name="motivation" rows="4" required></textarea>
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="submit">
                Soumettre
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

