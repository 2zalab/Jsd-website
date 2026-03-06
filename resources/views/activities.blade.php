@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════ --}}
<section class="act-hero">
    <div class="act-hero__bg" style="background-image:url('{{ asset('images/hack.jpg') }}')"></div>
    <div class="act-hero__overlay"></div>
    <div class="act-hero__content">
        <span class="act-eyebrow">
            <i class="fas fa-calendar-alt"></i>
            {{ $edition->nom }}
        </span>
        <h1 class="act-hero__title">Forum de<br><em>l'Innovation</em><br>Numérique</h1>
        @if($edition->date_debut && $edition->date_fin)
        <p class="act-hero__meta">
            <i class="fas fa-map-marker-alt"></i>
            {{ $edition->date_debut->isoFormat('D') }} au {{ $edition->date_fin->isoFormat('D MMMM YYYY') }}
            &nbsp;·&nbsp; {{ $edition->lieu }}
        </p>
        @endif
    </div>
    {{-- Floating pill nav --}}
    <nav class="act-pill-nav">
        <a href="#hackathon"><i class="fas fa-bolt"></i> Hackathon</a>
        <a href="#programmation"><i class="fas fa-code"></i> Programmation</a>
        <a href="#projets"><i class="fas fa-laptop-code"></i> Projets Digitaux</a>
        <a href="#table-ronde"><i class="fas fa-comments"></i> Table Ronde</a>
        <a href="#expo"><i class="fas fa-store"></i> Expo Startups</a>
    </nav>
</section>

{{-- ═══════════════════════════════════════════════════
     HACKATHON — Pleine largeur
═══════════════════════════════════════════════════ --}}
<section class="act-feature act-feature--green" id="hackathon">
    <div class="act-feature__media">
        <img src="{{ asset('images/hackathon.png') }}" alt="Hackathon JSD" loading="lazy">
        <div class="act-feature__media-tag">
            <i class="fas fa-bolt"></i> Hackathon
        </div>
    </div>
    <div class="act-feature__body">
        <span class="act-cat act-cat--green">Innovation intense</span>
        <h2>Hackathon sur les<br>problématiques du Sahel</h2>
        <p class="act-feature__lead">Plongez au cœur de l'innovation avec notre Hackathon axé sur les défis uniques du Sahel. Des équipes pluridisciplinaires collaboreront pour concevoir des solutions technologiques concrètes.</p>
        <ul class="act-details">
            <li><i class="fas fa-clock" style="color:#10b981"></i> <span><strong>Durée</strong> — plusieurs heures intensives non-stop</span></li>
            <li><i class="fas fa-users" style="color:#10b981"></i> <span><strong>Équipes</strong> — 3 à 5 participants par groupe</span></li>
            <li><i class="fas fa-leaf" style="color:#10b981"></i> <span><strong>Thèmes</strong> — Eau, Agriculture, Éducation, Santé</span></li>
            <li><i class="fas fa-trophy" style="color:#10b981"></i> <span><strong>Prix</strong> — récompenses substantielles pour les meilleures solutions</span></li>
        </ul>
        <a href="{{ route('dashboard') }}?panel=hackathon" class="act-btn act-btn--green">
            <i class="fas fa-rocket"></i> S'inscrire au Hackathon
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CONCOURS PROGRAMMATION — Double carte
═══════════════════════════════════════════════════ --}}
<section class="act-duo-section" id="programmation">
    <div class="act-duo-header">
        <span class="act-cat act-cat--blue">Compétition</span>
        <h2>Concours de Programmation</h2>
        <p>Deux niveaux, une même passion pour le code</p>
    </div>
    <div class="act-duo-visual">
        <img src="{{ asset('images/programming-contest.png') }}" alt="Concours programmation" loading="lazy">
        <div class="act-duo-visual__overlay"></div>
    </div>
    <div class="act-duo-cards">
        <div class="act-duo-card act-duo-card--blue">
            <div class="act-duo-card__ribbon">Lycéen·ne·s</div>
            <div class="act-duo-card__icon"><i class="fas fa-graduation-cap"></i></div>
            <h3>CMPL</h3>
            <p>Le CMPL est une opportunité unique pour les lycéens passionnés de programmation de démontrer leurs compétences et leur créativité.</p>
            <ul class="act-mini-list">
                <li>Algorithmes, Structures de données, Résolution de problèmes</li>
                <li>Langages acceptés : Python, Java, C++</li>
                <li>Ouvert aux lycéens de tous niveaux</li>
            </ul>
            <a href="{{ route('dashboard') }}?panel=programmeur" class="act-btn act-btn--blue">Participer au CMPL</a>
        </div>
        <div class="act-duo-card act-duo-card--teal">
            <div class="act-duo-card__ribbon act-duo-card__ribbon--teal">Senior·e·s</div>
            <div class="act-duo-card__icon"><i class="fas fa-terminal"></i></div>
            <h3>CMPS</h3>
            <p>Le CMPS met au défi les étudiants universitaires et jeunes professionnels de démontrer leur expertise en programmation avancée.</p>
            <ul class="act-mini-list">
                <li>Optimisation, Sécurité, IA, Dev Web/Mobile</li>
                <li>Tous les langages majeurs acceptés</li>
                <li>Pour étudiants et jeunes professionnels</li>
            </ul>
            <a href="{{ route('dashboard') }}?panel=programmeur" class="act-btn act-btn--teal">Participer au CMPS</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     GALERIE INTERMÉDIAIRE
