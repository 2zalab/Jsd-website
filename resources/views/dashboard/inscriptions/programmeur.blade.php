@extends('dashboard._layout')
@php $pageTitle = 'Inscription — Concours Programmeur'; $activeNav = 'home'; @endphp

@push('styles')
<style>
.page-hero{margin-bottom:1.5rem}
.page-hero h1{font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:.25rem}
.page-hero p{color:#94a3b8;font-size:.875rem}
.ds-card{background:#fff;border-radius:16px;border:1px solid #e8ecf0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.04)}
.ds-card-head{padding:1.1rem 1.5rem;border-bottom:1px solid #f1f5f9;font-size:.95rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.5rem;background:#fafbfc}
.form-body{padding:1.75rem}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem}
.form-group{margin-bottom:0}
.form-label{display:block;font-size:.82rem;font-weight:600;color:#374151;margin-bottom:.4rem}
.form-label span{color:#ef4444;margin-left:2px}
.form-input{width:100%;padding:.72rem 1rem;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.9rem;font-family:inherit;color:#0f172a;background:#fff;transition:border-color .2s,box-shadow .2s;outline:none}
.form-input:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12)}
.form-input.is-invalid{border-color:#ef4444}
.form-select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394a3b8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.5rem}
.error-msg{font-size:.75rem;color:#ef4444;margin-top:.3rem}
.section-title{font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;margin:1.5rem 0 .75rem;padding-bottom:.4rem;border-bottom:1px solid #f1f5f9}
.section-title:first-child{margin-top:0}
.langages-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:.5rem;padding:.75rem;background:#fafbfc;border-radius:10px;border:1.5px solid #e2e8f0}
.lang-label{display:flex;align-items:center;gap:.5rem;padding:.3rem .5rem;border-radius:7px;cursor:pointer;font-size:.83rem;color:#374151;transition:background .1s}
.lang-label:hover{background:#eff6ff}
.lang-label input[type=checkbox]{accent-color:#6366f1;width:15px;height:15px;flex-shrink:0}
.btn-submit{display:inline-flex;align-items:center;gap:.625rem;background:#4f46e5;color:#fff;border:none;border-radius:10px;padding:.8rem 2rem;font-size:.9rem;font-weight:700;cursor:pointer;font-family:inherit;transition:background .15s}
.btn-submit:hover{background:#4338ca}
.btn-back{display:inline-flex;align-items:center;gap:.5rem;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;border-radius:10px;padding:.75rem 1.25rem;font-size:.875rem;font-weight:600;text-decoration:none;transition:all .15s}
.btn-back:hover{background:#f1f5f9}
.alert-ok{background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:.875rem 1rem;color:#166534;font-size:.875rem;display:flex;align-items:center;gap:.625rem;margin-bottom:1.5rem}
.alert-err-box{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:.875rem 1rem;margin-bottom:1.5rem}
.alert-err-box li{color:#991b1b;font-size:.85rem;margin-bottom:.2rem;list-style:none}
.concours-types{display:grid;grid-template-columns:1fr 1fr;gap:.75rem}
.type-card{border:2px solid #e2e8f0;border-radius:12px;padding:1rem;cursor:pointer;transition:all .15s;position:relative}
.type-card:hover{border-color:#6366f1;background:#fafbff}
.type-card input[type=radio]{position:absolute;opacity:0;width:0;height:0}
.type-card.selected{border-color:#6366f1;background:#f5f3ff}
.type-card .tc-title{font-size:.875rem;font-weight:700;color:#0f172a;margin-bottom:.2rem}
.type-card .tc-desc{font-size:.75rem;color:#64748b}
.type-card .tc-check{width:18px;height:18px;border-radius:50%;border:2px solid #e2e8f0;position:absolute;top:.875rem;right:.875rem;transition:all .15s;display:flex;align-items:center;justify-content:center}
.type-card.selected .tc-check{background:#6366f1;border-color:#6366f1}
.type-card.selected .tc-check::after{content:'✓';color:#fff;font-size:.65rem;font-weight:900}
@@media(max-width:640px){.form-grid{grid-template-columns:1fr}.concours-types{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

<div class="page-hero">
    <a href="{{ route('dashboard') }}" class="btn-back" style="margin-bottom:1rem;display:inline-flex">
        <i class="fas fa-arrow-left"></i> Retour au tableau de bord
    </a>
    <h1><i class="fas fa-code" style="color:#6366f1;margin-right:.5rem"></i> Inscription — Concours Programmeur</h1>
    <p>Inscrivez-vous au concours CMPL (Lycée) ou CMPS (Senior)</p>
</div>

@if(session('success'))
<div class="alert-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

@if($errors->any())
<ul class="alert-err-box">
    @foreach($errors->all() as $e)<li><i class="fas fa-exclamation-circle" style="color:#ef4444;margin-right:.3rem"></i>{{ $e }}</li>@endforeach
</ul>
@endif

<div class="ds-card">
    <div class="ds-card-head">
        <i class="fas fa-user-check" style="color:#6366f1"></i> Formulaire d'inscription
    </div>
    <form method="POST" action="{{ route('concours.programmeur.submit') }}" class="form-body">
        @csrf
        <input type="hidden" name="_from" value="dashboard">

        {{-- Type de concours --}}
        <div class="section-title">Type de concours</div>
        <div class="concours-types" id="type-cards">
            @foreach($typesConcours as $val => $label)
            <div class="type-card {{ old('type_concours') === $val ? 'selected' : '' }}" onclick="selectType('{{ $val }}', this)">
                <input type="radio" name="type_concours" value="{{ $val }}" {{ old('type_concours') === $val ? 'checked' : '' }}>
                <div class="tc-title">{{ $val }}</div>
                <div class="tc-desc">{{ $label }}</div>
                <div class="tc-check"></div>
            </div>
            @endforeach
        </div>
        @error('type_concours')<div class="error-msg" style="margin-top:.5rem">{{ $message }}</div>@enderror

        {{-- Informations personnelles --}}
        <div class="section-title">Informations personnelles</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nom complet <span>*</span></label>
                <input type="text" name="nom" class="form-input {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                    value="{{ old('nom', $user->name) }}" required>
                @error('nom')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Téléphone <span>*</span></label>
                <input type="tel" name="telephone" class="form-input {{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                    value="{{ old('telephone', $user->phone) }}" required>
                @error('telephone')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group" style="margin-top:1.25rem">
            <label class="form-label">Adresse email <span>*</span></label>
            <input type="email" name="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email', $user->email) }}" required>
            @error('email')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        {{-- Scolarité --}}
        <div class="section-title">Scolarité</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Niveau d'études <span>*</span></label>
                <select name="niveau_etude" id="niveau_etude" class="form-input form-select {{ $errors->has('niveau_etude') ? 'is-invalid' : '' }}" required onchange="updateClasses()">
                    <option value="">Choisir…</option>
                    <option value="secondaire" {{ old('niveau_etude') === 'secondaire' ? 'selected' : '' }}>Secondaire (Lycée)</option>
                    <option value="superieur"  {{ old('niveau_etude') === 'superieur'  ? 'selected' : '' }}>Supérieur (Université)</option>
                </select>
                @error('niveau_etude')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Classe / Niveau <span>*</span></label>
                <select name="classe" id="classe" class="form-input form-select {{ $errors->has('classe') ? 'is-invalid' : '' }}" required>
                    <option value="">Choisir d'abord le niveau…</option>
                </select>
                @error('classe')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group" style="margin-top:1.25rem">
            <label class="form-label">Établissement <span>*</span></label>
            <input type="text" name="etablissement" class="form-input {{ $errors->has('etablissement') ? 'is-invalid' : '' }}"
                value="{{ old('etablissement') }}" placeholder="Nom de votre école / université" required>
            @error('etablissement')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        {{-- Langages --}}
        <div class="section-title">Langages de programmation maîtrisés <span style="color:#ef4444">*</span></div>
        @error('langages')<div class="error-msg" style="margin-bottom:.5rem">{{ $message }}</div>@enderror
        <div class="langages-grid">
            @foreach($langagesProgrammation as $langage)
            <label class="lang-label">
                <input type="checkbox" name="langages[]" value="{{ $langage }}"
                    {{ in_array($langage, old('langages', [])) ? 'checked' : '' }}>
                {{ $langage }}
            </label>
            @endforeach
        </div>

        <div style="display:flex;gap:.875rem;align-items:center;margin-top:2rem;flex-wrap:wrap">
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Soumettre l'inscription</button>
            <a href="{{ route('dashboard') }}" class="btn-back">Annuler</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
const classesLycee = ['3ème','2nde','1ère','Terminale'];
const classesSup   = ['L1','L2','L3','M1','M2','DUT1','DUT2','BTS1','BTS2','Doctorat','Autre'];
const oldClasse    = '{{ old("classe") }}';

function updateClasses() {
    const niveau = document.getElementById('niveau_etude').value;
    const sel    = document.getElementById('classe');
    const opts   = niveau === 'secondaire' ? classesLycee : (niveau === 'superieur' ? classesSup : []);
    sel.innerHTML = '<option value="">Choisir…</option>';
    opts.forEach(c => {
        const o = document.createElement('option');
        o.value = c; o.textContent = c;
        if (c === oldClasse) o.selected = true;
        sel.appendChild(o);
    });
    // Auto-select concours type based on niveau
    document.querySelectorAll('.type-card').forEach(card => {
        const radio = card.querySelector('input[type=radio]');
        if (niveau === 'secondaire' && radio.value === 'CMPL') selectType('CMPL', card);
        if (niveau === 'superieur'  && radio.value === 'CMPS') selectType('CMPS', card);
    });
}

function selectType(val, el) {
    document.querySelectorAll('.type-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input[type=radio]').checked = true;
}

// Restore on load
document.addEventListener('DOMContentLoaded', () => {
    if ('{{ old("niveau_etude") }}') updateClasses();
    const selected = document.querySelector('.type-card.selected');
    if (selected) selected.querySelector('input[type=radio]').checked = true;
});
</script>
@endpush
