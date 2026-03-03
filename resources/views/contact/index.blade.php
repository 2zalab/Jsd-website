@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>Contactez-nous</h1>
    <p>Nous sommes là pour répondre à vos questions. N'hésitez pas à nous écrire !</p>
</div>

<div class="container max-w-5xl mx-auto px-4 py-12">

    <div id="messageCardContainer"></div>

    @if ($errors->any())
        <div class="alert alert-error2 mb-6">
            <i class="fas fa-exclamation-circle"></i>
            <ul style="list-style:disc; padding-left:1.25rem; margin:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-2xl overflow-hidden border border-gray-100">
        <div class="flex flex-col md:flex-row">

            {{-- Formulaire --}}
            <div class="md:w-1/2 p-8">
                <h2 class="text-xl font-bold mb-6" style="color: var(--color-text);">Envoyez-nous un message</h2>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="form-input" placeholder="Votre nom" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-input" placeholder="vous@exemple.com" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" rows="5"
                                  class="form-input form-textarea" placeholder="Votre message..." required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="submit-button">
                        <i class="fas fa-paper-plane mr-2"></i> Envoyer le message
                    </button>
                </form>

                <hr class="my-6" style="border-color: var(--color-border);">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-sm" style="color: var(--color-text-muted);">
                            <i class="fas fa-phone" style="color: var(--color-primary-light); width:16px;"></i>
                            <span>+237 697 460 267</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm" style="color: var(--color-text-muted);">
                            <i class="fas fa-envelope" style="color: var(--color-primary-light); width:16px;"></i>
                            <span>info@saheldigital.net</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm" style="color: var(--color-text-muted);">
                            <i class="fas fa-map-marker-alt" style="color: var(--color-primary-light); width:16px;"></i>
                            <span>Maroua, Cameroun</span>
                        </div>
                    </div>

                    <div style="width:1px; height:64px; background: var(--color-border);" class="hidden sm:block"></div>

                    <div class="flex gap-3">
                        <a href="#" class="text-blue-500 hover:text-blue-700 transition" aria-label="LinkedIn">
                            <i class="fab fa-linkedin fa-xl"></i>
                        </a>
                        <a href="https://web.facebook.com/profile.php?id=61552171995857" class="text-blue-500 hover:text-blue-700 transition" aria-label="Facebook">
                            <i class="fab fa-facebook fa-xl"></i>
                        </a>
                        <a href="https://chat.whatsapp.com/G6jhDz9XaTn55yGEdrIlEW" class="text-blue-500 hover:text-blue-700 transition" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp fa-xl"></i>
                        </a>
                        <a href="#" class="text-blue-500 hover:text-blue-700 transition" aria-label="Instagram">
                            <i class="fab fa-instagram fa-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="md:w-1/2 hidden md:block">
                <img src="{{ asset('images/secretariat.jpg') }}"
                     alt="Contactez-nous"
                     class="w-full h-full object-cover"
                     style="min-height: 400px;"
                     loading="lazy">
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const cls = type === 'success' ? 'alert-success2' : 'alert-error2';
    const icon = type === 'success'
        ? '<i class="fas fa-check-circle"></i>'
        : '<i class="fas fa-times-circle"></i>';
    container.innerHTML = `
        <div class="alert ${cls} mb-6">
            ${icon}
            <span>${message}</span>
            <button onclick="this.parentElement.remove()"
                    style="margin-left:auto; background:none; border:none; cursor:pointer; font-size:1.1rem;"
                    aria-label="Fermer">&times;</button>
        </div>`;
}

document.addEventListener('DOMContentLoaded', function () {
    @if (session('success'))
        showMessageCard('success', "{{ session('success') }}");
    @endif
    @if (session('error'))
        showMessageCard('error', "{{ session('error') }}");
    @endif
});
</script>
@endsection
