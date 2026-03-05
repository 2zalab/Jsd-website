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

/* ── Page body ── */
.ci-body {
    max-width: 860px;
    margin: 0 auto;
    padding: 2.5rem 1.5rem 4rem;
}

/* ── Notice strip ── */
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

/* ── Concours cards ── */
.ci-cards { display: flex; flex-direction: column; gap: .875rem; margin-bottom: 2.5rem; }

.ci-card {
    background: #fff;
    border: 1.5px solid #e8ecf0;
    border-radius: 14px;
    padding: 1.5rem 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    transition: border-color .15s, background .15s;
    text-decoration: none;
}
.ci-card:hover { border-color: var(--ci-color); background: var(--ci-bg); }

.ci-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: var(--ci-bg);
    color: var(--ci-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
    border: 1.5px solid var(--ci-border);
}

.ci-info { flex: 1; min-width: 0; }
.ci-name {
    font-size: 1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 .2rem;
}
.ci-sub {
    font-size: .8rem;
    color: #94a3b8;
    font-weight: 500;
    margin: 0 0 .625rem;
}
.ci-tags { display: flex; gap: .375rem; flex-wrap: wrap; }
.ci-tag {
    font-size: .7rem;
    font-weight: 600;
    padding: .2rem .6rem;
    border-radius: 999px;
    background: var(--ci-bg);
    color: var(--ci-color);
    border: 1px solid var(--ci-border);
}

.ci-cta {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--ci-color);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: .65rem 1.25rem;
    font-size: .85rem;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: opacity .15s;
    font-family: inherit;
}
.ci-cta:hover { opacity: .88; color: #fff; }

/* ── Stand card (different style) ── */
.ci-stand {
    background: #fafbfc;
    border: 1.5px dashed #e2e8f0;
    border-radius: 14px;
    padding: 1.25rem 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    transition: border-color .15s, background .15s;
}
.ci-stand:hover { border-color: #f59e0b; background: #fffbeb; }

@media (max-width: 600px) {
    .ci-card, .ci-stand { flex-wrap: wrap; }
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
        Ces concours sont ouverts à tous les étudiant·e·s et élèves passionné·e·s de technologies.
    </div>

    <div class="ci-section-label">Concours individuels &amp; collectifs</div>

    <div class="ci-cards">

        {{-- Programmeur --}}
        <div class="ci-card" style="--ci-color:#3b82f6;--ci-bg:#eff6ff;--ci-border:#bfdbfe">
            <div class="ci-icon"><i class="fas fa-code"></i></div>
            <div class="ci-info">
                <div class="ci-name">Concours Programmeur</div>
                <div class="ci-sub">Relevez des défis techniques en algorithme et programmation</div>
                <div class="ci-tags">
                    <span class="ci-tag">CMPL — Lycéen</span>
                    <span class="ci-tag">CMPS — Senior</span>
                </div>
            </div>
            <a href="{{ auth()->check() ? route('dashboard').'?panel=programmeur' : route('login') }}" class="ci-cta">
                <i class="fas fa-arrow-right"></i> S'inscrire
            </a>
        </div>

        {{-- Projet Digital --}}
        <div class="ci-card" style="--ci-color:#10b981;--ci-bg:#f0fdf4;--ci-border:#a7f3d0">
            <div class="ci-icon"><i class="fas fa-laptop-code"></i></div>
            <div class="ci-info">
                <div class="ci-name">Meilleur Projet Digital</div>
                <div class="ci-sub">Présentez un projet innovant qui résout un problème réel</div>
                <div class="ci-tags">
                    <span class="ci-tag">CMPDL — Lycéen</span>
                    <span class="ci-tag">CMPDS — Senior</span>
                </div>
            </div>
            <a href="{{ auth()->check() ? route('dashboard').'?panel=projet-digital' : route('login') }}" class="ci-cta">
                <i class="fas fa-arrow-right"></i> S'inscrire
            </a>
        </div>

        {{-- Hackathon --}}
        <div class="ci-card" style="--ci-color:#8b5cf6;--ci-bg:#fdf4ff;--ci-border:#e9d5ff">
            <div class="ci-icon"><i class="fas fa-rocket"></i></div>
            <div class="ci-info">
                <div class="ci-name">Hackathon</div>
                <div class="ci-sub">Formez une équipe et développez une solution en temps limité</div>
                <div class="ci-tags">
                    <span class="ci-tag">2 – 5 membres</span>
                    <span class="ci-tag">Lycée &amp; Supérieur</span>
                </div>
            </div>
            <a href="{{ auth()->check() ? route('dashboard').'?panel=hackathon' : route('login') }}" class="ci-cta">
                <i class="fas fa-arrow-right"></i> S'inscrire
            </a>
        </div>

    </div>

    <div class="ci-section-label">Exposants</div>

    {{-- Stand --}}
    <div class="ci-stand" style="--ci-color:#f59e0b;--ci-bg:#fffbeb;--ci-border:#fde68a">
        <div class="ci-icon" style="background:#fffbeb;color:#f59e0b;border-color:#fde68a"><i class="fas fa-store"></i></div>
        <div class="ci-info">
            <div class="ci-name" style="color:#0f172a">Réservation de Stand</div>
            <div class="ci-sub">Présentez votre entreprise ou projet lors de l'événement</div>
            <div class="ci-tags">
                <span class="ci-tag" style="background:#fffbeb;color:#f59e0b;border-color:#fde68a">Entreprises</span>
                <span class="ci-tag" style="background:#fffbeb;color:#f59e0b;border-color:#fde68a">Projets étudiants</span>
            </div>
        </div>
        <a href="{{ route('concours.stand') }}" class="ci-cta" style="background:#f59e0b">
            <i class="fas fa-arrow-right"></i> Réserver
        </a>
    </div>

</div>

@endsection

@section('scripts')
<script>
function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const cls = type === 'success' ? 'alert-success2' : 'alert-error2';
    container.innerHTML = `
        <div class="alert ${cls} mb-6" style="max-width:860px;margin:1rem auto;border-radius:10px">
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
