@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>À Propos des JSD</h1>
    <p>{{ $edition->nom }} — Promouvoir l'innovation numérique en Afrique</p>
</div>

<div class="container max-w-5xl mx-auto px-4 py-12">

    <div class="content-section">
        <h2>Contexte &amp; Justification</h2>
        <p>Les Journées Sahel Digital (JSD) sont nées de la nécessité de promouvoir l'entrepreneuriat numérique en Afrique, particulièrement dans la région du Sahel. Face aux défis démographiques et économiques à venir — avec une population africaine qui devrait atteindre 2,4 milliards d'habitants d'ici 2050, dont plus de la moitié aura moins de 25 ans — l'économie numérique représente une opportunité cruciale de croissance et d'emploi.</p>
    </div>

    <div class="content-section">
        <h2>Objectifs</h2>
        <ul>
            <li>Sensibiliser sur les opportunités des Technologies de l'Information et de la Communication (TIC)</li>
            <li>Encourager la créativité et l'entrepreneuriat numérique</li>
            <li>Promouvoir et renforcer la visibilité de l'École Nationale Supérieure Polytechnique de Maroua (ENSPM)</li>
            <li>Favoriser l'insertion socioprofessionnelle à l'ère de l'économie numérique</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Activités Principales</h2>
        <ul>
            <li>Concours du Meilleur Programmeur (CMP)</li>
            <li>Concours de Meilleur Projet Digital (CMPD)</li>
            <li>Leçon inaugurale sur les mythes et réalités de l'entrepreneuriat numérique</li>
            <li>Table ronde sur l'insertion socioprofessionnelle à l'ère de l'économie numérique</li>
            <li>Exposition et visite des startups</li>
        </ul>
    </div>

    @if($stats['participants'] > 0 || $stats['projets'] > 0)
    <div class="content-section">
        <h2>JSD en chiffres — toutes éditions confondues</h2>
        <ul>
            @if($stats['participants'])
            <li>Plus de {{ number_format($stats['participants']) }} participants : élèves, étudiants, entrepreneurs, startupeurs, enseignants-chercheurs et acteurs de la transformation numérique</li>
            @endif
            @if($stats['projets'])
            <li>{{ $stats['projets'] }} projets présentés au Concours de Meilleur Projet Digital, couvrant des thématiques cruciales pour le Sahel</li>
            @endif
            @if($stats['programmeurs'])
            <li>{{ $stats['programmeurs'] }} candidats au Concours du Meilleur Programmeur</li>
            @endif
            <li>Participation de plusieurs startups et de l'entreprise CAMTEL</li>
            <li>Une leçon inaugurale magistrale par le Prof. KOLYANG</li>
            <li>Une table ronde sur l'insertion socioprofessionnelle avec des intervenants de renom</li>
        </ul>
    </div>
    @endif

    <div class="content-section">
        <h2>Perspectives</h2>
        <p>Suite au succès de l'édition 2023, les JSD envisagent de renforcer leurs activités, notamment par&nbsp;:</p>
        <ul>
            <li>La signature d'une convention de partenariat avec ARTEX (Canada) pour une collaboration scientifique</li>
            <li>L'ajout d'activités de renforcement des capacités</li>
            <li>Une participation à la journée nationale de la chambre de commerce numérique</li>
        </ul>
    </div>

    <div class="content-section" style="background: linear-gradient(135deg, #eff6ff, #f0fdfa);">
        <h2 style="border-bottom-color: #bfdbfe;">À propos de l'organisateur</h2>
        <p>Les Journées Sahel Digital sont organisées par le <strong>Département d'Informatique de l'École Nationale Supérieure Polytechnique de Maroua (ENSPM)</strong>, Université de Maroua. L'événement vise à être une vitrine de l'innovation et de l'entrepreneuriat numérique dans la région du Sahel.</p>
    </div>

</div>
@endsection
