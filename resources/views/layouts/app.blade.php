<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JSD'24 - Journées Sahel Digital 2024</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sponsor.css') }}" rel="stylesheet">
    <link href="{{ asset('css/concours.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dialog-message-styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>
    @yield('styles')
</head>
<body>
    <header>
        <nav class="relative">
        <div class="container mx-auto">
            <div class="flex justify-between px-0 py-0">
                <!-- Logo à gauche -->
                <div class="logo flex-shrink-0">
                    <a href="{{ route('home') }}" id="logo">
                        <img src="{{ asset('images/logo_jsd.png') }}" alt="logo">
                    </a>
                </div>
                
                <!-- Menu de navigation (masqué sur mobile) -->
                <ul class="hidden md:flex md:items-center md:space-x-8" id="mobile-menu">
                    <li><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                    <li><a href="{{ route('activities') }}" class="nav-link">Activités</a></li>
                    <li><a href="{{ route('photos.index') }}" class="nav-link">Photos</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link">A Propos</a></li>
                    <li><a href="{{ route('contact.index') }}" class="nav-link">Contact</a></li>
                    <li><a href="{{ route('concours.index') }}" class="nav-link">S'incrire</a></li>
                </ul>
                
                <!-- Bouton menu burger à droite -->
                <button id="menu-toggle" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <style>
        .nav-link {
            @apply  text-gray-700 hover:text-gray-900 transition-colors duration-200;
        }

        #scroll-to-top {
            transition: opacity 0.3s, visibility 0.3s;
            opacity: 0;
            visibility: hidden;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
        }
        #scroll-to-top.show {
            opacity: 1;
            visibility: visible;
            display: block;
        }

        @media (max-width: 768px) {
            #mobile-menu {
                display: none;
                position: absolute;
                top: 100%;
                right: 0;
                background-color: #fff;
                padding-left: 0.5rem;
                padding-right:6rem; 
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                z-index: 20;
                transition: all 0.3s ease-in-out;
                align-items: left;
            }
            #mobile-menu.show {
                display: block;
            }
            #mobile-menu li {
                display: block;
                margin: 0.6rem 0;
                text-align: left;
            }
            .nav-link {
                display: block;
                padding: 0.5rem 1rem;
            }
        }
    </style>
    </header>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-left">
                <h1>Journées<br>Sahel digital 2024</h1>
                <p class="subtitle">Innovation à l'ère de l'intelligence Artificielle</p>
                <hr/>
            </div>
            <div class="hero-right">
                <h2>Deuxième édition</h2>
                <div class="cta-buttons">
                    <a href="{{ route('sponsor.form') }}" class="btn btn-primary">
                        <i class="fas fa-handshake"></i> Devenir Sponsor
                    </a>
                    <a href="{{ route(name: 'donate.index') }}" class="btn btn-secondary">
                        <i class="fas fa-donate"></i> Faire un don
                    </a>
                </div>

            </div>
        </div>
    </section>

    <main>
        @yield('content')
    </main>

    <button id="scroll-to-top" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 9999; font-size: 18px; border: none; outline: none; background-color: #007bff; color: white; cursor: pointer; padding: 15px; border-radius: 4px;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <div class="logo">
                    <a href="{{ route('home') }}" id="logo">
                    <img src="{{ asset('images/logo-jsd.png') }}" alt="logo">
                    </a>
                </div>
                <!--div class="footer-logo">
                    <a href="{{ route('home') }}" id="logo">
                    JSD'24
                    </a>
                </div-->
                <p>Journées Sahel Digital 2024 (JSD'24) Plongez dans un programme riche en innovation, avec des conférences, des ateliers, des concours et des opportunités uniques d'apprentissage</p>
                <br />
                <div class="footer-contact">
                    <p><i class="fas fa-envelope"></i> info@saheldigital.net</p>
                    <p><i class="fas fa-phone"></i> +237 697 460 267</p>
                </div>
            </div>
            <div class="footer-links">
                <h4>RESOURCES</h4>
                <ul>
                    <li><a href="{{ route('about') }}">A Propos</a></li>
                    <li><a href="{{ route('activities') }}">Activités</a></li>
                    <li><a href="#">JSD'23</a></li>
                    <li><a href="{{ route('sponsor.form') }}">Sponsors</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                    <li><a href="#">Branding</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>LEGAL</h4>
                <ul>
                    <li><a href="#">Conditions d'utilisation</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">Code de conduite</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h4>NOUS REJOINDRE</h4>
                <p>Inscrivez-vous à notre newsletter pour recevoir en exclusivité toutes les informations sur les Journées Sahel Digital 2024.</p>
                <form id="newsletter">
                @csrf
                <input type="email" name="email" placeholder="Saisir votre adresse email" class="px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">S'inscrire</button>
                </form>

                <div id="alertContainer" class="hidden"></div>

                <p>ou suivez-nous sur nos réseaux sociaux pour rester connecté avec les JSD'24 et ne rien manquer de nos événements</p>
                <div class="social-icons">
                    <a href="#" class="social-icon telegram">
                        <i class="fab fa-telegram"></i>
                        <span>Telegram</span>
                    </a>
                    <a href="https://chat.whatsapp.com/G6jhDz9XaTn55yGEdrIlEW" class="social-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                    <a href="https://web.facebook.com/profile.php?id=61552171995857" class="social-icon discord">
                        <i class="fab fa-facebook"></i>
                        <span>Facebook</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Journées sahel digital - 2024. Tous droits réservés</p>
            <p>Designed by <a class="2za" href="https://2zalab.com">2zaLab</a> </p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="https://web.facebook.com/profile.php?id=61552171995857"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('newsletter');
            const alertContainer = document.getElementById('alertContainer');

            form.addEventListener('submit', function(e) {
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
                .then(response => response.json())
                .then(data => {
                    showAlert(data.message, 'success');
                    form.reset();
                })
                .catch(error => {
                    showAlert('Une erreur est survenue. Veuillez réessayer.', 'error');
                });
            });

            function showAlert(message, type) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
                alertContainer.innerHTML = `
                    <div class="alert ${alertClass}2">
                        <span>${message}</span>
                        <button class="message-close-button" id="btn-close" onclick="closeAlert()">&times;</button>
                    </div>
                `;
                alertContainer.classList.remove('hidden');

                // Définition correcte de la fonction closeAlert
                const closeButton = alertContainer.querySelector('.message-close-button');
                closeButton.addEventListener('click', function() {
                    alertContainer.classList.add('hidden');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            
            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('show');
            });

            // Fermer le menu si on clique en dehors
            document.addEventListener('click', function(event) {
                const isClickInside = menuToggle.contains(event.target) || mobileMenu.contains(event.target);
                
                if (!isClickInside && mobileMenu.classList.contains('show')) {
                    mobileMenu.classList.remove('show');
                }
            });

            // Fermer le menu après avoir cliqué sur un lien
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        mobileMenu.classList.remove('show');
                    }
                });
            });
        });

        // Scroll to top button
        let mybutton = document.getElementById("scroll-to-top");

        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }

        mybutton.onclick = function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
     </script>

    <script src="{{ asset('js/countdown.js') }}"></script>
    @yield('scripts')

</body>
</html>
