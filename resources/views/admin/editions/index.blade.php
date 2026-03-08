<style>
/* ── Page ── */
.ed-page { padding: 28px 32px; }
.ed-page-header { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px; }
.ed-page-title { font-size:22px; font-weight:700; color:#0f172a; }
.ed-page-sub   { font-size:13px; color:#94a3b8; margin-top:2px; }

/* ── Cards grid ── */
.ed-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(320px,1fr)); gap:20px; }

/* ── Card ── */
.ed-card {
    background:#fff; border-radius:16px; border:1px solid #e2e8f0;
    overflow:hidden; transition:box-shadow .2s, transform .2s;
    position:relative;
}
.ed-card:hover { box-shadow:0 8px 32px rgba(0,0,0,.1); transform:translateY(-2px); }
.ed-card-top { padding:20px 20px 0; }
.ed-card-accent {
    height:4px; border-radius:2px; margin-bottom:16px;
    background:linear-gradient(90deg, #6366f1, #8b5cf6);
}
.ed-card-accent.courante { background:linear-gradient(90deg, #10b981, #34d399); }
.ed-card-accent.passee   { background:linear-gradient(90deg, #94a3b8, #cbd5e1); }
.ed-card-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:12px; }
.ed-card-name { font-size:18px; font-weight:800; color:#0f172a; }
.ed-card-num  { font-size:12px; color:#64748b; font-weight:500; margin-top:2px; }
.ed-badge-courante { display:inline-flex; align-items:center; gap:4px; background:#dcfce7; color:#16a34a; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:700; flex-shrink:0; }
.ed-badge-passee   { background:#f1f5f9; color:#64748b; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600; flex-shrink:0; }
.ed-card-theme { font-size:12.5px; color:#475569; font-style:italic; margin-bottom:14px; line-height:1.5;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.ed-card-meta { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:14px; }
.ed-meta-item { display:flex; align-items:center; gap:6px; font-size:11.5px; color:#64748b; }
.ed-meta-item i { width:14px; text-align:center; color:#94a3b8; font-size:10px; }
.ed-stats-row { display:flex; gap:8px; padding:14px 20px; background:#f8fafc; border-top:1px solid #f1f5f9; }
.ed-stat { flex:1; text-align:center; }
.ed-stat-num { font-size:15px; font-weight:800; color:#6366f1; }
.ed-stat-lbl { font-size:9.5px; color:#94a3b8; text-transform:uppercase; letter-spacing:.04em; margin-top:1px; }
.ed-card-actions { display:flex; gap:6px; padding:12px 20px; border-top:1px solid #f1f5f9; flex-wrap:wrap; }
.btn-sm { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; border-radius:8px; font-size:12px; font-weight:600; cursor:pointer; border:none; transition:all .15s; font-family:inherit; }
.btn-view    { background:#eff6ff; color:#1d4ed8; }
.btn-view:hover { background:#dbeafe; }
.btn-star    { background:#dcfce7; color:#16a34a; }
.btn-star:hover { background:#bbf7d0; }
.btn-edit    { background:#fef3c7; color:#d97706; }
.btn-edit:hover { background:#fde68a; }
.btn-del     { background:#fee2e2; color:#dc2626; }
.btn-del:hover { background:#fecaca; }
.btn-primary-lg { display:inline-flex; align-items:center; gap:8px; background:#6366f1; color:#fff; border:none; cursor:pointer; font-size:13.5px; font-weight:600; padding:10px 20px; border-radius:10px; transition:background .15s; font-family:inherit; }
.btn-primary-lg:hover { background:#4f46e5; }

/* ── Empty state ── */
.ed-empty { text-align:center; padding:60px 20px; color:#94a3b8; grid-column:1/-1; }
.ed-empty i { font-size:48px; display:block; margin-bottom:12px; color:#e2e8f0; }
.ed-empty h3 { font-size:16px; font-weight:700; color:#94a3b8; margin-bottom:6px; }
.ed-empty p { font-size:13.5px; }

/* ── Modal backdrop ── */
.ed-modal-bg { display:none; position:fixed; inset:0; background:rgba(15,23,42,.55); z-index:1000; align-items:center; justify-content:center; padding:16px; }
.ed-modal-bg.open { display:flex; }
.ed-modal { background:#fff; border-radius:20px; width:100%; max-width:720px; max-height:90vh; overflow-y:auto; box-shadow:0 24px 64px rgba(0,0,0,.22); }
.ed-modal-header { padding:20px 24px 16px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; background:#fff; z-index:10; }
.ed-modal-title { font-size:16px; font-weight:800; color:#0f172a; }
.ed-modal-close { background:none; border:none; font-size:18px; color:#94a3b8; cursor:pointer; padding:4px; border-radius:6px; }
.ed-modal-close:hover { color:#374151; background:#f1f5f9; }
.ed-modal-body { padding:20px 24px; }
.ed-modal-footer { padding:14px 24px; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; gap:10px; }

/* ── Show modal specific ── */
.show-section { margin-bottom:20px; }
.show-section-title { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:#94a3b8; margin-bottom:10px; padding-bottom:6px; border-bottom:1px solid #f1f5f9; }
.show-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
.show-field { background:#f8fafc; border-radius:10px; padding:10px 14px; }
.show-field.full { grid-column:1/-1; }
.show-field-label { font-size:10.5px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:.05em; margin-bottom:3px; }
.show-field-value { font-size:13px; font-weight:600; color:#0f172a; }
.show-field-value.empty { color:#cbd5e1; font-style:italic; font-weight:400; }
.show-stats { display:flex; gap:12px; }
.show-stat { flex:1; background:linear-gradient(135deg,#eff6ff,#dbeafe); border-radius:12px; padding:12px; text-align:center; }
.show-stat-num { font-size:22px; font-weight:800; color:#4f46e5; }
.show-stat-lbl { font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:.04em; }
.show-badge-courante { display:inline-flex; align-items:center; gap:4px; background:#dcfce7; color:#16a34a; padding:4px 12px; border-radius:999px; font-size:12px; font-weight:700; }
.show-badge-passee { background:#f1f5f9; color:#64748b; padding:4px 12px; border-radius:999px; font-size:12px; font-weight:600; }

/* ── Form modal ── */
.form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.form-group  { display:flex; flex-direction:column; gap:4px; }
.form-group.full { grid-column:1/-1; }
.form-group label { font-size:11.5px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.form-group input, .form-group textarea, .form-group select {
    border:1.5px solid #e2e8f0; border-radius:8px; padding:8px 12px;
    font-size:13.5px; color:#1e293b; width:100%; transition:border-color .15s; background:#fff; font-family:inherit;
}
.form-group input:focus, .form-group textarea:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.12); }
.form-group textarea { min-height:80px; resize:vertical; }
.toggle-row { display:flex; align-items:center; gap:10px; }
.toggle-row input[type=checkbox] { width:18px; height:18px; accent-color:#6366f1; }

/* ── Toast ── */
.ed-toast-wrap { position:fixed; bottom:24px; right:24px; z-index:9999; display:flex; flex-direction:column; gap:8px; pointer-events:none; }
.ed-toast { background:#0f172a; color:#fff; padding:12px 18px; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.18); font-size:13px; font-weight:500; display:flex; align-items:center; gap:10px; transform:translateX(110%); transition:transform .3s ease; }
.ed-toast.show { transform:translateX(0); }

@media(max-width:640px){
    .ed-page { padding:16px; }
    .ed-grid { grid-template-columns:1fr; }
    .show-grid, .form-grid-2 { grid-template-columns:1fr; }
    .show-stats { flex-direction:column; }
}
</style>

<div class="ed-page">

    {{-- Header --}}
    <div class="ed-page-header">
        <div>
            <h1 class="ed-page-title"><i class="fas fa-layer-group" style="color:#6366f1;margin-right:8px"></i>Gestion des Éditions</h1>
            <p class="ed-page-sub">{{ $editions->count() }} édition(s) enregistrée(s)</p>
        </div>
        <button class="btn-primary-lg" onclick="openFormModal()">
            <i class="fas fa-plus"></i> Nouvelle édition
        </button>
    </div>

    {{-- Cards grid --}}
    <div class="ed-grid">
        @forelse($editions as $ed)
        <div class="ed-card" id="ed-card-{{ $ed->id }}">
            <div class="ed-card-top">
                <div class="ed-card-accent {{ $ed->est_courante ? 'courante' : 'passee' }}"></div>
                <div class="ed-card-header">
                    <div>
                        <div class="ed-card-name">{{ $ed->nom }}</div>
                        <div class="ed-card-num">{{ $ed->numero }}{{ $ed->numero == 1 ? 'ère' : 'ème' }} Édition · {{ $ed->annee }}</div>
                    </div>
                    @if($ed->est_courante)
                        <span class="ed-badge-courante"><i class="fas fa-circle" style="font-size:7px"></i> En cours</span>
                    @else
                        <span class="ed-badge-passee">Passée</span>
                    @endif
                </div>
                @if($ed->theme)
                <p class="ed-card-theme">"{{ $ed->theme }}"</p>
                @endif
                <div class="ed-card-meta">
                    <div class="ed-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        @if($ed->date_debut)
                            {{ $ed->date_debut->format('d/m/Y') }}@if($ed->date_fin) → {{ $ed->date_fin->format('d/m/Y') }}@endif
                        @else
                            <span style="color:#cbd5e1">Date non définie</span>
                        @endif
                    </div>
                    <div class="ed-meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $ed->lieu ?? '—' }}
                    </div>
                    @if($ed->date_limite_inscription)
                    <div class="ed-meta-item" style="grid-column:1/-1">
                        <i class="fas fa-clock"></i>
                        Inscription avant le {{ $ed->date_limite_inscription->format('d/m/Y') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="ed-stats-row">
                <div class="ed-stat">
                    <div class="ed-stat-num">{{ number_format($ed->stats_participants) }}</div>
                    <div class="ed-stat-lbl">Participants</div>
                </div>
                <div class="ed-stat">
                    <div class="ed-stat-num">{{ $ed->stats_projets }}</div>
                    <div class="ed-stat-lbl">Projets</div>
                </div>
                <div class="ed-stat">
                    <div class="ed-stat-num">{{ $ed->stats_programmeurs }}</div>
                    <div class="ed-stat-lbl">Programmeurs</div>
                </div>
            </div>

            <div class="ed-card-actions">
                <button class="btn-sm btn-view" onclick="showEdition({{ $ed->id }})">
                    <i class="fas fa-eye"></i> Voir
                </button>
                @unless($ed->est_courante)
                <button class="btn-sm btn-star" onclick="setCourante({{ $ed->id }}, '{{ addslashes($ed->nom) }}')">
                    <i class="fas fa-star"></i> Définir courante
                </button>
                @endunless
                <button class="btn-sm btn-edit" onclick="editEdition({{ $ed->id }})">
                    <i class="fas fa-edit"></i> Modifier
                </button>
                <button class="btn-sm btn-del" onclick="deleteEdition({{ $ed->id }}, '{{ addslashes($ed->nom) }}')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="ed-empty">
            <i class="fas fa-calendar-times"></i>
            <h3>Aucune édition enregistrée</h3>
            <p>Créez la première édition des Journées Sahel Digital.</p>
        </div>
        @endforelse
    </div>

</div>

{{-- ── Modal Show ── --}}
<div class="ed-modal-bg" id="showModal">
    <div class="ed-modal">
        <div class="ed-modal-header">
            <span class="ed-modal-title" id="show-modal-title">Détails de l'édition</span>
            <button class="ed-modal-close" onclick="closeShowModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="ed-modal-body" id="show-modal-body">
            <div style="text-align:center;padding:30px;color:#94a3b8"><i class="fas fa-spinner fa-spin fa-2x"></i></div>
        </div>
        <div class="ed-modal-footer">
            <button class="btn-sm btn-edit" id="show-edit-btn" onclick="">
                <i class="fas fa-edit"></i> Modifier
            </button>
            <button class="btn-sm" style="background:#f1f5f9;color:#64748b" onclick="closeShowModal()">Fermer</button>
        </div>
    </div>
</div>

{{-- ── Modal Form (Créer / Modifier) ── --}}
<div class="ed-modal-bg" id="formModal">
    <div class="ed-modal">
        <div class="ed-modal-header">
            <span class="ed-modal-title" id="form-modal-title">Nouvelle édition</span>
            <button class="ed-modal-close" onclick="closeFormModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="ed-modal-body">
            <form id="edForm">
                @csrf
                <input type="hidden" id="ed-id"     name="_id"     value="">
                <input type="hidden" id="ed-method" name="_method" value="POST">

                <div class="form-grid-2" style="margin-bottom:14px">
                    <div class="form-group">
                        <label>Nom de l'édition *</label>
                        <input type="text" name="nom" id="ed-nom" placeholder="JSD'26" required>
                    </div>
                    <div class="form-group">
                        <label>Numéro *</label>
                        <input type="number" name="numero" id="ed-numero" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Année *</label>
                        <input type="number" name="annee" id="ed-annee" min="2000" max="2100" required>
                    </div>
                    <div class="form-group">
                        <label>Lieu</label>
                        <input type="text" name="lieu" id="ed-lieu" placeholder="Maroua, Cameroun">
                    </div>
                    <div class="form-group full">
                        <label>Thème</label>
                        <input type="text" name="theme" id="ed-theme" placeholder="Thème de l'édition...">
                    </div>
                    <div class="form-group">
                        <label>Date de début</label>
                        <input type="date" name="date_debut" id="ed-date-debut">
                    </div>
                    <div class="form-group">
                        <label>Date de fin</label>
                        <input type="date" name="date_fin" id="ed-date-fin">
                    </div>
                    <div class="form-group full">
                        <label>Date limite d'inscription</label>
                        <input type="date" name="date_limite_inscription" id="ed-date-limite">
                    </div>
                    <div class="form-group">
                        <label>Nb participants</label>
                        <input type="number" name="stats_participants" id="ed-participants" min="0" value="0">
                    </div>
                    <div class="form-group">
                        <label>Nb projets</label>
                        <input type="number" name="stats_projets" id="ed-projets" min="0" value="0">
                    </div>
                    <div class="form-group">
                        <label>Nb programmeurs</label>
                        <input type="number" name="stats_programmeurs" id="ed-programmeurs" min="0" value="0">
                    </div>
                    <div class="form-group" style="justify-content:flex-end">
                        <label>Édition courante</label>
                        <div class="toggle-row">
                            <input type="checkbox" name="est_courante" id="ed-courante" value="1">
                            <span style="font-size:13px;color:#475569">Afficher sur le site public</span>
                        </div>
                    </div>
                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description" id="ed-description" placeholder="Texte introductif..."></textarea>
                    </div>
                    <div class="form-group full">
                        <label>Mot du Président du CO</label>
                        <textarea name="mot_president" id="ed-mot-president" placeholder="Message du président..." style="min-height:100px"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="ed-modal-footer">
            <button type="button" class="btn-sm" style="background:#f1f5f9;color:#64748b" onclick="closeFormModal()">Annuler</button>
            <button type="button" class="btn-primary-lg" style="font-size:13px;padding:8px 18px" id="form-submit-btn" onclick="submitForm()">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="ed-toast-wrap" id="ed-toast-wrap"></div>

<script>
const edCsrf = document.querySelector('meta[name="csrf-token"]').content;

/* ── Toast ── */
function edToast(msg, ok = true) {
    const wrap = document.getElementById('ed-toast-wrap');
    const t = document.createElement('div');
    t.className = 'ed-toast';
    t.style.borderLeft = `3px solid ${ok ? '#22c55e' : '#ef4444'}`;
    t.innerHTML = `<i class="fas ${ok ? 'fa-check-circle' : 'fa-exclamation-circle'}" style="color:${ok ? '#22c55e' : '#ef4444'}"></i>${msg}`;
    wrap.appendChild(t);
    setTimeout(() => t.classList.add('show'), 10);
    setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3200);
}

/* ── Show modal ── */
function showEdition(id) {
    document.getElementById('showModal').classList.add('open');
    document.getElementById('show-modal-body').innerHTML = '<div style="text-align:center;padding:30px;color:#94a3b8"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';
    document.getElementById('show-edit-btn').onclick = () => { closeShowModal(); editEdition(id); };

    fetch(`/admin/editions/${id}/json`, { headers: { 'X-CSRF-TOKEN': edCsrf, 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(d => {
        document.getElementById('show-modal-title').textContent = d.nom + ' — ' + d.annee;
        const statut = d.est_courante
            ? '<span class="show-badge-courante"><i class="fas fa-circle" style="font-size:7px"></i> Édition en cours</span>'
            : '<span class="show-badge-passee">Édition passée</span>';
        const fmtDate = s => s ? new Date(s).toLocaleDateString('fr-FR') : '<span class="empty">Non défini</span>';
        const val = v => v ? `<span class="show-field-value">${v}</span>` : `<span class="show-field-value empty">Non renseigné</span>`;
        document.getElementById('show-modal-body').innerHTML = `
            <div class="show-section">
                <div class="show-section-title">Informations générales</div>
                <div class="show-grid">
                    <div class="show-field"><div class="show-field-label">Nom</div>${val(d.nom)}</div>
                    <div class="show-field"><div class="show-field-label">Numéro</div><span class="show-field-value">${d.numero}${d.numero==1?'ère':'ème'} Édition</span></div>
                    <div class="show-field"><div class="show-field-label">Année</div><span class="show-field-value">${d.annee}</span></div>
                    <div class="show-field"><div class="show-field-label">Lieu</div>${val(d.lieu)}</div>
                    <div class="show-field full"><div class="show-field-label">Thème</div>${val(d.theme)}</div>
                    <div class="show-field full"><div class="show-field-label">Statut</div>${statut}</div>
                </div>
            </div>
            <div class="show-section">
                <div class="show-section-title">Dates</div>
                <div class="show-grid">
                    <div class="show-field"><div class="show-field-label">Date de début</div><span class="show-field-value">${fmtDate(d.date_debut)}</span></div>
                    <div class="show-field"><div class="show-field-label">Date de fin</div><span class="show-field-value">${fmtDate(d.date_fin)}</span></div>
                    <div class="show-field full"><div class="show-field-label">Limite inscription</div><span class="show-field-value">${fmtDate(d.date_limite_inscription)}</span></div>
                </div>
            </div>
            <div class="show-section">
                <div class="show-section-title">Statistiques</div>
                <div class="show-stats">
                    <div class="show-stat"><div class="show-stat-num">${(d.stats_participants||0).toLocaleString()}</div><div class="show-stat-lbl">Participants</div></div>
                    <div class="show-stat"><div class="show-stat-num">${d.stats_projets||0}</div><div class="show-stat-lbl">Projets</div></div>
                    <div class="show-stat"><div class="show-stat-num">${d.stats_programmeurs||0}</div><div class="show-stat-lbl">Programmeurs</div></div>
                </div>
            </div>
            ${d.description ? `<div class="show-section"><div class="show-section-title">Description</div><div class="show-field full"><div class="show-field-value" style="font-weight:400;line-height:1.7;white-space:pre-line">${d.description}</div></div></div>` : ''}
            ${d.mot_president ? `<div class="show-section"><div class="show-section-title">Mot du Président</div><div class="show-field full"><div class="show-field-value" style="font-weight:400;line-height:1.7;font-style:italic;white-space:pre-line">"${d.mot_president}"</div></div></div>` : ''}
        `;
    });
}
function closeShowModal() { document.getElementById('showModal').classList.remove('open'); }

/* ── Form modal ── */
function openFormModal(data) {
    document.getElementById('form-modal-title').textContent = data ? 'Modifier l\'édition' : 'Nouvelle édition';
    document.getElementById('ed-id').value              = data?.id ?? '';
    document.getElementById('ed-method').value          = data ? 'PUT' : 'POST';
    document.getElementById('ed-nom').value             = data?.nom ?? '';
    document.getElementById('ed-numero').value          = data?.numero ?? '';
    document.getElementById('ed-annee').value           = data?.annee ?? '';
    document.getElementById('ed-lieu').value            = data?.lieu ?? 'Maroua, Cameroun';
    document.getElementById('ed-theme').value           = data?.theme ?? '';
    document.getElementById('ed-date-debut').value      = data?.date_debut ?? '';
    document.getElementById('ed-date-fin').value        = data?.date_fin ?? '';
    document.getElementById('ed-date-limite').value     = data?.date_limite_inscription ?? '';
    document.getElementById('ed-participants').value    = data?.stats_participants ?? 0;
    document.getElementById('ed-projets').value         = data?.stats_projets ?? 0;
    document.getElementById('ed-programmeurs').value    = data?.stats_programmeurs ?? 0;
    document.getElementById('ed-courante').checked      = data ? !!data.est_courante : false;
    document.getElementById('ed-description').value     = data?.description ?? '';
    document.getElementById('ed-mot-president').value   = data?.mot_president ?? '';
    document.getElementById('formModal').classList.add('open');
}
function closeFormModal() {
    document.getElementById('formModal').classList.remove('open');
    document.getElementById('edForm').reset();
}

function editEdition(id) {
    fetch(`/admin/editions/${id}/json`, { headers: { 'X-CSRF-TOKEN': edCsrf, 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => openFormModal(data));
}

function submitForm() {
    const id     = document.getElementById('ed-id').value;
    const method = document.getElementById('ed-method').value;
    const url    = id ? `/admin/editions/${id}` : '/admin/editions';
    const btn    = document.getElementById('form-submit-btn');
    const fd     = new FormData(document.getElementById('edForm'));
    if (method === 'PUT') fd.append('_method', 'PUT');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement…';

    fetch(url, { method:'POST', headers:{ 'X-CSRF-TOKEN':edCsrf,'X-Requested-With':'XMLHttpRequest' }, body:fd })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            closeFormModal();
            edToast(res.message || 'Édition enregistrée.');
            setTimeout(() => loadContent('{{ route("admin.editions.index") }}', 'Éditions'), 600);
        } else {
            edToast(res.message || 'Erreur.', false);
        }
    })
    .catch(() => edToast('Erreur réseau.', false))
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save"></i> Enregistrer';
    });
}

function setCourante(id, nom) {
    if (!confirm(`Définir "${nom}" comme édition courante ?`)) return;
    fetch(`/admin/editions/${id}/courante`, { method:'POST', headers:{'X-CSRF-TOKEN':edCsrf,'X-Requested-With':'XMLHttpRequest'} })
    .then(r => r.json())
    .then(res => {
        if (res.success) { edToast(res.message || 'Édition courante mise à jour.'); setTimeout(() => loadContent('{{ route("admin.editions.index") }}', 'Éditions'), 600); }
        else edToast(res.message || 'Erreur.', false);
    });
}

function deleteEdition(id, nom) {
    if (!confirm(`Supprimer l'édition "${nom}" ? Cette action est irréversible.`)) return;
    fetch(`/admin/editions/${id}`, { method:'POST', headers:{'X-CSRF-TOKEN':edCsrf,'X-Requested-With':'XMLHttpRequest'}, body:new URLSearchParams({_method:'DELETE'}) })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.getElementById('ed-card-' + id);
            if (card) { card.style.opacity='0'; card.style.transform='scale(.9)'; setTimeout(()=>card.remove(), 300); }
            edToast('Édition supprimée.');
        } else edToast(res.message || 'Erreur.', false);
    });
}

/* Close modals on backdrop click */
document.getElementById('showModal').addEventListener('click', e => { if (e.target === document.getElementById('showModal')) closeShowModal(); });
document.getElementById('formModal').addEventListener('click', e => { if (e.target === document.getElementById('formModal')) closeFormModal(); });

/* Expose to global */
window.showEdition   = showEdition;
window.editEdition   = editEdition;
window.setCourante   = setCourante;
window.deleteEdition = deleteEdition;
window.openFormModal = openFormModal;
</script>
