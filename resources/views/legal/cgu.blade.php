@extends('layouts.app')

@section('styles')
@include('legal._styles')
@endsection

@section('content')

{{-- Hero --}}
<section class="lp-hero">
    <div class="lp-hero-inner">
        <div class="lp-hero-icon"><i class="fas fa-file-contract"></i></div>
        <h1>Conditions d'utilisation</h1>
        <div class="lp-meta">
            <span class="lp-badge"><i class="fas fa-calendar-alt"></i> Dernière mise à jour : mars 2026</span>
            <span class="lp-badge"><i class="fas fa-shield-alt"></i> Version 1.0</span>
        </div>
    </div>
</section>

{{-- Breadcrumb --}}
<div class="lp-breadcrumb">
    <a href="{{ route('home') }}">Accueil</a>
    <span class="sep"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></span>
    <span>Conditions d'utilisation</span>
</div>

{{-- Layout --}}
<div class="lp-layout">

    {{-- ToC --}}
    <aside class="lp-toc">
        <div class="lp-toc-title">Sommaire</div>
        <nav>
            <a href="#s1"><span class="toc-num">01</span> Acceptation</a>
            <a href="#s2"><span class="toc-num">02</span> Description</a>
            <a href="#s3"><span class="toc-num">03</span> Utilisation</a>
            <a href="#s4"><span class="toc-num">04</span> Propriété intellectuelle</a>
            <a href="#s5"><span class="toc-num">05</span> Responsabilité</a>
            <a href="#s6"><span class="toc-num">06</span> Modifications</a>
            <a href="#s7"><span class="toc-num">07</span> Contact</a>
        </nav>
    </aside>

    {{-- Content --}}
    <main class="lp-content">

        <div class="lp-section" id="s1">
            <div class="lp-section-header">
                <div class="lp-section-num">1</div>
                <h2>Acceptation des conditions</h2>
            </div>
            <p>En accédant au site des Journées Sahel Digital (JSD), vous acceptez d'être lié par les présentes conditions d'utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser ce site.</p>
            <div class="lp-callout">
                <strong>Important :</strong> L'utilisation du site vaut acceptation pleine et entière des présentes conditions, dans leur version en vigueur au moment de la visite.
            </div>
        </div>

        <div class="lp-section" id="s2">
            <div class="lp-section-header">
                <div class="lp-section-num">2</div>
                <h2>Description du service</h2>
            </div>
            <p>Le site JSD fournit des informations sur les éditions des Journées Sahel Digital, permet l'inscription aux concours, l'accès aux ressources et la communication avec les organisateurs.</p>
        </div>

        <div class="lp-section" id="s3">
            <div class="lp-section-header">
                <div class="lp-section-num">3</div>
                <h2>Utilisation du site</h2>
            </div>
            <p>Vous vous engagez à utiliser ce site uniquement à des fins licites et de manière à ne pas porter atteinte aux droits de tiers. Il est notamment interdit de :</p>
            <ul>
                <li>Publier des contenus illicites, diffamatoires ou contraires aux bonnes mœurs ;</li>
                <li>Tenter de pirater ou de perturber le fonctionnement du site ;</li>
                <li>Collecter des données personnelles d'autres utilisateurs sans leur consentement ;</li>
                <li>Usurper l'identité d'une autre personne ou entité.</li>
            </ul>
        </div>

        <div class="lp-section" id="s4">
            <div class="lp-section-header">
                <div class="lp-section-num">4</div>
                <h2>Propriété intellectuelle</h2>
            </div>
            <p>L'ensemble des contenus présents sur ce site (textes, images, logos, vidéos) sont protégés par le droit de la propriété intellectuelle et sont la propriété exclusive de JSD ou de ses partenaires. Toute reproduction, même partielle, est interdite sans autorisation préalable.</p>
        </div>

        <div class="lp-section" id="s5">
            <div class="lp-section-header">
                <div class="lp-section-num">5</div>
                <h2>Limitation de responsabilité</h2>
            </div>
            <p>JSD s'efforce de maintenir des informations exactes et à jour sur ce site. Cependant, nous ne pouvons garantir l'exactitude, la complétude ou l'actualité des informations diffusées. L'utilisation des informations fournies se fait sous la responsabilité exclusive de l'utilisateur.</p>
        </div>

        <div class="lp-section" id="s6">
            <div class="lp-section-header">
                <div class="lp-section-num">6</div>
                <h2>Modification des conditions</h2>
            </div>
            <p>JSD se réserve le droit de modifier les présentes conditions à tout moment. Les modifications prennent effet dès leur publication sur le site. Nous vous invitons à consulter régulièrement cette page.</p>
        </div>

        <div class="lp-section" id="s7">
            <div class="lp-section-header">
                <div class="lp-section-num">7</div>
                <h2>Contact</h2>
            </div>
            <p>Pour toute question relative aux présentes conditions, contactez-nous à : <a href="mailto:info@saheldigital.net">info@saheldigital.net</a></p>
        </div>

    </main>
</div>

@endsection

@section('scripts')
<script>
// Highlight active ToC link on scroll
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
