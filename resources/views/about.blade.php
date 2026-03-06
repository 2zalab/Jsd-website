@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO CINÉMATIQUE
═══════════════════════════════════════════════════ --}}
<section class="about-hero">
    <div class="about-hero__bg" style="background-image:url('{{ asset('images/photo-famille.jpg') }}')"></div>
    <div class="about-hero__overlay"></div>
    <div class="about-hero__content">
        <span class="about-hero__eyebrow">Journées Sahel Digital</span>
        <h1 class="about-hero__title">Bâtir l'Afrique<br><em>numérique</em></h1>
        <p class="about-hero__sub">{{ $edition->nom }} — Promouvoir l'innovation et l'entrepreneuriat numérique dans la région du Sahel</p>
        <div class="about-hero__scroll">
            <span></span>
        </div>
    </div>
    {{-- Vignette droite --}}
    <div class="about-hero__vignette-img" style="background-image:url('{{ asset('images/about-image.png') }}')"></div>
</section>

{{-- ═══════════════════════════════════════════════════
     STATS FLOTTANTES
═══════════════════════════════════════════════════ --}}
@if($globalStats['participants'] > 0 || $globalStats['projets'] > 0)
<section class="about-stats">
    <div class="about-stats__grid">
        @if($globalStats['participants'])
        <div class="about-stat">
            <span class="about-stat__num">{{ number_format($globalStats['participants']) }}+</span>
            <span class="about-stat__label">Participants</span>
        </div>
        @endif
        @if($globalStats['projets'])
        <div class="about-stat">
            <span class="about-stat__num">{{ $globalStats['projets'] }}</span>
            <span class="about-stat__label">Projets présentés</span>
        </div>
        @endif
        @if($globalStats['programmeurs'])
        <div class="about-stat">
            <span class="about-stat__num">{{ $globalStats['programmeurs'] }}</span>
            <span class="about-stat__label">Programmeurs en lice</span>
        </div>
        @endif
        <div class="about-stat">
            <span class="about-stat__num">3+</span>
            <span class="about-stat__label">Éditions réussies</span>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════
     CONTEXTE — Split layout
═══════════════════════════════════════════════════ --}}
<section class="about-split about-split--ltr">
    <div class="about-split__img-wrap">
        <img src="{{ asset('images/hero_1.jpg') }}" alt="Contexte JSD" loading="lazy">
        <div class="about-split__img-badge">
            <i class="fas fa-globe-africa"></i>
            <span>Sahel Digital</span>
        </div>
    </div>
    <div class="about-split__text">
        <span class="about-label">Contexte &amp; Justification</span>
        <h2>Face aux défis de<br>demain, le numérique<br>comme réponse</h2>
        <p>Les Journées Sahel Digital sont nées de la nécessité de promouvoir l'entrepreneuriat numérique en Afrique, particulièrement dans la région du Sahel. Face aux défis démographiques et économiques à venir — avec une population africaine qui devrait atteindre <strong>2,4 milliards d'habitants</strong> d'ici 2050, dont plus de la moitié aura moins de 25 ans — l'économie numérique représente une opportunité cruciale de croissance et d'emploi.</p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     GALERIE MOSAÏQUE
═══════════════════════════════════════════════════ --}}
<section class="about-mosaic">
    <div class="about-mosaic__inner">
        <div class="about-mosaic__cell about-mosaic__cell--tall">
            <img src="{{ asset('images/conference.png') }}" alt="Conférence JSD" loading="lazy">
        </div>
        <div class="about-mosaic__col">
            <div class="about-mosaic__cell">
                <img src="{{ asset('images/eleves-godola.jpg') }}" alt="Élèves Godola" loading="lazy">
            </div>
            <div class="about-mosaic__cell">
                <img src="{{ asset('images/meet.jpg') }}" alt="Réunion JSD" loading="lazy">
            </div>
        </div>
        <div class="about-mosaic__cell about-mosaic__cell--tall">
            <img src="{{ asset('images/hackathon.jpg') }}" alt="Hackathon" loading="lazy">
            <div class="about-mosaic__cell-overlay">
                <span>Moments forts</span>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     OBJECTIFS — Grille graphique
