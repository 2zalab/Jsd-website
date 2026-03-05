<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $edition->nom }} — Journées Sahel Digital {{ $edition->annee }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind en premier (base reset), puis nos styles custom par-dessus -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Styles custom (prioritaires sur Tailwind) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/concours.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dialog-message-styles.css') }}">

    <!-- Payment -->
    <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>

    <!-- Hero slider overrides -->
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

    /* slides */
    .hero-slides {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .hero-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1s ease;
    }
    .hero-slide.active { opacity: 1; }

    /* overlay */
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,.78) 0%, rgba(30,64,175,.62) 100%);
        z-index: 1;
    }

    /* content above overlay */
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

    /* prev / next arrows */
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

    /* dots */
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
    .hero-dot.active {
        background: #fff;
        transform: scale(1.3);
    }
    </style>

    @yield('styles')
</head>
<body>

    <!-- ===== NAVIGATION ===== -->
    <header id="site-header">
        <nav>
            <a href="{{ route('home') }}" class="logo" aria-label="Accueil {{ $edition->nom }}">
                <img src="{{ asset('images/logo_jsd.png') }}" alt="Logo {{ $edition->nom }}">
            </a>

            <ul class="nav-links" id="nav-links" role="list">
                <li><a href="{{ route('home') }}"             class="nav-link">Accueil</a></li>
                <li><a href="{{ route('activities') }}"       class="nav-link">Activités</a></li>
                <li><a href="{{ route('ressources.index') }}" class="nav-link">Ressources</a></li>
                <li><a href="{{ route('about') }}"            class="nav-link">À Propos</a></li>
                <li><a href="{{ route('contact.index') }}"    class="nav-link">Contact</a></li>
                @auth
                <li><a href="{{ route('dashboard') }}"        class="nav-link">
                    <i class="fas fa-user-circle"></i> Mon Espace
                </a></li>
                @endauth
                <li><a href="{{ route('concours.index') }}"  class="nav-link nav-cta">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </a></li>
            </ul>

            <button class="menu-toggle" id="menu-toggle" aria-label="Ouvrir le menu" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>
    </header>

    <!-- ===== HERO (slider 4 images) ===== -->
    <section class="hero" id="hero-section">

        <!-- Slides -->
        <div class="hero-slides">
            <div class="hero-slide active" style="background-image:url('{{ asset('images/hero-background.png') }}')"></div>
            <div class="hero-slide"        style="background-image:url('{{ asset('images/hackathon.jpg') }}')"></div>
            <div class="hero-slide"        style="background-image:url('{{ asset('images/projet-presentation.jpg') }}')"></div>
            <div class="hero-slide"        style="background-image:url('{{ asset('images/photo-famille.jpg') }}')"></div>
        </div>

        <!-- Overlay -->
        <div class="hero-overlay"></div>

        <!-- Content -->
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
                    <a href="{{ route('sponsor.form') }}" class="btn btn-primary">
                        <i class="fas fa-handshake"></i> Devenir Sponsor
                    </a>
                    <a href="{{ route('donate.index') }}" class="btn btn-secondary">
                        <i class="fas fa-donate"></i> Faire un don
                    </a>
                </div>
            </div>
        </div>

        <!-- Arrows -->
        <button class="hero-arrow prev" id="hero-prev" aria-label="Image précédente">&#8249;</button>
        <button class="hero-arrow next" id="hero-next" aria-label="Image suivante">&#8250;</button>

        <!-- Dots -->
        <div class="hero-dots" role="tablist">
            <button class="hero-dot active" data-index="0" aria-label="Image 1"></button>
            <button class="hero-dot"        data-index="1" aria-label="Image 2"></button>
            <button class="hero-dot"        data-index="2" aria-label="Image 3"></button>
            <button class="hero-dot"        data-index="3" aria-label="Image 4"></button>
        </div>
    </section>

    <!-- ===== CONTENU PRINCIPAL ===== -->
    <main>
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <div class="logo">
                    <a href="{{ route('home') }}" aria-label="Accueil">
                        <img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'26">
                    </a>
                </div>
                <p>Journées Sahel Digital {{ $edition->annee }}@if($edition->theme) — {{ $edition->theme }}@endif.</p>
                <div class="footer-contact">
                    <p><i class="fas fa-envelope"></i> info@saheldigital.net</p>
                    <p><i class="fas fa-phone"></i> +237 697 460 267</p>
                </div>
            </div>

            <div class="footer-links">
                <h4>Ressources</h4>
                <ul>
                    <li><a href="{{ route('about') }}">À Propos</a></li>
                    <li><a href="{{ route('activities') }}">Activités</a></li>
                    <li><a href="{{ route('ressources.index') }}">Photos &amp; Documents</a></li>
                    <li><a href="{{ route('sponsor.form') }}">Sponsors</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Légal</h4>
                <ul>
                    <li><a href="#">Conditions d'utilisation</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">Code de conduite</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-newsletter">
                <h4>Nous Rejoindre</h4>
                <p>Inscrivez-vous à notre newsletter pour ne rien manquer de {{ $edition->nom }}.</p>
                <form id="newsletter">
                    @csrf
                    <input type="email" name="email" placeholder="Votre adresse email" required>
                    <button type="submit">S'inscrire</button>
                </form>
                <div id="alertContainer" class="hidden"></div>
                <p>Ou suivez-nous sur nos réseaux sociaux :</p>
                <div class="social-icons">
                    <a href="#" class="social-icon telegram">
                        <i class="fab fa-telegram"></i> Telegram
                    </a>
                    <a href="https://chat.whatsapp.com/G6jhDz9XaTn55yGEdrIlEW" class="social-icon whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://web.facebook.com/profile.php?id=61552171995857" class="social-icon discord">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; Journées Sahel Digital {{ $edition->annee }} — Tous droits réservés</p>
            <p>Conçu par <a href="https://2zalab.com" target="_blank" rel="noopener">2zaLab</a></p>
            <div class="social-icons">
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://web.facebook.com/profile.php?id=61552171995857" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </footer>

    <!-- ===== Scroll to top ===== -->
    <button id="scroll-to-top" aria-label="Retour en haut">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ===== Scripts globaux ===== -->
    <script>
    (function () {
        // --- Newsletter AJAX ---
        const form = document.getElementById('newsletter');
        const alertContainer = document.getElementById('alertContainer');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('{{ route('newsletter.subscribe') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => { showAlert(data.message, 'success'); form.reset(); })
                .catch(() => showAlert('Une erreur est survenue. Veuillez réessayer.', 'error'));
            });
        }

        function showAlert(message, type) {
            const cls = type === 'success' ? 'alert-success2' : 'alert-error2';
            alertContainer.innerHTML = `
                <div class="alert ${cls}" style="margin-top:.75rem">
                    <span>${message}</span>
                    <button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;font-size:1.1rem">&times;</button>
                </div>`;
            alertContainer.classList.remove('hidden');
        }

        // --- Menu burger ---
        const toggle = document.getElementById('menu-toggle');
        const links  = document.getElementById('nav-links');

        if (toggle && links) {
            toggle.addEventListener('click', function () {
                const open = links.classList.toggle('show');
                toggle.setAttribute('aria-expanded', open);
            });

            document.addEventListener('click', function (e) {
                if (!toggle.contains(e.target) && !links.contains(e.target)) {
                    links.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            links.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    links.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                });
            });
        }

        // --- Active nav link ---
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href && (href === currentPath || (href !== '/' && currentPath.startsWith(href)))) {
                link.classList.add('active');
            }
        });

        // --- Header scroll shadow ---
        const header = document.getElementById('site-header');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });

        // --- Scroll to top ---
        const scrollBtn = document.getElementById('scroll-to-top');
        window.addEventListener('scroll', () => {
            scrollBtn.classList.toggle('show', window.scrollY > 300);
        }, { passive: true });

        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

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

            function start() {
                timer = setInterval(() => goTo(current + 1), 5000);
            }
            function stop() {
                clearInterval(timer);
            }

            document.getElementById('hero-prev')?.addEventListener('click', () => { stop(); goTo(current - 1); start(); });
            document.getElementById('hero-next')?.addEventListener('click', () => { stop(); goTo(current + 1); start(); });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    stop();
                    goTo(parseInt(dot.dataset.index));
                    start();
                });
            });

            document.getElementById('hero-section')?.addEventListener('mouseenter', stop);
            document.getElementById('hero-section')?.addEventListener('mouseleave', start);

            start();
        })();
    })();
    </script>

    <script src="{{ asset('js/countdown.js') }}"></script>
    @yield('scripts')
</body>
</html>
