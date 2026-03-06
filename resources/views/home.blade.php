@extends('layouts.app')

@section('styles')
<style>
.hero {
    position: relative;
    min-height: 480px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: none !important;
}
.hero::before { display: none !important; }

.hero-slides { position: absolute; inset: 0; z-index: 0; }
.hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1s ease;
}
.hero-slide.active { opacity: 1; }

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(15,23,42,.78) 0%, rgba(30,64,175,.62) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: var(--container-max);
    width: 100%;
    margin: 0 auto;
    padding: var(--space-16) var(--space-6);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--space-8);
    color: #fff;
}

.hero-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 3;
    background: rgba(255,255,255,.18);
    border: 1px solid rgba(255,255,255,.3);
    backdrop-filter: blur(4px);
    color: #fff;
    font-size: 1.5rem;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
    line-height: 1;
}
.hero-arrow:hover { background: rgba(255,255,255,.32); }
.hero-arrow.prev { left: 1rem; }
.hero-arrow.next { right: 1rem; }

.hero-dots {
    position: absolute;
    bottom: 1.25rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    display: flex;
    gap: .5rem;
}
.hero-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,.45);
    cursor: pointer;
    border: none;
    padding: 0;
    transition: background .2s, transform .2s;
}
.hero-dot.active { background: #fff; transform: scale(1.3); }
</style>
@endsection

@section('content')

{{-- ===== HERO (slider 4 images) ===== --}}
<section class="hero" id="hero-section">

    <div class="hero-slides">
        <div class="hero-slide active" style="background-image:url('{{ asset('images/hero-background.png') }}')"></div>
        <div class="hero-slide"        style="background-image:url('{{ asset('images/hackathon.jpg') }}')"></div>
        <div class="hero-slide"        style="background-image:url('{{ asset('images/projet-presentation.jpg') }}')"></div>
        <div class="hero-slide"        style="background-image:url('{{ asset('images/photo-famille.jpg') }}')"></div>
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="hero-left">
            <h1>Journées<br>Sahel Digital {{ $edition->annee }}</h1>
            @if($edition->theme)
            <p class="subtitle">{{ $edition->theme }}</p>
            @endif
            <hr/>
        </div>
        <div class="hero-right">
            <div class="hero-badge">{{ $edition->numero }}{{ $edition->numero == 1 ? 'ère' : 'ème' }} Édition</div>
            <div class="cta-buttons">
                <a href="{{ route('concours.index') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> S'inscrire aux concours
                </a>
                <a href="{{ route('donate.index') }}" class="btn btn-secondary">
                    <i class="fas fa-donate"></i> Faire un don
                </a>
            </div>
        </div>
    </div>

    <button class="hero-arrow prev" id="hero-prev" aria-label="Image précédente">&#8249;</button>
    <button class="hero-arrow next" id="hero-next" aria-label="Image suivante">&#8250;</button>

    <div class="hero-dots" role="tablist">
        <button class="hero-dot active" data-index="0" aria-label="Image 1"></button>
        <button class="hero-dot"        data-index="1" aria-label="Image 2"></button>
        <button class="hero-dot"        data-index="2" aria-label="Image 3"></button>
        <button class="hero-dot"        data-index="3" aria-label="Image 4"></button>
    </div>
</section>

{{-- ===== COUNTDOWN ===== --}}
<section class="countdown-section">
    <div class="countdown-content">
        <div class="countdown-image">
            <img src="{{ asset('images/developer.png') }}" alt="Développeur avec un ordinateur portable" loading="lazy">
        </div>
        <div class="countdown-text">
            <h2>Le compte à rebours a commencé !</h2>
            <p>Rejoignez-nous pour célébrer l'innovation et l'entrepreneuriat à l'ère de l'intelligence artificielle.</p>

            <div class="countdown-timer">
                <div class="countdown-item">
                    <span id="days">00</span>
                    <p>Jours</p>
                </div>
                <div class="countdown-item">
                    <span id="hours">00</span>
                    <p>Heures</p>
                </div>
                <div class="countdown-item">
                    <span id="minutes">00</span>
                    <p>Minutes</p>
                </div>
                <div class="countdown-item">
                    <span id="seconds">00</span>
                    <p>Secondes</p>
                </div>
            </div>

            <p class="event-description">
                Préparez-vous à découvrir des projets créatifs, à participer à des concours passionnants et à assister à des débats sur les technologies de demain.
                @if($edition->date_debut && $edition->date_fin)
                Ne manquez pas cet événement du <span class="highlight">{{ $edition->date_debut->isoFormat('D') }} au {{ $edition->date_fin->isoFormat('D MMMM YYYY') }}</span>&nbsp;!
                @endif
            </p>
            @if($edition->date_limite_inscription)
            <p class="registration-deadline">
                Inscrivez-vous et soumettez vos projets avant le <span class="highlight">{{ $edition->date_limite_inscription->isoFormat('D MMMM YYYY') }}</span>&nbsp;!
            </p>
            @endif

            <div class="cta-buttons">
                <a href="{{ route('concours.index') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> S'inscrire aux concours
                </a>
                <a href="{{ route('sponsor.form') }}" class="btn btn-secondary2">
                    <i class="fas fa-handshake"></i> Devenir Sponsor
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== PROGRAMME 3 JOURS ===== --}}
@if($edition->date_debut)
<section style="background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%);padding:3rem 0;">
    <div style="max-width:var(--container-max,1200px);margin:0 auto;padding:0 1.5rem;">
        <div style="text-align:center;margin-bottom:2rem;">
            <span style="display:inline-block;background:rgba(99,102,241,.2);color:#a5b4fc;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem 1rem;border-radius:999px;margin-bottom:.75rem;">
                <i class="fas fa-calendar-check"></i>&nbsp; Programme {{ $edition->nom }}
            </span>
            <h2 style="color:#fff;font-size:1.6rem;font-weight:800;margin:0;">
                {{ $edition->date_debut->isoFormat('D') }} – {{ $edition->date_fin ? $edition->date_fin->isoFormat('D MMMM YYYY') : '' }}
                &nbsp;·&nbsp; {{ $edition->lieu }}
            </h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.25rem;">

            {{-- Jour 1 --}}
            <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.5rem;backdrop-filter:blur(6px);transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;">
                    <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:800;color:#fff;flex-shrink:0;">1</div>
                    <div>
                        <div style="color:#a5b4fc;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Jour 1</div>
                        <div style="color:#fff;font-weight:700;font-size:.95rem;">{{ $edition->date_debut->isoFormat('dddd D MMMM') }}</div>
                    </div>
                </div>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.6rem;">
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-flag" style="color:#818cf8;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Cérémonie de lancement
                    </li>
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-laptop-code" style="color:#818cf8;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Évaluation des Projets Digitaux
                    </li>
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-rocket" style="color:#818cf8;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Lancement du Hackathon
                    </li>
                </ul>
            </div>

            {{-- Jour 2 --}}
            <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.5rem;backdrop-filter:blur(6px);transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;">
                    <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:800;color:#fff;flex-shrink:0;">2</div>
                    <div>
                        <div style="color:#6ee7b7;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Jour 2</div>
                        <div style="color:#fff;font-weight:700;font-size:.95rem;">{{ $edition->date_debut->copy()->addDay()->isoFormat('dddd D MMMM') }}</div>
                    </div>
                </div>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.6rem;">
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-code" style="color:#34d399;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Évaluation du Hackathon
                    </li>
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-trophy" style="color:#34d399;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Concours Meilleur Programmeur
                    </li>
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-gift" style="color:#34d399;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Préparation des prix
                    </li>
                </ul>
            </div>

            {{-- Jour 3 --}}
            <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.5rem;backdrop-filter:blur(6px);transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;">
                    <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:800;color:#fff;flex-shrink:0;">3</div>
                    <div>
                        <div style="color:#fcd34d;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Jour 3</div>
                        <div style="color:#fff;font-weight:700;font-size:.95rem;">{{ $edition->date_debut->copy()->addDays(2)->isoFormat('dddd D MMMM') }}</div>
                    </div>
                </div>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.6rem;">
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-award" style="color:#fbbf24;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Remise des prix &amp; récompenses
                    </li>
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#cbd5e1;font-size:.875rem;">
                        <i class="fas fa-flag-checkered" style="color:#fbbf24;margin-top:2px;flex-shrink:0;font-size:.8rem;"></i>
                        Cérémonie de clôture
                    </li>
                    <li style="display:flex;align-items:flex-start;gap:.6rem;color:#94a3b8;font-size:.8rem;font-style:italic;">
                        <i class="fas fa-info-circle" style="color:#64748b;margin-top:2px;flex-shrink:0;font-size:.75rem;"></i>
                        Programme détaillé à finaliser par le secrétariat
                    </li>
                </ul>
            </div>

        </div>{{-- /grid --}}

        <div style="text-align:center;margin-top:1.75rem;">
            <a href="{{ route('concours.index') }}" class="btn btn-primary" style="background:rgba(99,102,241,.9);border-color:transparent;">
                <i class="fas fa-user-plus"></i> S'inscrire maintenant
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===== MOT DU PRÉSIDENT ===== --}}
<section class="pres-section">
    {{-- Fond décoratif --}}
    <div class="pres-deco" aria-hidden="true">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="rgba(16,185,129,.06)" d="M47,-55.4C59.5,-45.2,67.2,-28.3,68.1,-11.3C69,5.7,63.1,22.8,53.1,36.8C43.1,50.7,29,61.6,12,68.5C-5.1,75.3,-25.2,78.1,-41.5,70.7C-57.8,63.3,-70.3,45.7,-74.9,26.5C-79.5,7.4,-76.2,-13.3,-66.8,-29.6C-57.4,-45.8,-41.8,-57.6,-25.6,-66C-9.4,-74.4,7.4,-79.4,22.4,-74.1C37.4,-68.8,34.5,-65.7,47,-55.4Z" transform="translate(100 100)"/>
        </svg>
    </div>

    <div class="pres-inner">

        {{-- ── Photo col ── --}}
        <div class="pres-photo-col">
            <div class="pres-photo-frame">
                <div class="pres-photo-img">
                    <img src="{{ asset('images/pr-kaladzavi.jpg') }}" alt="Pr. Kaladzavi Guidedi" loading="lazy">
                </div>
                {{-- Badge flottant --}}
                <div class="pres-badge">
                    <div class="pres-badge__icon"><i class="fas fa-user-tie"></i></div>
                    <div>
                        <strong>Pr. Kaladzavi Guidedi</strong>
                        <span>Président du Comité d'Organisation</span>
                    </div>
                </div>
                {{-- Ligne décorative --}}
                <div class="pres-photo-accent"></div>
            </div>
        </div>

        {{-- ── Content col ── --}}
        <div class="pres-content-col">
            <span class="pres-eyebrow"><i class="fas fa-quote-left"></i> Message officiel</span>
            <h2 class="pres-title">Mot du <em>Président</em></h2>

            {{-- Grande citation d'accroche --}}
            <blockquote class="pres-quote">
                @if($edition->theme)
                Sous le thème <strong>«&nbsp;{{ $edition->theme }}&nbsp;»</strong>, les {{ $edition->nom }} se veulent un espace de réflexion, de création et d'action.
                @else
                Ensemble, cultivons l'esprit d'innovation pour un Sahel prospère, connecté et résilient.
                @endif
            </blockquote>

            <div class="pres-body">
                <p>Chers participants, chers partenaires,</p>
                <p>C'est avec une immense fierté que je vous souhaite une massive participation à la <strong>{{ $edition->numero }}{{ $edition->numero == 1 ? 'ère' : 'ème' }} édition des Journées Sahel Digital</strong>. Cet événement se veut un espace de réflexion, de création et d'action pour les jeunes talents et entrepreneur·e·s du Sahel.</p>
                <p>En tant que promoteurs de cette initiative, nous croyons fermement que l'avenir du continent africain passe par l'innovation technologique et numérique. L'intelligence artificielle offre des opportunités inédites pour relever les défis socio-économiques auxquels nous sommes confrontés.</p>
                <p>Que vous soyez programmeur·euse, entrepreneur·euse, étudiant·e ou simplement passionné·e du numérique, les JSD sont faites pour vous. <strong>Ensemble, façonnons l'avenir numérique du Sahel&nbsp;!</strong></p>
            </div>

            <div class="pres-footer">
                <div class="pres-signature">
                    <div class="pres-signature__line"></div>
                    <div>
                        <strong>Pr. Kaladzavi Guidedi</strong>
                        <span>Chef de département INFOTEL · ENSPM — UMa</span>
                    </div>
                </div>
                <a href="{{ route('contact.index') }}" class="pres-cta">
                    <i class="fas fa-envelope"></i> Nous contacter
                </a>
            </div>
        </div>

    </div>
</section>

<style>
/* ═══ MOT DU PRÉSIDENT ═══ */
.pres-section {
    position: relative;
    background: linear-gradient(160deg, #f8fafc 0%, #fff 50%, #f0fdf4 100%);
    padding: 6rem 2rem;
    overflow: hidden;
    border-top: 1px solid #e2e8f0;
}
.pres-deco {
    position: absolute;
    top: -120px; right: -120px;
    width: 480px; height: 480px;
    pointer-events: none;
    opacity: .6;
}
.pres-inner {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 5rem;
    align-items: center;
}

/* ── Photo col ── */
.pres-photo-col { position: relative; }
.pres-photo-frame { position: relative; }
.pres-photo-img {
    border-radius: 24px;
    overflow: hidden;
    aspect-ratio: 3/4;
    box-shadow: 0 24px 64px rgba(0,0,0,.13);
    position: relative;
}
.pres-photo-img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 55%, rgba(3,30,20,.6) 100%);
}
.pres-photo-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform .7s;
}
.pres-photo-frame:hover .pres-photo-img img { transform: scale(1.04); }
.pres-photo-accent {
    position: absolute;
    top: -14px; left: -14px;
    width: 100%; height: 100%;
    border: 3px solid #10b981;
    border-radius: 28px;
    z-index: -1;
    opacity: .35;
}
.pres-badge {
    position: absolute;
    bottom: 1.5rem; left: 1.5rem; right: 1.5rem;
    background: rgba(255,255,255,.9);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,.5);
    border-radius: 16px;
    padding: 1rem 1.2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    z-index: 2;
    box-shadow: 0 8px 24px rgba(0,0,0,.12);
}
.pres-badge__icon {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, #059669, #10b981);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.1rem; flex-shrink: 0;
}
.pres-badge strong { display: block; font-size: .9rem; font-weight: 800; color: #0f172a; }
.pres-badge span   { font-size: .78rem; color: #64748b; }

/* ── Content col ── */
.pres-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #059669;
    font-size: .72rem;
    font-weight: 800;
    letter-spacing: .2em;
    text-transform: uppercase;
    margin-bottom: 1rem;
}
.pres-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 900;
    color: #0f172a;
    margin: 0 0 1.8rem;
    line-height: 1.1;
    letter-spacing: -.03em;
}
.pres-title em {
    font-style: normal;
    background: linear-gradient(90deg, #059669, #10b981);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.pres-quote {
    position: relative;
    margin: 0 0 2rem;
    padding: 1.5rem 1.75rem 1.5rem 2.5rem;
    background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
    border-left: 4px solid #10b981;
    border-radius: 0 16px 16px 0;
    font-size: 1.08rem;
    font-style: italic;
    color: #1e3a2f;
    line-height: 1.7;
}
.pres-quote::before {
    content: '\201C';
    position: absolute;
    top: -.4rem; left: .8rem;
    font-size: 4.5rem;
    font-family: Georgia, serif;
    color: #10b981;
    opacity: .4;
    line-height: 1;
}

.pres-body { margin-bottom: 2.5rem; }
.pres-body p {
    color: #475569;
    font-size: .97rem;
    line-height: 1.8;
    margin-bottom: 1rem;
}
.pres-body p:last-child { margin-bottom: 0; }

.pres-footer {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}
.pres-signature {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.pres-signature__line {
    width: 3px;
    height: 40px;
    background: linear-gradient(to bottom, #10b981, #6ee7b7);
    border-radius: 2px;
    flex-shrink: 0;
}
.pres-signature strong { display: block; font-size: .92rem; font-weight: 800; color: #0f172a; }
.pres-signature span   { font-size: .78rem; color: #64748b; }
.pres-cta {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .7rem 1.6rem;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    border-radius: 12px;
    font-weight: 700;
    font-size: .88rem;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(5,150,105,.28);
    transition: transform .2s, box-shadow .2s;
}
.pres-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(5,150,105,.4);
    color: #fff;
}

@media (max-width: 960px) {
    .pres-inner { grid-template-columns: 1fr; gap: 3rem; }
    .pres-photo-img { aspect-ratio: 4/3; max-height: 400px; }
}
@media (max-width: 560px) {
    .pres-section { padding: 4rem 1.25rem; }
    .pres-footer { flex-direction: column; align-items: flex-start; }
}
</style>

{{-- ===== ACTIVITÉS ===== --}}
<section class="act-section">

    {{-- En-tête section --}}
    <div class="act-header">
        <div>
            <span class="act-eyebrow"><i class="fas fa-bolt"></i> Programme {{ $edition->annee }}</span>
            <h2 class="act-title">Activités <em>phares</em></h2>
        </div>
        <p class="act-subtitle">Hackathons, concours de programmation, expositions de startups et conférences inspirantes — 3 jours d'innovation en immersion.</p>
    </div>

    @if($activites->isNotEmpty())
    @php $featured = $activites->first(); $others = $activites->slice(1)->take(4); @endphp

    {{-- ── Activité vedette ── --}}
    <div class="act-featured">
        @if($featured->image)
        <div class="act-featured__img">
            <img src="{{ asset('images/' . $featured->image) }}" alt="{{ $featured->titre }}" loading="lazy">
            <div class="act-featured__img-overlay"></div>
        </div>
        @endif
        <div class="act-featured__body">
            <span class="act-tag act-tag--star">
                <i class="fas fa-star"></i> Activité phare
            </span>
            <h3>{{ $featured->titre }}</h3>
            <p>{{ $featured->description }}</p>
            <div class="act-featured__meta">
                <div class="act-meta-pill"><i class="fas fa-calendar-alt"></i> 3 jours</div>
                <div class="act-meta-pill"><i class="fas fa-users"></i> Ouvert à tous</div>
                <div class="act-meta-pill"><i class="fas fa-trophy"></i> Prix à gagner</div>
            </div>
            <a href="{{ route('concours.hackathon') }}" class="act-cta-btn">
                <i class="fas fa-rocket"></i> S'inscrire maintenant
                <span class="act-cta-btn__arrow"><i class="fas fa-arrow-right"></i></span>
            </a>
        </div>
    </div>

    {{-- ── Autres activités ── --}}
    @if($others->count())
    <div class="act-grid">
        @foreach($others as $idx => $activite)
        @php
            $palette = [
                ['icon'=>'fa-laptop-code',  'color'=>'#6366f1', 'bg'=>'#eef2ff'],
                ['icon'=>'fa-trophy',        'color'=>'#f59e0b', 'bg'=>'#fffbeb'],
                ['icon'=>'fa-lightbulb',     'color'=>'#10b981', 'bg'=>'#f0fdf4'],
                ['icon'=>'fa-microphone-alt','color'=>'#ec4899', 'bg'=>'#fdf2f8'],
            ];
            $p = $palette[$idx % count($palette)];
        @endphp
        <div class="act-card">
            @if($activite->image)
            <div class="act-card__img">
                <img src="{{ asset('images/' . $activite->image) }}" alt="{{ $activite->titre }}" loading="lazy">
                <div class="act-card__img-cover"></div>
                <div class="act-card__icon-float" style="background:{{ $p['bg'] }};color:{{ $p['color'] }}">
                    <i class="fas {{ $p['icon'] }}"></i>
                </div>
            </div>
            @else
            <div class="act-card__no-img" style="background:{{ $p['bg'] }}">
                <i class="fas {{ $p['icon'] }}" style="color:{{ $p['color'] }};font-size:2rem;"></i>
            </div>
            @endif
            <div class="act-card__body">
                <h4>{{ $activite->titre }}</h4>
                <p>{{ Str::limit($activite->description, 110) }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @else
    <div class="act-empty">
        <div class="act-empty__icon"><i class="fas fa-calendar-plus"></i></div>
        <h3>Activités bientôt annoncées</h3>
        <p>Le programme de {{ $edition->nom }} sera publié prochainement. Restez connectés&nbsp;!</p>
    </div>
    @endif

    <div class="act-see-all">
        <a href="{{ route('activities') }}" class="act-see-all__btn">
            Voir toutes les activités <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<style>
/* ═══ ACTIVITÉS ═══ */
.act-section {
    background: #f8fafc;
    padding: 6rem 2rem;
    border-top: 1px solid #e2e8f0;
}
.act-header {
    max-width: 1200px;
    margin: 0 auto 3rem;
    display: flex;
    align-items: flex-end;
    gap: 3rem;
    flex-wrap: wrap;
}
.act-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #6366f1;
    font-size: .72rem;
    font-weight: 800;
    letter-spacing: .2em;
    text-transform: uppercase;
    margin-bottom: .8rem;
}
.act-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 900;
    color: #0f172a;
    margin: 0;
    line-height: 1.1;
    letter-spacing: -.03em;
}
.act-title em {
    font-style: normal;
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.act-subtitle {
    flex: 1;
    min-width: 240px;
    color: #64748b;
    font-size: .97rem;
    line-height: 1.7;
    margin: 0;
    padding-bottom: .3rem;
}

/* ── Activité vedette ── */
.act-featured {
    max-width: 1200px;
    margin: 0 auto 1.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 16px 50px rgba(0,0,0,.1);
    min-height: 380px;
    background: #fff;
}
.act-featured__img {
    position: relative;
    overflow: hidden;
}
.act-featured__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .7s;
}
.act-featured:hover .act-featured__img img { transform: scale(1.05); }
.act-featured__img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(99,102,241,.3) 0%, transparent 70%);
}
.act-featured__body {
    padding: 2.5rem 2.8rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1rem;
}
.act-tag {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    font-size: .68rem;
    font-weight: 800;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: .3rem .9rem;
    border-radius: 100px;
}
.act-tag--star {
    background: linear-gradient(135deg, #ede9fe, #ddd6fe);
    color: #6d28d9;
}
.act-featured__body h3 {
    font-size: 1.6rem;
    font-weight: 900;
    color: #0f172a;
    margin: 0;
    line-height: 1.2;
}
.act-featured__body p {
    color: #475569;
    font-size: .97rem;
    line-height: 1.75;
    margin: 0;
}
.act-featured__meta {
    display: flex;
    gap: .6rem;
    flex-wrap: wrap;
}
.act-meta-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: #f1f5f9;
    color: #475569;
    font-size: .75rem;
    font-weight: 600;
    padding: .35rem .9rem;
    border-radius: 100px;
}
.act-meta-pill i { color: #6366f1; }
.act-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: .7rem;
    padding: .85rem 1.8rem;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    color: #fff;
    border-radius: 14px;
    font-weight: 700;
    font-size: .92rem;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(99,102,241,.35);
    transition: transform .2s, box-shadow .2s;
    align-self: flex-start;
}
.act-cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(99,102,241,.45);
    color: #fff;
}
.act-cta-btn__arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px; height: 24px;
    background: rgba(255,255,255,.2);
    border-radius: 6px;
    font-size: .75rem;
    transition: background .2s;
}
.act-cta-btn:hover .act-cta-btn__arrow { background: rgba(255,255,255,.35); }

