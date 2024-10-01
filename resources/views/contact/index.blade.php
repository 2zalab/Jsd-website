@extends('layouts.app')

@section('content')
<d class="container mx-auto px-2 py-4">
    <div id="messageCardContainer"></div>

    <!-- Messages d'alerte >
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

    <h1 class="text-3xl font-bold mb-8 text-center text-blue-600">Contactez-nous</h1>
    <p class="intro mb-4 text-center">Nous sommes là pour répondre à vos questions et vous aider. N'hésitez pas à nous contacter !</p>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row">
            <!-- Image à gauche (en haut sur mobile) -->
            <div class="md:w-2/4 md:order-2">
                <img src="{{ asset('images/contact-image-desktop.png') }}" alt="Contactez-nous" class="w-full h-full object-cover hidden md:block">
                <img src="{{ asset('images/contact-image-mobile.png') }}" alt="Contactez-nous" class="w-full h-64 object-cover md:hidden">
            </div>

            <!-- Formulaire à droite -->
            <div class="md:w-2/4 p-8 md:order-1">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">Envoyer</button>
                    </div>
                </form>
                <br>

                <hr class="my-6">
                <br>

                <!-- Nouvelles informations de contact -->
                <div class="flex justify-between items-center">
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center text-blue-500">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+237 697 460 267</span>
                        </div>
                        <div class="flex items-center text-blue-500">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>info@saheldigital.net</span>
                        </div>
                        <div class="flex items-center text-blue-500">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>46 Maroua-Cameroon</span>
                        </div>
                    </div>
                    <div class="w-px h-20 bg-gray-300"></div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-500 hover:text-blue-700">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                        <a href="https://web.facebook.com/profile.php?id=61552171995857" class="text-blue-500 hover:text-blue-700">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://chat.whatsapp.com/G6jhDz9XaTn55yGEdrIlEW" class="text-blue-500 hover:text-blue-700">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                        <a href="#" class="text-blue-500 hover:text-blue-700">
                            <i class="fab fa-x fa-2x"></i>
                        </a>
                        <a href="#" class="text-blue-500 hover:text-blue-700">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
