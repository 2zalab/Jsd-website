<style>
.adm-page { padding: 28px 32px; max-width: 640px; }
.back-btn { display:inline-flex;align-items:center;gap:8px;color:#64748b;font-size:13px;font-weight:500;border:none;background:none;cursor:pointer;padding:0;margin-bottom:20px;transition:color .15s; }
.back-btn:hover { color:#059669; }
.adm-page-title { font-size:22px;font-weight:700;color:#0f172a;margin-bottom:4px; }
.adm-page-sub { font-size:13px;color:#94a3b8;margin-bottom:28px; }
.form-card { background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:24px;margin-bottom:16px; }
.form-card-title { font-size:12.5px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.06em;margin-bottom:18px;display:flex;align-items:center;gap:7px; }
.form-card-title i { color:#059669;font-size:13px; }
.field-group { margin-bottom:16px; }
.field-group:last-child { margin-bottom:0; }
.field-label { display:block;font-size:12.5px;font-weight:600;color:#374151;margin-bottom:6px; }
.field-input,.field-textarea { width:100%;border:1px solid #e2e8f0;border-radius:9px;padding:9px 12px;font-size:13px;outline:none;background:#fff;color:#0f172a;transition:border-color .15s,box-shadow .15s;font-family:inherit; }
.field-input:focus,.field-textarea:focus { border-color:#059669;box-shadow:0 0 0 3px rgba(5,150,105,.1); }
.field-textarea { resize:vertical;min-height:90px; }
.field-row { display:grid;grid-template-columns:1fr 1fr;gap:16px; }
.field-hint { font-size:11.5px;color:#94a3b8;margin-top:4px; }
.upload-zone { border:2px dashed #e2e8f0;border-radius:12px;padding:20px;text-align:center;cursor:pointer;transition:border-color .15s,background .15s;position:relative; }
.upload-zone:hover,.upload-zone.drag-over { border-color:#059669;background:#f0fdf4; }
.upload-zone input[type=file] { position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%; }
.upload-icon { font-size:26px;color:#6ee7b7;margin-bottom:7px; }
.upload-label { font-size:13px;font-weight:600;color:#374151; }
.upload-sub { font-size:11.5px;color:#94a3b8;margin-top:3px; }
.preview-area { margin-top:12px; }
.preview-img { max-height:120px;width:100%;border-radius:10px;object-fit:cover;border:1px solid #e2e8f0; }
.toggle-switch { position:relative;display:inline-block;width:44px;height:24px; }
.toggle-switch input { opacity:0;width:0;height:0; }
.toggle-slider { position:absolute;inset:0;background:#e2e8f0;border-radius:999px;transition:.2s;cursor:pointer; }
.toggle-slider::before { position:absolute;content:'';width:18px;height:18px;bottom:3px;left:3px;background:#fff;border-radius:50%;transition:.2s;box-shadow:0 1px 3px rgba(0,0,0,.2); }
input:checked + .toggle-slider { background:#059669; }
input:checked + .toggle-slider::before { transform:translateX(20px); }
.form-actions { display:flex;gap:12px;align-items:center;justify-content:flex-end; }
.btn-cancel { display:inline-flex;align-items:center;gap:7px;background:#fff;color:#374151;border:1px solid #e2e8f0;cursor:pointer;font-size:13px;font-weight:500;padding:10px 20px;border-radius:9px;transition:all .15s; }
.btn-cancel:hover { background:#f8fafc; }
.btn-save { display:inline-flex;align-items:center;gap:8px;background:#059669;color:#fff;border:none;cursor:pointer;font-size:14px;font-weight:600;padding:10px 24px;border-radius:9px;transition:background .15s; }
.btn-save:hover { background:#047857; }
.btn-save:disabled { opacity:.6;cursor:not-allowed; }
.alert { border-radius:10px;padding:11px 16px;font-size:13px;margin-bottom:18px; }
.alert-success { background:#f0fdf4;border:1px solid #bbf7d0;color:#166534; }
.alert-error   { background:#fef2f2;border:1px solid #fecaca;color:#991b1b; }
</style>

<div class="adm-page">
    <button onclick="loadContent('{{ route('admin.activites.index') }}')" class="back-btn">
        <i class="fas fa-arrow-left"></i> Retour aux activités
    </button>
    <h1 class="adm-page-title">{{ $activite ? "Modifier l'activité" : 'Nouvelle activité' }}</h1>
    <p class="adm-page-sub">{{ $activite ? 'Modifiez les informations de cette activité.' : 'Ajoutez une activité au programme des JSD.' }}</p>

    <div id="aform-alert" class="alert" style="display:none"></div>

    <form id="aform" enctype="multipart/form-data">
        @csrf

        <div class="form-card">
            <div class="form-card-title"><i class="fas fa-info-circle"></i> Informations</div>
            <div class="field-group">
                <label class="field-label">Titre *</label>
                <input type="text" name="titre" class="field-input" required value="{{ $activite?->titre }}" placeholder="Ex: Hackathon, Conférences…">
            </div>
            <div class="field-group">
                <label class="field-label">Description *</label>
                <textarea name="description" class="field-textarea" required rows="4" placeholder="Décrivez l'activité…">{{ $activite?->description }}</textarea>
            </div>
            <div class="field-row">
                <div class="field-group">
                    <label class="field-label">Ordre d'affichage</label>
                    <input type="number" name="ordre" class="field-input" value="{{ $activite?->ordre ?? 0 }}" min="0">
                    <p class="field-hint">Ordre croissant (0 = premier)</p>
                </div>
                <div class="field-group" style="display:flex;flex-direction:column;justify-content:center">
                    <label class="field-label">Statut</label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer">
                        <label class="toggle-switch">
                            <input type="checkbox" name="actif" value="1" {{ ($activite?->actif ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span style="font-size:13px;color:#374151;font-weight:500">Visible sur le site</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-title"><i class="fas fa-image"></i> Image
                @if($activite) <span style="font-size:11px;font-weight:400;color:#94a3b8;text-transform:none;letter-spacing:0">— laisser vide pour conserver l'actuelle</span> @endif
            </div>

            @if($activite?->image)
            <div style="margin-bottom:16px">
                <img src="{{ asset('images/' . $activite->image) }}" alt="{{ $activite->titre }}"
                    style="width:100%;max-height:120px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0">
            </div>
            @endif

            <div class="upload-zone" id="upload-zone">
                <input type="file" name="image" id="image-input" accept="image/*">
                <div id="upload-placeholder">
                    <div class="upload-icon"><i class="fas fa-image"></i></div>
                    <div class="upload-label">{{ $activite ? 'Changer l\'image' : 'Téléverser une image' }}</div>
                    <div class="upload-sub">JPG, PNG, WEBP · Max 5 Mo</div>
                </div>
                <div class="preview-area" id="img-preview" style="display:none"></div>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" onclick="loadContent('{{ route('admin.activites.index') }}')" class="btn-cancel">Annuler</button>
            <button type="submit" class="btn-save" id="aform-submit">
                <i class="fas fa-save"></i> {{ $activite ? 'Enregistrer les modifications' : 'Créer l\'activité' }}
            </button>
        </div>
    </form>
</div>

<script>
/* preview */
document.getElementById('image-input').addEventListener('change', function () {
    const file = this.files[0];
    const preview = document.getElementById('img-preview');
    const ph = document.getElementById('upload-placeholder');
    if (!file) { preview.style.display = 'none'; ph.style.display = 'block'; return; }
    const reader = new FileReader();
    reader.onload = e => {
        preview.innerHTML = `<img src="${e.target.result}" class="preview-img" alt="Aperçu"><p style="font-size:11px;color:#94a3b8;margin-top:6px">${file.name} · ${(file.size/1024/1024).toFixed(2)} Mo</p>`;
        preview.style.display = 'block';
        ph.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

/* drag & drop */
const zone = document.getElementById('upload-zone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
zone.addEventListener('drop', e => {
    e.preventDefault(); zone.classList.remove('drag-over');
    if (e.dataTransfer.files.length) {
        const inp = document.getElementById('image-input');
        inp.files = e.dataTransfer.files;
        inp.dispatchEvent(new Event('change'));
    }
});

/* submit */
document.getElementById('aform').addEventListener('submit', function (e) {
    e.preventDefault();
    const alertEl = document.getElementById('aform-alert');
    const btn = document.getElementById('aform-submit');
    const url = '{{ $activite ? route("admin.activites.update", $activite->id) : route("admin.activites.store") }}';
    const body = new FormData(this);
    @if($activite) body.append('_method', 'PUT'); @endif

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement…';
    alertEl.style.display = 'none';

    fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'X-Requested-With': 'XMLHttpRequest' },
        body,
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            alertEl.className = 'alert alert-success';
            alertEl.textContent = d.message || 'Activité enregistrée avec succès.';
            alertEl.style.display = 'block';
            setTimeout(() => loadContent('{{ route('admin.activites.index') }}'), 1200);
        } else {
            alertEl.className = 'alert alert-error';
            alertEl.textContent = d.message || 'Erreur.';
            alertEl.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save"></i> {{ $activite ? "Enregistrer les modifications" : "Créer l\'activité" }}';
        }
    })
    .catch(() => {
        alertEl.className = 'alert alert-error';
        alertEl.textContent = 'Erreur réseau.';
        alertEl.style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save"></i> {{ $activite ? "Enregistrer les modifications" : "Créer l\'activité" }}';
    });
});
</script>
