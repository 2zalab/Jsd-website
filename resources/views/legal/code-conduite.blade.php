@extends('layouts.app')

@section('styles')
@include('legal._styles')
@endsection

@section('content')

{{-- Hero --}}
<section class="lp-hero">
    <div class="lp-hero-inner">
        <div class="lp-hero-icon"><i class="fas fa-handshake-angle"></i></div>
        <h1>Code de conduite</h1>
        <div class="lp-meta">
            <span class="lp-badge"><i class="fas fa-rotate"></i> En vigueur pour toutes les éditions</span>
            <span class="lp-badge"><i class="fas fa-users"></i> Inclusif &amp; Respectueux</span>
        </div>
    </div>
</section>

{{-- Breadcrumb --}}
<div class="lp-breadcrumb">
    <a href="{{ route('home') }}">Accueil</a>
    <span class="sep"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></span>
    <span>Code de conduite</span>
</div>

{{-- Layout --}}
<div class="lp-layout">

    {{-- ToC --}}
    <aside class="lp-toc">
        <div class="lp-toc-title">Sommaire</div>
        <nav>
            <a href="#s0"><span class="toc-num">—</span> Introduction</a>
            <a href="#s1"><span class="toc-num">01</span> Nos valeurs</a>
            <a href="#s2"><span class="toc-num">02</span> Comportements attendus</a>
            <a href="#s3"><span class="toc-num">03</span> Comportements inacceptables</a>
            <a href="#s4"><span class="toc-num">04</span> Signalement</a>
            <a href="#s5"><span class="toc-num">05</span> Conséquences</a>
        </nav>
    </aside>

    {{-- Content --}}
    <main class="lp-content">

        <div class="lp-section" id="s0">
            <div class="lp-section-header">
                <div class="lp-section-num" style="background:linear-gradient(135deg,var(--color-accent),var(--color-primary))">
                    <i class="fas fa-info" style="font-size:.75rem"></i>
                </div>
                <h2>Introduction</h2>
            </div>
            <p>Les Journées Sahel Digital (JSD) s'engagent à offrir un environnement accueillant, inclusif et respectueux pour tous les participants, intervenants, sponsors et membres de l'équipe.</p>
            <p>Ce code de conduite s'applique dans <strong>tous les espaces de l'événement</strong>, en ligne comme en présentiel.</p>
        </div>

        <div class="lp-section" id="s1">
            <div class="lp-section-header">
                <div class="lp-section-num">1</div>
                <h2>Nos valeurs</h2>
            </div>
            <div class="lp-values-grid">
                <div class="lp-value-card">
                    <div class="vc-icon">🤝</div>
                    <strong>Respect</strong>
                    <p>Traitez chaque personne avec dignité et courtoisie, quelle que soit son origine ou ses opinions.</p>
                </div>
                <div class="lp-value-card">
                    <div class="vc-icon">🌍</div>
                    <strong>Inclusion</strong>
                    <p>JSD est ouvert à tous. Nous valorisons la diversité et encourageons la participation de toutes et tous.</p>
                </div>
                <div class="lp-value-card">
                    <div class="vc-icon">💡</div>
                    <strong>Collaboration</strong>
                    <p>Partagez vos connaissances, entraidez-vous et contribuez positivement à la communauté.</p>
                </div>
                <div class="lp-value-card">
                    <div class="vc-icon">🚀</div>
                    <strong>Innovation</strong>
                    <p>Osez proposer de nouvelles idées et remettre en question le statu quo de manière constructive.</p>
                </div>
            </div>
        </div>

        <div class="lp-section" id="s2">
            <div class="lp-section-header">
                <div class="lp-section-num" style="background:linear-gradient(135deg,var(--color-success),#059669)">2</div>
                <h2>Comportements attendus</h2>
            </div>
            <ul class="lp-check-list">
                <li><i class="fas fa-check-circle li-icon ok"></i> Utiliser un langage inclusif et respectueux</li>
                <li><i class="fas fa-check-circle li-icon ok"></i> Respecter les opinions et expériences différentes des vôtres</li>
                <li><i class="fas fa-check-circle li-icon ok"></i> Accepter les critiques constructives avec bienveillance</li>
                <li><i class="fas fa-check-circle li-icon ok"></i> Se concentrer sur ce qui est le mieux pour la communauté</li>
                <li><i class="fas fa-check-circle li-icon ok"></i> Faire preuve d'empathie envers les autres participants</li>
            </ul>
        </div>

        <div class="lp-section" id="s3">
            <div class="lp-section-header">
                <div class="lp-section-num" style="background:linear-gradient(135deg,var(--color-danger),#dc2626)">3</div>
                <h2>Comportements inacceptables</h2>
            </div>
            <ul class="lp-check-list">
                <li><i class="fas fa-times-circle li-icon nok"></i> Harcèlement, intimidation ou discrimination sous quelque forme que ce soit</li>
                <li><i class="fas fa-times-circle li-icon nok"></i> Propos offensants liés au genre, à l'origine ethnique, à la religion ou à toute autre caractéristique personnelle</li>
                <li><i class="fas fa-times-circle li-icon nok"></i> Publication de contenus à caractère sexuel ou violent</li>
                <li><i class="fas fa-times-circle li-icon nok"></i> Perturbation délibérée des présentations ou activités</li>
                <li><i class="fas fa-times-circle li-icon nok"></i> Tout autre comportement raisonnablement considéré comme inapproprié</li>
            </ul>
        </div>

        <div class="lp-section" id="s4">
            <div class="lp-section-header">
                <div class="lp-section-num">4</div>
                <h2>Signalement</h2>
            </div>
            <p>Si vous êtes victime ou témoin d'un comportement contraire à ce code, signalez-le immédiatement à l'équipe organisatrice ou par email à <a href="mailto:info@saheldigital.net">info@saheldigital.net</a>.</p>
            <div class="lp-callout">
                <strong>Confidentialité garantie :</strong> Tout signalement sera traité de manière strictement confidentielle par notre équipe.
            </div>
        </div>

        <div class="lp-section" id="s5">
            <div class="lp-section-header">
                <div class="lp-section-num">5</div>
                <h2>Conséquences</h2>
            </div>
            <p>Tout participant qui ne respecte pas ce code de conduite pourra être exclu de l'événement à la discrétion des organisateurs, sans remboursement ni recours possible.</p>
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
