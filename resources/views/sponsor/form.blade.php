@extends('layouts.app')

@section('styles')
<style>
/* ── Hero ─────────────────────────────────────────────────── */
.sponsor-hero {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 60%, var(--color-accent) 100%);
    color: #fff;
    padding: var(--space-20) var(--space-6);
    text-align: center;
    position: relative;
    overflow: hidden;
}
.sponsor-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.sponsor-hero-inner { position: relative; max-width: var(--container-max); margin: 0 auto; }
.sponsor-hero .badge {
    display: inline-flex; align-items: center; gap: var(--space-2);
    background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
    padding: var(--space-2) var(--space-4); border-radius: var(--radius-full);
    font-size: var(--font-size-sm); font-weight: 500; margin-bottom: var(--space-6);
    backdrop-filter: blur(4px);
}
.sponsor-hero h1 {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800; line-height: 1.15;
    margin-bottom: var(--space-6);
    text-shadow: 0 2px 8px rgba(0,0,0,.2);
}
.sponsor-hero h1 span { color: #fbbf24; }
.sponsor-hero p {
    font-size: var(--font-size-lg); opacity: .9;
    max-width: 640px; margin: 0 auto var(--space-8);
    line-height: 1.7;
}
.hero-cta {
    display: inline-flex; align-items: center; gap: var(--space-2);
    background: #fff; color: var(--color-primary);
    padding: var(--space-3) var(--space-8);
    border-radius: var(--radius-full); font-weight: 700;
    font-size: var(--font-size-base); text-decoration: none;
    box-shadow: 0 4px 20px rgba(0,0,0,.2);
    transition: transform var(--transition), box-shadow var(--transition);
}
.hero-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,.25); color: var(--color-primary-dark); }

/* ── Stats bar ────────────────────────────────────────────── */
.stats-bar { background: var(--color-bg-card); border-bottom: 1px solid var(--color-border); }
.stats-bar-inner {
    max-width: var(--container-max); margin: 0 auto;
    padding: var(--space-8) var(--space-6);
    display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: var(--space-6); text-align: center;
}
.stat-item .stat-num {
    font-size: var(--font-size-3xl); font-weight: 800;
    color: var(--color-primary); line-height: 1;
}
.stat-item .stat-label {
    font-size: var(--font-size-sm); color: var(--color-text-muted);
    margin-top: var(--space-1);
}

/* ── Section layout ───────────────────────────────────────── */
.sponsor-section {
    max-width: var(--container-max); margin: 0 auto;
    padding: var(--space-16) var(--space-6);
}
.section-header { text-align: center; margin-bottom: var(--space-12); }
.section-header .eyebrow {
    display: inline-block; font-size: var(--font-size-sm); font-weight: 600;
    color: var(--color-primary); text-transform: uppercase; letter-spacing: .08em;
    margin-bottom: var(--space-3);
}
.section-header h2 {
    font-size: clamp(1.6rem, 3vw, 2.25rem); font-weight: 700;
    color: var(--color-text); margin-bottom: var(--space-4);
}
.section-header p { color: var(--color-text-muted); max-width: 560px; margin: 0 auto; line-height: 1.7; }

/* ── Avantages ────────────────────────────────────────────── */
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: var(--space-6);
}
.benefit-card {
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    transition: box-shadow var(--transition), transform var(--transition);
}
.benefit-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-3px); }
.benefit-icon {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
    border-radius: var(--radius-lg);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: #fff; margin-bottom: var(--space-4);
}
.benefit-card h3 { font-size: var(--font-size-base); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-2); }
.benefit-card p { font-size: var(--font-size-sm); color: var(--color-text-muted); line-height: 1.6; }

