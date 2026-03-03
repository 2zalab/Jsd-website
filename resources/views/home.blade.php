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
                Ne manquez pas cet événement du <span class="highlight">26 au 28 novembre 2024</span>&nbsp;!
            </p>
            <p class="registration-deadline">
                Inscrivez-vous et soumettez vos projets avant le <span class="highlight">15 novembre 2024</span>&nbsp;!
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
<div id="contest-dates-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display:none; z-index:200;">
    <div class="relative top-20 mx-auto p-6 border w-11/12 max-w-lg shadow-xl rounded-2xl bg-white">
        <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Dates des Concours</h3>
        <p class="text-gray-500 text-center text-sm mb-6">Inscrivez-vous dès maintenant !</p>

        <div class="space-y-5">
            <div class="flex items-start gap-4 p-4 rounded-xl bg-blue-50">
                <i class="fas fa-laptop-code text-3xl text-blue-500 mt-1"></i>
                <div>
                    <h4 class="text-lg font-semibold text-blue-700">26 novembre</h4>
                    <p class="text-gray-600 text-sm mb-2">Concours des Meilleurs Projets Digital &amp; Hackathon</p>
                    <a href="{{ route('concours.index') }}" class="inline-block px-4 py-1.5 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-sign-in-alt mr-1"></i>S'inscrire
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-xl bg-green-50">
                <i class="fas fa-code text-3xl text-green-500 mt-1"></i>
                <div>
                    <h4 class="text-lg font-semibold text-green-700">27 novembre</h4>
                    <p class="text-gray-600 text-sm mb-2">Concours des Meilleurs Programmeurs</p>
                    <a href="{{ route('concours.index') }}" class="inline-block px-4 py-1.5 bg-green-500 text-white text-sm font-semibold rounded-lg hover:bg-green-600 transition">
                        <i class="fas fa-sign-in-alt mr-1"></i>S'inscrire
                    </a>
                </div>
            </div>
        </div>

        <button id="close-modal" class="mt-6 w-full py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition">
            <i class="fas fa-times mr-2"></i>Fermer
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
            <p>C'est avec une immense fierté que je vous souhaite une massive participation à la deuxième édition des Journées Sahel Digital (JSD'24). Sous le thème <strong>«&nbsp;Innovation à l'ère de l'intelligence artificielle&nbsp;»</strong>, cet événement se veut un espace de réflexion, de création et d'action pour les jeunes talents et entrepreneur·e·s du Sahel.</p>
            <p>En tant que promoteurs de cette initiative, nous croyons fermement que l'avenir du continent africain passe par l'innovation technologique et numérique. L'intelligence artificielle offre des opportunités inédites pour relever les défis socio-économiques auxquels nous sommes confrontés.</p>
            <p>Que vous soyez programmeur·euse, entrepreneur·euse, étudiant·e ou simplement passionné·e du numérique, les Journées Sahel Digital sont faites pour vous. Ensemble, cultivons l'esprit d'innovation pour un Sahel prospère, connecté et résilient.</p>
        </div>
    </div>
</section>

{{-- ===== ACTIVITÉS ===== --}}
<section class="activities">
    <div class="activities-inner">
        <h2 class="section-title centered">Activités</h2>
        <p>Découvrez les activités phares des Journées Sahel Digital 2024&nbsp;: hackathons, concours de programmation, expositions de startups et conférences inspirantes.</p>

        <div class="activity-grid">
            <div class="activity-card">
                <img src="{{ asset('images/hackathon.png') }}" alt="Hackathon" loading="lazy">
                <div class="activity-card-body">
                    <h3>Hackathon</h3>
                    <p>Participez à un hackathon intensif pour relever les défis numériques du Sahel à travers l'innovation technologique.</p>
                </div>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/digital-project-contest.png') }}" alt="Concours de Programmation" loading="lazy">
                <div class="activity-card-body">
                    <h3>Concours de Programmation</h3>
                    <p>Montrez vos compétences et remportez des prix pour vos solutions ingénieuses lors du concours du Meilleur Programmeur.</p>
                </div>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/digital-project-contest.png') }}" alt="Meilleur Projet Digital" loading="lazy">
                <div class="activity-card-body">
                    <h3>Meilleur Projet Digital</h3>
                    <p>Présentez vos idées innovantes et propulsez votre startup ou projet lors de ce concours phare.</p>
                </div>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/startup-expo.png') }}" alt="Conférences et Débats" loading="lazy">
                <div class="activity-card-body">
                    <h3>Conférences &amp; Débats</h3>
                    <p>Assistez à des conférences animées par des experts du numérique, avec un focus sur l'IA et l'innovation.</p>
                </div>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/startup-expo.png') }}" alt="Exposition des Startups" loading="lazy">
                <div class="activity-card-body">
                    <h3>Exposition des Startups</h3>
                    <p>Découvrez les startups les plus prometteuses du Sahel et leurs solutions technologiques innovantes.</p>
                </div>
            </div>
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
            <img src="{{ asset('images/about-image.png') }}" alt="À propos de JSD'24" loading="lazy">
        </div>
    </div>
</section>

{{-- ===== PARTENAIRES ===== --}}
<section class="partners">
    <div class="partners-inner">
        <h2 class="section-title centered">Partenaires Officiels</h2>
        <p>Nos partenaires soutiennent cette édition pour en faire un succès. Ensemble, nous façonnons l'avenir numérique du Sahel.</p>

        <div class="partner-logos">
            <img src="{{ asset('images/partner1.png') }}"  alt="Partenaire 1" loading="lazy">
            <img src="{{ asset('images/partner2.jpeg') }}" alt="Partenaire 2" loading="lazy">
            <img src="{{ asset('images/partner3.png') }}"  alt="Partenaire 3" loading="lazy">
            <img src="{{ asset('images/partner4.png') }}"  alt="Partenaire 4" loading="lazy">
            <img src="{{ asset('images/partner8.png') }}"  alt="Partenaire 8" loading="lazy">
            <img src="{{ asset('images/partner9.jpeg') }}" alt="Partenaire 9" loading="lazy">
            <img src="{{ asset('images/partner5.png') }}"  alt="Partenaire 5" loading="lazy">
            <img src="{{ asset('images/partner6.png') }}"  alt="Partenaire 6" loading="lazy">
            <img src="{{ asset('images/partner7.png') }}"  alt="Partenaire 7" loading="lazy">
            <img src="{{ asset('images/partner10.png') }}" alt="2zaLab" loading="lazy">
            <img src="{{ asset('images/mit-logo.png') }}"  alt="MIT" loading="lazy">
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
    const countDownDate = new Date("Nov 26, 2024 08:00:00").getTime();
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
