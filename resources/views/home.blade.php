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
<section style="background:#fff; padding: 4rem 0; border-top: 1px solid #e2e8f0;">
    <div class="welcome-message">
        <div class="presi-card">
            <img src="{{ asset('images/pr-kaladzavi.jpg') }}" alt="Pr Kaladzavi Guidedi" loading="lazy">
            <p><b>Pr. Kaladzavi Guidedi</b><br><i>Chef de département d'INFOTEL, ENSPM&nbsp;— UMa</i></p>
        </div>
        <div class="message-content">
            <h3>Mot du Président du Comité d'Organisation</h3>
            <p>Chers participants, chers partenaires,</p>
            <p>C'est avec une immense fierté que je vous souhaite une massive participation à la {{ $edition->numero }}{{ $edition->numero == 1 ? 'ère' : 'ème' }} édition des Journées Sahel Digital ({{ $edition->nom }}). Sous le thème @if($edition->theme)<strong>«&nbsp;{{ $edition->theme }}&nbsp;»</strong>@endif, cet événement se veut un espace de réflexion, de création et d'action pour les jeunes talents et entrepreneur·e·s du Sahel.</p>
            <p>En tant que promoteurs de cette initiative, nous croyons fermement que l'avenir du continent africain passe par l'innovation technologique et numérique. L'intelligence artificielle offre des opportunités inédites pour relever les défis socio-économiques auxquels nous sommes confrontés.</p>
            <p>Que vous soyez programmeur·euse, entrepreneur·euse, étudiant·e ou simplement passionné·e du numérique, les Journées Sahel Digital sont faites pour vous. Ensemble, cultivons l'esprit d'innovation pour un Sahel prospère, connecté et résilient.</p>
        </div>
    </div>
</section>

{{-- ===== ACTIVITÉS ===== --}}
<section class="activities">
    <div class="activities-inner">
        <h2 class="section-title centered">Activités</h2>
        <p>Découvrez les activités phares des Journées Sahel Digital {{ $edition->annee }}&nbsp;: hackathons, concours de programmation, expositions de startups et conférences inspirantes.</p>

        @if($activites->isNotEmpty())
        @php $featured = $activites->first(); $others = $activites->slice(1)->take(4); @endphp

        {{-- Featured activity (Hackathon) — full width horizontal card --}}
        <div style="display:flex;gap:0;border-radius:var(--radius-2xl);overflow:hidden;box-shadow:var(--shadow-md);margin-bottom:1.5rem;min-height:260px;background:var(--color-bg-card);">
            @if($featured->image)
            <div style="flex:0 0 42%;max-width:42%;overflow:hidden;">
                <img src="{{ asset('images/' . $featured->image) }}" alt="{{ $featured->titre }}" loading="lazy"
                     style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s;" onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            @endif
            <div style="flex:1;padding:2rem 2.25rem;display:flex;flex-direction:column;justify-content:center;gap:.75rem;">
                <span style="display:inline-flex;align-items:center;gap:.4rem;background:linear-gradient(135deg,#eff6ff,#dbeafe);color:var(--color-primary);font-size:.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.3rem .85rem;border-radius:999px;width:fit-content;">
                    <i class="fas fa-star" style="font-size:.65rem;"></i> À la une
                </span>
                <h3 style="font-size:1.35rem;font-weight:800;color:var(--color-text);margin:0;">{{ $featured->titre }}</h3>
                <p style="color:var(--color-text-muted);font-size:.95rem;line-height:1.65;margin:0;">{{ $featured->description }}</p>
                <a href="{{ route('concours.hackathon') }}" class="btn btn-primary" style="width:fit-content;margin-top:.25rem;font-size:.875rem;padding:.5rem 1.25rem;">
                    <i class="fas fa-rocket"></i> S'inscrire
                </a>
            </div>
        </div>

        {{-- 2 × 2 grid for remaining activities --}}
        @if($others->count())
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.25rem;margin-bottom:1.5rem;">
            @foreach($others as $activite)
            <div style="background:var(--color-bg-card);border-radius:var(--radius-2xl);overflow:hidden;box-shadow:var(--shadow-sm);transition:box-shadow var(--transition),transform var(--transition);" onmouseover="this.style.boxShadow='var(--shadow-md)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='translateY(0)'">
                @if($activite->image)
                <img src="{{ asset('images/' . $activite->image) }}" alt="{{ $activite->titre }}" loading="lazy"
                     style="width:100%;height:180px;object-fit:cover;display:block;">
                @endif
                <div style="padding:1.25rem 1.5rem;">
                    <h3 style="font-size:1rem;font-weight:700;color:var(--color-text);margin-bottom:.4rem;">{{ $activite->titre }}</h3>
                    <p style="font-size:.875rem;color:var(--color-text-muted);line-height:1.6;margin:0;">{{ $activite->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @else
        <p style="color:var(--color-text-muted)">Aucune activité disponible pour le moment.</p>
        @endif

        <div style="text-align:center;">
            <a href="{{ route('activities') }}" class="btn btn-primary">
                Voir toutes les activités <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

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
