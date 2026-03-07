@extends('layouts.app')

@section('styles')
<style>
.legal-page { max-width: 860px; margin: 0 auto; padding: var(--space-10) var(--space-6); }
.legal-page h1 { font-size: var(--font-size-3xl); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-2); }
.legal-page .subtitle { color: var(--color-text-muted); margin-bottom: var(--space-8); }
.legal-page h2 { font-size: var(--font-size-xl); font-weight: 600; color: var(--color-text); margin: var(--space-8) 0 var(--space-3); }
.legal-page p, .legal-page li { color: var(--color-text-muted); line-height: 1.7; margin-bottom: var(--space-3); }
.legal-page ul { padding-left: 1.5rem; }
.legal-page ul li { list-style: disc; }
.conduct-card { background: var(--color-surface, #f8f9fa); border-left: 4px solid var(--color-primary, #16a34a); border-radius: 0 var(--radius-md) var(--radius-md) 0; padding: var(--space-4) var(--space-5); margin-bottom: var(--space-4); }
</style>
@endsection

@section('content')
<section class="legal-page">
    <h1>Code de conduite</h1>
    <p class="subtitle">En vigueur pour toutes les éditions des Journées Sahel Digital</p>

    <p>Les Journées Sahel Digital (JSD) s'engagent à offrir un environnement accueillant, inclusif et respectueux pour tous les participants, intervenants, sponsors et membres de l'équipe. Ce code de conduite s'applique dans tous les espaces de l'événement, en ligne comme en présentiel.</p>

    <h2>Nos valeurs</h2>
    <div class="conduct-card">
        <strong>Respect</strong> — Traitez chaque personne avec dignité et courtoisie, quelle que soit son origine, son niveau de compétence ou ses opinions.
    </div>
    <div class="conduct-card">
        <strong>Inclusion</strong> — JSD est ouvert à tous. Nous valorisons la diversité et encourageons la participation de toutes et tous.
    </div>
    <div class="conduct-card">
        <strong>Collaboration</strong> — Partagez vos connaissances, entraidez-vous et contribuez positivement à la communauté.
    </div>
    <div class="conduct-card">
        <strong>Innovation</strong> — Osez proposer de nouvelles idées et remettre en question le statu quo de manière constructive.
    </div>

    <h2>Comportements attendus</h2>
    <ul>
        <li>Utiliser un langage inclusif et respectueux ;</li>
        <li>Respecter les opinions et expériences différentes des vôtres ;</li>
        <li>Accepter les critiques constructives avec bienveillance ;</li>
        <li>Se concentrer sur ce qui est le mieux pour la communauté ;</li>
        <li>Faire preuve d'empathie envers les autres participants.</li>
    </ul>

    <h2>Comportements inacceptables</h2>
    <ul>
        <li>Harcèlement, intimidation ou discrimination sous quelque forme que ce soit ;</li>
        <li>Propos ou comportements offensants liés au genre, à l'origine ethnique, à la religion ou à toute autre caractéristique personnelle ;</li>
        <li>Publication de contenus à caractère sexuel ou violent ;</li>
        <li>Perturbation délibérée des présentations ou activités ;</li>
        <li>Tout autre comportement raisonnablement considéré comme inapproprié.</li>
    </ul>

    <h2>Signalement</h2>
    <p>Si vous êtes victime ou témoin d'un comportement contraire à ce code, signalez-le immédiatement à l'équipe organisatrice ou par email à <a href="mailto:info@saheldigital.net">info@saheldigital.net</a>. Toute signalement sera traité de manière confidentielle.</p>

    <h2>Conséquences</h2>
    <p>Tout participant qui ne respecte pas ce code de conduite pourra être exclu de l'événement à la discrétion des organisateurs, sans remboursement ni recours possible.</p>
</section>
@endsection
