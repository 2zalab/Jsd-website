@extends('layouts.app')

@section('styles')
<style>
/* ── Page header ── */
.page-header {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: #fff;
    padding: var(--space-16) var(--space-6);
    text-align: center;
}
.page-header h1 { font-size: var(--font-size-4xl); font-weight: 800; margin-bottom: var(--space-3); }
.page-header p  { font-size: var(--font-size-lg); opacity: .85; max-width: 600px; margin: 0 auto; }

/* ── Tabs ── */
.tabs-wrapper {
    background: var(--color-bg-section);
    border-bottom: 2px solid var(--color-border);
    position: sticky;
    top: 64px;
    z-index: 10;
}
.tabs-nav {
    display: flex;
    gap: 0;
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--space-6);
    overflow-x: auto;
    scrollbar-width: none;
}
.tabs-nav::-webkit-scrollbar { display: none; }
.tab-btn {
    padding: var(--space-4) var(--space-6);
    font-size: var(--font-size-sm);
    font-weight: 600;
    color: var(--color-text-muted);
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    cursor: pointer;
    white-space: nowrap;
    transition: color var(--transition), border-color var(--transition);
}
.tab-btn:hover { color: var(--color-primary); }
.tab-btn.active {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
}

/* ── Tab panels ── */
.tab-panel { display: none; }
.tab-panel.active { display: block; }

/* ── Section inner ── */
.ressources-section {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: var(--space-12) var(--space-6);
}

/* ── Sub-section title ── */
.ressources-subtitle {
    font-size: var(--font-size-2xl);
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: var(--space-2);
    display: flex;
    align-items: center;
    gap: var(--space-3);
}
.ressources-subtitle i {
    color: var(--color-primary);
    font-size: 1.4rem;
}
.ressources-divider {
    border: none;
    border-top: 2px solid var(--color-border);
    margin-bottom: var(--space-8);
}

/* ── Photo grid ── */
.photo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--space-6);
    margin-bottom: var(--space-12);
}
.photo-card {
    background: var(--color-bg-card);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: box-shadow var(--transition), transform var(--transition);
}
.photo-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-3px);
}
.photo-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
}
.photo-card-body {
    padding: var(--space-4);
}
.photo-card-body h3 {
    font-size: var(--font-size-base);
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: var(--space-1);
}
.photo-card-body p {
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
    margin: 0;
}