/* ── Tiers ────────────────────────────────────────────────── */
.tiers-section { background: var(--color-bg-section); }
.tiers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: var(--space-6);
}
.tier-card {
    background: var(--color-bg-card);
    border: 2px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    text-align: center;
    position: relative;
    transition: box-shadow var(--transition), transform var(--transition);
}
.tier-card:hover { box-shadow: var(--shadow-xl); transform: translateY(-4px); }
.tier-card.featured {
    border-color: #f59e0b;
    box-shadow: 0 0 0 4px rgba(245,158,11,.12);
}
.tier-badge {
    position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
    background: #f59e0b; color: #fff;
    padding: var(--space-1) var(--space-4);
    border-radius: var(--radius-full); font-size: var(--font-size-xs);
    font-weight: 700; white-space: nowrap; text-transform: uppercase; letter-spacing: .06em;
}
.tier-icon { font-size: 2.5rem; margin-bottom: var(--space-3); line-height: 1; }
.tier-card h3 { font-size: var(--font-size-xl); font-weight: 700; margin-bottom: var(--space-1); }
.tier-card .tier-desc { font-size: var(--font-size-sm); color: var(--color-text-muted); margin-bottom: var(--space-4); }
.tier-features { list-style: none; text-align: left; }
.tier-features li {
    display: flex; align-items: flex-start; gap: var(--space-2);
    font-size: var(--font-size-sm); color: var(--color-text-muted);
    padding: var(--space-2) 0;
    border-bottom: 1px solid var(--color-border);
}
.tier-features li:last-child { border-bottom: none; }
.tier-features li .check { color: var(--color-success); flex-shrink: 0; margin-top: 2px; }
/* tier colors */
.tier-bronze h3 { color: #92400e; }
.tier-silver h3 { color: #475569; }
.tier-gold   h3 { color: #b45309; }
.tier-plat   h3 { color: var(--color-primary-dark); }

/* ── Formulaire ───────────────────────────────────────────── */
.form-section-inner {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: var(--space-12);
    align-items: start;
}
@media (max-width: 768px) {
    .form-section-inner { grid-template-columns: 1fr; }
    .form-aside { display: none; }
}
.form-aside h3 { font-size: var(--font-size-xl); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-4); }
.form-aside p { font-size: var(--font-size-sm); color: var(--color-text-muted); line-height: 1.7; margin-bottom: var(--space-6); }
.aside-contact-item {
    display: flex; align-items: center; gap: var(--space-3);
    font-size: var(--font-size-sm); color: var(--color-text-muted);
    margin-bottom: var(--space-3);
}
.aside-contact-item i { color: var(--color-primary); width: 18px; text-align: center; }
.form-aside .aside-img {
    width: 100%; border-radius: var(--radius-xl);
    overflow: hidden; margin-bottom: var(--space-6);
}
.form-aside .aside-img img { width: 100%; display: block; object-fit: cover; }

.sponsor-form-card {
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-2xl);
    padding: var(--space-8);
    box-shadow: var(--shadow-lg);
}
.form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4); }
@media (max-width: 600px) { .form-grid-2 { grid-template-columns: 1fr; } }

.form-group { margin-bottom: var(--space-5); }
.form-group label {
    display: block; font-size: var(--font-size-sm); font-weight: 600;
    color: var(--color-text); margin-bottom: var(--space-2);
}
.form-group label .req { color: var(--color-danger); margin-left: 2px; }
.form-control {
    width: 100%;
    padding: var(--space-3) var(--space-4);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-md);
    font-size: var(--font-size-base);
    color: var(--color-text);
    background: var(--color-bg-card);
    transition: border-color var(--transition), box-shadow var(--transition);
    font-family: var(--font-sans);
    outline: none;
}
.form-control:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(30,64,175,.12);
}
.form-control::placeholder { color: var(--color-text-light); }
.form-control.file-input { padding: var(--space-2) var(--space-3); cursor: pointer; }
.form-hint { font-size: var(--font-size-xs); color: var(--color-text-muted); margin-top: var(--space-1); }
textarea.form-control { resize: vertical; min-height: 100px; }

.btn-submit {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: var(--space-3);
    padding: var(--space-4) var(--space-6);
    background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
    color: #fff; font-weight: 700; font-size: var(--font-size-base);
    border: none; border-radius: var(--radius-full);
    cursor: pointer;
    transition: opacity var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: 0 4px 14px rgba(30,64,175,.35);
    margin-top: var(--space-2);
}
.btn-submit:hover { opacity: .92; transform: translateY(-2px); box-shadow: 0 8px 22px rgba(30,64,175,.4); }
.btn-submit:active { transform: translateY(0); }

/* file upload zone */
.file-upload-zone {
    border: 2px dashed var(--color-border);
    border-radius: var(--radius-md);
    padding: var(--space-6);
    text-align: center;
    cursor: pointer;
    transition: border-color var(--transition), background var(--transition);
    position: relative;
    overflow: hidden;
}
.file-upload-zone:hover, .file-upload-zone.drag-over {
    border-color: var(--color-primary);
    background: rgba(30,64,175,.04);
}
.file-upload-zone input[type="file"] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.file-upload-zone .upload-icon { font-size: 2rem; color: var(--color-text-muted); margin-bottom: var(--space-2); }
.file-upload-zone .upload-text { font-size: var(--font-size-sm); color: var(--color-text-muted); }
.file-upload-zone .upload-text strong { color: var(--color-primary); }
.file-preview { display: none; align-items: center; gap: var(--space-3); margin-top: var(--space-3); }
.file-preview img { width: 48px; height: 48px; object-fit: contain; border-radius: var(--radius-sm); border: 1px solid var(--color-border); }
.file-preview .file-name { font-size: var(--font-size-sm); color: var(--color-text-muted); }