/* ── Grille autres activités ── */
.act-grid {
    max-width: 1200px;
    margin: 0 auto 1.5rem;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 1.2rem;
}
.act-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    transition: box-shadow .25s, transform .25s, border-color .25s;
}
.act-card:hover {
    box-shadow: 0 12px 36px rgba(0,0,0,.1);
    transform: translateY(-4px);
    border-color: #c7d2fe;
}
.act-card__img {
    position: relative;
    height: 180px;
    overflow: hidden;
}
.act-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .5s;
}
.act-card:hover .act-card__img img { transform: scale(1.07); }
.act-card__img-cover {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,.08) 100%);
}
.act-card__icon-float {
    position: absolute;
    bottom: .8rem; right: .8rem;
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,.12);
}
.act-card__no-img {
    height: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.act-card__body {
    padding: 1.3rem 1.5rem;
}
.act-card__body h4 {
    font-size: 1rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 .5rem;
}
.act-card__body p {
    font-size: .85rem;
    color: #64748b;
    line-height: 1.65;
    margin: 0;
}

/* ── Empty ── */
.act-empty {
    max-width: 460px;
    margin: 0 auto 2rem;
    text-align: center;
    padding: 3rem 2rem;
}
.act-empty__icon {
    width: 64px; height: 64px;
    background: #ede9fe;
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem; color: #6366f1;
    margin: 0 auto 1.5rem;
}
.act-empty h3 { font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0 0 .6rem; }
.act-empty p  { color: #64748b; font-size: .95rem; }

/* ── See all ── */
.act-see-all {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
    padding-top: 1rem;
}
.act-see-all__btn {
    display: inline-flex;
    align-items: center;
    gap: .6rem;
    padding: .8rem 2rem;
    border: 2px solid #6366f1;
    color: #4f46e5;
    border-radius: 14px;
    font-weight: 700;
    font-size: .92rem;
    text-decoration: none;
    transition: background .2s, color .2s, box-shadow .2s;
}
.act-see-all__btn:hover {
    background: #4f46e5;
    color: #fff;
    box-shadow: 0 8px 24px rgba(99,102,241,.3);
}

/* ── Responsive ── */
@media (max-width: 860px) {
    .act-featured { grid-template-columns: 1fr; }
    .act-featured__img { height: 260px; }
    .act-header { flex-direction: column; gap: 1rem; align-items: flex-start; }
}
@media (max-width: 560px) {
    .act-section { padding: 4rem 1.25rem; }
    .act-grid { grid-template-columns: 1fr; }
    .act-featured__body { padding: 1.75rem; }
}
</style>

{{-- ===== À PROPOS ===== --}}
<section class="about">
    <div class="about-inner">
        <div class="about-content">
            <h2 class="section-title">À Propos</h2>
            <p>Le Département d'Informatique de l'École Nationale Supérieure Polytechnique de Maroua et ses partenaires initient les « Journées Sahel Digital » afin de faire éclore et promouvoir le génie des jeunes camerounais et d'encourager les porteurs de projets digitaux.</p>

            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">{{ number_format($globalStats['participants']) }}+</span>
                    <p>Participants : étudiants, entrepreneurs et passionnés de technologie venus de tout le Sahel.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $globalStats['projets'] }}+</span>
                    <p>Projets technologiques concrets ayant un impact positif sur la communauté locale.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $globalStats['editions'] }}</span>
                    <p>Éditions organisées depuis le lancement des Journées Sahel Digital.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $globalStats['programmeurs'] }}+</span>
                    <p>Candidats talentueux aux concours des programmeurs et du Meilleur Projet Digital.</p>
                </div>
            </div>
        </div>
        <div class="about-image">
            <img src="{{ asset('images/about-image.png') }}" alt="À propos de JSD'26" loading="lazy">
        </div>
    </div>
