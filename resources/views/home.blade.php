@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="hero-content">
            <div class="hero-left">
                <h1>Les Journées<br>Sahel digital 2024</h1>
                <p class="subtitle">Innovation à l'ère de l'intelligence Artificielle</p>
                <hr/>
            </div>
            <div class="hero-right">
                <h2>Deuxième édition</h2>
                <div class="cta-buttons">
                    <a href="{{ route('sponsor.form') }}" class="btn btn-primary">
                        <i class="fas fa-handshake"></i> Devenir Sponsor
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-donate"></i> Faire un don
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!--section class="hero">
        <div class="hero-content">
            <h1>Les Journées<br>Sahel digital 2024</h1>
            <h2>Deuxième édition</h2>
            <p class="subtitle">Innovation à l'ère de l'intelligence Artificielle</p>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary">Devenir Sponsor</a>
                <a href="#" class="btn btn-secondary">Faire un don</a>
            </div>
        </div>
    </section-->

    <section class="countdown-section">
    <div class="countdown-content">
        <div class="countdown-image">
            <img src="{{ asset('images/developer.png') }}" alt="Développeur avec un ordinateur portable">
        </div>
        <div class="countdown-text">
            <h2>Le compte à rebours a commencé !</h2>
            <p>Rejoignez-nous pour célébrer l'innovation et l'entrepreneuriat à l'ère de l'intelligence artificielle</p>
            <div class="countdown-timer">
                <div class="countdown-item">
                    <span id="days">00</span>
                    <p>JOURS</p>
                </div>
                <div class="countdown-item">
                    <span id="hours">00</span>
                    <p>HEURES</p>
                </div>
                <div class="countdown-item">
                    <span id="minutes">00</span>
                    <p>MINUTES</p>
                </div>
                <div class="countdown-item">
                    <span id="seconds">00</span>
                    <p>SECONDES</p>
                </div>
            </div>
            <p class="event-description">Préparez-vous à découvrir les projets les plus créatifs, à participer à des concours passionnants et à assister à des débats inspirants sur les technologies de demain. Ne manquez pas cet événement incontournable du <span class="highlight">26 au 28 novembre 2024</span> !</p>
            <p class="registration-deadline">Inscrivez-vous dès maintenant et soumettez vos projets avant le <span class="highlight">15 novembre 2024</span> !</p>
            <div class="cta-buttons">
                <a href="{{ route('concours.inscription') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </a>
                <a href="#" class="btn btn-secondary2">
                    <i class="fas fa-calendar-alt"></i> Date des concours
                </a>
            </div>
        </div>
    </div>
