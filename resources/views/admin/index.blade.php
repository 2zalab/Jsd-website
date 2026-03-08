<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JSD Admin — Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --sidebar-w: 260px;
        --accent: #6366f1;
        --accent-hover: #4f46e5;
        --topbar-h: 60px;
    }

    body { font-family: 'Inter', sans-serif; background: #f4f6fb; color: #1e293b; margin: 0; }

    /* ── Sidebar ── */
    .sidebar {
        position: fixed; top: 0; left: 0; bottom: 0;
        width: var(--sidebar-w);
        background: #fff;
        border-right: 1px solid #e8ecf0;
        display: flex; flex-direction: column;
        z-index: 100;
        overflow: hidden;
        transition: transform .25s ease;
    }

    /* Brand / logo */
    .sidebar-brand {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        flex-shrink: 0;
    }
    .sidebar-brand img { height: 36px; display: block; }

    /* User block */
    .sidebar-user-block {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; gap: .875rem;
    }
    .sidebar-avatar {
        width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: .95rem; color: #fff;
    }
    .sidebar-user-name { font-size: .85rem; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.3; }
    .sidebar-user-role { font-size: .72rem; color: #94a3b8; display: block; margin-top: 1px; }

    /* Scrollable nav */
    .sidebar-scroll {
        flex: 1; overflow-y: auto; padding: .75rem 0;
    }
    .sidebar-scroll::-webkit-scrollbar { width: 4px; }
    .sidebar-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 2px; }

    /* Section label */
    .nav-section-label {
        padding: .5rem 1.5rem .2rem;
        font-size: .68rem; font-weight: 700;
        letter-spacing: .08em; text-transform: uppercase;
        color: #94a3b8;
    }

    /* Nav item */
    .nav-item { position: relative; }
    .nav-link {
        display: flex; align-items: center; gap: .75rem;
        padding: .6rem 1.5rem;
        font-size: .875rem; font-weight: 500;
        color: #64748b;
        text-decoration: none; cursor: pointer;
        transition: color .15s, background .15s;
        border: none; background: none; width: 100%;
        text-align: left; font-family: inherit;
        position: relative;
    }
    .nav-link:hover { color: var(--accent); background: rgba(99,102,241,.06); }
    .nav-link.active { color: var(--accent-hover); background: rgba(99,102,241,.09); font-weight: 600; }
    .nav-link.active::before {
        content: ''; position: absolute; left: 0; top: 15%; bottom: 15%;
        width: 3px; background: var(--accent-hover); border-radius: 0 4px 4px 0;
    }
    .nav-icon {
        width: 18px; text-align: center;
        font-size: .9rem; flex-shrink: 0;
        color: #94a3b8; transition: color .15s;
    }
    .nav-link:hover .nav-icon,
    .nav-link.active .nav-icon { color: var(--accent); }
    .nav-chevron {
        margin-left: auto; font-size: 11px; color: #cbd5e1;
        transition: transform .2s;
    }
    .nav-item.open > .nav-link .nav-chevron { transform: rotate(90deg); }

    /* Submenu */
    .submenu {
        max-height: 0; overflow: hidden;
        transition: max-height .25s ease;
        background: #fafbfc;
        border-top: 1px solid transparent;
    }
    .nav-item.open .submenu { max-height: 300px; border-top-color: #f1f5f9; }
    .submenu-link {
        display: flex; align-items: center; gap: .6rem;
        padding: .55rem 1.5rem .55rem 3.1rem;
        font-size: .82rem; font-weight: 500;
        color: #64748b;
        text-decoration: none; cursor: pointer;
        border: none; background: none; width: 100%; text-align: left;
        font-family: inherit;
        transition: color .15s, background .15s;
    }
    .submenu-link::before {
        content: ''; width: 5px; height: 5px; border-radius: 50%;
        background: #e2e8f0; flex-shrink: 0;
        transition: background .15s;
    }
    .submenu-link:hover { color: var(--accent); background: rgba(99,102,241,.05); }
    .submenu-link:hover::before { background: var(--accent); }
    .submenu-link.active { color: var(--accent-hover); font-weight: 600; }
    .submenu-link.active::before { background: var(--accent); }

    /* Sidebar footer */
    .sidebar-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #f1f5f9;
        flex-shrink: 0;
    }
    .logout-btn {
        display: flex; align-items: center; gap: .75rem;
        font-size: .85rem; color: #64748b;
        cursor: pointer; background: none; border: none;
        width: 100%; text-align: left; padding: .45rem 0;
        font-family: inherit; transition: color .15s;
    }
    .logout-btn:hover { color: #ef4444; }
    .logout-btn i { width: 18px; text-align: center; }

    /* ── Main layout ── */
    .main-wrapper {
        margin-left: var(--sidebar-w);
        display: flex; flex-direction: column;
        min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
        height: var(--topbar-h);
        background: #fff;
        border-bottom: 1px solid #e8ecf0;
        display: flex; align-items: center; justify-content: space-between;
        padding: 0 2rem;
        position: sticky; top: 0; z-index: 50;
        gap: 1rem;
    }
    .topbar-left { display: flex; align-items: center; gap: .5rem; }
    .breadcrumb { font-size: .82rem; color: #94a3b8; display: flex; align-items: center; gap: .4rem; }
    .breadcrumb span { color: #0f172a; font-weight: 700; }
    .topbar-right { display: flex; align-items: center; gap: .875rem; }
    .topbar-greeting { font-size: .82rem; color: #64748b; }
    .topbar-greeting strong { color: #0f172a; }

    /* Mobile topbar */
    .mobile-topbar {
        display: none; position: sticky; top: 0; z-index: 90;
        background: #fff; border-bottom: 1px solid #e8ecf0;
        padding: .875rem 1.25rem; align-items: center; justify-content: space-between;
    }
    .mobile-topbar img { height: 30px; }
    .hamburger-btn {
        background: none; border: none; cursor: pointer;
        color: #475569; font-size: 1.2rem; padding: .25rem;
    }
    .sidebar-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,.35); z-index: 99;
    }
    .sidebar-overlay.show { display: block; }

    /* ── Content ── */
    .main-content-area { flex: 1; padding: 0; overflow-x: hidden; }
    #main-content { min-height: calc(100vh - var(--topbar-h)); }

    /* ── Loading spinner ── */
    #page-loader {
        position: fixed; inset: 0; background: rgba(15,23,42,.35);
        display: flex; align-items: center; justify-content: center;
        z-index: 999; opacity: 0; pointer-events: none;
        transition: opacity .1s;
    }
    #page-loader.visible { opacity: 1; pointer-events: all; }
    .loader-ring {
        width: 48px; height: 48px; border-radius: 50%;
        border: 4px solid rgba(255,255,255,.25);
        border-top-color: #fff;
        animation: spin .65s linear infinite;
        box-shadow: 0 0 0 1px rgba(99,102,241,.5);
    }
    /* Barre de progression en haut */
    #page-progress {
        position: fixed; top: 0; left: 0; height: 3px; width: 0%;
        background: linear-gradient(90deg, #6366f1, #a855f7);
        z-index: 1000; transition: width .4s ease, opacity .3s;
        opacity: 0;
    }
    #page-progress.running { opacity: 1; }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
        .sidebar { transform: translateX(-100%); }
        .sidebar.mobile-open { transform: translateX(0); }
        .main-wrapper { margin-left: 0; }
        .topbar { display: none; }
        .mobile-topbar { display: flex; }
    }

    /* ── Print ── */
    @media print {
        .sidebar, .topbar, .mobile-topbar { display: none !important; }
        .main-wrapper { margin: 0; }
        #main-content { padding: 0; }
    }
    </style>
</head>
<body>

<!-- ── Loader ── -->
<div id="page-loader"><div class="loader-ring"></div></div>

<div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>

<!-- ── Sidebar ── -->
<aside class="sidebar" id="admin-sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}"><img src="{{ asset('images/logo_jsd.png') }}" alt="JSD"></a>
    </div>

    <div class="sidebar-user-block">
        <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        <div>
            <p class="sidebar-user-name">{{ Auth::user()->name }}</p>
            <span class="sidebar-user-role"><i class="fas fa-shield-alt" style="color:#6366f1;font-size:.65rem"></i> Administrateur</span>
        </div>
    </div>

    <nav class="sidebar-scroll">

        <div class="nav-section-label">Principal</div>

        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <span>Tableau de bord</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.messages') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-envelope"></i>
                <span>Messages</span>
            </a>
        </div>

        <div class="nav-section-label">Inscriptions & Concours</div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <span>Inscriptions</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('admin.inscriptions') }}" class="submenu-link menu-link">Vue consolidée</a>
                <a href="{{ route('admin.programmeurs.create') }}" class="submenu-link menu-link">+ Programmeur</a>
                <a href="{{ route('admin.projets.create') }}" class="submenu-link menu-link">+ Projet Digital</a>
                <a href="{{ route('admin.hackathons.create') }}" class="submenu-link menu-link">+ Hackathon</a>
                <a href="{{ route('admin.stands.create') }}" class="submenu-link menu-link">+ Stand</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-code"></i>
                <span>Hackathon</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('hackathons.lycee') }}" class="submenu-link menu-link">Hackathon Lycée</a>
                <a href="{{ route('hackathons.superieur') }}" class="submenu-link menu-link">Hackathon Supérieur</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-trophy"></i>
                <span>Meilleur Programmeur</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('concours.cmpl') }}" class="submenu-link menu-link">Niveau Lycée</a>
                <a href="{{ route('concours.cmps') }}" class="submenu-link menu-link">Niveau Supérieur</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-laptop-code"></i>
                <span>Meilleur Projet Digital</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('concours.cmpdl') }}" class="submenu-link menu-link">Niveau Lycée</a>
                <a href="{{ route('concours.cmpds') }}" class="submenu-link menu-link">Niveau Supérieur</a>
            </div>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.stands') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-store"></i>
                <span>Réservation Stand</span>
            </a>
        </div>

        <div class="nav-section-label">Contenu du Site</div>

        <div class="nav-item">
            <a href="{{ route('admin.editions.index') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <span>Éditions JSD</span>
            </a>
        </div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-handshake"></i>
                <span>Partenaires</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('admin.partenaires.index') }}" class="submenu-link menu-link">Tous les partenaires</a>
                <a href="{{ route('admin.partenaires.create') }}" class="submenu-link menu-link">+ Ajouter</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-calendar-check"></i>
                <span>Activités</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('admin.activites.index') }}" class="submenu-link menu-link">Toutes les activités</a>
                <a href="{{ route('admin.activites.create') }}" class="submenu-link menu-link">+ Ajouter</a>
            </div>
        </div>

        <div class="nav-item">
            <button class="nav-link nav-toggle">
                <i class="nav-icon fas fa-photo-video"></i>
                <span>Ressources</span>
                <i class="nav-chevron fas fa-chevron-right"></i>
            </button>
            <div class="submenu">
                <a href="{{ route('admin.ressources.index') }}" class="submenu-link menu-link">Toutes les ressources</a>
                <a href="{{ route('admin.ressources.create') }}" class="submenu-link menu-link">+ Ajouter</a>
            </div>
        </div>

        <div class="nav-section-label">Administration</div>

        <div class="nav-item">
            <a href="{{ route('admin.donations.index') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-hand-holding-heart"></i>
                <span>Dons</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.sponsors') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <span>Sponsoring</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.newsletter') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-paper-plane"></i>
                <span>Newsletter</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.notifications') }}" class="nav-link menu-link">
                <i class="nav-icon fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </div>

    </nav>

    <!-- Sidebar footer -->
    <div class="sidebar-footer">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.75rem;font-size:.85rem;color:#64748b;text-decoration:none;padding:.4rem 0;transition:color .15s" onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#64748b'">
            <i style="width:18px;text-align:center" class="fas fa-arrow-left"></i> Retour au site
        </a>
        <form action="{{ route('logout') }}" method="POST" style="margin-top:4px">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
            </button>
        </form>
    </div>