/* alert inline */
.alert-inline {
    display: flex; align-items: flex-start; gap: var(--space-3);
    padding: var(--space-4); border-radius: var(--radius-md);
    margin-bottom: var(--space-6);
    font-size: var(--font-size-sm);
}
.alert-inline.success { background: #ecfdf5; border: 1px solid #6ee7b7; color: #065f46; }
.alert-inline.error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }
.alert-inline i { margin-top: 2px; flex-shrink: 0; }
</style>
@endsection

@section('content')

{{-- ── HERO ── --}}
<section class="sponsor-hero">
    <div class="sponsor-hero-inner">
        <div class="badge"><i class="fas fa-handshake"></i> Partenariat &amp; Sponsoring</div>
        <h1>Devenez <span>partenaire</span><br>des Journées Sahel Digital</h1>
        <p>Rejoignez les entreprises et organisations qui soutiennent l'innovation technologique au Sahel. Gagnez en visibilité, inspirez la jeunesse et construisez votre marque employeur.</p>
        <a href="#formulaire" class="hero-cta">
            <i class="fas fa-pen-to-square"></i> Soumettre ma candidature
        </a>
    </div>
</section>

{{-- ── STATS ── --}}
<div class="stats-bar">
    <div class="stats-bar-inner">
        <div class="stat-item">
            <div class="stat-num">1 000+</div>
            <div class="stat-label">Participants attendus</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">3 jours</div>
            <div class="stat-label">D'innovation intense</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">10+</div>
            <div class="stat-label">Établissements représentés</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">4</div>
            <div class="stat-label">Catégories de concours</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">100%</div>
            <div class="stat-label">Focus Tech &amp; Innovation</div>
        </div>
    </div>
</div>

{{-- ── AVANTAGES ── --}}
<section class="sponsor-section">
    <div class="section-header">
        <span class="eyebrow">Pourquoi nous rejoindre ?</span>
        <h2>Des avantages concrets pour votre organisation</h2>
        <p>En sponsorisant JSD, vous bénéficiez d'une exposition unique auprès d'un public qualifié de jeunes talents passionnés de technologie.</p>
    </div>
    <div class="benefits-grid">
        <div class="benefit-card">
            <div class="benefit-icon"><i class="fas fa-eye"></i></div>
            <h3>Visibilité maximale</h3>
            <p>Votre logo sur toutes les communications officielles : affiches, bannières, site web, réseaux sociaux et supports de l'événement.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="fas fa-users"></i></div>
            <h3>Accès aux talents</h3>
            <p>Rencontrez directement les futurs ingénieurs, développeurs et entrepreneurs du Sahel. Recrutez ou identifiez des profils prometteurs.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="fas fa-trophy"></i></div>
            <h3>Association à l'excellence</h3>
            <p>Associez votre marque à l'innovation et à l'excellence technique en parrainant les meilleurs projets et compétitions.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="fas fa-network-wired"></i></div>
            <h3>Réseau stratégique</h3>
            <p>Échangez avec d'autres leaders, institutions académiques et partenaires institutionnels présents à l'événement.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="fas fa-bullhorn"></i></div>
            <h3>Communication ciblée</h3>
            <p>Bénéficiez de temps de parole, de prises de parole officielles ou d'ateliers pour promouvoir vos produits et services.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="fas fa-heart"></i></div>
            <h3>Impact social</h3>
            <p>Contribuez au développement du numérique dans la région du Sahel et renforcez votre image de marque engagée.</p>
        </div>
    </div>
</section>

