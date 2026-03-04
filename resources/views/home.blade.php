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
                Ne manquez pas cet événement du <span class="highlight">26 au 28 novembre 2026</span>&nbsp;!
            </p>
            <p class="registration-deadline">
                Inscrivez-vous et soumettez vos projets avant le <span class="highlight">15 novembre 2026</span>&nbsp;!
            </p>

            <div class="cta-buttons">
                <a href="{{ route('concours.index') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> S'inscrire aux concours
                </a>
                <button id="open-contest-dates-modal" class="btn btn-secondary2">
                    <i class="fas fa-calendar-alt"></i> Dates des concours
                </button>
            </div>
        </div>
    </div>
</section>

{{-- ===== MODAL DATES ===== --}}
<div id="contest-dates-modal" class="modal">
    <div class="modal-content" style="max-width:520px;">
        <h3 style="font-size:1.4rem;font-weight:800;text-align:center;margin-bottom:0.25rem;color:var(--color-text)">Dates des Concours</h3>
        <p style="text-align:center;color:var(--color-text-muted);font-size:var(--font-size-sm);margin-bottom:1.5rem">Inscrivez-vous dès maintenant !</p>

        <div style="display:flex;flex-direction:column;gap:1rem;">
            <div style="display:flex;align-items:flex-start;gap:1rem;padding:1rem;border-radius:var(--radius-xl);background:#eff6ff;">
                <i class="fas fa-laptop-code" style="font-size:1.75rem;color:var(--color-primary-light);margin-top:2px;flex-shrink:0;"></i>
                <div>
                    <h4 style="font-size:var(--font-size-lg);font-weight:700;color:var(--color-primary);margin-bottom:0.25rem;">26 novembre</h4>
                    <p style="color:var(--color-text-muted);font-size:var(--font-size-sm);margin-bottom:0.75rem;">Concours des Meilleurs Projets Digital &amp; Hackathon</p>
                    <a href="{{ route('concours.index') }}" class="btn btn-primary" style="padding:0.4rem 1rem;font-size:var(--font-size-sm);">
                        <i class="fas fa-sign-in-alt"></i> S'inscrire
                    </a>
                </div>
            </div>

            <div style="display:flex;align-items:flex-start;gap:1rem;padding:1rem;border-radius:var(--radius-xl);background:#f0fdf4;">
                <i class="fas fa-code" style="font-size:1.75rem;color:var(--color-success);margin-top:2px;flex-shrink:0;"></i>
                <div>
                    <h4 style="font-size:var(--font-size-lg);font-weight:700;color:#065f46;margin-bottom:0.25rem;">27 novembre</h4>
                    <p style="color:var(--color-text-muted);font-size:var(--font-size-sm);margin-bottom:0.75rem;">Concours des Meilleurs Programmeurs</p>
                    <a href="{{ route('concours.index') }}" class="btn" style="padding:0.4rem 1rem;font-size:var(--font-size-sm);background:var(--color-success);color:#fff;border-color:var(--color-success);">
                        <i class="fas fa-sign-in-alt"></i> S'inscrire
                    </a>
                </div>
            </div>
        </div>

        <button id="close-modal" style="margin-top:1.5rem;width:100%;padding:0.75rem;background:var(--color-bg-section);border:none;border-radius:var(--radius-xl);font-weight:600;color:var(--color-text-muted);cursor:pointer;transition:background var(--transition);" onmouseover="this.style.background='var(--color-border)'" onmouseout="this.style.background='var(--color-bg-section)'">
            <i class="fas fa-times"></i> Fermer
        </button>
    </div>
</div>

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
            <p>C'est avec une immense fierté que je vous souhaite une massive participation à la troisième édition des Journées Sahel Digital (JSD'26). Sous le thème <strong>«&nbsp;Intelligence artificielle et développement de l'économie numérique : enjeux et perspectives pour le Sahel&nbsp;»</strong>, cet événement se veut un espace de réflexion, de création et d'action pour les jeunes talents et entrepreneur·e·s du Sahel.</p>
            <p>En tant que promoteurs de cette initiative, nous croyons fermement que l'avenir du continent africain passe par l'innovation technologique et numérique. L'intelligence artificielle offre des opportunités inédites pour relever les défis socio-économiques auxquels nous sommes confrontés.</p>
            <p>Que vous soyez programmeur·euse, entrepreneur·euse, étudiant·e ou simplement passionné·e du numérique, les Journées Sahel Digital sont faites pour vous. Ensemble, cultivons l'esprit d'innovation pour un Sahel prospère, connecté et résilient.</p>
        </div>
    </div>
</section>

{{-- ===== ACTIVITÉS ===== --}}
<section class="activities">
    <div class="activities-inner">
        <h2 class="section-title centered">Activités</h2>
        <p>Découvrez les activités phares des Journées Sahel Digital 2026&nbsp;: hackathons, concours de programmation, expositions de startups et conférences inspirantes.</p>

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
                    <span class="stat-number">500+</span>
                    <p>Participants : étudiants, entrepreneurs et passionnés de technologie venus de tout le Sahel.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">11+</span>
                    <p>Projets technologiques concrets ayant un impact positif sur la communauté locale.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">11+</span>
                    <p>Projets innovants présentés lors de la JSD'23, de l'e-commerce à l'intelligence artificielle.</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">30+</span>
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
        <p>Nos partenaires soutiennent cette édition pour en faire un succès. Ensemble, nous façonnons l'avenir numérique du Sahel.</p>

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
    const countDownDate = new Date("Nov 26, 2026 08:00:00").getTime();
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

    // --- Modal dates ---
    const modal   = document.getElementById('contest-dates-modal');
    const openBtn = document.getElementById('open-contest-dates-modal');
    const closeBtn= document.getElementById('close-modal');

    if (modal && openBtn && closeBtn) {
        openBtn.addEventListener('click',  () => modal.style.display = 'block');
        closeBtn.addEventListener('click', () => modal.style.display = 'none');
        modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });
    }
})();
</script>
@endsection