</section>

{{-- ===== PARTENAIRES ===== --}}
<section class="partners">
    <div class="partners-inner">
        <h2 class="section-title centered">Partenaires Officiels</h2>
        <p>Nos partenaires soutiennent {{ $edition->nom }} pour en faire un succès. Ensemble, nous façonnons l'avenir numérique du Sahel.</p>

        <div class="partner-logos">
            @forelse($partenaires as $partenaire)
                @if($partenaire->lien)
                    <a href="{{ $partenaire->lien }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('images/' . $partenaire->logo) }}" alt="{{ $partenaire->nom ?? 'Partenaire' }}" loading="lazy">
                    </a>
                @else
                    <img src="{{ asset('images/' . $partenaire->logo) }}" alt="{{ $partenaire->nom ?? 'Partenaire' }}" loading="lazy">
                @endif
            @empty
                <p style="color:var(--color-text-muted)">Aucun partenaire pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== CTA FINAL ===== --}}
<section class="cta">
    <h2>Rejoignez-nous dès aujourd'hui !</h2>
    <p>Faites partie de l'avenir numérique du Sahel et engagez-vous aux côtés des innovateurs de demain !</p>
    <a href="{{ route('sponsor.form') }}" class="btn btn-primary">
        <i class="fas fa-handshake"></i> Devenir Sponsor
    </a>
