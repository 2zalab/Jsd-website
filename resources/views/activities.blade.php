@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>Activités du Forum de l'Innovation</h1>
    <p>{{ $edition->nom }}@if($edition->date_debut && $edition->date_fin) — {{ $edition->date_debut->isoFormat('D') }} au {{ $edition->date_fin->isoFormat('D MMMM YYYY') }}, {{ $edition->lieu }}@endif</p>
</div>

<div class="container max-w-5xl mx-auto px-4 py-12">

    {{-- Hackathon --}}
    <div class="content-section">
        <h2>Hackathon sur les problématiques du Sahel</h2>
        <div class="flex flex-col md:flex-row gap-6 mt-4">
            <img src="{{ asset('images/hackathon.png') }}" alt="Hackathon" class="w-full md:w-1/3 rounded-xl object-cover" loading="lazy" style="max-height:220px;">
            <div class="flex-1">
                <p class="mb-4">Plongez au cœur de l'innovation avec notre Hackathon axé sur les défis uniques du Sahel. Des équipes pluridisciplinaires collaboreront pour concevoir des solutions technologiques innovantes.</p>
                <h3>Détails de l'événement</h3>
                <ul>
                    <li>Durée : plusieurs heures intenses non-stop</li>
                    <li>Équipes : 3 à 5 participants</li>
                    <li>Thèmes : Gestion de l'eau, Agriculture durable, Éducation, Santé</li>
                    <li>Prix : des récompenses substantielles pour les meilleures solutions</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}?panel=hackathon" class="btn btn-primary">
                        <i class="fas fa-rocket"></i> S'inscrire au Hackathon
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Concours Programmation --}}
    <div class="content-section">
        <h2>Concours de Programmation</h2>
        <div class="card-grid-2 mt-4">
            <div>
                <h3 style="color: var(--color-primary-light);">CMPL — Lycéen·ne·s</h3>
                <p class="mb-3">Le CMPL est une opportunité unique pour les lycéens passionnés de programmation de démontrer leurs compétences et leur créativité.</p>
                <ul class="mb-4">
                    <li>Ouvert aux lycéens de tous niveaux</li>
                    <li>Épreuves : Algorithmes, Structures de données, Résolution de problèmes</li>
                    <li>Langages acceptés : Python, Java, C++</li>
                </ul>
                <a href="{{ route('dashboard') }}?panel=programmeur" class="btn btn-primary" style="font-size:.875rem; padding:.5rem 1rem;">Participer au CMPL</a>
            </div>
            <div>
                <h3 style="color: var(--color-success);">CMPS — Senior·e·s</h3>
                <p class="mb-3">Le CMPS met au défi les étudiants universitaires et jeunes professionnels de démontrer leur expertise en programmation avancée.</p>
                <ul class="mb-4">
                    <li>Pour étudiants universitaires et jeunes professionnels</li>
                    <li>Épreuves : Optimisation, Sécurité, IA, Développement Web/Mobile</li>
                    <li>Langages acceptés : tous les langages majeurs</li>
                </ul>
                <a href="{{ route('dashboard') }}?panel=programmeur" class="btn btn-primary" style="background:linear-gradient(135deg,#10b981,#059669); box-shadow:0 4px 14px rgba(16,185,129,.35); font-size:.875rem; padding:.5rem 1rem;">Participer au CMPS</a>
            </div>
        </div>
    </div>

    {{-- Projets Digitaux --}}
    <div class="content-section">
        <h2>Concours de Projets Digitaux</h2>
        <div class="card-grid-2 mt-4">
            <div>
                <h3 style="color: #7c3aed;">CMPDL — Lycéen·ne·s</h3>
                <p class="mb-3">Le CMPDL encourage les lycéens à développer des projets digitaux innovants. C'est l'occasion pour les jeunes esprits créatifs de donner vie à leurs idées.</p>
                <ul class="mb-4">
                    <li>Projets : applications mobiles, sites web, jeux vidéo éducatifs</li>
                    <li>Critères : créativité, faisabilité, impact social</li>
                    <li>Mentorat disponible pour guider les participants</li>
                </ul>
                <a href="{{ route('dashboard') }}?panel=projet-digital" class="btn btn-primary" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed); box-shadow:0 4px 14px rgba(124,58,237,.35); font-size:.875rem; padding:.5rem 1rem;">Soumettre au CMPDL</a>
            </div>
            <div>
                <h3 style="color: #7c3aed;">CMPDS — Senior·e·s</h3>
                <p class="mb-3">Le CMPDS est la plateforme idéale pour étudiants et jeunes entrepreneurs pour présenter leurs projets digitaux les plus ambitieux.</p>
                <ul class="mb-4">
                    <li>Projets : startups tech, solutions B2B, plateformes innovantes</li>
                    <li>Critères : innovation, modèle économique, scalabilité</li>
                    <li>Opportunités de financement et d'incubation pour les meilleurs projets</li>
                </ul>
                <a href="{{ route('dashboard') }}?panel=projet-digital" class="btn btn-primary" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed); box-shadow:0 4px 14px rgba(124,58,237,.35); font-size:.875rem; padding:.5rem 1rem;">Soumettre au CMPDS</a>
            </div>
        </div>
    </div>

    {{-- Table ronde --}}
    <div class="content-section">
        <h2>Table Ronde : Écosystème de l'Innovation dans le Sahel</h2>
        <div class="flex flex-col md:flex-row gap-6 mt-4">
            <img src="{{ asset('images/startup-expo.png') }}" alt="Table Ronde" class="w-full md:w-1/3 rounded-xl object-cover" loading="lazy" style="max-height:220px;">
            <div class="flex-1">
                <p class="mb-4">Cet événement rassemblera des experts, des entrepreneurs et des décideurs politiques pour discuter des défis et opportunités uniques de l'innovation dans la région sahélienne.</p>
                <h3>Points clés</h3>
                <ul>
                    <li>État actuel de l'écosystème d'innovation au Sahel</li>
                    <li>Rôle de la technologie dans le développement durable de la région</li>
                    <li>Opportunités de collaboration entre startups, universités et industries</li>
                    <li>Stratégies pour attirer les investissements et soutenir l'entrepreneuriat local</li>
                </ul>
                <div class="mt-4">
                    <a href="#" class="btn btn-primary" style="background:linear-gradient(135deg,#f59e0b,#d97706); box-shadow:0 4px 14px rgba(245,158,11,.35);">
                        <i class="fas fa-calendar-check"></i> Réserver votre place
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Exposition Startups --}}
    <div class="content-section">
        <h2>Exposition et Visite des Startups</h2>
        <div class="flex flex-col md:flex-row gap-6 mt-4">
            <div class="flex-1">
                <p class="mb-4">Découvrez l'effervescence de l'innovation locale lors de notre exposition de startups. Cet événement mettra en lumière les entreprises les plus prometteuses de la région du Sahel.</p>
                <h3>Ce que vous pouvez attendre</h3>
                <ul>
                    <li>Stands interactifs présentant les dernières innovations technologiques</li>
                    <li>Démonstrations de produits et prototypes</li>
                    <li>Opportunités de networking avec des fondateurs et investisseurs</li>
                    <li>Sessions de pitch où les startups présenteront leurs idées au public</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}?panel=stand" class="btn btn-primary">
                        <i class="fas fa-store"></i> Réserver votre stand
                    </a>
                </div>
            </div>
            <img src="{{ asset('images/startup-expo.png') }}" alt="Exposition Startups" class="w-full md:w-1/3 rounded-xl object-cover" loading="lazy" style="max-height:220px;">
        </div>
    </div>

</div>
@endsection
