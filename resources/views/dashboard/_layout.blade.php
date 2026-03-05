{{--
  Shared layout for user dashboard pages.
  Variables expected by caller:
    $user       — Auth user
    $unread     — int unread notifications
    $pageTitle  — string  (e.g. "Vue d'ensemble")
    $activeNav  — string  (home | notifications | profile)
    $slot       — page content (via @yield('content'))
--}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Mon Espace' }} — JSD'24</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* ── Reset / base ── */
        *,*::before,*::after{box-sizing:border-box}
        body{background:#f4f6fb;font-family:'Inter',sans-serif;margin:0}

        /* ── Layout ── */
        .ds-layout{display:flex;min-height:100vh}

        /* ── Sidebar ── */
        .ds-sidebar{
            width:260px;flex-shrink:0;background:#fff;
            border-right:1px solid #e8ecf0;
            display:flex;flex-direction:column;
            position:fixed;top:0;left:0;height:100vh;
            overflow-y:auto;z-index:100;
            transition:transform .25s ease;
        }
        .ds-sidebar.mobile-open{transform:translateX(0)}
        .ds-logo{padding:1.25rem 1.5rem;border-bottom:1px solid #f1f5f9}
        .ds-logo img{height:36px}
        .ds-user-block{
            padding:1rem 1.5rem;border-bottom:1px solid #f1f5f9;
            display:flex;align-items:center;gap:.875rem;
        }
        .ds-avatar{
            width:40px;height:40px;border-radius:50%;flex-shrink:0;
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            display:flex;align-items:center;justify-content:center;
            color:#fff;font-weight:800;font-size:.95rem;
        }
        .ds-user-name{font-size:.85rem;font-weight:700;color:#0f172a;margin:0;line-height:1.3}
        .ds-user-role{font-size:.72rem;color:#94a3b8;display:block;margin-top:1px}

        /* ── Nav ── */
        .ds-nav{flex:1;padding:.75rem 0}
        .ds-nav-section{
            padding:.5rem 1.5rem .2rem;font-size:.68rem;font-weight:700;
            letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;
        }
        .ds-nav-link{
            display:flex;align-items:center;gap:.75rem;
            padding:.6rem 1.5rem;font-size:.875rem;color:#64748b;
            text-decoration:none;transition:all .15s;position:relative;
        }
        .ds-nav-link:hover{background:rgba(99,102,241,.06);color:#6366f1}
        .ds-nav-link.active{background:rgba(99,102,241,.09);color:#4f46e5;font-weight:600}
        .ds-nav-link.active::before{
            content:'';position:absolute;left:0;top:15%;bottom:15%;
            width:3px;background:#4f46e5;border-radius:0 4px 4px 0;
        }
        .ds-nav-link i{width:18px;text-align:center;font-size:.9rem;flex-shrink:0}
        .ds-badge{
            margin-left:auto;background:#ef4444;color:#fff;
            font-size:.65rem;font-weight:700;padding:.1rem .4rem;
            border-radius:999px;min-width:17px;text-align:center;
        }

        /* ── Sidebar footer ── */
        .ds-sidebar-footer{padding:1rem 1.5rem;border-top:1px solid #f1f5f9}
        .ds-logout{
            display:flex;align-items:center;gap:.75rem;font-size:.85rem;
            color:#64748b;cursor:pointer;background:none;border:none;
            width:100%;text-align:left;padding:.45rem 0;
            font-family:inherit;transition:color .15s;
        }
        .ds-logout:hover{color:#ef4444}
        .ds-logout i{width:18px;text-align:center}

        /* ── Main ── */
        .ds-main{
            margin-left:260px;flex:1;
            padding:2rem 2.5rem;max-width:1060px;
            min-height:100vh;
        }

        /* ── Topbar (mobile) ── */
        .ds-topbar{
            display:none;position:sticky;top:0;z-index:90;
            background:#fff;border-bottom:1px solid #e8ecf0;
            padding:.875rem 1.25rem;align-items:center;justify-content:space-between;
        }
        .ds-topbar img{height:30px}
        .ds-hamburger{
            background:none;border:none;cursor:pointer;
            color:#475569;font-size:1.2rem;padding:.25rem;
        }
        .ds-overlay{
            display:none;position:fixed;inset:0;
            background:rgba(0,0,0,.35);z-index:99;
        }
        .ds-overlay.show{display:block}

        /* ── Responsive ── */
        @@media(max-width:1024px){
            .ds-sidebar{transform:translateX(-100%)}
            .ds-main{margin-left:0;padding:1.5rem}
            .ds-topbar{display:flex}
        }
        @@media(max-width:640px){
            .ds-main{padding:1rem}
        }

        /* ── Inscription modal ── */
        .insc-overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:2000;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s}
        .insc-overlay.open{opacity:1;pointer-events:all}
        .insc-box{background:#fff;border-radius:20px;padding:2rem;max-width:560px;width:calc(100% - 2rem);box-shadow:0 24px 64px rgba(0,0,0,.2);transform:scale(.96);transition:transform .2s}
        .insc-overlay.open .insc-box{transform:scale(1)}
        .insc-box-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1.5rem}
        .insc-box-title{font-size:1.15rem;font-weight:800;color:#0f172a}
        .insc-box-sub{font-size:.82rem;color:#94a3b8;margin-top:.25rem}
        .insc-close{background:none;border:none;cursor:pointer;color:#94a3b8;font-size:1.1rem;padding:.3rem .4rem;border-radius:8px;transition:all .15s;flex-shrink:0}
        .insc-close:hover{background:#f1f5f9;color:#374151}
        .insc-type-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.875rem}
        .insc-type-card{border:2px solid #e2e8f0;border-radius:14px;padding:1.25rem .875rem;text-align:center;cursor:pointer;transition:all .15s;background:#fff}
        .insc-type-card:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.09)}
        .itc-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;margin:0 auto .875rem}
        .itc-name{font-size:.9rem;font-weight:700;color:#0f172a;margin-bottom:.2rem}
        .itc-sub{font-size:.72rem;color:#94a3b8}

        /* ── Form panels (side-panel — sidebar stays visible) ── */
        .form-panel{position:fixed;left:260px;top:0;bottom:0;right:0;z-index:200;background:#f4f6fb;overflow-y:auto;transform:translateX(calc(100% + 260px));transition:transform .3s cubic-bezier(.32,.72,0,1)}
        .form-panel.open{transform:translateX(0)}
        .fp-header{position:sticky;top:0;z-index:10;background:#fff;border-bottom:1px solid #e8ecf0;padding:.875rem 1.5rem;display:flex;align-items:center;gap:1rem;box-shadow:0 1px 4px rgba(0,0,0,.05)}
        .fp-back{display:inline-flex;align-items:center;gap:.5rem;background:#fff;border:1px solid #e2e8f0;cursor:pointer;font-size:.85rem;font-weight:600;color:#64748b;padding:.4rem .875rem;border-radius:9px;transition:all .15s;font-family:inherit}
        .fp-back:hover{background:#f1f5f9;color:#374151}
        .fp-title{font-size:.95rem;font-weight:700;color:#0f172a;flex:1;margin:0}
        .fp-content{max-width:820px;margin:0 auto;padding:2rem 1.5rem}
        .fp-card{background:#fff;border-radius:16px;border:1px solid #e8ecf0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.04)}
        .fp-card-head{padding:1.1rem 1.5rem;border-bottom:1px solid #f1f5f9;font-size:.95rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.5rem;background:#fafbfc}
        .fp-body{padding:1.75rem}
        .fp-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem}
        .fp-grp{margin-bottom:0}
        .fp-lbl{display:block;font-size:.82rem;font-weight:600;color:#374151;margin-bottom:.4rem}
        .fp-lbl span{color:#ef4444;margin-left:2px}
        .fp-inp{width:100%;padding:.72rem 1rem;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.9rem;font-family:inherit;color:#0f172a;background:#fff;transition:border-color .2s,box-shadow .2s;outline:none}
        .fp-inp:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12)}
        .fp-sel{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394a3b8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.5rem}
        .fp-sec{font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;margin:1.5rem 0 .75rem;padding-bottom:.4rem;border-bottom:1px solid #f1f5f9}
        .fp-sec:first-child{margin-top:0}
        .fp-type-row{display:grid;grid-template-columns:1fr 1fr;gap:.75rem}
        .fp-tc{border:2px solid #e2e8f0;border-radius:12px;padding:1rem;cursor:pointer;transition:all .15s;position:relative}
        .fp-tc:hover{border-color:#6366f1;background:#fafbff}
        .fp-tc input[type=radio]{position:absolute;opacity:0;width:0;height:0}
        .fp-tc.selected{border-color:#6366f1;background:#f5f3ff}
        .fp-tc .tc-title{font-size:.875rem;font-weight:700;color:#0f172a;margin-bottom:.2rem}
        .fp-tc .tc-desc{font-size:.75rem;color:#64748b}
        .fp-tc .tc-chk{width:18px;height:18px;border-radius:50%;border:2px solid #e2e8f0;position:absolute;top:.875rem;right:.875rem;transition:all .15s}
        .fp-tc.selected .tc-chk{background:#6366f1;border-color:#6366f1}
        .fp-langs{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:.5rem;padding:.75rem;background:#fafbfc;border-radius:10px;border:1.5px solid #e2e8f0}
        .fp-lang{display:flex;align-items:center;gap:.5rem;padding:.3rem .5rem;border-radius:7px;cursor:pointer;font-size:.83rem;color:#374151;transition:background .1s}
        .fp-lang:hover{background:#eff6ff}
        .fp-lang input{accent-color:#6366f1;width:15px;height:15px;flex-shrink:0}
        .fp-submit{display:inline-flex;align-items:center;gap:.625rem;color:#fff;border:none;border-radius:10px;padding:.8rem 2rem;font-size:.9rem;font-weight:700;cursor:pointer;font-family:inherit;transition:filter .15s}
        .fp-submit:hover{filter:brightness(.9)}
        .fp-cancel{display:inline-flex;align-items:center;gap:.5rem;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;border-radius:10px;padding:.75rem 1.25rem;font-size:.875rem;font-weight:600;cursor:pointer;font-family:inherit;transition:all .15s}
        .fp-cancel:hover{background:#f1f5f9}
        .fp-mem-row{display:flex;gap:.5rem;align-items:center;margin-bottom:.5rem}
        .fp-err{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:.875rem 1rem;margin-bottom:1.5rem;list-style:none}
        .fp-err li{color:#991b1b;font-size:.85rem;margin-bottom:.2rem}
        .fp-file input[type=file]{width:100%;padding:.6rem .875rem;border:1.5px dashed #e2e8f0;border-radius:10px;font-size:.85rem;cursor:pointer;background:#fafbfc}
        .fp-file input[type=file]:hover{border-color:#6366f1}
        @@media(max-width:900px){
            .form-panel{left:0;transform:translateX(100%)}
        }
        @@media(max-width:600px){
            .insc-type-grid{grid-template-columns:1fr}
            .fp-grid,.fp-type-row{grid-template-columns:1fr}
            .fp-content{padding:1.25rem 1rem}
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="ds-overlay" id="ds-overlay" onclick="closeSidebar()"></div>

<div class="ds-layout">
    {{-- ── Sidebar ── --}}
    <aside class="ds-sidebar" id="ds-sidebar">
        <div class="ds-logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'24"></a>
        </div>
        <div class="ds-user-block">
            <div class="ds-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div>
                <p class="ds-user-name">{{ $user->name }}</p>
                <span class="ds-user-role">
                    @if($user->role === 'admin')
                        <i class="fas fa-shield-alt" style="color:#6366f1"></i> Administrateur
                    @else
                        <i class="fas fa-user" style="color:#94a3b8"></i> Participant
                    @endif
                </span>
            </div>
        </div>
        <nav class="ds-nav">
            <span class="ds-nav-section">Navigation</span>
            <a href="{{ route('dashboard') }}" class="ds-nav-link {{ ($activeNav ?? '') === 'home' ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Vue d'ensemble
            </a>
            <a href="{{ route('dashboard.notifications') }}" class="ds-nav-link {{ ($activeNav ?? '') === 'notifications' ? 'active' : '' }}">
                <i class="fas fa-bell"></i> Notifications
                @if(($unread ?? 0) > 0)<span class="ds-badge">{{ $unread }}</span>@endif
            </a>
            <span class="ds-nav-section" style="margin-top:.375rem">Concours</span>
            <button onclick="openInscModal(event)" class="ds-nav-link" style="background:none;border:none;cursor:pointer;width:100%;text-align:left;font-family:inherit;font-size:.875rem">
                <i class="fas fa-plus-circle"></i> Nouvelle inscription
            </button>
            <a href="{{ route('dashboard.profile') }}" class="ds-nav-link {{ ($activeNav ?? '') === 'profile' ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> Mon profil
            </a>
            @if($user->role === 'admin')
            <span class="ds-nav-section" style="margin-top:.375rem">Administration</span>
            <a href="{{ route('admin.index') }}" class="ds-nav-link" style="color:#6366f1">
                <i class="fas fa-cog"></i> Panel admin
            </a>
            @endif
        </nav>
        <div class="ds-sidebar-footer">
            <a href="{{ route('home') }}" class="ds-nav-link" style="padding:.4rem 0;color:#64748b;text-decoration:none">
                <i class="fas fa-arrow-left" style="width:18px;text-align:center"></i> Retour au site
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:4px">
                @csrf
                <button type="submit" class="ds-logout">
                    <i class="fas fa-sign-out-alt"></i> Se déconnecter
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Content ── --}}
    <div style="flex:1;display:flex;flex-direction:column;min-width:0">
        {{-- Mobile topbar --}}
        <div class="ds-topbar">
            <img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'24">
            <div style="display:flex;align-items:center;gap:.75rem">
                @if(($unread ?? 0) > 0)
                <a href="{{ route('dashboard.notifications') }}" style="position:relative;color:#64748b">
                    <i class="fas fa-bell"></i>
                    <span style="position:absolute;top:-5px;right:-5px;background:#ef4444;color:#fff;border-radius:999px;font-size:.6rem;font-weight:700;padding:.05rem .3rem">{{ $unread }}</span>
                </a>
                @endif
                <button class="ds-hamburger" onclick="openSidebar()"><i class="fas fa-bars"></i></button>
            </div>
        </div>

        <main class="ds-main">
            @yield('content')
        </main>
    </div>
</div>

<script>
function openSidebar() {
    document.getElementById('ds-sidebar').classList.add('mobile-open');
    document.getElementById('ds-overlay').classList.add('show');
}
function closeSidebar() {
    document.getElementById('ds-sidebar').classList.remove('mobile-open');
    document.getElementById('ds-overlay').classList.remove('show');
}

/* ── Inscription modal ── */
function openInscModal(e) {
    if (e) e.preventDefault();
    document.getElementById('insc-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeInscModal() {
    document.getElementById('insc-overlay').classList.remove('open');
    document.body.style.overflow = '';
}
function openFormPanel(type) {
    closeInscModal();
    document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('open'));
    document.getElementById('fp-' + type).classList.add('open');
    document.body.style.overflow = 'hidden';
    if (type === 'hackathon') fpHkUpdateMembres();
}
function closeFormPanel() {
    document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('open'));
    document.body.style.overflow = '';
}

/* ── Programmeur panel ── */
function fpPgSelectType(val, el) {
    document.querySelectorAll('#fp-pg-types .fp-tc').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input[type=radio]').checked = true;
    const n = val === 'CMPL' ? 'secondaire' : 'superieur';
    document.getElementById('fp-pg-niveau').value = n;
    fpPgUpdateClasses(false);
}
function fpPgUpdateClasses(autoType) {
    const n = document.getElementById('fp-pg-niveau').value;
    const sel = document.getElementById('fp-pg-classe');
    const lycee = ['3\u00e8me','2nde','1\u00e8re','Terminale'];
    const sup = ['L1','L2','L3','M1','M2','DUT1','DUT2','BTS1','BTS2','Doctorat','Autre'];
    const opts = n === 'secondaire' ? lycee : (n === 'superieur' ? sup : []);
    sel.innerHTML = '<option value="">Choisir\u2026</option>';
    opts.forEach(c => sel.appendChild(new Option(c, c)));
    if (autoType !== false) {
        document.querySelectorAll('#fp-pg-types .fp-tc').forEach(card => {
            const r = card.querySelector('input[type=radio]');
            if ((n === 'secondaire' && r.value === 'CMPL') || (n === 'superieur' && r.value === 'CMPS')) {
                fpPgSelectType(r.value, card);
            }
        });
    }
}

/* ── Projet Digital panel ── */
function fpPdSelectType(val, el) {
    document.querySelectorAll('#fp-pd-types .fp-tc').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input[type=radio]').checked = true;
}
function fpPdUpdateClasses() {
    const n = document.getElementById('fp-pd-niveau').value;
    const sel = document.getElementById('fp-pd-classe');
    const lycee = ['3\u00e8me','2nde','1\u00e8re','Terminale'];
    const sup = ['L1','L2','L3','M1','M2','DUT1','DUT2','BTS1','BTS2','Doctorat','Autre'];
    const opts = n === 'secondaire' ? lycee : (n === 'superieur' ? sup : []);
    sel.innerHTML = '<option value="">Choisir\u2026</option>';
    opts.forEach(c => sel.appendChild(new Option(c, c)));
}

/* ── Hackathon panel ── */
function fpHkUpdateMembres() {
    const nb = parseInt(document.getElementById('fp-hk-nb').value) - 1;
    const cont = document.getElementById('fp-hk-membres');
    cont.innerHTML = '';
    for (let i = 0; i < nb; i++) {
        const row = document.createElement('div');
        row.className = 'fp-mem-row';
        row.innerHTML = '<input type="text" name="membres[]" class="fp-inp" placeholder="Nom du membre ' + (i + 1) + '" required>';
        cont.appendChild(row);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('insc-overlay').addEventListener('click', function (e) {
        if (e.target === this) closeInscModal();
    });
    /* Auto-open panel if form had validation errors */
    const validPanels = ['programmeur', 'projet-digital', 'hackathon'];
    const autoPanel = '{{ old("_form_panel") }}';
    if (validPanels.includes(autoPanel)) openFormPanel(autoPanel);
});
</script>

{{-- ── Type-selection modal ── --}}
<div class="insc-overlay" id="insc-overlay">
    <div class="insc-box">
        <div class="insc-box-head">
            <div>
                <div class="insc-box-title"><i class="fas fa-plus-circle" style="color:#6366f1;margin-right:.5rem"></i> Nouvelle inscription</div>
                <div class="insc-box-sub">Choisissez le type de concours pour votre inscription</div>
            </div>
            <button class="insc-close" onclick="closeInscModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="insc-type-grid">
            <div class="insc-type-card" onclick="openFormPanel('programmeur')" style="border-color:#bfdbfe">
                <div class="itc-icon" style="background:#eff6ff;color:#3b82f6"><i class="fas fa-code"></i></div>
                <div class="itc-name">Programmeur</div>
                <div class="itc-sub">CMPL &middot; CMPS</div>
            </div>
            <div class="insc-type-card" onclick="openFormPanel('projet-digital')" style="border-color:#a7f3d0">
                <div class="itc-icon" style="background:#f0fdf4;color:#10b981"><i class="fas fa-laptop-code"></i></div>
                <div class="itc-name">Projet Digital</div>
                <div class="itc-sub">CMPDL &middot; CMPDS</div>
            </div>
            <div class="insc-type-card" onclick="openFormPanel('hackathon')" style="border-color:#e9d5ff">
                <div class="itc-icon" style="background:#fdf4ff;color:#a855f7"><i class="fas fa-rocket"></i></div>
                <div class="itc-name">Hackathon</div>
                <div class="itc-sub">Lyc&eacute;e &middot; Sup&eacute;rieur</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Form panel: Programmeur ── --}}
<div class="form-panel" id="fp-programmeur">
    <div class="fp-header">
        <button class="fp-back" onclick="closeFormPanel()"><i class="fas fa-arrow-left"></i> Retour</button>
        <span class="fp-title"><i class="fas fa-code" style="color:#3b82f6;margin-right:.4rem"></i> Inscription &mdash; Concours Programmeur</span>
    </div>
    <div class="fp-content">
        @if($errors->any())
        <ul class="fp-err">
            @foreach($errors->all() as $e)
            <li><i class="fas fa-exclamation-circle" style="color:#ef4444;margin-right:.3rem"></i>{{ $e }}</li>
            @endforeach
        </ul>
        @endif
        <div class="fp-card" style="border-top:3px solid #3b82f6">
            <div class="fp-card-head"><i class="fas fa-user-check" style="color:#6366f1"></i> Formulaire d'inscription</div>
            <form method="POST" action="{{ route('concours.programmeur.submit') }}" class="fp-body">
                @csrf
                <input type="hidden" name="_from" value="dashboard">
                <input type="hidden" name="_form_panel" value="programmeur">

                <div class="fp-sec">Type de concours</div>
                <div class="fp-type-row" id="fp-pg-types">
                    <div class="fp-tc" onclick="fpPgSelectType('CMPL', this)">
                        <input type="radio" name="type_concours" value="CMPL">
                        <div class="tc-title">CMPL</div>
                        <div class="tc-desc">Concours Meilleur.e Programmeur.e Lyc&eacute;en</div>
                        <div class="tc-chk"></div>
                    </div>
                    <div class="fp-tc" onclick="fpPgSelectType('CMPS', this)">
                        <input type="radio" name="type_concours" value="CMPS">
                        <div class="tc-title">CMPS</div>
                        <div class="tc-desc">Concours Meilleur.e Programmeur.e Senior</div>
                        <div class="tc-chk"></div>
                    </div>
                </div>

                <div class="fp-sec">Informations personnelles</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Nom complet <span>*</span></label>
                        <input type="text" name="nom" class="fp-inp" value="{{ $user->name }}" required>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">T&eacute;l&eacute;phone <span>*</span></label>
                        <input type="tel" name="telephone" class="fp-inp" value="{{ $user->phone }}" required>
                    </div>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">Adresse email <span>*</span></label>
                    <input type="email" name="email" class="fp-inp" value="{{ $user->email }}" required>
                </div>

                <div class="fp-sec">Scolarit&eacute;</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Niveau d'&eacute;tudes <span>*</span></label>
                        <select name="niveau_etude" id="fp-pg-niveau" class="fp-inp fp-sel" required onchange="fpPgUpdateClasses()">
                            <option value="">Choisir&hellip;</option>
                            <option value="secondaire">Secondaire (Lyc&eacute;e)</option>
                            <option value="superieur">Sup&eacute;rieur (Universit&eacute;)</option>
                        </select>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">Classe / Niveau <span>*</span></label>
                        <select name="classe" id="fp-pg-classe" class="fp-inp fp-sel" required>
                            <option value="">Choisir d'abord le niveau&hellip;</option>
                        </select>
                    </div>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">&Eacute;tablissement <span>*</span></label>
                    <input type="text" name="etablissement" class="fp-inp" placeholder="Nom de votre &eacute;cole / universit&eacute;" required>
                </div>

                <div class="fp-sec">Langages de programmation ma&icirc;tris&eacute;s <span style="color:#ef4444">*</span></div>
                <div class="fp-langs">
                    @foreach(['JavaScript','Python','Java','C','C++','C#','Ruby','PHP','Swift','Go','Rust','TypeScript','Kotlin','Scala','R','Dart','Lua','Perl','Haskell','Julia','COBOL','Pascal'] as $lang)
                    <label class="fp-lang">
                        <input type="checkbox" name="langages[]" value="{{ $lang }}"> {{ $lang }}
                    </label>
                    @endforeach
                </div>

                <div style="display:flex;gap:.875rem;align-items:center;margin-top:2rem;flex-wrap:wrap">
                    <button type="submit" class="fp-submit" style="background:#4f46e5"><i class="fas fa-paper-plane"></i> Soumettre l'inscription</button>
                    <button type="button" class="fp-cancel" onclick="closeFormPanel()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── Form panel: Projet Digital ── --}}
<div class="form-panel" id="fp-projet-digital">
    <div class="fp-header">
        <button class="fp-back" onclick="closeFormPanel()"><i class="fas fa-arrow-left"></i> Retour</button>
        <span class="fp-title"><i class="fas fa-laptop-code" style="color:#10b981;margin-right:.4rem"></i> Inscription &mdash; Projet Digital</span>
    </div>
    <div class="fp-content">
        @if($errors->any())
        <ul class="fp-err">
            @foreach($errors->all() as $e)
            <li><i class="fas fa-exclamation-circle" style="color:#ef4444;margin-right:.3rem"></i>{{ $e }}</li>
            @endforeach
        </ul>
        @endif
        <div class="fp-card" style="border-top:3px solid #10b981">
            <div class="fp-card-head"><i class="fas fa-laptop-code" style="color:#10b981"></i> Formulaire de soumission</div>
            <form method="POST" action="{{ route('concours.projet-digital.submit') }}" enctype="multipart/form-data" class="fp-body">
                @csrf
                <input type="hidden" name="_from" value="dashboard">
                <input type="hidden" name="_form_panel" value="projet-digital">

                <div class="fp-sec">Type de concours</div>
                <div class="fp-type-row" id="fp-pd-types">
                    <div class="fp-tc" onclick="fpPdSelectType('CMPDL', this)" style="border-color:#d1fae5">
                        <input type="radio" name="type_concours" value="CMPDL">
                        <div class="tc-title">CMPDL</div>
                        <div class="tc-desc">Concours Meilleur Projet Digital Lyc&eacute;en</div>
                        <div class="tc-chk"></div>
                    </div>
                    <div class="fp-tc" onclick="fpPdSelectType('CMPDS', this)" style="border-color:#d1fae5">
                        <input type="radio" name="type_concours" value="CMPDS">
                        <div class="tc-title">CMPDS</div>
                        <div class="tc-desc">Concours Meilleur Projet Digital Senior</div>
                        <div class="tc-chk"></div>
                    </div>
                </div>

                <div class="fp-sec">Informations de l'&eacute;quipe</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Nom de l'&eacute;quipe <span>*</span></label>
                        <input type="text" name="nom_equipe" class="fp-inp" required>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">Chef d'&eacute;quipe <span>*</span></label>
                        <input type="text" name="chef_equipe" class="fp-inp" value="{{ $user->name }}" required>
                    </div>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">Email du chef d'&eacute;quipe <span>*</span></label>
                    <input type="email" name="email_chef_equipe" class="fp-inp" value="{{ $user->email }}" required>
                </div>

                <div class="fp-sec">Scolarit&eacute;</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Niveau d'&eacute;tudes <span>*</span></label>
                        <select name="niveau_etude" id="fp-pd-niveau" class="fp-inp fp-sel" required onchange="fpPdUpdateClasses()">
                            <option value="">Choisir&hellip;</option>
                            <option value="secondaire">Secondaire (Lyc&eacute;e)</option>
                            <option value="superieur">Sup&eacute;rieur (Universit&eacute;)</option>
                        </select>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">Classe <span>*</span></label>
                        <select name="classe" id="fp-pd-classe" class="fp-inp fp-sel" required>
                            <option value="">Choisir d'abord le niveau&hellip;</option>
                        </select>
                    </div>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">&Eacute;tablissement <span>*</span></label>
                    <input type="text" name="etablissement" class="fp-inp" required>
                </div>

                <div class="fp-sec">Projet</div>
                <div class="fp-grp">
                    <label class="fp-lbl">Nom du projet <span>*</span></label>
                    <input type="text" name="nom_projet" class="fp-inp" required>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">Description du projet <span>*</span></label>
                    <textarea name="description_projet" class="fp-inp" rows="4" required></textarea>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">Lien vid&eacute;o YouTube (optionnel)</label>
                    <input type="url" name="lien_youtube" class="fp-inp" placeholder="https://youtube.com/&hellip;">
                </div>

                <div class="fp-sec">Documents (PDF)</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Livre du projet (PDF, max 10Mo)</label>
                        <div class="fp-file"><input type="file" name="livre_projet" accept=".pdf"></div>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">Certificat de scolarit&eacute; (PDF, max 5Mo)</label>
                        <div class="fp-file"><input type="file" name="certificat_scolarite" accept=".pdf"></div>
                    </div>
                </div>

                <div style="display:flex;gap:.875rem;align-items:center;margin-top:2rem;flex-wrap:wrap">
                    <button type="submit" class="fp-submit" style="background:#10b981"><i class="fas fa-paper-plane"></i> Soumettre le projet</button>
                    <button type="button" class="fp-cancel" onclick="closeFormPanel()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ── Form panel: Hackathon ── --}}
<div class="form-panel" id="fp-hackathon">
    <div class="fp-header">
        <button class="fp-back" onclick="closeFormPanel()"><i class="fas fa-arrow-left"></i> Retour</button>
        <span class="fp-title"><i class="fas fa-rocket" style="color:#a855f7;margin-right:.4rem"></i> Inscription &mdash; Hackathon</span>
    </div>
    <div class="fp-content">
        @if($errors->any())
        <ul class="fp-err">
            @foreach($errors->all() as $e)
            <li><i class="fas fa-exclamation-circle" style="color:#ef4444;margin-right:.3rem"></i>{{ $e }}</li>
            @endforeach
        </ul>
        @endif
        <div class="fp-card" style="border-top:3px solid #a855f7">
            <div class="fp-card-head"><i class="fas fa-users" style="color:#a855f7"></i> Formulaire d'inscription &eacute;quipe</div>
            <form method="POST" action="{{ route('concours.hackathon.submit') }}" class="fp-body">
                @csrf
                <input type="hidden" name="_from" value="dashboard">
                <input type="hidden" name="_form_panel" value="hackathon">

                <div class="fp-sec">Informations de l'&eacute;quipe</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Nom de l'&eacute;quipe <span>*</span></label>
                        <input type="text" name="nom_equipe" class="fp-inp" required>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">Nombre de participants <span>*</span></label>
                        <select name="nombre_participants" id="fp-hk-nb" class="fp-inp fp-sel" required onchange="fpHkUpdateMembres()">
                            <option value="2">2 participants</option>
                            <option value="3">3 participants</option>
                            <option value="4">4 participants</option>
                            <option value="5">5 participants</option>
                        </select>
                    </div>
                </div>

                <div class="fp-sec">Chef d'&eacute;quipe</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Nom du chef <span>*</span></label>
                        <input type="text" name="nom_chef_equipe" class="fp-inp" value="{{ $user->name }}" required>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">T&eacute;l&eacute;phone chef <span>*</span></label>
                        <input type="tel" name="telephone_chef_equipe" class="fp-inp" value="{{ $user->phone }}" required>
                    </div>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">Email chef <span>*</span></label>
                    <input type="email" name="email_chef_equipe" class="fp-inp" value="{{ $user->email }}" required>
                </div>

                <div class="fp-sec">Scolarit&eacute; de l'&eacute;quipe</div>
                <div class="fp-grid">
                    <div class="fp-grp">
                        <label class="fp-lbl">Niveau d'&eacute;tudes <span>*</span></label>
                        <input type="text" name="niveau_etudes" class="fp-inp" placeholder="ex: Terminale, L2, BTS&hellip;" required>
                    </div>
                    <div class="fp-grp">
                        <label class="fp-lbl">Classe <span>*</span></label>
                        <input type="text" name="classe" class="fp-inp" placeholder="ex: Terminale C, L2 Info&hellip;" required>
                    </div>
                </div>
                <div class="fp-grp" style="margin-top:1.25rem">
                    <label class="fp-lbl">&Eacute;tablissement <span>*</span></label>
                    <input type="text" name="etablissement" class="fp-inp" placeholder="Nom de l'&eacute;cole / universit&eacute;" required>
                </div>

                <div class="fp-sec">Membres de l'&eacute;quipe (hors chef)</div>
                <div id="fp-hk-membres"></div>

                <div style="display:flex;gap:.875rem;align-items:center;margin-top:2rem;flex-wrap:wrap">
                    <button type="submit" class="fp-submit" style="background:#a855f7"><i class="fas fa-paper-plane"></i> Inscrire l'&eacute;quipe</button>
                    <button type="button" class="fp-cancel" onclick="closeFormPanel()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