{{-- ── NIVEAUX DE PARTENARIAT ── --}}
<div class="tiers-section">
    <section class="sponsor-section">
        <div class="section-header">
            <span class="eyebrow">Niveaux de partenariat</span>
            <h2>Choisissez votre formule</h2>
            <p>Chaque niveau offre des avantages adaptés à vos objectifs. Contactez-nous pour un devis personnalisé.</p>
        </div>
        <div class="tiers-grid">

            <div class="tier-card tier-bronze">
                <div class="tier-icon">🥉</div>
                <h3>Bronze</h3>
                <p class="tier-desc">Partenaire de soutien</p>
                <ul class="tier-features">
                    <li><i class="fas fa-check check"></i> Logo sur le site web</li>
                    <li><i class="fas fa-check check"></i> Mention sur les réseaux sociaux</li>
                    <li><i class="fas fa-check check"></i> 2 invitations à l'événement</li>
                    <li><i class="fas fa-times" style="color:var(--color-border)"></i> Stand d'exposition</li>
                    <li><i class="fas fa-times" style="color:var(--color-border)"></i> Prise de parole</li>
                </ul>
            </div>

            <div class="tier-card tier-silver">
                <div class="tier-icon">🥈</div>
                <h3>Argent</h3>
                <p class="tier-desc">Partenaire associé</p>
                <ul class="tier-features">
                    <li><i class="fas fa-check check"></i> Logo sur tous les supports</li>
                    <li><i class="fas fa-check check"></i> Posts dédiés sur les réseaux</li>
                    <li><i class="fas fa-check check"></i> 5 invitations à l'événement</li>
                    <li><i class="fas fa-check check"></i> Stand 3m² d'exposition</li>
                    <li><i class="fas fa-times" style="color:var(--color-border)"></i> Prise de parole</li>
                </ul>
            </div>

            <div class="tier-card tier-gold featured">
                <div class="tier-badge">⭐ Le plus populaire</div>
                <div class="tier-icon">🥇</div>
                <h3>Or</h3>
                <p class="tier-desc">Partenaire principal</p>
                <ul class="tier-features">
                    <li><i class="fas fa-check check"></i> Logo premium visible partout</li>
                    <li><i class="fas fa-check check"></i> Campagne de communication dédiée</li>
                    <li><i class="fas fa-check check"></i> 10 invitations VIP</li>
                    <li><i class="fas fa-check check"></i> Stand 6m² avec enseigne</li>
                    <li><i class="fas fa-check check"></i> Prise de parole (10 min)</li>
                </ul>
            </div>

            <div class="tier-card tier-plat">
                <div class="tier-icon">💎</div>
                <h3>Platine</h3>
                <p class="tier-desc">Partenaire stratégique</p>
                <ul class="tier-features">
                    <li><i class="fas fa-check check"></i> Logo en position #1 sur tous supports</li>
                    <li><i class="fas fa-check check"></i> Partenariat média complet</li>
                    <li><i class="fas fa-check check"></i> Invitations illimitées</li>
                    <li><i class="fas fa-check check"></i> Stand premium 12m²</li>
                    <li><i class="fas fa-check check"></i> Prise de parole en plénière</li>
                </ul>
            </div>

        </div>
    </section>
</div>

