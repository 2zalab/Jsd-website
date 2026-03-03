<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications — JSD'24</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{background:var(--color-bg-section)}
        .dash-layout{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
        .dash-sidebar{background:#fff;border-right:1px solid var(--color-border);display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow-y:auto}
        .dash-logo{padding:1.5rem;border-bottom:1px solid var(--color-border)}
        .dash-logo img{height:40px}
        .dash-user{padding:1.25rem 1.5rem;border-bottom:1px solid var(--color-border);display:flex;align-items:center;gap:.875rem}
        .avatar{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,var(--color-primary-light),var(--color-accent));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:1rem;flex-shrink:0}
        .user-info p{font-size:.875rem;font-weight:600;color:var(--color-text);margin:0;line-height:1.3}
        .user-info span{font-size:.75rem;color:var(--color-text-muted)}
        .dash-nav{flex:1;padding:1rem 0}
        .nav-section{padding:.5rem 1.5rem .25rem;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--color-text-muted)}
        .dash-nav-link{display:flex;align-items:center;gap:.75rem;padding:.65rem 1.5rem;font-size:.9rem;color:var(--color-text-muted);transition:all .2s;position:relative;text-decoration:none}
        .dash-nav-link:hover{background:rgba(59,130,246,.06);color:var(--color-primary-light)}
        .dash-nav-link.active{background:rgba(59,130,246,.08);color:var(--color-primary-light);font-weight:600}
        .dash-nav-link.active::before{content:'';position:absolute;left:0;top:20%;bottom:20%;width:3px;background:var(--color-primary-light);border-radius:0 4px 4px 0}
        .dash-nav-link i{width:20px;text-align:center;font-size:.95rem}
        .notif-badge{margin-left:auto;background:var(--color-danger);color:#fff;font-size:.7rem;font-weight:700;padding:.1rem .45rem;border-radius:999px;min-width:18px;text-align:center}
        .sidebar-footer{padding:1.25rem 1.5rem;border-top:1px solid var(--color-border)}
        .btn-logout{display:flex;align-items:center;gap:.75rem;font-size:.875rem;color:var(--color-text-muted);cursor:pointer;background:none;border:none;width:100%;text-align:left;padding:.5rem 0;transition:color .2s;font-family:var(--font-sans)}
        .btn-logout:hover{color:var(--color-danger)}
        .dash-main{padding:2rem;max-width:900px}
        .page-title{font-size:1.5rem;font-weight:800;margin-bottom:.25rem}
        .page-sub{color:var(--color-text-muted);font-size:.875rem;margin-bottom:1.75rem}
        .dash-section{background:#fff;border-radius:var(--radius-xl);border:1px solid var(--color-border);overflow:hidden}
        .section-head{padding:1.25rem 1.5rem;border-bottom:1px solid var(--color-border);display:flex;justify-content:space-between;align-items:center}
        .section-head h2{font-size:1rem;font-weight:700}
        .notif-item{padding:1.1rem 1.5rem;border-bottom:1px solid var(--color-border);display:flex;align-items:flex-start;gap:1rem}
        .notif-item:last-child{border-bottom:none}
        .notif-item.unread{background:#f8faff}
        .notif-icon{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
        .notif-content{flex:1}
        .notif-content p{font-size:.9rem;color:var(--color-text);margin:0;font-weight:600}
        .notif-msg{color:var(--color-text-muted);font-weight:400;margin-top:.3rem;font-size:.85rem;line-height:1.6}
        .notif-time{color:var(--color-text-light);font-size:.75rem;margin-top:.5rem}
        .unread-dot{width:9px;height:9px;background:var(--color-primary-light);border-radius:50%;margin-left:auto;flex-shrink:0;margin-top:.75rem}
        .empty-state{text-align:center;padding:4rem 2rem}
        .empty-state i{font-size:3.5rem;color:var(--color-text-light);margin-bottom:1.25rem}
        .empty-state p{color:var(--color-text-muted);margin-bottom:1.25rem}
        @media(max-width:768px){.dash-layout{grid-template-columns:1fr}.dash-sidebar{display:none}.dash-main{padding:1.25rem}}
    </style>
</head>
<body>
<div class="dash-layout">
    <aside class="dash-sidebar">
        <div class="dash-logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'24"></a></div>
        <div class="dash-user">
            <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div class="user-info"><p>{{ $user->name }}</p><span>{{ $user->email }}</span></div>
        </div>
        <nav class="dash-nav">
            <div class="nav-section">Navigation</div>
            <a href="{{ route('dashboard') }}" class="dash-nav-link"><i class="fas fa-th-large"></i> Vue d'ensemble</a>
            <a href="{{ route('dashboard') }}#inscriptions" class="dash-nav-link"><i class="fas fa-list-check"></i> Mes inscriptions</a>
            <a href="{{ route('dashboard.notifications') }}" class="dash-nav-link active">
                <i class="fas fa-bell"></i> Notifications
                @if($unread > 0)<span class="notif-badge">{{ $unread }}</span>@endif
            </a>
            <div class="nav-section" style="margin-top:.5rem">Concours</div>
            <a href="{{ route('concours.index') }}" class="dash-nav-link"><i class="fas fa-plus-circle"></i> Nouvelle inscription</a>
            <a href="{{ route('dashboard.profile') }}" class="dash-nav-link"><i class="fas fa-user-circle"></i> Mon profil</a>
        </nav>
        <div class="sidebar-footer">
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.75rem;font-size:.875rem;color:var(--color-text-muted);margin-bottom:.75rem;text-decoration:none;padding:.35rem 0;"><i class="fas fa-home" style="width:20px;text-align:center;"></i> Retour au site</a>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt" style="width:20px;text-align:center;"></i> Se déconnecter</button>
            </form>
        </div>
    </aside>
    <main>
        <div class="dash-main">
            <div class="page-title"><i class="fas fa-bell" style="color:var(--color-primary-light);margin-right:.5rem;"></i> Notifications</div>
            <p class="page-sub">Tous vos messages et alertes importants</p>
            @if(session('success'))
                <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:var(--radius-md);padding:1rem;margin-bottom:1.5rem;color:#166534;display:flex;align-items:center;gap:.75rem;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            <div class="dash-section">
                <div class="section-head">
                    <h2>{{ $notifications->total() }} notification(s)</h2>
                    @if($unread > 0)
                        <form method="POST" action="{{ route('dashboard.notifications.read-all') }}">@csrf
                            <button type="submit" style="background:none;border:none;color:var(--color-primary-light);font-size:.8rem;font-weight:600;cursor:pointer;font-family:var(--font-sans);">
                                <i class="fas fa-check-double"></i> Tout marquer comme lu
                            </button>
                        </form>
                    @endif
                </div>
                @if($notifications->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-bell-slash"></i>
                        <p>Vous n'avez aucune notification pour le moment.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Retour au dashboard</a>
                    </div>
                @else
                    @foreach($notifications as $notif)
                    <div class="notif-item {{ $notif->isRead() ? '' : 'unread' }}">
                        <div class="notif-icon"
                             style="background:{{ $notif->type === 'success' ? '#f0fdf4' : ($notif->type === 'error' ? '#fef2f2' : ($notif->type === 'warning' ? '#fffbeb' : '#eff6ff')) }};
                                    color:{{ $notif->type === 'success' ? '#10b981' : ($notif->type === 'error' ? '#ef4444' : ($notif->type === 'warning' ? '#f59e0b' : 'var(--color-primary-light)')) }};">
                            <i class="fas {{ $notif->icon ?? 'fa-info-circle' }}"></i>
                        </div>
                        <div class="notif-content">
                            <p>{{ $notif->title }}</p>
                            <div class="notif-msg">{{ $notif->message }}</div>
                            <div class="notif-time"><i class="fas fa-clock" style="font-size:.7rem;"></i> {{ $notif->created_at->diffForHumans() }} — {{ $notif->created_at->format('d/m/Y à H:i') }}</div>
                        </div>
                        @if(!$notif->isRead())<div class="unread-dot"></div>@endif
                    </div>
                    @endforeach
                    <div style="padding:1rem 1.5rem;">{{ $notifications->links() }}</div>
                @endif
            </div>
        </div>
    </main>
</div>
</body>
</html>
