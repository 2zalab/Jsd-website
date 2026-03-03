<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil — JSD'24</title>
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
        .profile-card{background:#fff;border-radius:var(--radius-xl);border:1px solid var(--color-border);overflow:hidden;margin-bottom:1.5rem}
        .card-head{padding:1.25rem 1.5rem;border-bottom:1px solid var(--color-border);font-size:1rem;font-weight:700;color:var(--color-text)}
        .card-body{padding:1.5rem}
        .form-group{margin-bottom:1.25rem}
        .form-label{display:block;font-weight:600;font-size:.875rem;color:var(--color-text);margin-bottom:.5rem}
        .form-input{width:100%;padding:.75rem 1rem;border:1.5px solid var(--color-border);border-radius:var(--radius-md);font-size:.95rem;font-family:var(--font-sans);color:var(--color-text);background:#fff;transition:border-color .2s,box-shadow .2s;outline:none}
        .form-input:focus{border-color:var(--color-primary-light);box-shadow:0 0 0 3px rgba(59,130,246,.15)}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem}
        .error-list{background:#fef2f2;border:1px solid #fca5a5;border-radius:var(--radius-md);padding:1rem;margin-bottom:1.25rem}
        .error-list li{color:#991b1b;font-size:.875rem;margin-bottom:.2rem}
        .avatar-large{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--color-primary-light),var(--color-accent));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:2rem;margin-bottom:1rem}
        @media(max-width:768px){.dash-layout{grid-template-columns:1fr}.dash-sidebar{display:none}.dash-main{padding:1.25rem}.form-row{grid-template-columns:1fr}}
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
            <a href="{{ route('dashboard.notifications') }}" class="dash-nav-link">
                <i class="fas fa-bell"></i> Notifications
                @if($unread > 0)<span class="notif-badge">{{ $unread }}</span>@endif
            </a>
            <div class="nav-section" style="margin-top:.5rem">Concours</div>
            <a href="{{ route('concours.index') }}" class="dash-nav-link"><i class="fas fa-plus-circle"></i> Nouvelle inscription</a>
            <a href="{{ route('dashboard.profile') }}" class="dash-nav-link active"><i class="fas fa-user-circle"></i> Mon profil</a>
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
            @if(session('success'))
                <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:var(--radius-md);padding:1rem;margin-bottom:1.5rem;color:#166534;display:flex;align-items:center;gap:.75rem;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Avatar & infos -->
            <div class="profile-card">
                <div class="card-body" style="display:flex;align-items:center;gap:1.5rem;">
                    <div class="avatar-large">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <div>
                        <h2 style="font-size:1.3rem;font-weight:800;color:var(--color-text);margin-bottom:.2rem;">{{ $user->name }}</h2>
                        <p style="color:var(--color-text-muted);font-size:.875rem;">{{ $user->email }}</p>
                        <p style="color:var(--color-text-muted);font-size:.8rem;margin-top:.25rem;">Membre depuis le {{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Modifier le profil -->
            <div class="profile-card">
                <div class="card-head"><i class="fas fa-user-edit" style="color:var(--color-primary-light);margin-right:.5rem;"></i> Informations personnelles</div>
                <div class="card-body">
                    @if($errors->has('name') || $errors->has('email') || $errors->has('phone'))
                        <ul class="error-list">@foreach($errors->only(['name','email','phone']) as $e)<li>{{ $e }}</li>@endforeach</ul>
                    @endif
                    <form method="POST" action="{{ route('dashboard.profile.update') }}">
                        @csrf @method('PUT')
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nom complet</label>
                                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}" placeholder="+237 6XX XXX XXX">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="font-size:.875rem;">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>
                    </form>
                </div>
            </div>

            <!-- Changer le mot de passe -->
            <div class="profile-card">
                <div class="card-head"><i class="fas fa-lock" style="color:var(--color-primary-light);margin-right:.5rem;"></i> Changer le mot de passe</div>
                <div class="card-body">
                    @if($errors->has('current_password') || $errors->has('password'))
                        <ul class="error-list">@foreach($errors->only(['current_password','password']) as $e)<li>{{ $e }}</li>@endforeach</ul>
                    @endif
                    <form method="POST" action="{{ route('dashboard.password.update') }}">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Mot de passe actuel</label>
                            <input type="password" name="current_password" class="form-input" placeholder="••••••••" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="password" class="form-input" placeholder="Minimum 8 caractères" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirmer</label>
                                <input type="password" name="password_confirmation" class="form-input" placeholder="Répétez le mot de passe" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="font-size:.875rem;">
                            <i class="fas fa-key"></i> Mettre à jour le mot de passe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
