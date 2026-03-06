@extends('layouts.app')

@section('styles')
<style>
/* ── Hero ── */
.ci-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
    padding: 4rem 1.5rem 3.5rem;
    text-align: center;
    color: #fff;
}
.ci-hero h1 {
    font-size: clamp(1.75rem, 4vw, 2.75rem);
    font-weight: 900;
    margin: 0 0 .75rem;
    letter-spacing: -.02em;
}
.ci-hero p {
    font-size: 1.05rem;
    color: rgba(255,255,255,.72);
    max-width: 540px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ── Body ── */
.ci-body {
    max-width: 900px;
    margin: 0 auto;
    padding: 2.5rem 1.5rem 4rem;
}

/* ── Notice ── */
.ci-notice {
    background: #f8faff;
    border: 1px solid #e0e7ff;
    border-left: 3px solid #6366f1;
    border-radius: 10px;
    padding: .875rem 1.25rem;
    font-size: .875rem;
    color: #4338ca;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: .625rem;
}

/* ── Section label ── */
.ci-section-label {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: 1rem;
}

/* ── Big cards with image ── */
.ci-cards { display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 2.5rem; }

.ci-card {
    background: #fff;
    border: 1.5px solid #e8ecf0;
    border-radius: 16px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 260px;
    transition: border-color .15s, background .15s;
    min-height: 200px;
}
.ci-card:hover { border-color: var(--ci-color); }

.ci-card-body {
    padding: 1.75rem 1.75rem 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.ci-card-top {}
.ci-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .3rem .75rem;
    border-radius: 999px;
    background: var(--ci-bg);
    color: var(--ci-color);
    border: 1px solid var(--ci-border);
    margin-bottom: .875rem;
}
.ci-card-title {
    font-size: 1.2rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 .5rem;
    letter-spacing: -.01em;
}
.ci-card-desc {
    font-size: .875rem;
    color: #64748b;
    line-height: 1.65;
    margin: 0 0 1rem;
}
.ci-tags {
    display: flex;
    gap: .375rem;
    flex-wrap: wrap;
    margin-bottom: 1.25rem;
}
.ci-tag {
    font-size: .7rem;
    font-weight: 600;
    padding: .2rem .65rem;
    border-radius: 999px;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
}
.ci-points {
    list-style: none;
    padding: 0;
    margin: 0 0 1.25rem;
    display: flex;
    flex-direction: column;
    gap: .35rem;
}
.ci-points li {
    font-size: .82rem;
    color: #475569;
    display: flex;
    align-items: flex-start;
    gap: .5rem;
}
.ci-points li::before {
    content: '';
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--ci-color);
    flex-shrink: 0;
    margin-top: .45rem;
}

.ci-cta {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--ci-color);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: .7rem 1.4rem;
    font-size: .875rem;
    font-weight: 700;
    text-decoration: none;
    width: fit-content;
    transition: opacity .15s;
    font-family: inherit;
}
.ci-cta:hover { opacity: .85; color: #fff; }

/* ── Card image panel ── */
.ci-card-img {
    position: relative;
    overflow: hidden;
    background: var(--ci-bg);
}
.ci-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s ease;
}
.ci-card:hover .ci-card-img img { transform: scale(1.04); }
.ci-card-img .ci-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(255,255,255,.15), transparent);
}

