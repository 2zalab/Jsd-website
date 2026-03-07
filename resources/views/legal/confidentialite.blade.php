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
</style>
@endsection

@section('content')
<section class="legal-page">
    <h1>Politique de confidentialité</h1>
    <p class="subtitle">Dernière mise à jour : mars 2026</p>

    <h2>1. Collecte des données</h2>
    <p>Dans le cadre de l'utilisation du site JSD, nous collectons les données personnelles suivantes :</p>
    <ul>
        <li>Nom et prénom lors de l'inscription à un concours ou à la newsletter ;</li>
        <li>Adresse e-mail pour la communication et la newsletter ;</li>
        <li>Numéro de téléphone lors de certaines inscriptions ;</li>
        <li>Données de navigation (cookies, adresse IP) à des fins statistiques.</li>
    </ul>

    <h2>2. Utilisation des données</h2>
    <p>Les données collectées sont utilisées pour :</p>
    <ul>
        <li>Gérer vos inscriptions aux concours et activités ;</li>
        <li>Vous envoyer des informations relatives aux Journées Sahel Digital ;</li>
        <li>Améliorer notre site et nos services ;</li>
        <li>Répondre à vos demandes de contact.</li>
    </ul>

    <h2>3. Conservation des données</h2>
    <p>Vos données sont conservées pendant une durée maximale de 3 ans à compter de votre dernière interaction avec nos services. Passé ce délai, elles sont supprimées ou anonymisées.</p>

    <h2>4. Partage des données</h2>
    <p>Vos données personnelles ne sont pas vendues à des tiers. Elles peuvent être partagées avec des partenaires techniques (hébergement, emailing) dans le strict cadre de la réalisation de l'événement.</p>

    <h2>5. Vos droits</h2>
    <p>Conformément à la réglementation en vigueur, vous disposez des droits suivants :</p>
    <ul>
        <li>Droit d'accès à vos données ;</li>
        <li>Droit de rectification de données inexactes ;</li>
        <li>Droit à l'effacement (droit à l'oubli) ;</li>
        <li>Droit d'opposition au traitement de vos données.</li>
    </ul>
    <p>Pour exercer ces droits, contactez-nous à : <a href="mailto:info@saheldigital.net">info@saheldigital.net</a></p>

    <h2>6. Cookies</h2>
    <p>Ce site utilise des cookies techniques nécessaires à son fonctionnement. Aucun cookie publicitaire ou de traçage tiers n'est utilisé sans votre consentement explicite.</p>
</section>
@endsection
