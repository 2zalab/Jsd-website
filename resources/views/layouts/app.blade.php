<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JSD'24 - Journées Sahel Digital 2024</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sponsor.css') }}" rel="stylesheet">
    <link href="{{ asset('css/concours.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @yield('styles')
</head>
<body>
    <header>
        <nav>
            <div class="logo">JSD'24</div>
            <ul>
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><a href="{{ route('activities') }}">Activités</a></li>
                <li><a href="{{ route('photos') }}">Photos</a></li>
                <li><a href="{{ route('about') }}">A Propos</a></li>
                <li><a href="{{ route('contacts') }}">Contacts</a></li>
                <li>FR</li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
    <div class="footer-content">
        <div class="footer-left">
            <div class="footer-logo">JSD'24</div>
            <p>Journées Sahel Digital 2024 (JSD'24) Plongez dans un programme riche en innovation, avec des conférences, des ateliers, des concours et des opportunités uniques d'apprentissage</p>
            <br />
            <div class="footer-contact">
                <p><i class="fas fa-envelope"></i> contact@jsd.cm</p>
                <p><i class="fas fa-phone"></i> +237 697460267</p>
            </div>
        </div>
        <div class="footer-links">
            <h4>RESOURCES</h4>
            <ul>
                <li><a href="{{ route('about') }}">A Propos</a></li>
                <li><a href="{{ route('activities') }}">Activités</a></li>
                <li><a href="#">JSD'23</a></li>
                <li><a href="#">Sponsors</a></li>
                <li><a href="{{ route('contacts') }}">Contact</a></li>
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
                <input type="email" placeholder="Saisir votre adresse email">
                <button type="submit">S'inscrire</button>
            </form>
            <p>ou suivez-nous sur nos réseaux sociaux pour rester connecté avec les JSD'24 et ne rien manquer de nos événements</p>
            <div class="social-icons">
                <a href="#" class="social-icon telegram">
                    <i class="fab fa-telegram"></i>
                    <span>Telegram</span>
                </a>
                <a href="#" class="social-icon whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
                <a href="#" class="social-icon discord">
                    <i class="fab fa-discord"></i>
                    <span>Discord</span>
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; Journées sahel digital - 2024. Tous droits réservés</p>
        <p>Designed by 2zaLab</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
        </div>
    </div>
</footer>

    <!--footer>
        <div class="footer-content">
            <div class="footer-logo">JSD'24</div>
            <div class="footer-links">
                <h4>RESOURCES</h4>
                <ul>
                    <li><a href="{{ route('about') }}">A Propos</a></li>
                    <li><a href="{{ route('activities') }}">Activités</a></li>
                    <li><a href="#">JSD'23</a></li>
                    <li><a href="#">Sponsors</a></li>
                    <li><a href="{{ route('contacts') }}">Contact</a></li>
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
                <form>
                    <input type="email" placeholder="Saisir votre adresse email">
                    <button type="submit">S'inscrire</button>
                </form>
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('images/telegram.png') }}" alt="Telegram"></a>
                    <a href="#"><img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp"></a>
                    <a href="#"><img src="{{ asset('images/discord.png') }}" alt="Discord"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Journées sahel digital - 2024. Tous droits réservés.</p>
            <p>Designed by 2zaLab</p>
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/twitter.png') }}" alt="Twitter"></a>
                <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn"></a>
                <a href="#"><img src="{{ asset('images/github.png') }}" alt="GitHub"></a>
            </div>
        </div>
    </footer-->

    <script src="{{ asset('js/countdown.js') }}"></script>
    @yield('scripts')

</body>
</html>