═══════════════════════════════════════════════════ --}}
<div class="act-gallery-strip">
    <div class="act-gallery-strip__item">
        <img src="{{ asset('images/eleves-godola.jpg') }}" alt="Élèves en compétition" loading="lazy">
    </div>
    <div class="act-gallery-strip__item act-gallery-strip__item--wide">
        <img src="{{ asset('images/projet-presentation.jpg') }}" alt="Présentation projet" loading="lazy">
        <div class="act-gallery-strip__label">Moments de l'édition précédente</div>
    </div>
    <div class="act-gallery-strip__item">
        <img src="{{ asset('images/evaluation_projet.jpg') }}" alt="Évaluation projet" loading="lazy">
    </div>
    <div class="act-gallery-strip__item">
        <img src="{{ asset('images/candidats-cmpd.jpg') }}" alt="Candidats CMPD" loading="lazy">
    </div>
</div>

{{-- ═══════════════════════════════════════════════════
     PROJETS DIGITAUX — Fond foncé
═══════════════════════════════════════════════════ --}}
<section class="act-dark-section" id="projets">
    <div class="act-dark-section__inner">
        <div class="act-dark-section__header">
            <span class="act-cat act-cat--purple">Création & Innovation</span>
            <h2>Concours de Projets<br>Digitaux</h2>
        </div>
        <div class="act-dark-section__grid">
            <div class="act-proj-card">
                <img src="{{ asset('images/digital-project-contest.png') }}" alt="Projets digitaux" loading="lazy">
                <div class="act-proj-card__content">
                    <span class="act-proj-badge">CMPDL — Lycéen·ne·s</span>
                    <h3>Idées digitales pour lycéens</h3>
                    <p>Encourager les lycéens à développer des projets digitaux innovants. Applications mobiles, sites web, jeux éducatifs — toutes les idées créatives sont les bienvenues.</p>
                    <ul class="act-proj-tags">
                        <li>Apps mobiles</li>
                        <li>Sites web</li>
                        <li>Impact social</li>
                        <li>Mentorat inclus</li>
                    </ul>
                    <a href="{{ route('dashboard') }}?panel=projet-digital" class="act-btn act-btn--purple">Soumettre au CMPDL</a>
                </div>
            </div>
            <div class="act-proj-card">
                <img src="{{ asset('images/photo1.jpg') }}" alt="Startups digitales" loading="lazy">
                <div class="act-proj-card__content">
                    <span class="act-proj-badge">CMPDS — Senior·e·s</span>
                    <h3>Projets ambitieux pour seniors</h3>
                    <p>La plateforme idéale pour étudiants et jeunes entrepreneurs souhaitant présenter leurs projets digitaux les plus innovants à un jury d'experts.</p>
                    <ul class="act-proj-tags">
                        <li>Startups tech</li>
                        <li>Solutions B2B</li>
                        <li>Scalabilité</li>
                        <li>Financement possible</li>
                    </ul>
                    <a href="{{ route('dashboard') }}?panel=projet-digital" class="act-btn act-btn--purple">Soumettre au CMPDS</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     TABLE RONDE — Split inversé
