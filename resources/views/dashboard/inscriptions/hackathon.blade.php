@extends('dashboard._layout')
@php $pageTitle = 'Inscription — Hackathon JSD\'24'; $activeNav = 'home'; @endphp

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
.form-input:focus{border-color:#a855f7;box-shadow:0 0 0 3px rgba(168,85,247,.12)}
.form-input.is-invalid{border-color:#ef4444}
.form-select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394a3b8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.5rem}
.error-msg{font-size:.75rem;color:#ef4444;margin-top:.3rem}
.section-title{font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;margin:1.5rem 0 .75rem;padding-bottom:.4rem;border-bottom:1px solid #f1f5f9}
.section-title:first-child{margin-top:0}
.membre-row{display:flex;gap:.5rem;align-items:center;margin-bottom:.5rem}
.membre-row .form-input{flex:1}
.btn-add-membre{display:inline-flex;align-items:center;gap:.375rem;background:#f0fdf4;color:#10b981;border:1px solid #86efac;border-radius:8px;padding:.45rem .875rem;font-size:.8rem;font-weight:600;cursor:pointer;font-family:inherit;transition:all .15s}
.btn-add-membre:hover{background:#dcfce7}
.btn-rm-membre{width:28px;height:28px;border-radius:8px;border:1px solid #fca5a5;background:#fef2f2;color:#ef4444;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.75rem;flex-shrink:0;transition:all .15s}
.btn-rm-membre:hover{background:#fecaca}
.btn-submit{display:inline-flex;align-items:center;gap:.625rem;background:#a855f7;color:#fff;border:none;border-radius:10px;padding:.8rem 2rem;font-size:.9rem;font-weight:700;cursor:pointer;font-family:inherit;transition:background .15s}
.btn-submit:hover{background:#9333ea}
.btn-back{display:inline-flex;align-items:center;gap:.5rem;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;border-radius:10px;padding:.75rem 1.25rem;font-size:.875rem;font-weight:600;text-decoration:none;transition:all .15s}
.btn-back:hover{background:#f1f5f9}
.alert-ok{background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:.875rem 1rem;color:#166534;font-size:.875rem;display:flex;align-items:center;gap:.625rem;margin-bottom:1.5rem}
.alert-err-box{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:.875rem 1rem;margin-bottom:1.5rem;list-style:none}
.alert-err-box li{color:#991b1b;font-size:.85rem;margin-bottom:.2rem}
@@media(max-width:640px){.form-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

<div class="page-hero">
    <a href="{{ route('dashboard') }}" class="btn-back" style="margin-bottom:1rem;display:inline-flex">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
    <h1><i class="fas fa-rocket" style="color:#a855f7;margin-right:.5rem"></i> Inscription — Hackathon JSD'24</h1>
    <p>Inscrivez votre équipe au Hackathon (2 à 5 membres)</p>
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
    <div class="ds-card-head"><i class="fas fa-users" style="color:#a855f7"></i> Formulaire d'inscription équipe</div>
    <form method="POST" action="{{ route('concours.hackathon.submit') }}" class="form-body">
        @csrf
        <input type="hidden" name="_from" value="dashboard">

        <div class="section-title">Informations de l'équipe</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nom de l'équipe <span>*</span></label>
                <input type="text" name="nom_equipe" class="form-input {{ $errors->has('nom_equipe') ? 'is-invalid' : '' }}"
                    value="{{ old('nom_equipe') }}" required>
                @error('nom_equipe')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Nombre de participants <span>*</span></label>
                <select name="nombre_participants" id="nb-participants" class="form-input form-select" required onchange="updateMembres()">
                    @foreach([2,3,4,5] as $n)
                    <option value="{{ $n }}" {{ old('nombre_participants') == $n ? 'selected' : '' }}>{{ $n }} participants</option>
                    @endforeach
                </select>
                @error('nombre_participants')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="section-title">Chef d'équipe</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nom du chef <span>*</span></label>
                <input type="text" name="nom_chef_equipe" class="form-input {{ $errors->has('nom_chef_equipe') ? 'is-invalid' : '' }}"
                    value="{{ old('nom_chef_equipe', $user->name) }}" required>
                @error('nom_chef_equipe')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Téléphone chef <span>*</span></label>
                <input type="tel" name="telephone_chef_equipe" class="form-input {{ $errors->has('telephone_chef_equipe') ? 'is-invalid' : '' }}"
                    value="{{ old('telephone_chef_equipe', $user->phone) }}" required>
                @error('telephone_chef_equipe')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group" style="margin-top:1.25rem">
            <label class="form-label">Email chef <span>*</span></label>
            <input type="email" name="email_chef_equipe" class="form-input {{ $errors->has('email_chef_equipe') ? 'is-invalid' : '' }}"
                value="{{ old('email_chef_equipe', $user->email) }}" required>
            @error('email_chef_equipe')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="section-title">Scolarité de l'équipe</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Niveau d'études <span>*</span></label>
                <input type="text" name="niveau_etudes" class="form-input {{ $errors->has('niveau_etudes') ? 'is-invalid' : '' }}"
                    value="{{ old('niveau_etudes') }}" placeholder="ex: Terminale, L2, BTS…" required>
                @error('niveau_etudes')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Classe <span>*</span></label>
                <input type="text" name="classe" class="form-input {{ $errors->has('classe') ? 'is-invalid' : '' }}"
                    value="{{ old('classe') }}" placeholder="ex: Terminale C, L2 Info…" required>
                @error('classe')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group" style="margin-top:1.25rem">
            <label class="form-label">Établissement <span>*</span></label>
            <input type="text" name="etablissement" class="form-input {{ $errors->has('etablissement') ? 'is-invalid' : '' }}"
                value="{{ old('etablissement') }}" placeholder="Nom de l'école / université" required>
            @error('etablissement')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="section-title">Membres de l'équipe (hors chef)</div>
        @error('membres')<div class="error-msg" style="margin-bottom:.5rem">{{ $message }}</div>@enderror
        <div id="membres-container">
            {{-- Filled dynamically --}}
        </div>

        <div style="display:flex;gap:.875rem;align-items:center;margin-top:2rem;flex-wrap:wrap">
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Inscrire l'équipe</button>
            <a href="{{ route('dashboard') }}" class="btn-back">Annuler</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
const oldMembres = @json(old('membres', []));

function updateMembres() {
    const nb   = parseInt(document.getElementById('nb-participants').value) - 1;
    const cont = document.getElementById('membres-container');
    cont.innerHTML = '';
    for (let i = 0; i < nb; i++) {
        const row = document.createElement('div');
        row.className = 'membre-row';
        row.innerHTML = `
            <input type="text" name="membres[]" class="form-input"
                placeholder="Nom du membre ${i + 1}"
                value="${oldMembres[i] || ''}" required>
        `;
        cont.appendChild(row);
    }
}

document.addEventListener('DOMContentLoaded', updateMembres);
</script>
@endpush
