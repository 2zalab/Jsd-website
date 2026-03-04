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
        --sidebar-bg: #0f172a;
        --sidebar-border: rgba(255,255,255,.06);
        --accent: #6366f1;
        --accent-hover: #4f46e5;
        --text-muted: #94a3b8;
        --text-light: #cbd5e1;
        --topbar-h: 60px;
    }

    body { font-family: 'Inter', sans-serif; background: #f1f5f9; color: #1e293b; }

    /* ── Sidebar ── */
    .sidebar {
        position: fixed; top: 0; left: 0; bottom: 0;
        width: var(--sidebar-w);
        background: var(--sidebar-bg);
        display: flex; flex-direction: column;
        z-index: 100;
        overflow: hidden;
    }
    .sidebar-brand {
        height: var(--topbar-h);
        display: flex; align-items: center; gap: 10px;
        padding: 0 20px;
        border-bottom: 1px solid var(--sidebar-border);
        flex-shrink: 0;
    }
    .sidebar-brand .brand-icon {
        width: 32px; height: 32px; border-radius: 8px;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; color: #fff;
    }
    .sidebar-brand span { font-size: 16px; font-weight: 700; color: #fff; }
    .sidebar-brand small { font-size: 10px; color: var(--text-muted); display: block; }

    .sidebar-scroll {
        flex: 1; overflow-y: auto; padding: 12px 0;
    }
    .sidebar-scroll::-webkit-scrollbar { width: 4px; }
    .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 2px; }

    /* section label */
    .nav-section-label {
        font-size: 10px; font-weight: 600; letter-spacing: .08em;
        color: #475569; text-transform: uppercase;
        padding: 12px 20px 4px;
    }

    /* nav item */
    .nav-item { position: relative; }
    .nav-link {
        display: flex; align-items: center; gap: 11px;
        padding: 9px 20px;
        font-size: 13.5px; font-weight: 500;
        color: var(--text-muted);
        text-decoration: none; cursor: pointer;
        border-radius: 0;
        transition: color .15s, background .15s;
        border: none; background: none; width: 100%;
        text-align: left;
    }
    .nav-link:hover { color: #fff; background: rgba(255,255,255,.06); }
    .nav-link.active { color: #fff; background: rgba(99,102,241,.18); }
    .nav-link.active .nav-icon { color: var(--accent); }
    .nav-icon {
        width: 18px; text-align: center;
        font-size: 14px; color: #475569;
        transition: color .15s; flex-shrink: 0;
    }
    .nav-link:hover .nav-icon { color: var(--text-light); }
    .nav-chevron {
        margin-left: auto; font-size: 11px; color: #475569;
        transition: transform .2s;
    }
    .nav-item.open > .nav-link .nav-chevron { transform: rotate(90deg); }

    /* submenu */
    .submenu {
        max-height: 0; overflow: hidden;
        transition: max-height .25s ease;
        background: rgba(0,0,0,.2);
    }
    .nav-item.open .submenu { max-height: 300px; }
    .submenu-link {
        display: flex; align-items: center; gap: 8px;
        padding: 7px 20px 7px 50px;
        font-size: 12.5px; font-weight: 500;
        color: #64748b;
        text-decoration: none; cursor: pointer;
        border: none; background: none; width: 100%; text-align: left;
        transition: color .15s;
    }
    .submenu-link::before {
        content: ''; width: 5px; height: 5px; border-radius: 50%;
        background: #334155; flex-shrink: 0;
        transition: background .15s;
    }
    .submenu-link:hover { color: #fff; }
    .submenu-link:hover::before { background: var(--accent); }

    /* sidebar footer */
    .sidebar-footer {
        padding: 14px 20px;
        border-top: 1px solid var(--sidebar-border);
        flex-shrink: 0;
    }
    .sidebar-user {
        display: flex; align-items: center; gap: 10px;
    }
    .sidebar-avatar {
        width: 34px; height: 34px; border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 14px; color: #fff; flex-shrink: 0;
    }
    .sidebar-user-info { flex: 1; min-width: 0; }
    .sidebar-user-name { font-size: 12.5px; font-weight: 600; color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sidebar-user-role { font-size: 10.5px; color: #64748b; }
    .logout-btn {
        background: none; border: none; color: #475569; cursor: pointer;
        font-size: 14px; padding: 4px; border-radius: 6px;
        transition: color .15s, background .15s;
    }
    .logout-btn:hover { color: #ef4444; background: rgba(239,68,68,.1); }

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
        border-bottom: 1px solid #e2e8f0;
        display: flex; align-items: center; justify-content: space-between;
        padding: 0 28px;
        position: sticky; top: 0; z-index: 50;
        gap: 16px;
    }
    .topbar-left { display: flex; align-items: center; gap: 8px; }
    .breadcrumb { font-size: 13px; color: #94a3b8; display: flex; align-items: center; gap: 6px; }
    .breadcrumb span { color: #1e293b; font-weight: 600; }
    .topbar-right { display: flex; align-items: center; gap: 12px; }
    .topbar-greeting { font-size: 13px; color: #64748b; }
    .topbar-greeting strong { color: #1e293b; }

    /* ── Content ── */
    .main-content-area {
        flex: 1; padding: 0;
        overflow-x: hidden;
    }
    #main-content { min-height: calc(100vh - var(--topbar-h)); }

    /* ── Loading spinner ── */
    #page-loader {
        position: fixed; inset: 0; background: rgba(15,23,42,.45);
        display: flex; align-items: center; justify-content: center;
        z-index: 999; opacity: 0; pointer-events: none;
        transition: opacity .2s;
    }
    #page-loader.visible { opacity: 1; pointer-events: all; }
    .loader-ring {
        width: 44px; height: 44px; border-radius: 50%;
        border: 3px solid rgba(255,255,255,.2);
        border-top-color: #fff;
        animation: spin .7s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── Print helper (for PDF export) ── */
    @media print {
        .sidebar, .topbar { display: none !important; }
        .main-wrapper { margin: 0; }
        #main-content { padding: 0; }
    }
    </style>
</head>
<body>

<!-- ── Loader ── -->
<div id="page-loader"><div class="loader-ring"></div></div>

<!-- ── Sidebar ── -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fas fa-bolt"></i></div>
        <div>
            <span>JSD Admin</span>
            <small>Journées Sahel Digital</small>
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
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                <div class="sidebar-user-role">Administrateur</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- ── Main ── -->
<div class="main-wrapper">

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="breadcrumb">
                <i class="fas fa-home" style="font-size:12px"></i>
                <i class="fas fa-chevron-right" style="font-size:9px;color:#cbd5e1"></i>
                <span id="page-title">Tableau de bord</span>
            </div>
        </div>
        <div class="topbar-right">
            <span class="topbar-greeting">Bonjour, <strong>{{ Auth::user()->name }}</strong> 👋</span>
        </div>
    </header>

    <!-- Content -->
    <main class="main-content-area">
        <div id="main-content"></div>
    </main>
</div>

<script>
(function () {
    const loader    = document.getElementById('page-loader');
    const mainEl    = document.getElementById('main-content');
    const pageTitle = document.getElementById('page-title');
    const csrf      = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    /* ── load page via AJAX ── */
    function loadContent(url, title) {
        loader.classList.add('visible');
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
        .finally(() => loader.classList.remove('visible'));
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