═══════════════════════════════════════════════════ --}}
<section class="about-objectives">
    <div class="about-objectives__header">
        <span class="about-label about-label--light">Nos ambitions</span>
        <h2>Pourquoi les JSD ?</h2>
        <p>Quatre piliers qui guident chacune de nos éditions</p>
    </div>
    <div class="about-objectives__grid">
        <div class="about-obj-card">
            <div class="about-obj-card__icon" style="--clr:#10b981">
                <i class="fas fa-lightbulb"></i>
            </div>
            <h3>Sensibiliser</h3>
            <p>Ouvrir les esprits aux opportunités des Technologies de l'Information et de la Communication</p>
        </div>
        <div class="about-obj-card">
            <div class="about-obj-card__icon" style="--clr:#3b82f6">
                <i class="fas fa-rocket"></i>
            </div>
            <h3>Encourager</h3>
            <p>Stimuler la créativité et l'entrepreneuriat numérique chez les jeunes du Sahel</p>
        </div>
        <div class="about-obj-card">
            <div class="about-obj-card__icon" style="--clr:#8b5cf6">
                <i class="fas fa-university"></i>
            </div>
            <h3>Promouvoir</h3>
            <p>Renforcer la visibilité de l'ENSPM comme pôle d'excellence en ingénierie et technologie</p>
        </div>
        <div class="about-obj-card">
            <div class="about-obj-card__icon" style="--clr:#f59e0b">
                <i class="fas fa-handshake"></i>
            </div>
            <h3>Insérer</h3>
            <p>Favoriser l'insertion socioprofessionnelle à l'ère de l'économie numérique</p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     ACTIVITÉS PRINCIPALES — Split inversé
═══════════════════════════════════════════════════ --}}
<section class="about-split about-split--rtl">
    <div class="about-split__text">
        <span class="about-label">Au programme</span>
        <h2>Activités phares<br>de chaque édition</h2>
        <ul class="about-activities-list">
            <li><i class="fas fa-code"></i> <span>Concours du Meilleur Programmeur <strong>(CMP)</strong></span></li>
            <li><i class="fas fa-laptop-code"></i> <span>Concours de Meilleur Projet Digital <strong>(CMPD)</strong></span></li>
            <li><i class="fas fa-chalkboard-teacher"></i> <span>Leçon inaugurale sur l'entrepreneuriat numérique</span></li>
            <li><i class="fas fa-comments"></i> <span>Table ronde sur l'insertion socioprofessionnelle</span></li>
            <li><i class="fas fa-store"></i> <span>Exposition et visite des startups locales</span></li>
        </ul>
    </div>
    <div class="about-split__img-wrap">
        <img src="{{ asset('images/evaluation_projet.jpg') }}" alt="Activités JSD" loading="lazy">
        <div class="about-split__img-badge about-split__img-badge--right">
            <i class="fas fa-trophy"></i>
            <span>Excellence</span>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     PERSPECTIVES — Fond sombre pleine largeur
═══════════════════════════════════════════════════ --}}
<section class="about-perspectives">
    <div class="about-perspectives__bg" style="background-image:url('{{ asset('images/hero_3.jpg') }}')"></div>
    <div class="about-perspectives__overlay"></div>
    <div class="about-perspectives__content">
        <span class="about-label about-label--light">Horizon 2025+</span>
        <h2>Vers un futur<br>encore plus ambitieux</h2>
        <div class="about-perspectives__items">
            <div class="about-persp-item">
                <i class="fas fa-globe"></i>
                <p>Convention de partenariat avec <strong>ARTEX (Canada)</strong> pour une collaboration scientifique internationale</p>
            </div>
            <div class="about-persp-item">
                <i class="fas fa-graduation-cap"></i>
                <p>Ajout d'activités de <strong>renforcement des capacités</strong> et de formation technique</p>
            </div>
            <div class="about-persp-item">
                <i class="fas fa-building"></i>
                <p>Participation à la <strong>journée nationale de la chambre de commerce numérique</strong></p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     ORGANISATEUR — Carte élégante
═══════════════════════════════════════════════════ --}}
<section class="about-organizer">
    <div class="about-organizer__card">
        <div class="about-organizer__img">
            <img src="{{ asset('images/roll-up.jpg') }}" alt="ENSPM" loading="lazy">
        </div>
        <div class="about-organizer__info">
            <span class="about-label">L'organisateur</span>
            <h2>Département d'Informatique<br>de l'ENSPM</h2>
            <p>Les Journées Sahel Digital sont organisées par le <strong>Département d'Informatique de l'École Nationale Supérieure Polytechnique de Maroua</strong>, Université de Maroua. L'événement vise à être une vitrine de l'innovation et de l'entrepreneuriat numérique dans la région du Sahel.</p>
            <a href="{{ route('contact') }}" class="about-btn">
                <i class="fas fa-envelope"></i> Nous contacter
            </a>
        </div>
    </div>
</section>

<style>
/* ═══════════════════════════════════════════
   ABOUT PAGE — Design élégant
═══════════════════════════════════════════ */

