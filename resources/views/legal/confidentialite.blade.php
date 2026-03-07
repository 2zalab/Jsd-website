@extends('layouts.app')

@section('styles')
@include('legal._styles')
@endsection

@section('content')

{{-- Hero --}}
<section class="lp-hero">
    <div class="lp-hero-inner">
        <div class="lp-hero-icon"><i class="fas fa-lock"></i></div>
        <h1>Politique de confidentialité</h1>
        <div class="lp-meta">
            <span class="lp-badge"><i class="fas fa-calendar-alt"></i> Dernière mise à jour : mars 2026</span>
            <span class="lp-badge"><i class="fas fa-user-shield"></i> Protection des données</span>
        </div>
    </div>
</section>

{{-- Breadcrumb --}}
<div class="lp-breadcrumb">
    <a href="{{ route('home') }}">Accueil</a>
    <span class="sep"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></span>
    <span>Confidentialité</span>
</div>

{{-- Layout --}}
<div class="lp-layout">

    {{-- ToC --}}
    <aside class="lp-toc">
        <div class="lp-toc-title">Sommaire</div>
        <nav>
            <a href="#s1"><span class="toc-num">01</span> Collecte des données</a>
            <a href="#s2"><span class="toc-num">02</span> Utilisation</a>
            <a href="#s3"><span class="toc-num">03</span> Conservation</a>
            <a href="#s4"><span class="toc-num">04</span> Partage</a>
            <a href="#s5"><span class="toc-num">05</span> Vos droits</a>
            <a href="#s6"><span class="toc-num">06</span> Cookies</a>
        </nav>
    </aside>

    {{-- Content --}}
    <main class="lp-content">

        <div class="lp-section" id="s1">
            <div class="lp-section-header">
                <div class="lp-section-num">1</div>
                <h2>Collecte des données</h2>
            </div>
            <p>Dans le cadre de l'utilisation du site JSD, nous collectons les données personnelles suivantes :</p>
            <ul>
                <li>Nom et prénom lors de l'inscription à un concours ou à la newsletter ;</li>
                <li>Adresse e-mail pour la communication et la newsletter ;</li>
                <li>Numéro de téléphone lors de certaines inscriptions ;</li>
                <li>Données de navigation (cookies, adresse IP) à des fins statistiques.</li>
            </ul>
        </div>

        <div class="lp-section" id="s2">
            <div class="lp-section-header">
                <div class="lp-section-num">2</div>
                <h2>Utilisation des données</h2>
            </div>
            <p>Les données collectées sont utilisées pour :</p>
            <ul>
                <li>Gérer vos inscriptions aux concours et activités ;</li>
                <li>Vous envoyer des informations relatives aux Journées Sahel Digital ;</li>
                <li>Améliorer notre site et nos services ;</li>
                <li>Répondre à vos demandes de contact.</li>
            </ul>
            <div class="lp-callout">
                <strong>Engagement :</strong> Vos données ne sont jamais utilisées à des fins commerciales ou revendues à des tiers à des fins publicitaires.
            </div>
        </div>

        <div class="lp-section" id="s3">
            <div class="lp-section-header">
                <div class="lp-section-num">3</div>
                <h2>Conservation des données</h2>
            </div>
            <p>Vos données sont conservées pendant une durée maximale de <strong>3 ans</strong> à compter de votre dernière interaction avec nos services. Passé ce délai, elles sont supprimées ou anonymisées.</p>
        </div>

        <div class="lp-section" id="s4">
            <div class="lp-section-header">
                <div class="lp-section-num">4</div>
                <h2>Partage des données</h2>
            </div>
            <p>Vos données personnelles ne sont pas vendues à des tiers. Elles peuvent être partagées avec des partenaires techniques (hébergement, emailing) dans le strict cadre de la réalisation de l'événement.</p>
        </div>

        <div class="lp-section" id="s5">
            <div class="lp-section-header">
                <div class="lp-section-num">5</div>
                <h2>Vos droits</h2>
            </div>
            <p>Conformément à la réglementation en vigueur, vous disposez des droits suivants :</p>
            <ul>
                <li>Droit d'accès à vos données ;</li>
                <li>Droit de rectification de données inexactes ;</li>
                <li>Droit à l'effacement (droit à l'oubli) ;</li>
                <li>Droit d'opposition au traitement de vos données.</li>
            </ul>
            <p>Pour exercer ces droits, contactez-nous à : <a href="mailto:info@saheldigital.net">info@saheldigital.net</a></p>
        </div>

        <div class="lp-section" id="s6">
            <div class="lp-section-header">
                <div class="lp-section-num">6</div>
                <h2>Cookies</h2>
            </div>
            <p>Ce site utilise des cookies techniques nécessaires à son fonctionnement. Aucun cookie publicitaire ou de traçage tiers n'est utilisé sans votre consentement explicite.</p>
            <div class="lp-callout">
                <strong>Note :</strong> Vous pouvez configurer votre navigateur pour refuser les cookies. Cela peut toutefois affecter certaines fonctionnalités du site.
            </div>
        </div>

    </main>
</div>

@endsection

@section('scripts')
<script>
const sections = document.querySelectorAll('.lp-section[id]');
const tocLinks = document.querySelectorAll('.lp-toc a');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            tocLinks.forEach(l => l.classList.remove('active'));
            const active = document.querySelector(`.lp-toc a[href="#${entry.target.id}"]`);
            if (active) active.classList.add('active');
        }
    });
}, { rootMargin: '-20% 0px -70% 0px' });
sections.forEach(s => observer.observe(s));
</script>
@endsection
