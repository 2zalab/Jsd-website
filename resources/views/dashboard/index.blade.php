<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace — JSD'24</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* ── Layout Dashboard ── */
        body{background:var(--color-bg-section)}
        .dash-layout{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
        /* ── Sidebar ── */
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
        /* ── Main ── */
        .dash-main{padding:2rem;max-width:1000px}
        .dash-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem}
        .dash-header h1{font-size:1.5rem;font-weight:800;color:var(--color-text)}
        .dash-header p{color:var(--color-text-muted);font-size:.875rem}
        /* ── Stats Cards ── */
        .stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem}
        .stat-card{background:#fff;border-radius:var(--radius-xl);padding:1.25rem;border:1px solid var(--color-border);box-shadow:var(--shadow-sm)}
        .stat-card .icon{width:44px;height:44px;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:.875rem}
        .stat-card .num{font-size:2rem;font-weight:900;color:var(--color-text);line-height:1}
        .stat-card .label{font-size:.8rem;color:var(--color-text-muted);margin-top:.25rem}
        .icon-blue{background:#eff6ff;color:var(--color-primary-light)}
        .icon-yellow{background:#fffbeb;color:#f59e0b}
        .icon-green{background:#f0fdf4;color:#10b981}
        .icon-red{background:#fef2f2;color:#ef4444}
        /* ── Section ── */
        .dash-section{background:#fff;border-radius:var(--radius-xl);border:1px solid var(--color-border);margin-bottom:1.5rem;overflow:hidden}
        .section-head{padding:1.25rem 1.5rem;border-bottom:1px solid var(--color-border);display:flex;justify-content:space-between;align-items:center}
        .section-head h2{font-size:1rem;font-weight:700;color:var(--color-text)}
        .section-head a{font-size:.8rem;color:var(--color-primary-light);font-weight:600}
        /* ── Table inscriptions ── */
        .inscriptions-table{width:100%;border-collapse:collapse}
        .inscriptions-table th{text-align:left;padding:.875rem 1.5rem;font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--color-text-muted);background:var(--color-bg-section);border-bottom:1px solid var(--color-border)}
        .inscriptions-table td{padding:1rem 1.5rem;border-bottom:1px solid var(--color-border);font-size:.875rem;color:var(--color-text)}
        .inscriptions-table tr:last-child td{border-bottom:none}
        .inscriptions-table tr:hover td{background:rgba(59,130,246,.02)}
        .badge{display:inline-flex;align-items:center;gap:.35rem;padding:.25rem .75rem;border-radius:999px;font-size:.75rem;font-weight:700}
        .badge-pending{background:#fffbeb;color:#92400e}
        .badge-approved{background:#f0fdf4;color:#065f46}
        .badge-rejected{background:#fef2f2;color:#991b1b}
        .type-tag{display:inline-flex;align-items:center;gap:.35rem;font-size:.8rem;color:var(--color-text-muted);background:var(--color-bg-section);padding:.2rem .6rem;border-radius:var(--radius-sm)}
        /* ── Notifications ── */
        .notif-item{padding:1rem 1.5rem;border-bottom:1px solid var(--color-border);display:flex;align-items:flex-start;gap:1rem;transition:background .15s}
        .notif-item:last-child{border-bottom:none}
        .notif-item:hover{background:rgba(59,130,246,.02)}
        .notif-item.unread{background:#f8faff}
        .notif-icon{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0}
        .notif-content p{font-size:.875rem;color:var(--color-text);margin:0;font-weight:500}
        .notif-content .notif-msg{color:var(--color-text-muted);font-weight:400;margin-top:.2rem;font-size:.82rem}
        .notif-content .notif-time{color:var(--color-text-light);font-size:.75rem;margin-top:.35rem}
        .unread-dot{width:8px;height:8px;background:var(--color-primary-light);border-radius:50%;margin-left:auto;flex-shrink:0;margin-top:.5rem}
        /* ── Empty state ── */
        .empty-state{text-align:center;padding:3rem 2rem}
        .empty-state i{font-size:3rem;color:var(--color-text-light);margin-bottom:1rem}
        .empty-state p{color:var(--color-text-muted);margin-bottom:1.25rem}
        /* ── Topbar mobile ── */
        .dash-topbar{display:none;background:#fff;border-bottom:1px solid var(--color-border);padding:1rem 1.5rem;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
        @media(max-width:1024px){.stats-row{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:768px){
            .dash-layout{grid-template-columns:1fr}
            .dash-sidebar{display:none}
            .dash-topbar{display:flex}
            .dash-main{padding:1.25rem}
        }
    </style>
</head>
<body>
<div class="dash-layout">
    <!-- ── Sidebar ── -->
    <aside class="dash-sidebar">
        <div class="dash-logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'24"></a>
        </div>
        <div class="dash-user">
            <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div class="user-info">
                <p>{{ $user->name }}</p>
                <span>{{ $user->email }}</span>
            </div>
        </div>
        <nav class="dash-nav">
            <div class="nav-section">Navigation</div>
            <a href="{{ route('dashboard') }}" class="dash-nav-link active">
                <i class="fas fa-th-large"></i> Vue d'ensemble
            </a>
            <a href="{{ route('dashboard') }}#inscriptions" class="dash-nav-link">
                <i class="fas fa-list-check"></i> Mes inscriptions
                @if($stats['total'] > 0)<span class="notif-badge" style="background:var(--color-primary-light)">{{ $stats['total'] }}</span>@endif
            </a>
            <a href="{{ route('dashboard.notifications') }}" class="dash-nav-link">
                <i class="fas fa-bell"></i> Notifications
                @if($unread > 0)<span class="notif-badge">{{ $unread }}</span>@endif
            </a>
            <div class="nav-section" style="margin-top:.5rem">Concours</div>
            <a href="{{ route('concours.index') }}" class="dash-nav-link">
                <i class="fas fa-plus-circle"></i> Nouvelle inscription
            </a>
            <a href="{{ route('dashboard.profile') }}" class="dash-nav-link">
                <i class="fas fa-user-circle"></i> Mon profil
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.75rem;font-size:.875rem;color:var(--color-text-muted);margin-bottom:.75rem;text-decoration:none;padding:.35rem 0;">
                <i class="fas fa-home" style="width:20px;text-align:center;"></i> Retour au site
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt" style="width:20px;text-align:center;"></i> Se déconnecter
                </button>
            </form>
        </div>
    </aside>

    <!-- ── Main Content ── -->
    <main>
        <!-- Topbar mobile -->
        <div class="dash-topbar">
            <img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'24" style="height:32px;">
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" style="background:none;border:none;color:var(--color-text-muted);cursor:pointer;font-size:.875rem;font-family:var(--font-sans);">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </form>
        </div>

        <div class="dash-main">
            @if(session('success'))
                <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:var(--radius-md);padding:1rem;margin-bottom:1.5rem;color:#166534;display:flex;align-items:center;gap:.75rem;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="dash-header">
                <div>
                    <h1>Bonjour, {{ explode(' ', $user->name)[0] }} 👋</h1>
                    <p>Voici un aperçu de vos activités sur JSD'24</p>
                </div>
                <a href="{{ route('concours.index') }}" class="btn btn-primary" style="font-size:.875rem;padding:.6rem 1.25rem;">
                    <i class="fas fa-plus"></i> S'inscrire
                </a>
            </div>

            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="icon icon-blue"><i class="fas fa-clipboard-list"></i></div>
                    <div class="num">{{ $stats['total'] }}</div>
                    <div class="label">Total inscriptions</div>
                </div>
                <div class="stat-card">
                    <div class="icon icon-yellow"><i class="fas fa-clock"></i></div>
                    <div class="num">{{ $stats['pending'] }}</div>
                    <div class="label">En attente</div>
                </div>
                <div class="stat-card">
                    <div class="icon icon-green"><i class="fas fa-check-circle"></i></div>
                    <div class="num">{{ $stats['approved'] }}</div>
                    <div class="label">Acceptées</div>
                </div>
                <div class="stat-card">
                    <div class="icon icon-red"><i class="fas fa-times-circle"></i></div>
                    <div class="num">{{ $stats['rejected'] }}</div>
                    <div class="label">Refusées</div>
                </div>
            </div>

            <!-- Inscriptions -->
            <div class="dash-section" id="inscriptions">
                <div class="section-head">
                    <h2><i class="fas fa-list-check" style="color:var(--color-primary-light);margin-right:.5rem;"></i> Mes Inscriptions</h2>
                </div>
                @if(count($inscriptions) === 0)
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Vous n'avez encore aucune inscription.</p>
                        <a href="{{ route('concours.index') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Participer à un concours
                        </a>
                    </div>
                @else
                    <div style="overflow-x:auto;">
                        <table class="inscriptions-table">
                            <thead>
                                <tr>
                                    <th>Concours</th>
                                    <th>Nom / Équipe</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscriptions as $insc)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;color:var(--color-text);margin-bottom:.25rem;">{{ $insc['type'] }}</div>
                                        <span class="type-tag">{{ $insc['label'] }}</span>
                                    </td>
                                    <td>{{ $insc['name'] }}</td>
                                    <td style="color:var(--color-text-muted);">{{ $insc['date']->format('d/m/Y') }}</td>
                                    <td>
                                        @if($insc['status'] === 'approved')
                                            <span class="badge badge-approved"><i class="fas fa-check"></i> Acceptée</span>
                                        @elseif($insc['status'] === 'rejected')
                                            <span class="badge badge-rejected"><i class="fas fa-times"></i> Refusée</span>
                                        @else
                                            <span class="badge badge-pending"><i class="fas fa-clock"></i> En attente</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Notifications -->
            <div class="dash-section">
                <div class="section-head">
                    <h2>
                        <i class="fas fa-bell" style="color:var(--color-primary-light);margin-right:.5rem;"></i> Notifications récentes
                        @if($unread > 0)
                            <span class="notif-badge" style="margin-left:.5rem;vertical-align:middle;">{{ $unread }}</span>
                        @endif
                    </h2>
                    <a href="{{ route('dashboard.notifications') }}">Voir tout</a>
                </div>
                @if($notifications->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-bell-slash"></i>
                        <p>Aucune notification pour le moment.</p>
                    </div>
                @else
                    @foreach($notifications as $notif)
                    <div class="notif-item {{ $notif->isRead() ? '' : 'unread' }}">
                        <div class="notif-icon"
                             style="background:{{ $notif->type === 'success' ? '#f0fdf4' : ($notif->type === 'error' ? '#fef2f2' : ($notif->type === 'warning' ? '#fffbeb' : '#eff6ff')) }};
                                    color:{{ $notif->type === 'success' ? '#10b981' : ($notif->type === 'error' ? '#ef4444' : ($notif->type === 'warning' ? '#f59e0b' : 'var(--color-primary-light)')) }};">
                            <i class="fas {{ $notif->icon ?? ($notif->type === 'success' ? 'fa-check-circle' : ($notif->type === 'error' ? 'fa-times-circle' : ($notif->type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'))) }}"></i>
                        </div>
                        <div class="notif-content" style="flex:1;">
                            <p>{{ $notif->title }}</p>
                            <div class="notif-msg">{{ $notif->message }}</div>
                            <div class="notif-time"><i class="fas fa-clock" style="font-size:.7rem;"></i> {{ $notif->created_at->diffForHumans() }}</div>
                        </div>
                        @if(!$notif->isRead())<div class="unread-dot"></div>@endif
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
</div>
</body>
</html>