/* ── Hero ── */
.about-hero {
    position: relative;
    height: 92vh;
    min-height: 600px;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.about-hero__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center 30%;
    transform: scale(1.05);
    animation: heroZoom 12s ease-in-out infinite alternate;
}
@keyframes heroZoom {
    from { transform: scale(1.05); }
    to   { transform: scale(1.12) translateX(-1%); }
}
.about-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(105deg,
        rgba(3,20,40,.88) 0%,
        rgba(3,40,30,.65) 55%,
        rgba(0,0,0,.2) 100%);
}
.about-hero__content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    width: 100%;
}
.about-hero__eyebrow {
    display: inline-block;
    background: rgba(16,185,129,.25);
    border: 1px solid rgba(16,185,129,.5);
    color: #6ee7b7;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .18em;
    text-transform: uppercase;
    padding: .4rem 1.1rem;
    border-radius: 100px;
    margin-bottom: 1.4rem;
}
.about-hero__title {
    font-size: clamp(2.8rem, 7vw, 5.5rem);
    font-weight: 900;
    line-height: 1.05;
    color: #fff;
    margin-bottom: 1.4rem;
    letter-spacing: -.02em;
}
.about-hero__title em {
    font-style: normal;
    background: linear-gradient(90deg, #34d399, #6ee7b7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.about-hero__sub {
    font-size: 1.1rem;
    color: rgba(255,255,255,.75);
    max-width: 520px;
    line-height: 1.7;
}
.about-hero__scroll {
    margin-top: 3rem;
}
.about-hero__scroll span {
    display: block;
    width: 1px;
    height: 60px;
    background: linear-gradient(to bottom, rgba(255,255,255,.6), transparent);
    margin: 0 auto;
    animation: scrollLine 2s ease-in-out infinite;
}
@keyframes scrollLine {
    0%,100% { transform: scaleY(1); opacity:1; }
    50%      { transform: scaleY(.5); opacity:.4; }
}
.about-hero__vignette-img {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 38%;
    background-size: cover;
    background-position: center;
    clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%);
    opacity: .18;
}

/* ── Stats ── */
.about-stats {
    background: #0a1628;
    padding: 0;
}
.about-stats__grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0;
}
.about-stat {
    padding: 2.5rem 2rem;
    text-align: center;
    border-right: 1px solid rgba(255,255,255,.07);
    position: relative;
}
.about-stat:last-child { border-right: none; }
.about-stat__num {
    display: block;
    font-size: 2.8rem;
    font-weight: 900;
    background: linear-gradient(135deg, #34d399, #6ee7b7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1.1;
    margin-bottom: .4rem;
}
.about-stat__label {
    display: block;
    font-size: .78rem;
    text-transform: uppercase;
    letter-spacing: .12em;
    color: rgba(255,255,255,.5);
    font-weight: 600;
}

/* ── Split ── */
.about-split {
    max-width: 1200px;
    margin: 0 auto;
    padding: 6rem 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
}
.about-split--rtl { direction: rtl; }
.about-split--rtl > * { direction: ltr; }
.about-split__img-wrap {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 30px 70px rgba(0,0,0,.18);
    aspect-ratio: 4/3;
}
.about-split__img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .8s ease;
}
.about-split__img-wrap:hover img { transform: scale(1.04); }
.about-split__img-badge {
    position: absolute;
    bottom: 1.5rem;
    left: 1.5rem;
    background: rgba(0,0,0,.65);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.15);
    color: #fff;
    padding: .6rem 1.2rem;
    border-radius: 100px;
    display: flex;
    align-items: center;
    gap: .5rem;
    font-size: .82rem;
    font-weight: 600;
}
.about-split__img-badge--right { left: auto; right: 1.5rem; }
.about-split__img-badge i { color: #34d399; }
.about-split__text {}
.about-label {
    display: inline-block;
    font-size: .72rem;
    font-weight: 800;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: #059669;
    margin-bottom: 1rem;
}
.about-label--light { color: #34d399; }
.about-split__text h2 {
    font-size: clamp(1.8rem, 3vw, 2.8rem);
    font-weight: 900;
    line-height: 1.15;
    color: #0f172a;
    margin-bottom: 1.5rem;
    letter-spacing: -.02em;
}
.about-split__text p {
    font-size: 1.05rem;
    color: #475569;
    line-height: 1.8;
}

/* ── Activities list ── */
.about-activities-list {
    list-style: none;
    padding: 0;
    margin-top: 1.5rem;
}
.about-activities-list li {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 1rem;
    color: #334155;
    line-height: 1.5;
}
.about-activities-list li:last-child { border-bottom: none; }
.about-activities-list li i {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    color: #059669;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    margin-top: .1rem;
}

/* ── Mosaïque ── */
.about-mosaic {
    background: #f8fafc;
    padding: 4rem 2rem;
    overflow: hidden;
}
.about-mosaic__inner {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 280px 280px;
    gap: 12px;
}
.about-mosaic__cell {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
}
.about-mosaic__cell img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s ease;
}
.about-mosaic__cell:hover img { transform: scale(1.06); }
.about-mosaic__cell--tall { grid-row: span 2; }
.about-mosaic__col {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.about-mosaic__col .about-mosaic__cell { flex: 1; }
.about-mosaic__cell-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(5,150,105,.85) 0%, transparent 50%);
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: .05em;
    opacity: 0;
    transition: opacity .4s;
}
.about-mosaic__cell:hover .about-mosaic__cell-overlay { opacity: 1; }

