@extends('layouts.app')

@section('content')

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

        <div class="activity-grid">
            @forelse($activites as $activite)
            <div class="activity-card">
                @if($activite->image)
                <img src="{{ asset('images/' . $activite->image) }}" alt="{{ $activite->titre }}" loading="lazy">
                @endif
                <div class="activity-card-body">
                    <h3>{{ $activite->titre }}</h3>
                    <p>{{ $activite->description }}</p>
                </div>
            </div>
            @empty
            <p style="color:var(--color-text-muted)">Aucune activité disponible pour le moment.</p>
            @endforelse
        </div>

        <div style="text-align:center;">
            <a href="{{ route('concours.index') }}" class="btn btn-primary">
                Participez à une activité <i class="fas fa-arrow-right"></i>
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
                    <span class="stat-number">{{ number_format($stats['participants']) }}+</span>
                    <p>Participants : étudiants, entrepreneurs et passionnés de technologie venus de tout le Sahel.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['projets'] }}+</span>
                    <p>Projets technologiques concrets ayant un impact positif sur la communauté locale.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['editions'] }}</span>
                    <p>Éditions organisées depuis le lancement des Journées Sahel Digital.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['programmeurs'] }}+</span>
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
@endsection