{{-- ── FORMULAIRE ── --}}
<section class="sponsor-section" id="formulaire">
    <div class="section-header">
        <span class="eyebrow">Candidature</span>
        <h2>Soumettez votre dossier de sponsoring</h2>
        <p>Remplissez le formulaire ci-dessous. Notre équipe vous recontactera sous 48h pour discuter de votre partenariat.</p>
    </div>

    <div class="form-section-inner">

        {{-- Aside ─────────────────────────────────────────── --}}
        <aside class="form-aside">
            <div class="aside-img">
                <img src="{{ asset('images/sponsor-image-desktop.png') }}" alt="Partenariat JSD">
            </div>
            <h3>Nous contacter directement</h3>
            <p>Vous souhaitez discuter avant de soumettre votre candidature ? Notre équipe est disponible pour vous accompagner.</p>
            <div class="aside-contact-item"><i class="fas fa-envelope"></i> info@saheldigital.net</div>
            <div class="aside-contact-item"><i class="fas fa-phone"></i> +237 697 460 267</div>
            <div class="aside-contact-item"><i class="fab fa-whatsapp"></i>
                <a href="https://chat.whatsapp.com/G6jhDz9XaTn55yGEdrIlEW" target="_blank" rel="noopener" style="color:inherit">Groupe WhatsApp</a>
            </div>
        </aside>

        {{-- Formulaire ──────────────────────────────────────── --}}
        <div>
            {{-- Alertes ── --}}
            @if(session('success'))
            <div class="alert-inline success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            @if($errors->any())
            <div class="alert-inline error">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin:0;padding-left:1rem">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('error'))
            <div class="alert-inline error">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
            </div>
            @endif

            <div class="sponsor-form-card">
                <form id="sponsorForm" method="post" action="{{ route('sponsor.submit') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="nom">Nom de la structure <span class="req">*</span></label>
                            <input class="form-control" id="nom" type="text" name="nom"
                                   value="{{ old('nom') }}" placeholder="Ex. : Acme Cameroun" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone <span class="req">*</span></label>
                            <input class="form-control" id="telephone" type="tel" name="telephone"
                                   value="{{ old('telephone') }}" placeholder="+237 6XX XXX XXX" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email <span class="req">*</span></label>
                        <input class="form-control" id="email" type="email" name="email"
                               value="{{ old('email') }}" placeholder="contact@votre-structure.com" required>
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse / Siège social <span class="req">*</span></label>
                        <textarea class="form-control" id="adresse" name="adresse"
                                  rows="2" placeholder="Ville, Pays — adresse complète" required>{{ old('adresse') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Logo de votre structure <span class="req">*</span></label>
                        <div class="file-upload-zone" id="uploadZone">
                            <input type="file" name="logo" id="logo" accept="image/*" required>
                            <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                            <div class="upload-text">
                                <strong>Cliquez ou déposez</strong> votre logo ici
                            </div>
                            <div class="upload-text" style="margin-top:4px">PNG, JPG, GIF — max 2 Mo</div>
                        </div>
                        <div class="file-preview" id="filePreview">
                            <img id="previewImg" src="" alt="Aperçu">
                            <span class="file-name" id="fileName"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="motivation">Vos attentes en tant que sponsor <span class="req">*</span></label>
                        <textarea class="form-control" id="motivation" name="motivation"
                                  rows="4" placeholder="Décrivez vos objectifs, le type de partenariat souhaité, vos attentes en termes de visibilité…" required>{{ old('motivation') }}</textarea>
                        <div class="form-hint">Minimum 10 caractères — 4 lignes recommandées</div>
                    </div>

                    <button class="btn-submit" type="submit" id="submit">
                        <i class="fas fa-paper-plane"></i> Soumettre ma candidature
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

{{-- Dialog modal ── --}}
<div id="messageCardContainer"></div>

@endsection

@section('scripts')
<script>
// ── Logo preview ──────────────────────────────────────────────
const logoInput   = document.getElementById('logo');
const filePreview = document.getElementById('filePreview');
const previewImg  = document.getElementById('previewImg');
const fileNameEl  = document.getElementById('fileName');
const uploadZone  = document.getElementById('uploadZone');

logoInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        previewImg.src = e.target.result;
        fileNameEl.textContent = file.name;
        filePreview.style.display = 'flex';
    };
    reader.readAsDataURL(file);
});

['dragover','dragenter'].forEach(ev => {
    uploadZone.addEventListener(ev, e => { e.preventDefault(); uploadZone.classList.add('drag-over'); });
});
['dragleave','drop'].forEach(ev => {
    uploadZone.addEventListener(ev, () => uploadZone.classList.remove('drag-over'));
});

// ── Modal message ─────────────────────────────────────────────
function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const iconSVG = type === 'success'
        ? '<svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
        : '<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
    container.innerHTML = `
        <div id="messageCard" class="dialog-overlay">
            <div class="dialog-content">
                <div class="dialog-header">
                    <h3 class="dialog-title">${type === 'success' ? 'Candidature envoyée !' : 'Erreur'}</h3>
                    <button onclick="closeMessageCard()" class="dialog-close-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="dialog-body">
                    <div class="dialog-icon">${iconSVG}</div>
                    <p class="dialog-message">${message}</p>
                </div>
                <div class="dialog-footer">
                    <button onclick="closeMessageCard()" class="dialog-button">Fermer</button>
                </div>
            </div>
        </div>`;
}

function closeMessageCard() {
    document.getElementById('messageCardContainer').innerHTML = '';
}

if (history.replaceState) history.replaceState(null, '', window.location.href);

document.addEventListener('DOMContentLoaded', function() {
    if (sessionStorage.getItem('messageShown')) { sessionStorage.removeItem('messageShown'); return; }
    @if(session('success')) showMessageCard('success', "{{ session('success') }}"); @endif
    @if(session('error'))   showMessageCard('error',   "{{ session('error') }}");   @endif
});

// ── Smooth scroll to form ─────────────────────────────────────
document.querySelectorAll('a[href="#formulaire"]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault();
        document.getElementById('formulaire').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>
@endsection
