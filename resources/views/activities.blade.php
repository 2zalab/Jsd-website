@extends('layouts.app')

@section('content')
<div class="container max-w-6xl mx-auto px-2 py-4">
    <h1 class="text-4xl font-bold mb-8 text-center text-blue-600">Activités du Forum de l'Innovation, JSD'24</h1>

    <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Hackathon sur les problématiques du Sahel</h2>
        <div class="flex flex-col md:flex-row gap-6">
            <img src="{{ asset('images/hack.jpg') }}" alt="Hackathon" class="w-full md:w-1/3 rounded-lg">
            <div>
                <p class="mb-4">Plongez au cœur de l'innovation avec notre Hackathon axé sur les défis uniques du Sahel. Pendant des heures intenses, des équipes pluridisciplinaires collaboreront pour concevoir des solutions technologiques innovantes répondant aux problématiques cruciales de la région.</p>
                <h3 class="text-xl font-semibold mb-2">Détails de l'événement :</h3>
                <ul class="list-disc pl-5 mb-4">
                    <li>Durée : des heures non-stop</li>
                    <li>Équipes : 3 à 5 participants</li>
                    <li>Thèmes abordés : Gestion de l'eau, Agriculture durable, Éducation, Santé,et autres</li>
                    <li>Prix : Des récompenses substantielles pour les meilleures solutions</li>
                </ul>
                <p class="mb-4">Rejoignez-nous pour cet événement stimulant et contribuez à façonner l'avenir du Sahel !</p>
                <a href="{{ route('concours.hackathon') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">S'inscrire au Hackathon</a>
            </div>
        </div>
    </section>

    <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Concours de Programmation</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-xl font-semibold mb-2 text-blue-500">Concours Meilleur.e Programmeur.e Lycéen (CMPL)</h3>
                <p class="mb-4">Le CMPL est une opportunité unique pour les lycéens passionnés de programmation de démontrer leurs compétences et leur créativité. Les participants relèveront une série de défis de codage adaptés à leur niveau, couvrant divers langages et concepts de programmation.</p>
                <ul class="list-disc pl-5 mb-4">
                    <li>Ouvert aux lycéens de tous niveaux</li>
                    <li>Épreuves : Algorithmes, Structures de données, Résolution de problèmes</li>
                    <li>Langages acceptés : Python, Java, C++</li>
                </ul>
                <a href="{{ route('concours.programmeur') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">Participer au CMPL</a>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2 text-blue-500">Concours Meilleur.e Programmeur.e Senior (CMPS)</h3>
                <p class="mb-4">Le CMPS met au défi les étudiants universitaires et les jeunes professionnels de démontrer leur expertise en programmation. Ce concours de haut niveau teste les compétences avancées en développement logiciel et en résolution de problèmes complexes.</p>
                <ul class="list-disc pl-5 mb-4">
                    <li>Pour étudiants universitaires et jeunes professionnels</li>
                    <li>Épreuves : Optimisation, Sécurité, IA, Développement Web/Mobile</li>
                    <li>Langages acceptés : Tous les langages majeurs</li>
                </ul>
                <a href="{{ route('concours.programmeur') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">Participer au CMPS</a>
            </div>
        </div>
    </section>

    <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Concours de Projets Digitaux</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-xl font-semibold mb-2 text-purple-500">Concours de Meilleur Projet Digital Lycéen (CMPDL)</h3>
                <p class="mb-4">Le CMPDL encourage les lycéens à développer des projets digitaux innovants. C'est l'occasion parfaite pour les jeunes esprits créatifs de donner vie à leurs idées et de les présenter à un public d'experts.</p>
                <ul class="list-disc pl-5 mb-4">
                    <li>Projets : Applications mobiles, Sites web, Jeux vidéo éducatifs</li>
                    <li>Critères d'évaluation : Créativité, Faisabilité, Impact social</li>
                    <li>Mentorat disponible pour guider les participants</li>
                </ul>
                <a href="{{ route('concours.projet-digital') }}" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded transition duration-300">Soumettre un projet au CMPDL</a>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2 text-purple-500">Concours Meilleur Projet Digital Senior (CMPDS)</h3>
                <p class="mb-4">Le CMPDS est la plateforme idéale pour les étudiants universitaires et les jeunes entrepreneurs pour présenter leurs projets digitaux les plus ambitieux. Ce concours met en lumière les innovations qui ont le potentiel de transformer les industries.</p>
                <ul class="list-disc pl-5 mb-4">
                    <li>Projets : Startups tech, Solutions B2B, Plateformes innovantes</li>
                    <li>Critères d'évaluation : Innovation, Modèle économique, Scalabilité</li>
                    <li>Opportunités de financement et d'incubation pour les meilleurs projets</li>
                </ul>
                <a href="{{ route('concours.projet-digital') }}" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded transition duration-300">Soumettre un projet au CMPDS</a>
            </div>
        </div>
    </section>

    <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Table Ronde : Écosystème de l'innovation dans le Sahel</h2>
        <div class="flex flex-col md:flex-row gap-6">
            <img src="{{ asset('images/conferences.png') }}" alt="Table Ronde" class="w-full md:w-1/3 rounded-lg">
            <div>
                <p class="mb-4">Assistez à notre table ronde exceptionnelle qui servira de leçon inaugurale sur le thème crucial de "l'écosystème de l'innovation dans le Sahel". Cet événement rassemblera des experts, des entrepreneurs et des décideurs politiques pour discuter des défis et des opportunités uniques de l'innovation dans la région sahélienne.</p>
                <h3 class="text-xl font-semibold mb-2">Points clés de la discussion :</h3>
                <ul class="list-disc pl-5 mb-4">
                    <li>État actuel de l'écosystème d'innovation au Sahel</li>
                    <li>Rôle de la technologie dans le développement durable de la région</li>
                    <li>Opportunités de collaboration entre startups, universités et industries</li>
                    <li>Stratégies pour attirer les investissements et soutenir l'entrepreneuriat local</li>
                </ul>
                <p class="mb-4">Ne manquez pas cette opportunité d'acquérir des connaissances précieuses et de participer à des échanges stimulants sur l'avenir de l'innovation dans le Sahel.</p>
                <a href="#" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-300">Réserver votre place</a>
            </div>
        </div>
    </section>

    <section class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Exposition et Visite des Startups</h2>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-2/3">
                <p class="mb-4">Découvrez l'effervescence de l'innovation locale lors de notre exposition de startups. Cet événement mettra en lumière les entreprises les plus prometteuses et les projets innovants issus de la région du Sahel et au-delà.</p>
                <h3 class="text-xl font-semibold mb-2">Ce que vous pouvez attendre :</h3>
                <ul class="list-disc pl-5 mb-4">
                    <li>Stands interactifs présentant les dernières innovations technologiques</li>
                    <li>Démonstrations de produits et prototypes</li>
                    <li>Opportunités de networking avec des fondateurs, investisseurs et experts de l'industrie</li>
                    <li>Sessions de pitch où les startups présenteront leurs idées au public</li>
                </ul>
                <p class="mb-4">Que vous soyez un investisseur potentiel, un futur entrepreneur ou simplement curieux des dernières avancées technologiques, cette exposition est l'endroit idéal pour s'immerger dans l'écosystème startup du Sahel.</p>
                <a href="{{ route('concours.stand') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">Reserver votre stand</a>
            </div>
            <img src="{{ asset('images/startup-expo.png') }}" alt="Exposition Startups" class="w-full md:w-1/3 rounded-lg">
        </div>
    </section>
</div>
@endsection