</aside>

<!-- ── Main ── -->
<div class="main-wrapper">

    <!-- Mobile topbar -->
    <div class="mobile-topbar">
        <img src="{{ asset('images/logo_jsd.png') }}" alt="JSD">
        <button class="hamburger-btn" onclick="openSidebar()"><i class="fas fa-bars"></i></button>
    </div>

    <!-- Desktop Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="breadcrumb">
                <i class="fas fa-home" style="font-size:11px"></i>
                <i class="fas fa-chevron-right" style="font-size:9px;color:#cbd5e1"></i>
                <span id="page-title">Tableau de bord</span>
            </div>
        </div>
        <div class="topbar-right">
            <span class="topbar-greeting">Bonjour, <strong>{{ Auth::user()->name }}</strong> 👋</span>
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:.4rem;font-size:.8rem;color:#64748b;text-decoration:none;padding:.4rem .75rem;border:1px solid #e2e8f0;border-radius:8px;transition:all .15s" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                <i class="fas fa-external-link-alt" style="font-size:.7rem"></i> Voir le site
            </a>
        </div>
    </header>

    <!-- Content -->
    <main class="main-content-area">
        <div id="main-content"></div>
    </main>
</div>
<div id="page-progress"></div>

<script>
function openSidebar() {
    document.getElementById('admin-sidebar').classList.add('mobile-open');
    document.getElementById('sidebar-overlay').classList.add('show');
}
function closeSidebar() {
    document.getElementById('admin-sidebar').classList.remove('mobile-open');
    document.getElementById('sidebar-overlay').classList.remove('show');
}

