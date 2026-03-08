@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO CONTACT
═══════════════════════════════════════════════════ --}}
<section class="ct-hero">
    <div class="ct-hero__bg" style="background-image:url('{{ asset('images/hack/image5.JPG') }}')"></div>
    <div class="ct-hero__overlay"></div>
    <div class="ct-hero__content">
        <span class="ct-eyebrow"><i class="fas fa-envelope"></i> Contact</span>
        <h1 class="ct-hero__title">Parlons de<br><em>votre projet</em></h1>
        <p class="ct-hero__sub">Notre équipe est disponible pour répondre à toutes vos questions sur les Journées Sahel Digital.</p>
    </div>
    {{-- Info pills flottantes --}}
    <div class="ct-hero__pills">
        <div class="ct-pill">
            <i class="fas fa-phone"></i>
            <span>+237 697 460 267</span>
        </div>
        <div class="ct-pill">
            <i class="fas fa-envelope"></i>
            <span>info@saheldigital.net</span>
        </div>
        <div class="ct-pill">
            <i class="fas fa-map-marker-alt"></i>
            <span>Maroua, Cameroun</span>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CORPS PRINCIPAL
═══════════════════════════════════════════════════ --}}
<section class="ct-main">

    {{-- Alertes --}}
    <div class="ct-alerts" id="messageCardContainer">
        @if ($errors->any())
        <div class="ct-alert ct-alert--error">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            <button onclick="this.parentElement.remove()" aria-label="Fermer">&times;</button>
        </div>
        @endif
    </div>

    <div class="ct-grid">

        {{-- ── FORMULAIRE ── --}}
        <div class="ct-form-panel">
            <div class="ct-form-header">
                <span class="ct-label">Écrivez-nous</span>
                <h2>Envoyez-nous<br>un message</h2>
                <p>Nous vous répondrons dans les meilleurs délais.</p>
            </div>

            <form action="{{ route('contact.submit') }}" method="POST" class="ct-form" id="contactForm">
                @csrf

                <div class="ct-field">
                    <label for="name">
                        <i class="fas fa-user"></i> Nom complet
                    </label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="votre nom"
                           required>
                </div>

                <div class="ct-field">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Adresse email
                    </label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="vous@exemple.com"
                           required>
                </div>

                <div class="ct-field">
                    <label for="message">
                        <i class="fas fa-comment-alt"></i> Votre message
                    </label>
                    <textarea id="message" name="message" rows="5"
                              placeholder="Décrivez votre demande..."
                              required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="ct-submit" id="submitBtn">
                    <span class="ct-submit__label">
                        <i class="fas fa-paper-plane"></i> Envoyer le message
                    </span>
                    <span class="ct-submit__loading" style="display:none;">
                        <i class="fas fa-circle-notch fa-spin"></i> Envoi en cours…
                    </span>
                </button>
            </form>
        </div>

        {{-- ── INFOS LATÉRALES ── --}}
        <aside class="ct-aside">

            {{-- Photo --}}
            <div class="ct-aside__photo">
                <img src="{{ asset('images/contact-image.png') }}" alt="Journées Sahel Digital" loading="lazy">
                <div class="ct-aside__photo-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>Réponse garantie sous 48h</span>
                </div>
            </div>

            {{-- Coordonnées --}}
            <div class="ct-info-cards">
                <div class="ct-info-card">
                    <div class="ct-info-card__icon" style="--c:#10b981">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <strong>Téléphone</strong>
                        <span>+237 697 460 267</span>
                    </div>
                </div>
                <div class="ct-info-card">
                    <div class="ct-info-card__icon" style="--c:#3b82f6">
                        <i class="fas fa-at"></i>
                    </div>
                    <div>
                        <strong>Email</strong>
                        <span>info@saheldigital.net</span>
                    </div>
                </div>
                <div class="ct-info-card">
                    <div class="ct-info-card__icon" style="--c:#f59e0b">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <strong>Adresse</strong>
                        <span>ENSPM, Maroua, Cameroun</span>
                    </div>
                </div>
            </div>

            {{-- Réseaux sociaux --}}
            <div class="ct-socials">
                <p class="ct-socials__label">Suivez-nous</p>
                <div class="ct-socials__links">
                    <a href="https://web.facebook.com/profile.php?id=61552171995857"
                       target="_blank" rel="noopener"
                       class="ct-social ct-social--fb" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://chat.whatsapp.com/G6jhDz9XaTn55yGEdrIlEW"
                       target="_blank" rel="noopener"
                       class="ct-social ct-social--wa" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" class="ct-social ct-social--li" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="ct-social ct-social--ig" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

        </aside>
    </div>
