@extends('dashboard._layout')
@php $pageTitle = 'Mon profil'; $activeNav = 'profile'; @endphp

@push('styles')
<style>
.page-hero{margin-bottom:1.5rem}
.page-hero h1{font-size:1.5rem;font-weight:800;color:#0f172a;margin-bottom:.25rem}
.page-hero p{color:#94a3b8;font-size:.875rem}

.profile-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start}
.ds-card{background:#fff;border-radius:16px;border:1px solid #e8ecf0;overflow:hidden;margin-bottom:1.5rem;box-shadow:0 1px 3px rgba(0,0,0,.04)}
.ds-card-head{padding:1.1rem 1.5rem;border-bottom:1px solid #f1f5f9;font-size:.95rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.5rem}
.ds-card-body{padding:1.5rem}
.form-group{margin-bottom:1.25rem}
.form-label{display:block;font-size:.82rem;font-weight:600;color:#374151;margin-bottom:.4rem}
.form-input{width:100%;padding:.75rem 1rem;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.9rem;font-family:inherit;color:#0f172a;background:#fff;transition:border-color .2s,box-shadow .2s;outline:none}
.form-input:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12)}
.btn-submit{display:inline-flex;align-items:center;gap:.5rem;background:#4f46e5;color:#fff;border:none;border-radius:10px;padding:.7rem 1.5rem;font-size:.875rem;font-weight:700;cursor:pointer;font-family:inherit;transition:background .15s}
.btn-submit:hover{background:#4338ca}
.alert-ok{background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:.875rem 1rem;color:#166534;font-size:.875rem;display:flex;align-items:center;gap:.625rem;margin-bottom:1.25rem}
.alert-err{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:.875rem 1rem;margin-bottom:1.25rem;list-style:none}
.alert-err li{color:#991b1b;font-size:.85rem;margin-bottom:.2rem}

.id-card{background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);border-radius:16px;padding:1.75rem 2rem;color:#fff;margin-bottom:1.5rem;display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap}
.id-avatar{width:68px;height:68px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:1.6rem;flex-shrink:0;border:3px solid rgba(255,255,255,.35)}
.id-name{font-size:1.15rem;font-weight:800;margin-bottom:.2rem}
.id-detail{font-size:.82rem;opacity:.8;margin-bottom:.15rem}
.id-since{font-size:.72rem;opacity:.6}
.id-badge{display:inline-flex;align-items:center;gap:.35rem;background:rgba(255,255,255,.18);border-radius:999px;padding:.2rem .7rem;font-size:.72rem;font-weight:700;margin-top:.5rem}

.danger-card{background:#fff;border-radius:16px;border:2px solid #fecaca;overflow:hidden;margin-bottom:1.5rem}
.danger-head{padding:1.1rem 1.5rem;background:#fef2f2;border-bottom:1px solid #fecaca;font-size:.95rem;font-weight:700;color:#991b1b;display:flex;align-items:center;gap:.5rem}
.danger-body{padding:1.5rem}
.btn-danger{display:inline-flex;align-items:center;gap:.5rem;background:#ef4444;color:#fff;border:none;border-radius:10px;padding:.7rem 1.5rem;font-size:.875rem;font-weight:700;cursor:pointer;font-family:inherit;transition:background .15s}
.btn-danger:hover{background:#dc2626}

.pw-strength{margin-top:.4rem;height:4px;border-radius:999px;background:#f1f5f9;overflow:hidden}
.pw-bar{height:100%;border-radius:999px;transition:width .3s,background .3s}

.ds-modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s}
.ds-modal-overlay.open{opacity:1;pointer-events:all}
.ds-modal{background:#fff;border-radius:16px;width:100%;max-width:420px;margin:1rem;box-shadow:0 20px 60px rgba(0,0,0,.2);transform:scale(.96);transition:transform .2s}
.ds-modal-overlay.open .ds-modal{transform:scale(1)}
.ds-modal-head{padding:1.25rem 1.5rem;border-bottom:1px solid #fecaca;background:#fef2f2;display:flex;align-items:center;justify-content:space-between}
.ds-modal-title{font-size:1rem;font-weight:700;color:#991b1b}
.ds-modal-body{padding:1.5rem}
.ds-modal-footer{padding:1rem 1.5rem;border-top:1px solid #f1f5f9;display:flex;justify-content:flex-end;gap:.75rem}
.btn-cancel{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:.65rem 1.25rem;font-size:.875rem;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit;transition:all .15s}
.btn-cancel:hover{background:#f1f5f9}

@@media(max-width:900px){.profile-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

<div class="page-hero">
    <h1><i class="fas fa-user-circle" style="color:#6366f1;margin-right:.5rem"></i> Mon profil</h1>
    <p>Gérez vos informations personnelles et paramètres de sécurité</p>
</div>

{{-- Identity card --}}
<div class="id-card">
    <div class="id-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
    <div>
        <div class="id-name">{{ $user->name }}</div>
        <div class="id-detail"><i class="fas fa-envelope" style="font-size:.75rem;opacity:.7;margin-right:.3rem"></i>{{ $user->email }}</div>
        @if($user->phone)<div class="id-detail"><i class="fas fa-phone" style="font-size:.75rem;opacity:.7;margin-right:.3rem"></i>{{ $user->phone }}</div>@endif
        <div class="id-since">Membre depuis le {{ $user->created_at->format('d F Y') }}</div>
        <div class="id-badge">
            @if($user->role === 'admin')
                <i class="fas fa-shield-alt"></i> Administrateur
            @else
                <i class="fas fa-user"></i> Participant
            @endif
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="profile-grid">
    {{-- Edit profile --}}
    <div>
        <div class="ds-card">
            <div class="ds-card-head"><i class="fas fa-user-edit" style="color:#6366f1"></i> Informations personnelles</div>
            <div class="ds-card-body">
                @if($errors->hasAny(['name','email','phone']))
                <ul class="alert-err">@foreach($errors->only(['name','email','phone']) as $e)<li>{{ $e }}</li>@endforeach</ul>
                @endif
                <form method="POST" action="{{ route('dashboard.profile.update') }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Nom complet *</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Adresse email *</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}" placeholder="+237 6XX XXX XXX">
                    </div>
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Change password --}}
    <div>
        <div class="ds-card">
            <div class="ds-card-head"><i class="fas fa-lock" style="color:#6366f1"></i> Changer le mot de passe</div>
            <div class="ds-card-body">
                @if($errors->hasAny(['current_password','password']))
                <ul class="alert-err">@foreach($errors->only(['current_password','password']) as $e)<li>{{ $e }}</li>@endforeach</ul>
                @endif
                <form method="POST" action="{{ route('dashboard.password.update') }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Mot de passe actuel *</label>
                        <div style="position:relative">
                            <input type="password" name="current_password" id="pw-current" class="form-input" placeholder="••••••••" required style="padding-right:2.75rem">
                            <button type="button" onclick="togglePw('pw-current',this)" style="position:absolute;right:.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;font-size:.9rem"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nouveau mot de passe *</label>
                        <div style="position:relative">
                            <input type="password" name="password" id="pw-new" class="form-input" placeholder="Minimum 8 caractères" required style="padding-right:2.75rem" oninput="checkStrength(this.value)">
                            <button type="button" onclick="togglePw('pw-new',this)" style="position:absolute;right:.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;font-size:.9rem"><i class="fas fa-eye"></i></button>
                        </div>
                        <div class="pw-strength"><div class="pw-bar" id="pw-bar" style="width:0;background:#ef4444"></div></div>
                        <div id="pw-hint" style="font-size:.72rem;color:#94a3b8;margin-top:.3rem"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirmer *</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Répétez le mot de passe" required>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fas fa-key"></i> Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Danger zone --}}
<div class="danger-card" id="danger-zone">
    <div class="danger-head"><i class="fas fa-exclamation-triangle"></i> Zone dangereuse</div>
    <div class="danger-body">
        <p style="font-size:.875rem;color:#64748b;margin-bottom:1.25rem;line-height:1.6">
            La suppression de votre compte est <strong>irréversible</strong>. Toutes vos données (inscriptions, notifications) seront définitivement effacées et ne pourront pas être récupérées.
        </p>
        <button onclick="document.getElementById('delete-modal').classList.add('open')" class="btn-danger">
            <i class="fas fa-trash-alt"></i> Supprimer mon compte
        </button>
    </div>
</div>

{{-- Delete account modal --}}
<div class="ds-modal-overlay" id="delete-modal">
    <div class="ds-modal">
        <div class="ds-modal-head">
            <span class="ds-modal-title"><i class="fas fa-exclamation-triangle" style="margin-right:.4rem"></i> Confirmer la suppression</span>
            <button onclick="document.getElementById('delete-modal').classList.remove('open')" style="background:none;border:none;cursor:pointer;font-size:1rem;color:#94a3b8"><i class="fas fa-times"></i></button>
        </div>
        <div class="ds-modal-body">
            <p style="font-size:.875rem;color:#374151;margin-bottom:1.25rem;line-height:1.6">
                Vous êtes sur le point de supprimer définitivement le compte <strong>{{ $user->email }}</strong>. Cette action est irréversible.<br><br>
                Saisissez votre mot de passe pour confirmer.
            </p>
            <form method="POST" action="{{ route('dashboard.account.delete') }}" id="delete-form">
                @csrf @method('DELETE')
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required autofocus>
                </div>
            </form>
        </div>
        <div class="ds-modal-footer">
            <button class="btn-cancel" onclick="document.getElementById('delete-modal').classList.remove('open')">Annuler</button>
            <button onclick="document.getElementById('delete-form').submit()" class="btn-danger"><i class="fas fa-trash-alt"></i> Supprimer définitivement</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const isText = input.type === 'text';
    input.type = isText ? 'password' : 'text';
    btn.querySelector('i').className = isText ? 'fas fa-eye' : 'fas fa-eye-slash';
}
function checkStrength(val) {
    const bar = document.getElementById('pw-bar');
    const hint = document.getElementById('pw-hint');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = [
        {w:'0%',c:'#ef4444',t:''},
        {w:'25%',c:'#ef4444',t:'Faible'},
        {w:'50%',c:'#f59e0b',t:'Moyen'},
        {w:'75%',c:'#3b82f6',t:'Bien'},
        {w:'100%',c:'#10b981',t:'Fort ✓'},
    ];
    bar.style.width = levels[score].w;
    bar.style.background = levels[score].c;
    hint.textContent = levels[score].t;
    hint.style.color = levels[score].c;
}
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
});
</script>
@endpush