</section>

    <section class="welcome-message">
        <img src="{{ asset('images/pr-kaladzavi-guidedi.png') }}" alt="Pr Kaladzavi Guidedi">
        <div class="message-content">
            <h3>Mot du Président du Comité d’Organisation</h3>
            <!--h4>Chef de département d'INFOTEL, ENSPM - UMa</h4-->
            <p>Chers participants, chers partenaires,</p>
            <p>C'est avec une immense fierté et un enthousiasme débordant que je vous souhaite la bienvenue à la deuxième édition des Journées Sahel Digital (JSD'24). Sous le thème "Innovation à l'ère de l'intelligence artificielle", cet événement se veut un espace de réflexion, de création et d'action pour les jeunes talents et entrepreneurs du Sahel.</p>
            <p>En tant que promoteurs de cette initiative, nous croyons fermement que l'avenir du continent africain passe par l'innovation technologique et numérique. L'intelligence artificielle, moteur de cette révolution, offre des opportunités inédites pour relever les défis socio-économiques auxquels nous sommes confrontés. Ce cadre unique vous permettra d'échanger des idées, de présenter des solutions et de concourir avec les meilleurs talents de la région.</p>
            <p>Que vous soyez programmeur, entrepreneur, étudiant ou simplement passionné par le numérique, les Journées Sahel Digital sont faites pour vous. Ensemble, cultivons l'esprit d'innovation pour un Sahel prospère, connecté et résilient.</p>
            <p>Je vous invite donc à saisir cette opportunité unique et à vous engager pleinement dans cette aventure numérique. L'avenir de notre région est entre nos mains. Soyons les artisans du changement.</p>
        </div>
    </section>

    <section class="activities">
        <h2>Activités</h2>
        <p>Découvrez les ctivités phares des Journées Sahel Digital 2024: hackathons, concours de programmation, expositions de startups et conférences inspirantes. Un événement dédié à l'innovation et à l'entrepreneuriat numérique au cœur du Sahel !</p>
        <div class="activity-grid">
            <div class="activity-card">
                <img src="{{ asset('images/hackathon.png') }}" alt="Hackathon">
                <h3>Hackathon</h3>
                <p>Participez à un hackathon de 48 heures pour relever les défis numériques du Sahel à travers l'innovation technologique</p>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/programming-contest.png') }}" alt="Concours de Programmation">
                <h3>Concours de Programmation</h3>
                <p>Montrez vos compétences lors du concours du Meilleur Programmeur et remportez des prix pour vos solutions ingénieuses.</p>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/digital-project-contest.png') }}" alt="Concours de Meilleur Projet Digital">
                <h3>Concours de Meilleur Projet Digital</h3>
                <p>Présentez vos idées innovantes lors du Concours de Meilleur Projet Digital et propulsez votre startup ou projet.</p>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/conferences.png') }}" alt="Conférences et Débats">
                <h3>Conférences et Débats</h3>
                <p>Assistez à des conférences et débats animés par des experts du numérique, avec un focus sur l'intelligence artificielle et l'innovation</p>
            </div>
            <div class="activity-card">
                <img src="{{ asset('images/startup-expo.png') }}" alt="Exposition des Startups">
                <h3>Exposition des Startups</h3>
                <p>Découvrez les startups les plus prometteuses du Sahel, qui exposeront leurs solutions technologiques innovantes.</p>
            </div>
        </div>
        <a href="{{ route('activities') }}" class="btn btn-primary">
            Toutes les activités <i class="fas fa-arrow-right"></i>
        </a>

    </section>

    <section class="about">
    <div class="about-content">
        <h2>A Propos</h2>
        <p>Le Département d'Informatique et de l'Ecole Nationale Supérieure Polytechnique de l'Université de Maroua et ses partenaires initient les « Journées Sahel Digital » en abrégé JSD afin de faire éclore, promouvoir le génie des jeunes camerounais et d'encourager les porteurs de projets digitaux.</p>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">500+</span>
                <p>participants, comprenant des étudiants, des entrepreneurs et des passionnés de technologie, venus de tout le Sahel."</p>
            </div>
            <div class="stat-item">
                <span class="stat-number">20+</span>
                <p>Projets technologiques concrets ayant un impact positif sur la communauté locale.</p>
            </div>
            <div class="stat-item">
                <span class="stat-number">30+</span>
                <p>projets innovants ont été présentés lors de la JSD'23, couvrant divers domaines, de e-commerce à l'intelligence artificielle."</p>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <p>candidats talentueux au concours des programmeurs, et ceux ayant soumis des projets créatifs pour le concours de Meilleur Projet Digital."</p>
            </div>
        </div>
    </div>
    <img src="{{ asset('images/about-image.png') }}" alt="À propos de JSD'24" class="about-image">
</section>

    <section class="partners">
        <h2>Partenaires Officiels</h2>
        <p>Nos partenaires nous soutiennent pour faire de cette édition un succès. Ensemble, nous façonnons l'avenir numérique du Sahel</p>
        <div class="partner-logos">
            <img src="{{ asset('images/partner1.png') }}" alt="Partenaire 1">
            <img src="{{ asset('images/partner2.jpeg') }}" alt="Partenaire 2">
            <img src="{{ asset('images/partner3.png') }}" alt="Partenaire 3">
            <img src="{{ asset('images/partner4.png') }}" alt="Partenaire 4">
            <img src="{{ asset('images/partner8.png') }}" alt="Partenaire 8">
            <img src="{{ asset('images/partner9.jpeg') }}" alt="Partenaire 9">
            <img src="{{ asset('images/partner5.jpg') }}" alt="Partenaire 5">
            <img src="{{ asset('images/partner6.jpg') }}" alt="Partenaire 6">
            <img src="{{ asset('images/partner7.png') }}" alt="Partenaire 7">

        </div>
    </section>

    <section class="cta">
        <h2>Rejoignez-nous dès aujourd'hui !</h2>
        <p>Faites partie de l'avenir numérique du Sahel et engagez-vous aux côtés des innovateurs de demain !</p>
        <a href="{{ route('sponsor.form') }}" class="btn btn-primary">
            <i class="fas fa-handshake"></i> Devenir Sponsor
        </a>
    </section>
@endsection

<script type="text/javascript">
// Set the date we're counting down to
const countDownDate = new Date("Nov 15, 2024 23:59:59").getTime();

// Update the countdown every 1 second
const x = setInterval(function() {
    // Get today's date and time
    const now = new Date().getTime();

    // Find the distance between now and the countdown date
    const distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="days", "hours", "minutes", "seconds"
    document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
    document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
    document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

    // If the countdown is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
