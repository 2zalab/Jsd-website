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
            <a href="{{ route('concours.index') }}" class="ds-nav-link">
                <i class="fas fa-plus-circle"></i> Nouvelle inscription
            </a>
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
</script>
@stack('scripts')
</body>
</html>
