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
    <h1>Conditions d'utilisation</h1>
    <p class="subtitle">Dernière mise à jour : mars 2026</p>

    <h2>1. Acceptation des conditions</h2>
    <p>En accédant au site des Journées Sahel Digital (JSD), vous acceptez d'être lié par les présentes conditions d'utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser ce site.</p>

    <h2>2. Description du service</h2>
    <p>Le site JSD fournit des informations sur les éditions des Journées Sahel Digital, permet l'inscription aux concours, l'accès aux ressources et la communication avec les organisateurs.</p>

    <h2>3. Utilisation du site</h2>
    <p>Vous vous engagez à utiliser ce site uniquement à des fins licites et de manière à ne pas porter atteinte aux droits de tiers. Il est notamment interdit de :</p>
    <ul>
        <li>Publier des contenus illicites, diffamatoires ou contraires aux bonnes mœurs ;</li>
        <li>Tenter de pirater ou de perturber le fonctionnement du site ;</li>
        <li>Collecter des données personnelles d'autres utilisateurs sans leur consentement ;</li>
        <li>Usurper l'identité d'une autre personne ou entité.</li>
    </ul>

    <h2>4. Propriété intellectuelle</h2>
    <p>L'ensemble des contenus présents sur ce site (textes, images, logos, vidéos) sont protégés par le droit de la propriété intellectuelle et sont la propriété exclusive de JSD ou de ses partenaires. Toute reproduction, même partielle, est interdite sans autorisation préalable.</p>

    <h2>5. Limitation de responsabilité</h2>
    <p>JSD s'efforce de maintenir des informations exactes et à jour sur ce site. Cependant, nous ne pouvons garantir l'exactitude, la complétude ou l'actualité des informations diffusées. L'utilisation des informations fournies se fait sous la responsabilité exclusive de l'utilisateur.</p>

    <h2>6. Modification des conditions</h2>
    <p>JSD se réserve le droit de modifier les présentes conditions à tout moment. Les modifications prennent effet dès leur publication sur le site. Nous vous invitons à consulter régulièrement cette page.</p>

    <h2>7. Contact</h2>
    <p>Pour toute question relative aux présentes conditions, contactez-nous à : <a href="mailto:info@saheldigital.net">info@saheldigital.net</a></p>
</section>
@endsection