/* ── Documents grid ── */
.docs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--space-4);
}
.doc-card {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-4) var(--space-5);
    background: var(--color-bg-card);
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    transition: box-shadow var(--transition), border-color var(--transition);
    text-decoration: none;
    color: inherit;
}
.doc-card:hover {
    box-shadow: var(--shadow-sm);
    border-color: var(--color-primary-light);
    text-decoration: none;
    color: inherit;
}
.doc-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.5rem;
    color: var(--color-primary);
}
.doc-icon.pdf  { background: #fef2f2; color: #dc2626; }
.doc-icon.ppt  { background: #fff7ed; color: #ea580c; }
.doc-icon.zip  { background: #f0fdf4; color: #16a34a; }
.doc-meta h4   { font-size: var(--font-size-sm); font-weight: 700; color: var(--color-text); margin-bottom: 2px; }
.doc-meta span { font-size: 0.75rem; color: var(--color-text-muted); }

/* ── Coming soon ── */
.coming-soon {
    text-align: center;
    padding: var(--space-20) var(--space-6);
}
.coming-soon-icon {
    font-size: 4rem;
    color: var(--color-border);
    margin-bottom: var(--space-4);
}
.coming-soon h3 {
    font-size: var(--font-size-2xl);
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: var(--space-2);
}
.coming-soon p {
    color: var(--color-text-muted);
    font-size: var(--font-size-base);
    max-width: 420px;
    margin: 0 auto var(--space-6);
}

@media (max-width: 640px) {
    .photo-grid { grid-template-columns: 1fr; }
    .docs-grid  { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')

{{-- ── Page header ── --}}
<div class="page-header">
    <h1><i class="fas fa-photo-video"></i> Ressources</h1>
    <p>Photos et documents des éditions passées et à venir des Journées Sahel Digital</p>
</div>

{{-- ── Tab navigation ── --}}
<div class="tabs-wrapper">
    <nav class="tabs-nav" role="tablist">
        <button class="tab-btn active" data-tab="jsd23" role="tab" aria-selected="true">
            <i class="fas fa-images"></i> JSD'23 — 1ère Édition
        </button>
        <button class="tab-btn" data-tab="jsd26" role="tab" aria-selected="false">
            <i class="fas fa-calendar-plus"></i> JSD'26 — 3ème Édition
        </button>
    </nav>
</div>

{{-- ── JSD'23 Panel ── --}}
<div id="tab-jsd23" class="tab-panel active">
    <div class="ressources-section">

        {{-- Photos JSD'23 --}}
        <h2 class="ressources-subtitle"><i class="fas fa-camera"></i> Photos de l'événement</h2>
        <hr class="ressources-divider">

        <div class="photo-grid">
            <div class="photo-card">
                <img src="{{ asset('images/hack.jpg') }}" alt="Concours de programmeur JSD'23" loading="lazy">
                <div class="photo-card-body">
                    <h3>CMP JSD'23</h3>
                    <p>Les équipes en pleine action lors du concours de meilleur programmeur</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/conferences.png') }}" alt="Panel de discussion JSD'23" loading="lazy">
                <div class="photo-card-body">
                    <h3>Panel sur l'innovation au Sahel</h3>
                    <p>Experts et entrepreneurs partagent leurs visions pour l'avenir</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/eleves-godola.jpg') }}" alt="Élèves du lycée de Godola au JSD'23" loading="lazy">
                <div class="photo-card-body">
                    <h3>Présence du lycée de Godola</h3>
                    <p>Les élèves marquant leur présence aux Journées du Savoir Digital 2023</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/projet-presentation.jpg') }}" alt="Présentation des projets" loading="lazy">
                <div class="photo-card-body">
                    <h3>Présentation des projets</h3>
                    <p>Concours des meilleurs projets digitaux lors de JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/secretariat.jpg') }}" alt="Secrétariat technique" loading="lazy">
                <div class="photo-card-body">
                    <h3>Secrétariat technique</h3>
                    <p>Impression des badges pour les participants au JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/photo-famille.jpg') }}" alt="Photo de famille JSD'23" loading="lazy">
                <div class="photo-card-body">
                    <h3>Photo de famille</h3>
                    <p>Photo de groupe à la fin des Journées du Savoir Digital 2023</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/roll-up.jpg') }}" alt="Stand des entreprises partenaires" loading="lazy">
                <div class="photo-card-body">
                    <h3>Stands des partenaires</h3>
                    <p>Les entreprises partenaires présentent leurs solutions au JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/startup-expo.png') }}" alt="Exposition startups" loading="lazy">
                <div class="photo-card-body">
                    <h3>Exposition dans les stands</h3>
                    <p>Présentation des innovations dans les stands des JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/candidats-cmpd.jpg') }}" alt="Candidats concours projets digitaux" loading="lazy">
                <div class="photo-card-body">
                    <h3>Candidats — Projets Digitaux</h3>
                    <p>Les participants au concours des meilleurs projets digitaux du JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/meet.jpg') }}" alt="Réunion de préparation technique" loading="lazy">
                <div class="photo-card-body">
                    <h3>Réunion de préparation</h3>
                    <p>Les équipes organisatrices en pleine réunion technique pour JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/touza.jpg') }}" alt="Community Manager JSD'23" loading="lazy">
                <div class="photo-card-body">
                    <h3>Community Manager</h3>
                    <p>Le CM gérant les communications digitales durant les JSD'23</p>
                </div>
            </div>
            <div class="photo-card">
                <img src="{{ asset('images/photo1.jpg') }}" alt="Équipe d'organisation JSD'23" loading="lazy">
                <div class="photo-card-body">
                    <h3>M. Douwé & M. Terdam</h3>
                    <p>Acteurs clés dans la planification des Journées du Savoir Digital 2023</p>
                </div>
            </div>
        </div>

        {{-- Documents JSD'23 --}}
        <h2 class="ressources-subtitle"><i class="fas fa-file-alt"></i> Documents officiels</h2>
        <hr class="ressources-divider">

        <div class="docs-grid">
            <a href="#" class="doc-card">
                <div class="doc-icon pdf"><i class="fas fa-file-pdf"></i></div>
                <div class="doc-meta">
                    <h4>Programme officiel JSD'23</h4>
                    <span>PDF · Programme complet</span>
                </div>
            </a>
            <a href="#" class="doc-card">
                <div class="doc-icon pdf"><i class="fas fa-file-pdf"></i></div>
                <div class="doc-meta">
                    <h4>Règlement des concours</h4>
                    <span>PDF · Conditions de participation</span>
                </div>
            </a>
            <a href="#" class="doc-card">
                <div class="doc-icon ppt"><i class="fas fa-file-powerpoint"></i></div>
                <div class="doc-meta">
                    <h4>Présentations des conférenciers</h4>
                    <span>PPT · Diapositives des interventions</span>
                </div>
            </a>
            <a href="#" class="doc-card">
                <div class="doc-icon pdf"><i class="fas fa-file-pdf"></i></div>
                <div class="doc-meta">
                    <h4>Rapport de synthèse JSD'23</h4>
                    <span>PDF · Bilan de l'édition 2023</span>
                </div>
            </a>
            <a href="#" class="doc-card">
                <div class="doc-icon zip"><i class="fas fa-file-archive"></i></div>
                <div class="doc-meta">
                    <h4>Pack photos haute résolution</h4>
                    <span>ZIP · Toutes les photos de l'événement</span>
                </div>
            </a>
            <a href="#" class="doc-card">
                <div class="doc-icon pdf"><i class="fas fa-file-pdf"></i></div>
                <div class="doc-meta">
                    <h4>Palmarès des concours JSD'23</h4>
                    <span>PDF · Résultats et lauréats</span>
                </div>
            </a>
        </div>

    </div>
</div>

{{-- ── JSD'26 Panel ── --}}
<div id="tab-jsd26" class="tab-panel">
    <div class="ressources-section">
        <div class="coming-soon">
            <div class="coming-soon-icon"><i class="fas fa-clock"></i></div>
            <h3>Bientôt disponible</h3>
            <p>Les ressources de la 3ème édition des Journées Sahel Digital seront publiées ici après l'événement. Restez connectés !</p>
            <a href="{{ route('concours.index') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> S'inscrire à JSD'26
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
(function () {
    const tabBtns   = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            tabBtns.forEach(b => { b.classList.remove('active'); b.setAttribute('aria-selected', 'false'); });
            tabPanels.forEach(p => p.classList.remove('active'));

            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');
            document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
        });
    });
})();
</script>
@endsection
