<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte — JSD'24</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .auth-page{min-height:100vh;display:grid;grid-template-columns:1fr 1fr}
        .auth-left{background:linear-gradient(135deg,var(--color-primary-dark) 0%,var(--color-primary-light) 60%,var(--color-accent) 100%);display:flex;flex-direction:column;justify-content:center;align-items:center;padding:3rem;color:#fff;text-align:center;position:relative;overflow:hidden}
        .auth-left::before{content:'';position:absolute;width:400px;height:400px;background:rgba(255,255,255,.05);border-radius:50%;top:-100px;right:-100px}
        .auth-left::after{content:'';position:absolute;width:300px;height:300px;background:rgba(255,255,255,.05);border-radius:50%;bottom:-80px;left:-80px}
        .auth-left-content{position:relative;z-index:1}
        .auth-left img{height:80px;width:auto;margin-bottom:2rem;filter:brightness(0) invert(1)}
        .auth-left h2{font-size:2rem;font-weight:900;margin-bottom:1rem;line-height:1.2}
        .auth-left p{font-size:1rem;opacity:.85;max-width:320px;line-height:1.7}
        .step-list{display:flex;flex-direction:column;gap:1rem;margin-top:2rem;text-align:left}
        .step-item{display:flex;align-items:center;gap:.75rem;font-size:.9rem;opacity:.9}
        .step-num{width:32px;height:32px;background:rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:700;font-size:.9rem}
        .auth-right{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:3rem 2rem;background:var(--color-bg);overflow-y:auto}
        .auth-card{width:100%;max-width:480px}
        .auth-card h1{font-size:1.75rem;font-weight:800;color:var(--color-text);margin-bottom:.25rem}
        .auth-card .subtitle{color:var(--color-text-muted);margin-bottom:2rem}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
        .form-group{margin-bottom:1.25rem}
        .form-label{display:block;font-weight:600;font-size:.875rem;color:var(--color-text);margin-bottom:.5rem}
        .form-input{width:100%;padding:.75rem 1rem;border:1.5px solid var(--color-border);border-radius:var(--radius-md);font-size:1rem;font-family:var(--font-sans);color:var(--color-text);background:#fff;transition:border-color .2s,box-shadow .2s;outline:none}
        .form-input:focus{border-color:var(--color-primary-light);box-shadow:0 0 0 3px rgba(59,130,246,.15)}
        .input-icon{position:relative}
        .input-icon i{position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:var(--color-text-muted);font-size:.9rem}
        .input-icon .form-input{padding-left:2.75rem}
        .error-list{background:#fef2f2;border:1px solid #fca5a5;border-radius:var(--radius-md);padding:1rem;margin-bottom:1.5rem}
        .error-list li{color:#991b1b;font-size:.875rem;margin-bottom:.25rem}
        .btn-auth{width:100%;padding:.875rem;background:linear-gradient(135deg,var(--color-primary-light),var(--color-primary));color:#fff;border:none;border-radius:var(--radius-md);font-size:1rem;font-weight:700;font-family:var(--font-sans);cursor:pointer;transition:transform .2s,box-shadow .2s;margin-top:.5rem}
        .btn-auth:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(59,130,246,.4)}
        .auth-footer{text-align:center;margin-top:1.5rem;font-size:.875rem;color:var(--color-text-muted)}
        .auth-footer a{color:var(--color-primary-light);font-weight:600}
        .password-hint{font-size:.78rem;color:var(--color-text-muted);margin-top:.35rem}
        @media(max-width:768px){.auth-page{grid-template-columns:1fr}.auth-left{display:none}.auth-right{padding:2rem 1.25rem}.form-row{grid-template-columns:1fr}}
    </style>
</head>
<body>
<div class="auth-page">
    <div class="auth-left">
        <div class="auth-left-content">
            <img src="{{ asset('images/logo_jsd.png') }}" alt="JSD'24">
            <h2>Rejoignez JSD'24 !</h2>
            <p>Créez votre compte pour participer aux concours et suivre vos inscriptions.</p>
            <div class="step-list">
                <div class="step-item"><div class="step-num">1</div><span>Créez votre compte en quelques secondes</span></div>
                <div class="step-item"><div class="step-num">2</div><span>Choisissez votre concours et inscrivez-vous</span></div>
                <div class="step-item"><div class="step-num">3</div><span>Suivez l'état de votre inscription depuis votre dashboard</span></div>
                <div class="step-item"><div class="step-num">4</div><span>Recevez des notifications sur les résultats</span></div>
            </div>
        </div>
    </div>
    <div class="auth-right">
        <div class="auth-card">
            <a href="{{ route('home') }}" style="color:var(--color-text-muted);font-size:.85rem;display:inline-flex;align-items:center;gap:.5rem;margin-bottom:1.5rem;"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
            <h1>Créer un compte</h1>
            <p class="subtitle">Rejoignez la communauté JSD'24 gratuitement</p>
            @if ($errors->any())
                <ul class="error-list">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">Nom complet</label>
                    <div class="input-icon"><i class="fas fa-user"></i>
                        <input id="name" type="text" name="name" class="form-input" placeholder="Jean Dupont" value="{{ old('name') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <div class="input-icon"><i class="fas fa-envelope"></i>
                        <input id="email" type="email" name="email" class="form-input" placeholder="votre@email.com" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">Téléphone <span style="color:var(--color-text-muted);font-weight:400;">(optionnel)</span></label>
                    <div class="input-icon"><i class="fas fa-phone"></i>
                        <input id="phone" type="tel" name="phone" class="form-input" placeholder="+237 6XX XXX XXX" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-icon"><i class="fas fa-lock"></i>
                        <input id="password" type="password" name="password" class="form-input" placeholder="Minimum 8 caractères" required>
                    </div>
                    <p class="password-hint"><i class="fas fa-info-circle"></i> Au moins 8 caractères</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="input-icon"><i class="fas fa-lock"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" placeholder="Répétez le mot de passe" required>
                    </div>
                </div>
                <button type="submit" class="btn-auth"><i class="fas fa-user-plus" style="margin-right:.5rem;"></i> Créer mon compte</button>
            </form>
            <div class="auth-footer">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></div>
        </div>
    </div>
</div>
</body>
</html>
