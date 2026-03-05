@extends('dashboard._layout')
@php $pageTitle = 'Réservation de Stand'; $activeNav = 'home'; @endphp

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
.form-input:focus{border-color:#f59e0b;box-shadow:0 0 0 3px rgba(245,158,11,.12)}
.form-input.is-invalid{border-color:#ef4444}
.form-select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394a3b8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.5rem}
.error-msg{font-size:.75rem;color:#ef4444;margin-top:.3rem}
.section-title{font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;margin:1.5rem 0 .75rem;padding-bottom:.4rem;border-bottom:1px solid #f1f5f9}
.section-title:first-child{margin-top:0}
.taille-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem}
.taille-card{border:2px solid #e2e8f0;border-radius:12px;padding:1rem;cursor:pointer;transition:all .15s;position:relative;text-align:center}
.taille-card:hover{border-color:#f59e0b;background:#fffdf0}
.taille-card input[type=radio]{position:absolute;opacity:0;width:0;height:0}
.taille-card.selected{border-color:#f59e0b;background:#fffbeb}
.taille-card .tc-icon{font-size:1.5rem;margin-bottom:.4rem}
.taille-card .tc-title{font-size:.875rem;font-weight:700;color:#0f172a}
.taille-card .tc-desc{font-size:.72rem;color:#64748b;margin-top:.15rem}
.btn-submit{display:inline-flex;align-items:center;gap:.625rem;background:#f59e0b;color:#fff;border:none;border-radius:10px;padding:.8rem 2rem;font-size:.9rem;font-weight:700;cursor:pointer;font-family:inherit;transition:background .15s}
.btn-submit:hover{background:#d97706}
.btn-back{display:inline-flex;align-items:center;gap:.5rem;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;border-radius:10px;padding:.75rem 1.25rem;font-size:.875rem;font-weight:600;text-decoration:none;transition:all .15s}
.btn-back:hover{background:#f1f5f9}
.alert-ok{background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:.875rem 1rem;color:#166534;font-size:.875rem;display:flex;align-items:center;gap:.625rem;margin-bottom:1.5rem}
.alert-err-box{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:.875rem 1rem;margin-bottom:1.5rem;list-style:none}
.alert-err-box li{color:#991b1b;font-size:.85rem;margin-bottom:.2rem}
@@media(max-width:640px){.form-grid{grid-template-columns:1fr}.taille-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

<div class="page-hero">
    <a href="{{ route('dashboard') }}" class="btn-back" style="margin-bottom:1rem;display:inline-flex">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
    <h1><i class="fas fa-store" style="color:#f59e0b;margin-right:.5rem"></i> Réservation de Stand</h1>
    <p>Réservez un stand pour votre entreprise ou structure</p>
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
    <div class="ds-card-head"><i class="fas fa-store" style="color:#f59e0b"></i> Formulaire de réservation</div>
    <form method="POST" action="{{ route('concours.stand.submit') }}" class="form-body">
        @csrf
        <input type="hidden" name="_from" value="dashboard">

        <div class="section-title">Informations de l'entreprise</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nom de l'entreprise <span>*</span></label>
                <input type="text" name="nom_entreprise" class="form-input {{ $errors->has('nom_entreprise') ? 'is-invalid' : '' }}"
                    value="{{ old('nom_entreprise') }}" required>
                @error('nom_entreprise')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Secteur d'activité <span>*</span></label>
                <input type="text" name="secteur_activite" class="form-input {{ $errors->has('secteur_activite') ? 'is-invalid' : '' }}"
                    value="{{ old('secteur_activite') }}" placeholder="ex: Informatique, Finance…" required>
                @error('secteur_activite')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group" style="margin-top:1.25rem">
            <label class="form-label">Adresse <span>*</span></label>
            <textarea name="adresse" class="form-input {{ $errors->has('adresse') ? 'is-invalid' : '' }}" rows="2" required>{{ old('adresse') }}</textarea>
            @error('adresse')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="section-title">Contact</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Email de contact <span>*</span></label>
                <input type="email" name="email_contact" class="form-input {{ $errors->has('email_contact') ? 'is-invalid' : '' }}"
                    value="{{ old('email_contact', $user->email) }}" required>
                @error('email_contact')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Téléphone de contact <span>*</span></label>
                <input type="tel" name="telephone_contact" class="form-input {{ $errors->has('telephone_contact') ? 'is-invalid' : '' }}"
                    value="{{ old('telephone_contact', $user->phone) }}" required>
                @error('telephone_contact')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="section-title">Taille du stand <span style="color:#ef4444">*</span></div>
        @error('taille_stand')<div class="error-msg" style="margin-bottom:.5rem">{{ $message }}</div>@enderror
        <div class="taille-grid">
            @foreach(['petit'=>['🏪','Petit','Espace compact (2×2m)'], 'moyen'=>['🏬','Moyen','Espace standard (3×3m)'], 'grand'=>['🏢','Grand','Espace premium (4×4m)']] as $val=>[$icon,$title,$desc])
            <div class="taille-card {{ old('taille_stand') === $val ? 'selected' : '' }}" onclick="selectTaille('{{ $val }}', this)">
                <input type="radio" name="taille_stand" value="{{ $val }}" {{ old('taille_stand') === $val ? 'checked' : '' }}>
                <div class="tc-icon">{{ $icon }}</div>
                <div class="tc-title">{{ $title }}</div>
                <div class="tc-desc">{{ $desc }}</div>
            </div>
            @endforeach
        </div>

        <div class="form-group" style="margin-top:1.5rem">
            <label class="form-label">Besoins spécifiques</label>
            <textarea name="besoins_specifiques" class="form-input" rows="3"
                placeholder="Équipements souhaités, besoins particuliers…">{{ old('besoins_specifiques') }}</textarea>
        </div>

        <div style="display:flex;gap:.875rem;align-items:center;margin-top:2rem;flex-wrap:wrap">
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Réserver le stand</button>
            <a href="{{ route('dashboard') }}" class="btn-back">Annuler</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
function selectTaille(val, el) {
    document.querySelectorAll('.taille-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input[type=radio]').checked = true;
}
</script>
@endpush
