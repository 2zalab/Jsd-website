@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>Participez aux Activités JSD'24</h1>
    <p>Inscrivez-vous et prenez part aux compétitions et événements des Journées Sahel Digital.</p>
</div>

<div class="container max-w-5xl mx-auto px-4 py-12">

    <div id="messageCardContainer"></div>

    <div class="content-section mb-8">
        <h2>Conditions générales de participation</h2>
        <p>Ces concours sont ouverts à tous les étudiant·e·s, élèves et passionné·e·s de technologies répondant aux exigences spécifiques de chaque concours.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="content-section" style="margin-bottom:0;">
            <h3 style="color: var(--color-primary-light);">
                <i class="fas fa-code mr-2"></i>Concours du Meilleur Programmeur
            </h3>
            <p class="mt-2 mb-4">Démontrez vos compétences en programmation et relevez des défis techniques passionnants.</p>
            <ul class="mb-4">
                <li>Ouvert aux étudiants et aux passionnés de programmation</li>
                <li>Choisissez parmi une variété de langages de programmation</li>
                <li>Deux catégories : Lycéen (CMPL) et Senior (CMPS)</li>
            </ul>
            <a href="{{ route('concours.programmeur') }}" class="btn btn-primary" style="font-size:.875rem;">
                <i class="fas fa-user-plus"></i> S'inscrire
            </a>
        </div>

        <div class="content-section" style="margin-bottom:0;">
            <h3 style="color: var(--color-success);">
                <i class="fas fa-lightbulb mr-2"></i>Meilleur Projet Digital
            </h3>
            <p class="mt-2 mb-4">Présentez votre projet innovant et montrez comment la technologie peut résoudre des problèmes réels.</p>
            <ul class="mb-4">
                <li>Projet innovant requis</li>
                <li>Fournir un descriptif, un certificat de scolarité et une présentation vidéo</li>
                <li>Business plan facultatif mais recommandé</li>
            </ul>
            <a href="{{ route('concours.projet-digital') }}" class="btn btn-primary" style="background:linear-gradient(135deg,#10b981,#059669); box-shadow:0 4px 14px rgba(16,185,129,.35); font-size:.875rem;">
                <i class="fas fa-user-plus"></i> S'inscrire
            </a>
        </div>

        <div class="content-section" style="margin-bottom:0;">
            <h3 style="color: #7c3aed;">
                <i class="fas fa-users mr-2"></i>Hackathon
            </h3>
            <p class="mt-2 mb-4">Rejoignez une équipe et développez une solution innovante en un temps limité.</p>
            <ul class="mb-4">
                <li>Formez des équipes de 2 à 5 participants</li>
                <li>Travaillez sur un projet pendant 24 à 48 heures</li>
                <li>Présentez votre solution devant un jury</li>
            </ul>
            <a href="{{ route('concours.hackathon') }}" class="btn btn-primary" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed); box-shadow:0 4px 14px rgba(124,58,237,.35); font-size:.875rem;">
                <i class="fas fa-user-plus"></i> S'inscrire
            </a>
        </div>

        <div class="content-section" style="margin-bottom:0;">
            <h3 style="color: var(--color-warning);">
                <i class="fas fa-store mr-2"></i>Réservation de Stand d'Exposition
            </h3>
            <p class="mt-2 mb-4">Présentez votre entreprise ou projet lors de notre événement.</p>
            <ul class="mb-4">
                <li>Stands disponibles pour entreprises et projets étudiants</li>
                <li>Différentes tailles de stands disponibles</li>
                <li>Opportunité de networking et de présentation</li>
            </ul>
            <a href="{{ route('concours.stand') }}" class="btn btn-primary" style="background:linear-gradient(135deg,#f59e0b,#d97706); box-shadow:0 4px 14px rgba(245,158,11,.35); font-size:.875rem;">
                <i class="fas fa-store"></i> Réserver un stand
            </a>
        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const cls = type === 'success' ? 'alert-success2' : 'alert-error2';
    container.innerHTML = `
        <div class="alert ${cls} mb-6">
            <span>${message}</span>
            <button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;font-size:1.1rem;">&times;</button>
        </div>`;
}

@if(session('success'))
    showMessageCard('success', "{{ session('success') }}");
@endif
@if(session('error'))
    showMessageCard('error', "{{ session('error') }}");
@endif
</script>
@endsection
