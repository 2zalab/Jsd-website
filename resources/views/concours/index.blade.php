@extends('layouts.app')

@section('content')
<div class="container max-w-6xl mx-auto px-2 py-4">
    <h1 class="text-4xl font-bold mb-8 text-center text-blue-600">Participez aux Activités des JSD </h1>
    <p class="intro">Cette section vous permet de vous inscrire et de prendre part à diverses compétitions et événements autour des Journées Sahel Digital (JSD).</p>

    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Conditions générales de participation</h2>
        <p class="mb-4 text-gray-700">Ces concours sont ouverts à tous les étudiant.e.s, élèves et passionnés de technologies répondant aux exigences spécifiques de chaque concours.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4 text-blue-500">
                <i class="fas fa-code mr-2"></i>Concours du Meilleur Programmeur
            </h3>
            <p class="text-gray-700 mb-4">Démontrez vos compétences en programmation et relevez des défis techniques passionnants.</p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Ouvert aux étudiants et aux passionnés de programmation</li>
                <li>Choisissez parmi une variété de langages de programmation</li>
                <li>Deux catégories : Lycéen (CMPL) et Senior (CMPS)</li>
            </ul>
            <a href="{{ route('concours.programmeur') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg text-center transition duration-300 ease-in-out inline-block">
                S'inscrire
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4 text-green-500">
                <i class="fas fa-lightbulb mr-2"></i>Concours du Meilleur Projet Digital
            </h3>
            <p class="text-gray-700 mb-4">Présentez votre projet innovant et montrez comment la technologie peut résoudre des problèmes réels.</p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Projet innovant requis</li>
                <li>Fournir un descriptif du projet, un certificat de scolarité, et une présentation vidéo</li>
                <li>Business plan facultatif mais recommandé</li>
            </ul>
            <a href="{{ route('concours.projet-digital') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg text-center transition duration-300 ease-in-out inline-block">
                S'inscrire
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4 text-purple-500">
                <i class="fas fa-users mr-2"></i>Hackathon
            </h3>
            <p class="text-gray-700 mb-4">Rejoignez une équipe et développez une solution innovante en un temps limité.</p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Formez des équipes de 2 à 5 participants</li>
                <li>Travaillez sur un projet pendant 24 à 48 heures</li>
                <li>Présentez votre solution devant un jury</li>
            </ul>
            <a href="{{ route('concours.hackathon') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg text-center transition duration-300 ease-in-out inline-block">
                S'inscrire
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4 text-yellow-500">
                <i class="fas fa-store mr-2"></i>Réservation de Stand d'Exposition
            </h3>
            <p class="text-gray-700 mb-4">Présentez votre entreprise ou votre projet lors de notre événement.</p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Stands disponibles pour les entreprises et les projets étudiants</li>
                <li>Différentes tailles de stands disponibles</li>
                <li>Opportunité de networking et de présentation</li>
            </ul>
            <a href="{{ route('concours.stand') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-center transition duration-300 ease-in-out inline-block">
                Réserver un stand
            </a>
        </div>
    </div>
</div>

<div id="messageCardContainer"></div>

@endsection

@section('scripts')
<script>
function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const alertClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
    const html = `
        <div class="border ${alertClass} px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">${type === 'success' ? 'Succès!' : 'Erreur!'}</strong>
            <span class="block sm:inline">${message}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.remove()">
                    <title>Fermer</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        </div>
    `;
    container.innerHTML = html;
}

// Afficher le message de succès ou d'erreur s'il existe dans la session
@if(session('success'))
    showMessageCard('success', "{{ session('success') }}");
@endif

@if(session('error'))
    showMessageCard('error', "{{ session('error') }}");
@endif
</script>
@endsection