/* ── Stand card ── */
.ci-stand-card {
    background: #fff;
    border: 1.5px dashed #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 200px;
    transition: border-color .15s;
}
.ci-stand-card:hover { border-color: #f59e0b; border-style: solid; background: #fffdf5; }

@media (max-width: 680px) {
    .ci-card, .ci-stand-card { grid-template-columns: 1fr; }
    .ci-card-img { min-height: 160px; max-height: 180px; }
    .ci-cta { width: 100%; justify-content: center; }
}
</style>
@endsection

@section('content')

<div id="messageCardContainer"></div>

<div class="ci-hero">
    <h1>Concours &amp; Activités <span style="color:#a5b4fc">{{ $edition->nom }}</span></h1>
    <p>Inscrivez-vous et prenez part aux compétitions des Journées Sahel Digital {{ $edition->annee }}.</p>
</div>

<div class="ci-body">

    <div class="ci-notice">
        <i class="fas fa-info-circle"></i>
        Ces concours sont ouverts à tous les étudiant·e·s, élèves et passionné·e·s de technologies répondant aux exigences de chaque concours.
    </div>

    <div class="ci-section-label">Concours individuels &amp; collectifs</div>

    <div class="ci-cards">

        {{-- Programmeur --}}
        <div class="ci-card" style="--ci-color:#3b82f6;--ci-bg:#eff6ff;--ci-border:#bfdbfe">
            <div class="ci-card-body">
                <div class="ci-card-top">
                    <div class="ci-badge"><i class="fas fa-code"></i> Individuel</div>
                    <div class="ci-card-title">Concours du Meilleur Programmeur</div>
                    <p class="ci-card-desc">Démontrez votre maîtrise de l'algorithmique et de la programmation en résolvant des défis techniques dans votre langage préféré. Un test de logique, de performance et de créativité.</p>
                    <ul class="ci-points">
                        <li>Résolution de problèmes algorithmiques chronométrés</li>
                        <li>Large choix de langages : Python, Java, C++, JavaScript et plus</li>
                        <li>Deux catégories : Lycéen (CMPL) et Senior (CMPS)</li>
                    </ul>
                    <div class="ci-tags">
                        <span class="ci-tag">CMPL — Lycée</span>
                        <span class="ci-tag">CMPS — Supérieur</span>
                        <span class="ci-tag">Individuel</span>
                    </div>
                </div>
                <a href="{{ auth()->check() ? route('dashboard').'?panel=programmeur' : route('login') }}" class="ci-cta">
                    <i class="fas fa-arrow-right"></i> S'inscrire
                </a>
            </div>
            <div class="ci-card-img">
                <img src="{{ asset('images/developer.png') }}" alt="Concours Programmeur" loading="lazy">
                <div class="ci-img-overlay"></div>
            </div>
        </div>

        {{-- Projet Digital --}}
        <div class="ci-card" style="--ci-color:#10b981;--ci-bg:#f0fdf4;--ci-border:#a7f3d0">
            <div class="ci-card-body">
                <div class="ci-card-top">
                    <div class="ci-badge"><i class="fas fa-laptop-code"></i> Équipe ou individuel</div>
                    <div class="ci-card-title">Meilleur Projet Digital</div>
                    <p class="ci-card-desc">Présentez votre solution numérique innovante face à un jury d'experts. Application mobile, web, IA, IoT — montrez comment la technologie peut résoudre des problèmes concrets.</p>
                    <ul class="ci-points">
                        <li>Descriptif du projet et présentation vidéo obligatoires</li>
                        <li>Business plan recommandé pour maximiser votre score</li>
                        <li>Deux catégories : Lycéen (CMPDL) et Senior (CMPDS)</li>
                    </ul>
                    <div class="ci-tags">
                        <span class="ci-tag">CMPDL — Lycée</span>
                        <span class="ci-tag">CMPDS — Supérieur</span>
                        <span class="ci-tag">Innovation</span>
                    </div>
                </div>
                <a href="{{ auth()->check() ? route('dashboard').'?panel=projet-digital' : route('login') }}" class="ci-cta">
                    <i class="fas fa-arrow-right"></i> S'inscrire
                </a>
            </div>
            <div class="ci-card-img">
                <img src="{{ asset('images/digital-project-contest.png') }}" alt="Projet Digital" loading="lazy">
                <div class="ci-img-overlay"></div>
            </div>
        </div>

        {{-- Hackathon --}}
        <div class="ci-card" style="--ci-color:#8b5cf6;--ci-bg:#fdf4ff;--ci-border:#e9d5ff">
            <div class="ci-card-body">
                <div class="ci-card-top">
                    <div class="ci-badge"><i class="fas fa-rocket"></i> Équipe</div>
                    <div class="ci-card-title">Hackathon</div>
                    <p class="ci-card-desc">En équipe, relevez un défi imposé et développez une solution fonctionnelle en un temps limité. Créativité, collaboration et rapidité d'exécution sont les clés de la victoire.</p>
                    <ul class="ci-points">
                        <li>Équipes de 2 à 5 participants, lycéens et étudiants</li>
                        <li>Thème révélé le jour J — préparez votre stack technique</li>
                        <li>Présentation devant un jury à la fin du sprint</li>
                    </ul>
                    <div class="ci-tags">
                        <span class="ci-tag">2 – 5 membres</span>
                        <span class="ci-tag">Lycée &amp; Supérieur</span>
                        <span class="ci-tag">Sprint créatif</span>
                    </div>
                </div>
                <a href="{{ auth()->check() ? route('dashboard').'?panel=hackathon' : route('login') }}" class="ci-cta">
                    <i class="fas fa-arrow-right"></i> S'inscrire
                </a>
            </div>
            <div class="ci-card-img">
                <img src="{{ asset('images/hackathon.png') }}" alt="Hackathon" loading="lazy">
                <div class="ci-img-overlay"></div>
            </div>
        </div>

    </div>

    <div class="ci-section-label">Exposants</div>

    {{-- Stand --}}
    <div class="ci-stand-card" style="--ci-color:#f59e0b;--ci-bg:#fffbeb;--ci-border:#fde68a">
        <div class="ci-card-body">
            <div class="ci-card-top">
                <div class="ci-badge" style="background:#fffbeb;color:#d97706;border-color:#fde68a"><i class="fas fa-store"></i> Entreprises &amp; Projets</div>
                <div class="ci-card-title">Réservation de Stand d'Exposition</div>
                <p class="ci-card-desc">Faites découvrir votre entreprise, startup ou projet étudiant à des centaines de visiteurs. Un espace de networking, de visibilité et d'échanges avec un public passionné de tech.</p>
                <ul class="ci-points" style="--ci-color:#f59e0b">
                    <li>Stands disponibles en trois tailles : petit, moyen, grand</li>
                    <li>Idéal pour les entreprises, startups et porteurs de projets</li>
                    <li>Opportunité unique de networking et de recrutement</li>
                </ul>
            </div>
            <a href="{{ auth()->check() ? route('dashboard').'?panel=stand' : route('login') }}" class="ci-cta" style="background:#f59e0b">
                <i class="fas fa-arrow-right"></i> Réserver un stand
            </a>
        </div>
        <div class="ci-card-img">
            <img src="{{ asset('images/conference.png') }}" alt="Stand exposition" loading="lazy">
            <div class="ci-img-overlay"></div>
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
        <div class="alert ${cls} mb-6" style="max-width:900px;margin:1rem auto;border-radius:10px">
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