(function () {
    const loader    = document.getElementById('page-loader');
    const progress  = document.getElementById('page-progress');
    const mainEl    = document.getElementById('main-content');
    const pageTitle = document.getElementById('page-title');
    const csrf      = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    /* ── Progress bar helpers ── */
    let _progTimer = null;
    function startProgress() {
        progress.style.width = '0%';
        progress.classList.add('running');
        let w = 0;
        _progTimer = setInterval(() => {
            w = Math.min(w + Math.random() * 18, 88);
            progress.style.width = w + '%';
        }, 120);
    }
    function finishProgress() {
        clearInterval(_progTimer);
        progress.style.width = '100%';
        setTimeout(() => { progress.classList.remove('running'); progress.style.width = '0%'; }, 350);
    }

    /* ── load page via AJAX ── */
    function loadContent(url, title) {
        loader.classList.add('visible');
        startProgress();
        fetch(url, {
            headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.text())
        .then(html => {
            mainEl.innerHTML = html;
            /* Re-execute <script> tags — innerHTML does NOT auto-execute them (HTML5 spec) */
            mainEl.querySelectorAll('script').forEach(oldScript => {
                const s = document.createElement('script');
                Array.from(oldScript.attributes).forEach(a => s.setAttribute(a.name, a.value));
                s.textContent = oldScript.textContent;
                oldScript.parentNode.replaceChild(s, oldScript);
            });
            if (title) pageTitle.textContent = title;
            attachFormListeners();
            updateActiveLink(url);
        })
        .catch(() => { mainEl.innerHTML = '<p style="padding:2rem;color:#ef4444">Erreur de chargement.</p>'; })
        .finally(() => { loader.classList.remove('visible'); finishProgress(); });
    }

    /* expose globally so partials can call loadContent() */
    window.loadContent = loadContent;

    /* ── form submit handler (for search forms inside content) ── */
    function attachFormListeners() {
        const form = document.getElementById('search-form');
        if (form) {
            form.removeEventListener('submit', handleSearch);
            form.addEventListener('submit', handleSearch);
        }
        document.querySelectorAll('.delete-message-form').forEach(f => {
            f.removeEventListener('submit', handleDeleteMsg);
            f.addEventListener('submit', handleDeleteMsg);
        });
    }
    function handleSearch(e) {
        e.preventDefault();
        const url = e.target.action + '?' + new URLSearchParams(new FormData(e.target)).toString();
        loadContent(url);
    }
    function handleDeleteMsg(e) {
        e.preventDefault();
        fetch(e.target.action, {
            method: e.target.method,
            headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
            body: new FormData(e.target)
        })
        .then(r => r.json())
        .then(d => { if (d.success) loadContent('{{ route("admin.messages") }}', 'Messages'); });
    }

    /* ── active link highlight ── */
    function updateActiveLink(url) {
        document.querySelectorAll('.nav-link, .submenu-link').forEach(l => l.classList.remove('active'));
        const match = document.querySelector(`.nav-link[href="${url}"], .submenu-link[href="${url}"]`);
        if (match) {
            match.classList.add('active');
            const parent = match.closest('.nav-item');
            if (parent) parent.classList.add('open');
        }
    }

    /* ── nav link clicks (event delegation — works for static AND dynamic content) ── */
    document.addEventListener('click', function (e) {
        const link = e.target.closest('a.menu-link, a.submenu-link');
        if (!link) return;
        const url = link.getAttribute('href');
        if (!url || url === '#') return;
        e.preventDefault();
        const title = link.querySelector('span')?.textContent || link.textContent.trim();
        loadContent(url, title);
    });

    /* ── toggle submenu ── */
    document.querySelectorAll('.nav-toggle').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const item = this.closest('.nav-item');
            const isOpen = item.classList.contains('open');
            // close all
            document.querySelectorAll('.nav-item.open').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        });
    });

    /* ── initial load ── */
    loadContent('{{ route("admin.dashboard") }}', 'Tableau de bord');
})();
</script>
</body>
</html>