═══════════════════════════════════════════════════ --}}
<section class="act-feature act-feature--amber act-feature--rtl" id="table-ronde">
    <div class="act-feature__media">
        <img src="{{ asset('images/conference.png') }}" alt="Table Ronde" loading="lazy">
        <div class="act-feature__media-tag" style="background:rgba(245,158,11,.9)">
            <i class="fas fa-comments"></i> Table Ronde
        </div>
    </div>
    <div class="act-feature__body">
        <span class="act-cat act-cat--amber">Dialogue & Expertise</span>
        <h2>Table Ronde : Écosystème<br>de l'Innovation au Sahel</h2>
        <p class="act-feature__lead">Experts, entrepreneurs et décideurs politiques se réunissent pour discuter des défis et des opportunités uniques de l'innovation dans la région sahélienne.</p>
        <ul class="act-details">
            <li><i class="fas fa-chart-bar" style="color:#f59e0b"></i> <span>État actuel de l'écosystème d'innovation au Sahel</span></li>
            <li><i class="fas fa-leaf" style="color:#f59e0b"></i> <span>Rôle de la technologie dans le développement durable</span></li>
            <li><i class="fas fa-handshake" style="color:#f59e0b"></i> <span>Collaboration startups, universités et industrie</span></li>
            <li><i class="fas fa-coins" style="color:#f59e0b"></i> <span>Stratégies pour attirer les investissements locaux</span></li>
        </ul>
        <a href="#" class="act-btn act-btn--amber">
            <i class="fas fa-calendar-check"></i> Réserver votre place
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     EXPOSITION STARTUPS — Pleine largeur
═══════════════════════════════════════════════════ --}}
<section class="act-expo" id="expo">
    <div class="act-expo__visual">
        <img src="{{ asset('images/meet.jpg') }}" alt="Expo Startups" loading="lazy">
        <div class="act-expo__visual-overlay"></div>
    </div>
    <div class="act-expo__content">
        <span class="act-cat act-cat--green">Networking & Découverte</span>
        <h2>Exposition &amp;<br>Visite des Startups</h2>
        <p>Découvrez l'effervescence de l'innovation locale lors de notre exposition. L'événement mettra en lumière les entreprises les plus prometteuses de la région du Sahel.</p>
        <div class="act-expo__features">
            <div class="act-expo-feat">
                <i class="fas fa-store"></i>
                <div>
                    <strong>Stands interactifs</strong>
                    <span>Innovations technologiques locales</span>
                </div>
            </div>
            <div class="act-expo-feat">
                <i class="fas fa-vial"></i>
                <div>
                    <strong>Démos &amp; Prototypes</strong>
                    <span>Produits en avant-première</span>
                </div>
            </div>
            <div class="act-expo-feat">
                <i class="fas fa-microphone-alt"></i>
                <div>
                    <strong>Sessions de Pitch</strong>
                    <span>Idées présentées devant un jury</span>
                </div>
            </div>
            <div class="act-expo-feat">
                <i class="fas fa-network-wired"></i>
                <div>
                    <strong>Networking</strong>
                    <span>Fondateurs, investisseurs, mentors</span>
                </div>
            </div>
        </div>
        <a href="{{ route('dashboard') }}?panel=stand" class="act-btn act-btn--green">
            <i class="fas fa-store"></i> Réserver votre stand
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CTA FINAL
═══════════════════════════════════════════════════ --}}
<section class="act-cta">
    <div class="act-cta__bg" style="background-image:url('{{ asset('images/photo-famille.jpg') }}')"></div>
    <div class="act-cta__overlay"></div>
    <div class="act-cta__content">
        <h2>Prêt à rejoindre l'aventure ?</h2>
        <p>Inscrivez-vous maintenant et faites partie des acteurs qui façonnent le futur numérique du Sahel.</p>
        <div class="act-cta__btns">
            <a href="{{ route('dashboard') }}" class="act-btn act-btn--white">
                <i class="fas fa-user-plus"></i> S'inscrire
            </a>
            <a href="{{ route('about') }}" class="act-btn act-btn--ghost">
                <i class="fas fa-info-circle"></i> En savoir plus
            </a>
        </div>
    </div>
</section>

<style>
/* ═══════════════════════════════════════════
   ACTIVITIES PAGE — Design magazine élégant
═══════════════════════════════════════════ */

