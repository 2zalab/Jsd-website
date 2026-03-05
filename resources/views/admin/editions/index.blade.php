<style>
.ed-header { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem; }
.ed-title  { font-size:1.25rem; font-weight:700; color:#1e293b; }
.ed-table-wrap { background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow-x:auto; }
.ed-table   { width:100%; min-width:900px; border-collapse:collapse; font-size:13.5px; }
.ed-table th { background:#f8fafc; color:#64748b; font-weight:600; font-size:11.5px; text-transform:uppercase; letter-spacing:.05em; padding:10px 16px; border-bottom:1px solid #e2e8f0; text-align:left; }
.ed-table td { padding:12px 16px; border-bottom:1px solid #f1f5f9; color:#1e293b; vertical-align:middle; }
.ed-table tr:last-child td { border-bottom:none; }
.ed-table tr:hover td { background:#f8fafc; }
.badge-courante { display:inline-flex; align-items:center; gap:4px; background:#dcfce7; color:#16a34a; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600; }
.badge-passee   { background:#f1f5f9; color:#64748b; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600; }
.btn-sm { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; border-radius:8px; font-size:12px; font-weight:600; cursor:pointer; border:none; transition:background .15s, color .15s; }
.btn-primary2 { background:#6366f1; color:#fff; }
.btn-primary2:hover { background:#4f46e5; }
.btn-success { background:#dcfce7; color:#16a34a; }
.btn-success:hover { background:#bbf7d0; }
.btn-warning { background:#fef3c7; color:#d97706; }
.btn-warning:hover { background:#fde68a; }
.btn-danger  { background:#fee2e2; color:#dc2626; }
.btn-danger:hover  { background:#fecaca; }
.ed-empty { text-align:center; padding:3rem; color:#94a3b8; font-size:14px; }

/* Modal */
.ed-modal-bg { display:none; position:fixed; inset:0; background:rgba(15,23,42,.55); z-index:1000; align-items:center; justify-content:center; }
.ed-modal-bg.open { display:flex; }
.ed-modal { background:#fff; border-radius:16px; width:100%; max-width:700px; max-height:90vh; overflow-y:auto; padding:2rem; box-shadow:0 20px 60px rgba(0,0,0,.25); }
.ed-modal h3 { font-size:1.1rem; font-weight:700; margin-bottom:1.5rem; color:#1e293b; }
.form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.form-group  { display:flex; flex-direction:column; gap:4px; }
.form-group.full { grid-column:1/-1; }
.form-group label { font-size:12px; font-weight:600; color:#475569; text-transform:uppercase; letter-spacing:.04em; }
.form-group input,
.form-group textarea,
.form-group select { border:1.5px solid #e2e8f0; border-radius:8px; padding:8px 12px; font-size:13.5px; color:#1e293b; width:100%; transition:border-color .15s; background:#fff; }
.form-group input:focus,
.form-group textarea:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.12); }
.form-group textarea { min-height:80px; resize:vertical; }
.toggle-row { display:flex; align-items:center; gap:10px; }
.toggle-row input[type=checkbox] { width:18px; height:18px; accent-color:#6366f1; }
.modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:1.5rem; }
</style>

<div style="padding:2rem 2rem 1.5rem;">
    <div class="ed-header">
        <div class="ed-title"><i class="fas fa-calendar-star" style="color:#6366f1;margin-right:8px;"></i>Gestion des Éditions</div>
        <button class="btn-sm btn-primary2" onclick="openModal()">
            <i class="fas fa-plus"></i> Nouvelle édition
        </button>
    </div>

    @if(session('success'))
    <div style="background:#dcfce7;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:1rem;font-size:13.5px;">
        {{ session('success') }}
    </div>
    @endif

    <div class="ed-table-wrap">
        @if($editions->isEmpty())
            <div class="ed-empty"><i class="fas fa-calendar-times" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>Aucune édition enregistrée.</div>
        @else
        <table class="ed-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>N°</th>
                    <th>Année</th>
                    <th>Thème</th>
                    <th>Dates</th>
                    <th>Lieu</th>
                    <th>Stats</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($editions as $ed)
                <tr>
                    <td><strong>{{ $ed->nom }}</strong></td>
                    <td>{{ $ed->numero }}</td>
                    <td>{{ $ed->annee }}</td>
                    <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $ed->theme }}">
                        {{ Str::limit($ed->theme, 60) }}
                    </td>
                    <td style="white-space:nowrap;font-size:12px;">
                        @if($ed->date_debut)
                            {{ $ed->date_debut->format('d/m/Y') }}
                            @if($ed->date_fin) → {{ $ed->date_fin->format('d/m/Y') }} @endif
                        @else <span style="color:#94a3b8">—</span> @endif
                    </td>
                    <td style="font-size:12px;">{{ $ed->lieu }}</td>
                    <td style="font-size:12px;">
                        <span title="Participants">👥 {{ number_format($ed->stats_participants) }}</span><br>
                        <span title="Projets">📁 {{ $ed->stats_projets }}</span>
                        <span title="Programmeurs" style="margin-left:4px;">💻 {{ $ed->stats_programmeurs }}</span>
                    </td>
                    <td>
                        @if($ed->est_courante)
                            <span class="badge-courante"><i class="fas fa-circle" style="font-size:7px;"></i> En cours</span>
                        @else
                            <span class="badge-passee">Passée</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            @unless($ed->est_courante)
                            <button class="btn-sm btn-success" onclick="setCourante({{ $ed->id }}, '{{ addslashes($ed->nom) }}')" title="Définir comme courante">
                                <i class="fas fa-star"></i>
                            </button>
                            @endunless
                            <button class="btn-sm btn-warning" onclick="editEdition({{ $ed->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-sm btn-danger" onclick="deleteEdition({{ $ed->id }}, '{{ addslashes($ed->nom) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

{{-- Modal --}}
<div class="ed-modal-bg" id="edModal">
    <div class="ed-modal">
        <h3 id="modal-title">Nouvelle édition</h3>
        <form id="edForm">
            @csrf
            <input type="hidden" id="ed-id" name="_id" value="">
            <input type="hidden" id="ed-method" name="_method" value="POST">

            <div class="form-grid-2">
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
                <div class="form-group" style="justify-content:flex-end;">
                    <label>Édition courante</label>
                    <div class="toggle-row">
                        <input type="checkbox" name="est_courante" id="ed-courante" value="1">
                        <span style="font-size:13px;color:#475569;">Afficher sur le site public</span>
                    </div>
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" id="ed-description" placeholder="Texte introductif affiché sur le site..."></textarea>
                </div>
                <div class="form-group full">
                    <label>Mot du Président du CO</label>
                    <textarea name="mot_president" id="ed-mot-president" placeholder="Message du président du comité d'organisation..." style="min-height:120px;"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-sm" style="background:#f1f5f9;color:#64748b;" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn-sm btn-primary2" id="modal-submit-btn">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

function openModal(data) {
    document.getElementById('modal-title').textContent = data ? 'Modifier l\'édition' : 'Nouvelle édition';
    document.getElementById('ed-id').value              = data ? data.id : '';
    document.getElementById('ed-method').value          = data ? 'PUT' : 'POST';
    document.getElementById('ed-nom').value             = data ? data.nom : '';
    document.getElementById('ed-numero').value          = data ? data.numero : '';
    document.getElementById('ed-annee').value           = data ? data.annee : '';
    document.getElementById('ed-lieu').value            = data ? (data.lieu || 'Maroua, Cameroun') : 'Maroua, Cameroun';
    document.getElementById('ed-theme').value           = data ? (data.theme || '') : '';
    document.getElementById('ed-date-debut').value      = data ? (data.date_debut || '') : '';
    document.getElementById('ed-date-fin').value        = data ? (data.date_fin || '') : '';
    document.getElementById('ed-date-limite').value     = data ? (data.date_limite_inscription || '') : '';
    document.getElementById('ed-participants').value    = data ? (data.stats_participants || 0) : 0;
    document.getElementById('ed-projets').value         = data ? (data.stats_projets || 0) : 0;
    document.getElementById('ed-programmeurs').value    = data ? (data.stats_programmeurs || 0) : 0;
    document.getElementById('ed-courante').checked      = data ? !!data.est_courante : false;
    document.getElementById('ed-description').value     = data ? (data.description || '') : '';
    document.getElementById('ed-mot-president').value   = data ? (data.mot_president || '') : '';
    document.getElementById('edModal').classList.add('open');
}

function closeModal() {
    document.getElementById('edModal').classList.remove('open');
    document.getElementById('edForm').reset();
}

document.getElementById('edModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Fetch edition data for edit
function editEdition(id) {
    fetch(`/admin/editions/${id}/json`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken }
    })
    .then(r => r.json())
    .then(data => openModal(data));
}

document.getElementById('edForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id     = document.getElementById('ed-id').value;
    const method = document.getElementById('ed-method').value;
    const url    = id ? `/admin/editions/${id}` : '/admin/editions';

    const fd = new FormData(this);
    // Laravel method spoofing
    if (method === 'PUT') fd.append('_method', 'PUT');

    fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: fd,
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            closeModal();
            loadContent('{{ route("admin.editions.index") }}', 'Éditions');
        } else {
            alert(res.message || 'Erreur.');
        }
    });
});

function setCourante(id, nom) {
    if (!confirm(`Définir "${nom}" comme édition courante ?`)) return;
    fetch(`/admin/editions/${id}/courante`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) loadContent('{{ route("admin.editions.index") }}', 'Éditions');
    });
}

function deleteEdition(id, nom) {
    if (!confirm(`Supprimer l'édition "${nom}" ? Cette action est irréversible.`)) return;
    fetch(`/admin/editions/${id}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: new URLSearchParams({ _method: 'DELETE' }),
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) loadContent('{{ route("admin.editions.index") }}', 'Éditions');
    });
}
</script>