</section>

<style>
/* ═══════════════════════════════════════════
   CONTACT PAGE
═══════════════════════════════════════════ */

/* ── Hero ── */
.ct-hero {
    position: relative;
    height: 72vh;
    min-height: 480px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
}
.ct-hero__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center 30%;
    animation: ctZoom 14s ease-in-out infinite alternate;
}
@keyframes ctZoom {
    from { transform: scale(1.04); }
    to   { transform: scale(1.09) translateX(-.5%); }
}
.ct-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(110deg,
        rgba(3,20,50,.92) 0%,
        rgba(3,40,30,.7) 55%,
        rgba(0,0,0,.25) 100%);
}
.ct-hero__content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    width: 100%;
}
.ct-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #34d399;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .18em;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
}
.ct-hero__title {
    font-size: clamp(2.8rem, 6vw, 5rem);
    font-weight: 900;
    line-height: 1.06;
    color: #fff;
    margin-bottom: 1.2rem;
    letter-spacing: -.03em;
}
.ct-hero__title em {
    font-style: normal;
    background: linear-gradient(90deg, #34d399, #6ee7b7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.ct-hero__sub {
    color: rgba(255,255,255,.7);
    font-size: 1.05rem;
    max-width: 460px;
    line-height: 1.7;
}
.ct-hero__pills {
    position: absolute;
    bottom: 0;
    left: 0; right: 0;
    z-index: 3;
    display: flex;
    justify-content: center;
    gap: 1px;
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(12px);
    border-top: 1px solid rgba(255,255,255,.1);
}
.ct-pill {
    display: flex;
    align-items: center;
    gap: .7rem;
    padding: 1rem 2rem;
    color: rgba(255,255,255,.85);
    font-size: .88rem;
    font-weight: 500;
    flex: 1;
    justify-content: center;
    border-right: 1px solid rgba(255,255,255,.1);
}
.ct-pill:last-child { border-right: none; }
.ct-pill i { color: #34d399; font-size: 1rem; }

/* ── Main ── */
.ct-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 5rem 2rem 6rem;
}
.ct-alerts { margin-bottom: 2rem; }
.ct-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-radius: 14px;
    font-size: .95rem;
    margin-bottom: 1rem;
}
.ct-alert--error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
}
.ct-alert--success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #16a34a;
}
.ct-alert i { margin-top: .15rem; flex-shrink: 0; }
.ct-alert p { margin: 0; line-height: 1.5; }
.ct-alert button {
    margin-left: auto;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    color: inherit;
    opacity: .6;
    flex-shrink: 0;
    padding: 0;
    line-height: 1;
}

.ct-grid {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 4rem;
    align-items: start;
}

