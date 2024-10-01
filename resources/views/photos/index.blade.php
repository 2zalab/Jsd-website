@extends('layouts.app')

@section('content')
<div class="container max-w-6xl mx-auto px-2 py-4">
    <h1 class="text-3xl font-bold mb-8 text-center text-blue-600">Galerie Photos</h1>
    <p class="text-xl text-center mb-12">Revivez les moments forts de nos derniers événements</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Photo 1 -->


        <!-- Photo 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/hack.jpg') }}" alt="Hackathon JSD'23" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">CMP JSD'23</h3>
                <p class="text-gray-700">Les équipes en pleine action lors du concours de meilleur programmeur</p>
            </div>
        </div>

        <!-- Photo 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/conferences.png') }}" alt="Panel de discussion JSD'23" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Panel sur l'innovation au Sahel</h3>
                <p class="text-gray-700">Experts et entrepreneurs partagent leurs visions pour l'avenir</p>
            </div>
        </div>


        <!-- Photo 1 - Élèves du lycée de Godola marquant leur présence au JSD'23 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/eleves-godola.jpg') }}" alt="Élèves du lycée de Godola au JSD'23" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Présence des élèves du lycée de Godola</h3>
                <p class="text-gray-700">Les élèves marquant leur présence aux Journées du Savoir Digital 2023.</p>
            </div>
        </div>

        <!-- Photo 2 - Présentation des projets (concours des meilleurs projets digitaux) -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/projet-presentation.jpg') }}" alt="Présentation des projets lors du concours" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Présentation des projets</h3>
                <p class="text-gray-700">Concours des meilleurs projets digitaux lors de JSD'23.</p>
            </div>
        </div>

        <!-- Photo 3 - Secrétariat technique en action (impression des badges) -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/secretariat.jpg') }}" alt="Secrétariat technique en action" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Secrétariat technique en action</h3>
                <p class="text-gray-700">Impression des badges pour les participants au JSD'23.</p>
            </div>
        </div>

        <!-- Photo 4 - Photo de famille à la fin des JSD'23 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/photo-famille.jpg') }}" alt="Photo de famille JSD'23" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Photo de famille</h3>
                <p class="text-gray-700">Photo de groupe à la fin des Journées du Savoir Digital 2023.</p>
            </div>
        </div>

        <!-- Photo 5 - Stand des entreprises partenaires -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/roll-up.jpg') }}" alt="Stand des entreprises partenaires" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Stand des entreprises partenaires</h3>
                <p class="text-gray-700">Les entreprises partenaires présentent leurs solutions au JSD'23.</p>
            </div>
        </div>

        <!-- Photo 6 - Exposition dans les stands -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/startup-expo.png') }}" alt="Exposition dans les stands" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Exposition dans les stands</h3>
                <p class="text-gray-700">Présentation des innovations dans les stands des JSD'23.</p>
            </div>
        </div>

        <!-- Photo 7 - Candidats au concours des meilleurs projets digitaux -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/candidats-cmpd.jpg') }}" alt="Candidats au concours de projets digitaux" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Candidats au concours de projets digitaux</h3>
                <p class="text-gray-700">Les participants au concours des meilleurs projets digitaux du JSD'23.</p>
            </div>
        </div>

        <!-- Photo 8 - Réunion de préparation technique -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/meet.jpg') }}" alt="Réunion de préparation technique" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Réunion de préparation technique</h3>
                <p class="text-gray-700">Les équipes organisatrices en pleine réunion de préparation technique pour JSD'23.</p>
            </div>
        </div>


        <!-- Photo du CM de l'événement -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/touza.jpg') }}" alt="Community Manager de l'événement JSD'23" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">Community Manager de l'événement</h3>
                <p class="text-gray-700">Le CM gérant les communications digitales et l'engagement en ligne durant les JSD'23.</p>
            </div>
        </div>

        <!-- Photo de M. Douwé, membre de l'équipe d'organisation -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="{{ asset('images/photo1.jpg') }}" alt="M. Douwé - Membre de l'équipe d'organisation" class="w-full h-64 object-cover">
        <div class="p-4">
            <h3 class="font-bold text-xl mb-2">M. Douwé et M. Terdam - Membres de l'équipe d'organisation</h3>
            <p class="text-gray-700">Deux acteurs clés dans la planification et l'exécution des Journées du Savoir Digital 2023.</p>
        </div>
    </div>

    <!--div class="mt-12 text-center">
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
            Voir plus de photos
        </a>
    </div-->
</div>
@endsection
