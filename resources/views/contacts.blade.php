@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-blue-600">Contactez-nous</h1>

    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Formulaire à gauche -->
        <div class="md:w-1/2 p-6">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Envoyer</button>
            </form>

            <hr class="my-6">

            <!-- Icônes de contact -->
            <div class="flex justify-between items-center">
                <a href="#" class="text-gray-600 hover:text-blue-500"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="text-gray-600 hover:text-blue-500"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="text-gray-600 hover:text-blue-500"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="tel:+123456789" class="text-gray-600 hover:text-blue-500"><i class="fas fa-phone fa-2x"></i></a>
                <a href="mailto:contact@example.com" class="text-gray-600 hover:text-blue-500"><i class="fas fa-envelope fa-2x"></i></a>
            </div>
        </div>

        <!-- Image à droite -->
        <div class="md:w-1/2">
            <img src="{{ asset('images/contact-image.jpg') }}" alt="Contact" class="w-full h-full object-cover">
        </div>
    </div>
</div>
@endsection