</section>

@endsection

@section('scripts')
<script>
(function () {
    // --- Countdown ---
    const countDownDate = new Date("{{ $edition->date_debut ? $edition->date_debut->format('M d, Y') . ' 08:00:00' : 'Jan 1, 2099 00:00:00' }}").getTime();
    const el = {
        days:    document.getElementById('days'),
        hours:   document.getElementById('hours'),
        minutes: document.getElementById('minutes'),
        seconds: document.getElementById('seconds'),
    };

    function pad(n) { return String(Math.max(0, n)).padStart(2, '0'); }

    const timer = setInterval(function () {
        const distance = countDownDate - Date.now();

        if (distance <= 0) {
            clearInterval(timer);
            Object.values(el).forEach(e => { if (e) e.textContent = '00'; });
            return;
        }

        if (el.days)    el.days.textContent    = pad(Math.floor(distance / 86400000));
        if (el.hours)   el.hours.textContent   = pad(Math.floor((distance % 86400000) / 3600000));
        if (el.minutes) el.minutes.textContent = pad(Math.floor((distance % 3600000)  / 60000));
        if (el.seconds) el.seconds.textContent = pad(Math.floor((distance % 60000)    / 1000));
    }, 1000);

})();
</script>
<script>
// --- Hero Slider ---
(function () {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    if (!slides.length) return;

    let current = 0;
    let timer   = null;

    function goTo(idx) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (idx + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function start() { timer = setInterval(() => goTo(current + 1), 5000); }
    function stop()  { clearInterval(timer); }

    document.getElementById('hero-prev')?.addEventListener('click', () => { stop(); goTo(current - 1); start(); });
    document.getElementById('hero-next')?.addEventListener('click', () => { stop(); goTo(current + 1); start(); });

    dots.forEach(dot => {
        dot.addEventListener('click', () => { stop(); goTo(parseInt(dot.dataset.index)); start(); });
    });

    document.getElementById('hero-section')?.addEventListener('mouseenter', stop);
    document.getElementById('hero-section')?.addEventListener('mouseleave', start);

    start();
})();
</script>
@endsection