/* ── Shared ── */
.act-cat {
    display: inline-block;
    font-size: .7rem;
    font-weight: 800;
    letter-spacing: .2em;
    text-transform: uppercase;
    padding: .35rem .9rem;
    border-radius: 100px;
    margin-bottom: 1rem;
}
.act-cat--green  { background: #d1fae5; color: #065f46; }
.act-cat--blue   { background: #dbeafe; color: #1e40af; }
.act-cat--teal   { background: #ccfbf1; color: #134e4a; }
.act-cat--purple { background: #ede9fe; color: #4c1d95; }
.act-cat--amber  { background: #fef3c7; color: #92400e; }

/* ── Hero ── */
.act-hero {
    position: relative;
    height: 90vh;
    min-height: 560px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
}
.act-hero__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center 40%;
    animation: actHeroZoom 14s ease-in-out infinite alternate;
}
@keyframes actHeroZoom {
    from { transform: scale(1.04); }
    to   { transform: scale(1.1) translateY(-1%); }
}
.act-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg,
        rgba(3,20,50,.92) 0%,
        rgba(5,50,30,.72) 60%,
        rgba(0,0,0,.3) 100%);
}
.act-hero__content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    width: 100%;
}
.act-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #34d399;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .15em;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
}
.act-eyebrow i { font-size: .9em; }
.act-hero__title {
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 900;
    line-height: 1.02;
    color: #fff;
    margin-bottom: 1.2rem;
    letter-spacing: -.03em;
}
.act-hero__title em {
    font-style: normal;
    background: linear-gradient(90deg, #34d399, #6ee7b7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.act-hero__meta {
    color: rgba(255,255,255,.65);
    font-size: .95rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.act-hero__meta i { color: #34d399; }
.act-pill-nav {
    position: absolute;
    bottom: 2.5rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    display: flex;
    gap: .6rem;
    flex-wrap: wrap;
    justify-content: center;
    padding: 0 1rem;
}
.act-pill-nav a {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: rgba(255,255,255,.12);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.88);
    padding: .55rem 1.1rem;
    border-radius: 100px;
    font-size: .78rem;
    font-weight: 600;
    text-decoration: none;
    transition: background .25s, border-color .25s, color .25s;
}
.act-pill-nav a:hover {
    background: rgba(52,211,153,.25);
    border-color: rgba(52,211,153,.6);
    color: #fff;
}

/* ── Feature section (split) ── */
.act-feature {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 560px;
}
.act-feature--rtl { direction: rtl; }
.act-feature--rtl > * { direction: ltr; }
.act-feature__media {
    position: relative;
    overflow: hidden;
}
.act-feature__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .7s ease;
}
.act-feature:hover .act-feature__media img { transform: scale(1.04); }
.act-feature__media-tag {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    background: rgba(16,185,129,.9);
    backdrop-filter: blur(8px);
    color: #fff;
    padding: .55rem 1.1rem;
    border-radius: 100px;
    font-size: .8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: .45rem;
}
.act-feature__body {
    padding: 4rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #fff;
}
.act-feature--green .act-feature__body { background: #f0fdf4; }
.act-feature--amber .act-feature__body { background: #fffbeb; }
.act-feature__body h2 {
    font-size: clamp(1.7rem, 2.8vw, 2.5rem);
    font-weight: 900;
    color: #0f172a;
    margin: .4rem 0 1.2rem;
    line-height: 1.18;
    letter-spacing: -.02em;
}
.act-feature__lead {
    font-size: 1.05rem;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 2rem;
}
.act-details {
    list-style: none;
    padding: 0;
    margin: 0 0 2.5rem;
    display: flex;
    flex-direction: column;
    gap: .9rem;
}
.act-details li {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    font-size: .95rem;
    color: #334155;
    line-height: 1.5;
}
.act-details li i { flex-shrink:0; margin-top:.15rem; font-size:1rem; }

/* ── Buttons ── */
.act-btn {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    padding: .85rem 2rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: .95rem;
    text-decoration: none;
    transition: transform .2s, box-shadow .2s;
    align-self: flex-start;
}
.act-btn:hover { transform: translateY(-2px); }
.act-btn--green  { background: linear-gradient(135deg,#059669,#10b981); color:#fff; box-shadow:0 8px 24px rgba(5,150,105,.3); }
.act-btn--green:hover  { box-shadow:0 12px 32px rgba(5,150,105,.45); color:#fff; }
.act-btn--blue   { background: linear-gradient(135deg,#2563eb,#3b82f6); color:#fff; box-shadow:0 8px 24px rgba(37,99,235,.3); }
.act-btn--blue:hover   { box-shadow:0 12px 32px rgba(37,99,235,.45); color:#fff; }
.act-btn--teal   { background: linear-gradient(135deg,#0d9488,#14b8a6); color:#fff; box-shadow:0 8px 24px rgba(13,148,136,.3); }
.act-btn--teal:hover   { box-shadow:0 12px 32px rgba(13,148,136,.45); color:#fff; }
.act-btn--purple { background: linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; box-shadow:0 8px 24px rgba(124,58,237,.3); }
.act-btn--purple:hover { box-shadow:0 12px 32px rgba(124,58,237,.45); color:#fff; }
.act-btn--amber  { background: linear-gradient(135deg,#d97706,#f59e0b); color:#fff; box-shadow:0 8px 24px rgba(217,119,6,.3); }
.act-btn--amber:hover  { box-shadow:0 12px 32px rgba(217,119,6,.45); color:#fff; }
.act-btn--white  { background:#fff; color:#0f172a; box-shadow:0 8px 24px rgba(0,0,0,.15); }
.act-btn--white:hover  { box-shadow:0 12px 32px rgba(0,0,0,.25); color:#0f172a; }
.act-btn--ghost  { background:transparent; color:#fff; border:2px solid rgba(255,255,255,.5); }
.act-btn--ghost:hover  { background:rgba(255,255,255,.1); color:#fff; }

/* ── Duo section (programmation) ── */
.act-duo-section {
    background: #f8fafc;
    padding: 5rem 2rem;
    position: relative;
    overflow: hidden;
}
.act-duo-header {
    text-align: center;
    max-width: 560px;
    margin: 0 auto 3rem;
}
.act-duo-header h2 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 900;
    color: #0f172a;
    margin: .4rem 0 .8rem;
    letter-spacing: -.02em;
}
.act-duo-header p { color: #64748b; font-size: 1rem; }
.act-duo-visual {
    position: relative;
    max-width: 1100px;
    margin: 0 auto 3rem;
    border-radius: 20px;
    overflow: hidden;
    height: 300px;
}
.act-duo-visual img { width:100%; height:100%; object-fit:cover; }
.act-duo-visual__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(30,64,175,.5) 0%, rgba(3,20,50,.8) 100%);
}
.act-duo-cards {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}
.act-duo-card {
    background: #fff;
    border-radius: 20px;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,.07);
    transition: transform .3s, box-shadow .3s;
}
.act-duo-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,.12); }
.act-duo-card__ribbon {
    position: absolute;
    top: 1.2rem;
    right: 1.2rem;
    background: #dbeafe;
    color: #1e40af;
    font-size: .68rem;
    font-weight: 800;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: .3rem .8rem;
    border-radius: 100px;
}
.act-duo-card__ribbon--teal { background: #ccfbf1; color: #134e4a; }
.act-duo-card__icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 1.2rem;
}
.act-duo-card--blue .act-duo-card__icon { background:#dbeafe; color:#2563eb; }
.act-duo-card--teal .act-duo-card__icon { background:#ccfbf1; color:#0d9488; }
.act-duo-card h3 {
    font-size: 1.7rem;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: .8rem;
}
.act-duo-card p { color: #475569; font-size: .95rem; line-height: 1.7; margin-bottom: 1.2rem; }
.act-mini-list {
    list-style: none;
    padding: 0;
    margin: 0 0 1.8rem;
}
.act-mini-list li {
    padding: .45rem 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: .88rem;
    color: #64748b;
    padding-left: 1.2rem;
    position: relative;
}
.act-mini-list li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: #10b981;
    font-weight: 700;
}

/* ── Gallery strip ── */
.act-gallery-strip {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr 1fr;
    height: 260px;
    gap: 6px;
}
.act-gallery-strip__item {
    position: relative;
    overflow: hidden;
}
.act-gallery-strip__item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s ease;
}
.act-gallery-strip__item:hover img { transform: scale(1.08); }
.act-gallery-strip__label {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(to top, rgba(0,0,0,.75), transparent);
    color: #fff;
    font-size: .78rem;
    font-weight: 600;
    padding: .8rem;
    letter-spacing: .05em;
}

/* ── Dark section (projets) ── */
.act-dark-section {
    background: #0a1628;
    padding: 5rem 2rem;
}
.act-dark-section__inner { max-width: 1200px; margin: 0 auto; }
.act-dark-section__header {
    text-align: center;
    margin-bottom: 3.5rem;
}
.act-dark-section__header h2 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 900;
    color: #fff;
    margin: .4rem 0;
    letter-spacing: -.02em;
}
.act-dark-section__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}
.act-proj-card {
    border-radius: 20px;
    overflow: hidden;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    transition: border-color .3s, transform .3s;
}
.act-proj-card:hover {
    border-color: rgba(139,92,246,.5);
    transform: translateY(-4px);
}
.act-proj-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
    transition: transform .6s;
}
.act-proj-card:hover img { transform: scale(1.04); }
.act-proj-card__content { padding: 2rem; }
.act-proj-badge {
    display: inline-block;
    background: rgba(139,92,246,.25);
    border: 1px solid rgba(139,92,246,.4);
    color: #c4b5fd;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: .3rem .85rem;
    border-radius: 100px;
    margin-bottom: 1rem;
}
.act-proj-card__content h3 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: .8rem;
}
.act-proj-card__content p { color: rgba(255,255,255,.6); font-size: .9rem; line-height: 1.7; margin-bottom: 1.2rem; }
.act-proj-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .45rem;
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem;
}
.act-proj-tags li {
    background: rgba(255,255,255,.08);
    color: rgba(255,255,255,.7);
    font-size: .75rem;
    padding: .3rem .7rem;
    border-radius: 100px;
    font-weight: 600;
}

/* ── Expo section ── */
.act-expo {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 600px;
}
.act-expo__visual {
    position: relative;
    overflow: hidden;
}
.act-expo__visual img { width:100%; height:100%; object-fit:cover; }
.act-expo__visual-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, transparent 0%, rgba(240,253,244,.6) 100%);
}
.act-expo__content {
    padding: 4rem;
    background: #f0fdf4;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.act-expo__content h2 {
    font-size: clamp(1.8rem, 2.8vw, 2.6rem);
    font-weight: 900;
    color: #0f172a;
    margin: .4rem 0 1.2rem;
    line-height: 1.18;
    letter-spacing: -.02em;
}
.act-expo__content > p {
    color: #475569;
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}
.act-expo__features {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
    margin-bottom: 2.5rem;
}
.act-expo-feat {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}
.act-expo-feat i {
    width: 42px;
    height: 42px;
    background: #d1fae5;
    color: #059669;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.act-expo-feat div { display: flex; flex-direction: column; }
.act-expo-feat strong { font-size: .92rem; color: #0f172a; font-weight: 700; }
.act-expo-feat span { font-size: .83rem; color: #64748b; }

/* ── CTA final ── */
.act-cta {
    position: relative;
    padding: 7rem 2rem;
    text-align: center;
    overflow: hidden;
}
.act-cta__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center 60%;
}
.act-cta__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(3,20,50,.92), rgba(3,60,30,.88));
}
.act-cta__content {
    position: relative;
    z-index: 2;
    max-width: 600px;
    margin: 0 auto;
}
.act-cta__content h2 {
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 900;
    color: #fff;
    margin-bottom: 1rem;
    letter-spacing: -.02em;
}
.act-cta__content p { color: rgba(255,255,255,.7); font-size: 1.05rem; margin-bottom: 2.5rem; }
.act-cta__btns {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* ═══ RESPONSIVE ═══ */
@media (max-width: 900px) {
    .act-feature, .act-expo { grid-template-columns: 1fr; }
    .act-feature--rtl { direction: ltr; }
    .act-feature__media { height: 280px; }
    .act-feature__body { padding: 2.5rem 1.5rem; }
    .act-duo-cards { grid-template-columns: 1fr; }
    .act-dark-section__grid { grid-template-columns: 1fr; }
    .act-expo__visual { height: 260px; }
    .act-expo__content { padding: 2.5rem 1.5rem; }
    .act-gallery-strip {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 180px 180px;
        height: auto;
    }
    .act-gallery-strip__item--wide { grid-column: span 2; }
    .act-pill-nav { gap: .4rem; }
    .act-pill-nav a { font-size: .7rem; padding: .45rem .85rem; }
}
@media (max-width: 560px) {
    .act-gallery-strip { grid-template-columns: 1fr; height: auto; }
    .act-gallery-strip__item, .act-gallery-strip__item--wide { height: 200px; grid-column: auto; }
    .act-cta__btns { flex-direction: column; align-items: center; }
}
</style>

@endsection