/* ── Objectifs ── */
.about-objectives {
    padding: 6rem 2rem;
    background: #fff;
}
.about-objectives__header {
    text-align: center;
    max-width: 580px;
    margin: 0 auto 4rem;
}
.about-objectives__header h2 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 900;
    color: #0f172a;
    margin: .5rem 0 1rem;
    letter-spacing: -.02em;
}
.about-objectives__header p { color: #64748b; font-size: 1.05rem; }
.about-objectives__grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 2rem;
}
.about-obj-card {
    padding: 2.5rem 2rem;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    background: #fff;
    transition: transform .3s, box-shadow .3s;
    position: relative;
    overflow: hidden;
}
.about-obj-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--clr, #10b981);
    border-radius: 3px 3px 0 0;
    transform: scaleX(0);
    transition: transform .35s;
    transform-origin: left;
}
.about-obj-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,.1); }
.about-obj-card:hover::before { transform: scaleX(1); }
.about-obj-card__icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: color-mix(in srgb, var(--clr) 15%, white);
    color: var(--clr);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 1.4rem;
}
.about-obj-card h3 {
    font-size: 1.15rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: .7rem;
}
.about-obj-card p { font-size: .92rem; color: #64748b; line-height: 1.7; }

/* ── Perspectives ── */
.about-perspectives {
    position: relative;
    padding: 7rem 2rem;
    overflow: hidden;
}
.about-perspectives__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
}
.about-perspectives__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(3,40,20,.93) 0%, rgba(3,20,60,.88) 100%);
}
.about-perspectives__content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 auto;
}
.about-perspectives__content h2 {
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 900;
    color: #fff;
    margin: .5rem 0 3rem;
    letter-spacing: -.02em;
    line-height: 1.1;
}
.about-perspectives__items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}
.about-persp-item {
    background: rgba(255,255,255,.07);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 16px;
    padding: 2rem;
    display: flex;
    gap: 1.2rem;
    align-items: flex-start;
    transition: background .3s;
}
.about-persp-item:hover { background: rgba(255,255,255,.12); }
.about-persp-item i {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    background: rgba(52,211,153,.2);
    color: #34d399;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}
.about-persp-item p { color: rgba(255,255,255,.8); font-size: .95rem; line-height: 1.7; margin: 0; }
.about-persp-item strong { color: #fff; }

/* ── Organisateur ── */
.about-organizer {
    padding: 6rem 2rem;
    background: #f8fafc;
}
.about-organizer__card {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 5rem;
    align-items: center;
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,.08);
}
.about-organizer__img {
    height: 100%;
    min-height: 420px;
}
.about-organizer__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.about-organizer__info {
    padding: 3rem 3rem 3rem 0;
}
.about-organizer__info h2 {
    font-size: 1.9rem;
    font-weight: 900;
    color: #0f172a;
    margin: .5rem 0 1.2rem;
    line-height: 1.25;
    letter-spacing: -.02em;
}
.about-organizer__info p {
    color: #475569;
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}
.about-btn {
    display: inline-flex;
    align-items: center;
    gap: .6rem;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    padding: .85rem 2rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: .95rem;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(5,150,105,.35);
    transition: transform .2s, box-shadow .2s;
}
.about-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(5,150,105,.45);
    color: #fff;
}

/* ═══ RESPONSIVE ═══ */
@media (max-width: 900px) {
    .about-hero__vignette-img { display: none; }
    .about-split { grid-template-columns: 1fr; gap: 2.5rem; padding: 3.5rem 1.2rem; }
    .about-split--rtl { direction: ltr; }
    .about-split__img-wrap { aspect-ratio: 16/9; max-height: 280px; }
    .about-mosaic__inner {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 200px 200px 200px;
    }
    .about-mosaic__cell--tall { grid-row: span 1; }
    .about-mosaic__col { display: contents; }
    .about-organizer__card { grid-template-columns: 1fr; }
    .about-organizer__img { min-height: 260px; }
    .about-organizer__info { padding: 2rem; }
}
@media (max-width: 580px) {
    .about-mosaic__inner { grid-template-columns: 1fr; grid-template-rows: auto; }
    .about-mosaic__cell, .about-mosaic__cell--tall { height: 200px; }
    .about-stats__grid { grid-template-columns: 1fr 1fr; }
    .about-stat { border-right: none; border-bottom: 1px solid rgba(255,255,255,.07); }
}
</style>

@endsection