/* ── Form panel ── */
.ct-form-panel {}
.ct-form-header { margin-bottom: 2.5rem; }
.ct-label {
    display: inline-block;
    font-size: .7rem;
    font-weight: 800;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: #059669;
    margin-bottom: .8rem;
}
.ct-form-header h2 {
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 900;
    color: #0f172a;
    margin: .3rem 0 .7rem;
    line-height: 1.18;
    letter-spacing: -.02em;
}
.ct-form-header p { color: #64748b; font-size: .95rem; }

.ct-form { display: flex; flex-direction: column; gap: 1.4rem; }

.ct-field label {
    display: flex;
    align-items: center;
    gap: .5rem;
    font-size: .82rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: .55rem;
    text-transform: uppercase;
    letter-spacing: .06em;
}
.ct-field label i { color: #10b981; font-size: .85em; }
.ct-field input,
.ct-field textarea {
    width: 100%;
    padding: .9rem 1.1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: .95rem;
    color: #0f172a;
    background: #f8fafc;
    transition: border-color .2s, background .2s, box-shadow .2s;
    outline: none;
    font-family: inherit;
    resize: vertical;
}
.ct-field input:focus,
.ct-field textarea:focus {
    border-color: #10b981;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(16,185,129,.1);
}
.ct-field input::placeholder,
.ct-field textarea::placeholder { color: #94a3b8; }

.ct-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .6rem;
    padding: 1rem 2.2rem;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    border: none;
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(5,150,105,.35);
    transition: transform .2s, box-shadow .2s;
    align-self: flex-start;
    font-family: inherit;
}
.ct-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(5,150,105,.45);
}
.ct-submit:active { transform: translateY(0); }

/* ── Aside ── */
.ct-aside { display: flex; flex-direction: column; gap: 2rem; }

.ct-aside__photo {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    aspect-ratio: 4/3;
    box-shadow: 0 20px 60px rgba(0,0,0,.12);
}
.ct-aside__photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .7s;
}
.ct-aside__photo:hover img { transform: scale(1.04); }
.ct-aside__photo-badge {
    position: absolute;
    bottom: 1.2rem;
    left: 1.2rem;
    right: 1.2rem;
    background: rgba(0,0,0,.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.15);
    color: #fff;
    padding: .75rem 1.2rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: .7rem;
    font-size: .85rem;
    font-weight: 600;
}
.ct-aside__photo-badge i { color: #34d399; flex-shrink: 0; }

.ct-info-cards { display: flex; flex-direction: column; gap: .8rem; }
.ct-info-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.3rem;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    transition: border-color .2s, box-shadow .2s;
}
.ct-info-card:hover {
    border-color: #a7f3d0;
    box-shadow: 0 4px 16px rgba(0,0,0,.06);
}
.ct-info-card__icon {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    background: color-mix(in srgb, var(--c) 15%, white);
    color: var(--c);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.ct-info-card strong { display: block; font-size: .82rem; font-weight: 700; color: #0f172a; }
.ct-info-card span   { font-size: .88rem; color: #64748b; }

.ct-socials { }
.ct-socials__label {
    font-size: .72rem;
    font-weight: 800;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: 1rem;
}
.ct-socials__links { display: flex; gap: .7rem; }
.ct-social {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    text-decoration: none;
    transition: transform .2s, box-shadow .2s;
}
.ct-social:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,.15); }
.ct-social--fb { background: #1877f2; color: #fff; }
.ct-social--wa { background: #25d366; color: #fff; }
.ct-social--li { background: #0a66c2; color: #fff; }
.ct-social--ig { background: linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); color: #fff; }

/* ═══ RESPONSIVE ═══ */
@media (max-width: 860px) {
    .ct-hero__pills { flex-wrap: wrap; }
    .ct-pill { flex: 1 0 33%; border-bottom: 1px solid rgba(255,255,255,.1); }
    .ct-grid { grid-template-columns: 1fr; gap: 2.5rem; }
    .ct-aside { flex-direction: row; flex-wrap: wrap; }
    .ct-aside__photo { flex: 1 1 280px; }
    .ct-info-cards { flex: 1 1 240px; }
    .ct-socials { width: 100%; }
}
@media (max-width: 560px) {
    .ct-pill { flex: 1 0 100%; border-right: none; }
    .ct-aside { flex-direction: column; }
    .ct-aside__photo { aspect-ratio: 16/9; }
}
</style>

@endsection

@section('scripts')
<script>
function showMessageCard(type, message) {
    const container = document.getElementById('messageCardContainer');
    const cls  = type === 'success' ? 'ct-alert--success' : 'ct-alert--error';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-times-circle';
    const div  = document.createElement('div');
    div.className = `ct-alert ${cls}`;
    div.innerHTML = `<i class="fas ${icon}"></i><div><p>${message}</p></div>
        <button onclick="this.parentElement.remove()" aria-label="Fermer">&times;</button>`;
    container.prepend(div);
}

document.addEventListener('DOMContentLoaded', function () {
    @if (session('success'))
        showMessageCard('success', "{{ session('success') }}");
    @endif
    @if (session('error'))
        showMessageCard('error', "{{ session('error') }}");
    @endif

    // Spinner on submit
    const form = document.getElementById('contactForm');
    const btn  = document.getElementById('submitBtn');
    if (form && btn) {
        form.addEventListener('submit', function () {
            btn.querySelector('.ct-submit__label').style.display = 'none';
            btn.querySelector('.ct-submit__loading').style.display = 'inline-flex';
            btn.disabled = true;
        });
    }
});
</script>
@endsection
