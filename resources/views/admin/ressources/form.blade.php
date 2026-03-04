<style>
.adm-page { padding: 28px 32px; }
.back-btn { display:inline-flex;align-items:center;gap:8px;color:#64748b;font-size:13px;font-weight:500;border:none;background:none;cursor:pointer;padding:0;margin-bottom:20px;transition:color .15s; }
.back-btn:hover { color:#4f46e5; }
.adm-page-title { font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
.adm-page-sub { font-size: 13px; color: #94a3b8; margin-bottom: 28px; }

.form-card { background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:28px;margin-bottom:20px; }
.form-card-title { font-size:13.5px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.06em;margin-bottom:20px;display:flex;align-items:center;gap:8px; }
.form-card-title i { color:#7c3aed;font-size:14px; }

.form-grid-2 { display:grid;grid-template-columns:1fr 1fr;gap:18px; }
.form-grid-3 { display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px; }
.field-group { margin-bottom:0; }
.field-label { display:block;font-size:12.5px;font-weight:600;color:#374151;margin-bottom:6px; }
.field-input, .field-select, .field-textarea {
    width:100%;border:1px solid #e2e8f0;border-radius:9px;
    padding:9px 12px;font-size:13px;outline:none;font-family:inherit;
    transition:border-color .15s,box-shadow .15s;background:#fff;color:#0f172a;
}
.field-input:focus, .field-select:focus, .field-textarea:focus {
    border-color:#7c3aed;box-shadow:0 0 0 3px rgba(124,58,237,.1);
}
.field-textarea { resize:vertical;min-height:80px; }

/* file upload zone */
.upload-zone {
    border:2px dashed #e2e8f0;border-radius:12px;
    padding:24px;text-align:center;cursor:pointer;
    transition:border-color .15s,background .15s;
    position:relative;
}
.upload-zone:hover, .upload-zone.drag-over {
    border-color:#7c3aed;background:#faf5ff;
}
.upload-zone input[type=file] {
    position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;
}
.upload-icon { font-size:28px;color:#c4b5fd;margin-bottom:8px; }
.upload-label { font-size:13px;font-weight:600;color:#374151; }
.upload-sub   { font-size:11.5px;color:#94a3b8;margin-top:3px; }
.preview-area { margin-top:14px; }
.preview-img { max-height:140px;max-width:100%;border-radius:10px;border:1px solid #e2e8f0;object-fit:cover; }
.preview-file { display:flex;align-items:center;gap:10px;padding:10px 14px;background:#f8fafc;border-radius:9px;border:1px solid #e2e8f0; }
.preview-file-icon { font-size:24px; }
.preview-file-name { font-size:12.5px;font-weight:600;color:#374151; }

/* form actions */
.form-actions { display:flex;gap:12px;align-items:center;justify-content:flex-end; }
.btn-cancel { display:inline-flex;align-items:center;gap:7px;background:#fff;color:#374151;border:1px solid #e2e8f0;cursor:pointer;font-size:13px;font-weight:500;padding:10px 20px;border-radius:9px;transition:all .15s; }
.btn-cancel:hover { background:#f8fafc; }
.btn-save { display:inline-flex;align-items:center;gap:8px;background:#7c3aed;color:#fff;border:none;cursor:pointer;font-size:14px;font-weight:600;padding:10px 24px;border-radius:9px;transition:background .15s; }
.btn-save:hover { background:#6d28d9; }
.btn-save:disabled { opacity:.6;cursor:not-allowed; }

/* alert */
.alert { border-radius:10px;padding:11px 16px;font-size:13px;margin-bottom:18px; }
.alert-success { background:#f0fdf4;border:1px solid #bbf7d0;color:#166534; }
.alert-error   { background:#fef2f2;border:1px solid #fecaca;color:#991b1b; }

/* helper */
.field-hint { font-size:11.5px;color:#94a3b8;margin-top:4px; }
</style>

<div class="adm-page">
    <button onclick="loadContent('{{ route('admin.ressources.index') }}')" class="back-btn">
        <i class="fas fa-arrow-left"></i> Retour aux ressources
    </button>

    <h1 class="adm-page-title">{{ $ressource ? 'Modifier la ressource' : 'Nouvelle ressource' }}</h1>
    <p class="adm-page-sub">{{ $ressource ? 'Mettez à jour les informations de cette ressource.' : 'Ajoutez une nouvelle photo ou un nouveau document à la médiathèque.' }}</p>

    <div id="rform-alert" class="alert" style="display:none"></div>

    <form id="rform" enctype="multipart/form-data">
        @csrf

        {{-- ── Classification ── --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fas fa-tag"></i> Classification</div>
            <div class="form-grid-3">
                <div class="field-group">
                    <label class="field-label">Type de ressource *</label>
                    <select name="type" id="res-type" class="field-select" required>
                        <option value="photo"    {{ ($ressource?->type ?? 'photo') === 'photo'    ? 'selected' : '' }}>📷 Photo</option>
                        <option value="document" {{ ($ressource?->type ?? '') === 'document' ? 'selected' : '' }}>📄 Document</option>
                    </select>
                </div>
                <div class="field-group">
                    <label class="field-label">Édition *</label>
                    <select name="edition" class="field-select" required>
                        <option value="JSD23" {{ ($ressource?->edition ?? 'JSD23') === 'JSD23' ? 'selected' : '' }}>JSD'23 — 1ère Édition</option>
                        <option value="JSD26" {{ ($ressource?->edition ?? '') === 'JSD26' ? 'selected' : '' }}>JSD'26 — 3ème Édition</option>
                    </select>
                </div>
                <div class="field-group" id="doc-categorie" style="{{ ($ressource?->type ?? 'photo') !== 'document' ? 'opacity:.4;pointer-events:none' : '' }}">
                    <label class="field-label">Catégorie du document</label>
                    <select name="categorie" class="field-select">
                        <option value="">Choisir…</option>
                        <option value="PDF"  {{ $ressource?->categorie === 'PDF'  ? 'selected' : '' }}>📕 PDF</option>
                        <option value="PPT"  {{ $ressource?->categorie === 'PPT'  ? 'selected' : '' }}>📊 Présentation (PPT)</option>
                        <option value="ZIP"  {{ $ressource?->categorie === 'ZIP'  ? 'selected' : '' }}>🗜️ Archive (ZIP)</option>
                        <option value="DOCX" {{ $ressource?->categorie === 'DOCX' ? 'selected' : '' }}>📝 Word (DOCX)</option>
                        <option value="XLSX" {{ $ressource?->categorie === 'XLSX' ? 'selected' : '' }}>📊 Excel (XLSX)</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ── Infos ── --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fas fa-info-circle"></i> Informations</div>
            <div class="field-group" style="margin-bottom:16px">
                <label class="field-label">Titre *</label>
                <input type="text" name="titre" class="field-input" required
                    value="{{ $ressource?->titre }}" placeholder="Ex: Photo de groupe JSD'23">
            </div>
            <div class="field-group" style="margin-bottom:16px">
                <label class="field-label">Description <span style="color:#94a3b8;font-weight:400">(facultatif)</span></label>
                <textarea name="description" class="field-textarea" placeholder="Courte description de la ressource…">{{ $ressource?->description }}</textarea>
            </div>
            <div class="form-grid-2">
                <div class="field-group">
                    <label class="field-label">Lien externe <span style="color:#94a3b8;font-weight:400">(facultatif)</span></label>
                    <input type="url" name="lien" class="field-input"
                        value="{{ $ressource?->lien }}"
                        placeholder="https://… (YouTube, Google Drive, etc.)">
                    <p class="field-hint">Laissez vide si vous téléversez un fichier.</p>
                </div>
                <div class="field-group">
                    <label class="field-label">Ordre d'affichage</label>
                    <input type="number" name="ordre" class="field-input" min="0"
                        value="{{ $ressource?->ordre ?? 0 }}">
                    <p class="field-hint">Les ressources sont triées par ordre croissant.</p>
                </div>
            </div>
        </div>

        {{-- ── Fichier ── --}}
        <div class="form-card">
            <div class="form-card-title"><i class="fas fa-upload"></i> Fichier
                @if($ressource) <span style="font-size:11px;font-weight:400;color:#94a3b8;text-transform:none;letter-spacing:0">— laisser vide pour conserver l'actuel</span> @endif
            </div>

            {{-- Aperçu actuel --}}
            @if($ressource?->fichier)
            <div style="margin-bottom:16px;padding:12px 16px;background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px">
                <span style="font-size:11.5px;color:#64748b;font-weight:600">Fichier actuel :</span>
                @if($ressource->type === 'photo')
                    <img src="{{ asset('images/' . $ressource->fichier) }}" alt="Aperçu" style="height:50px;border-radius:7px;border:1px solid #e2e8f0;object-fit:cover">
                @else
                    <span style="font-size:20px">📄</span>
                @endif
                <span style="font-size:12px;color:#374151">{{ $ressource->fichier }}</span>
            </div>
            @endif

            <div class="upload-zone" id="upload-zone">
                <input type="file" name="fichier" id="fichier-input" accept="image/*,application/pdf,.ppt,.pptx,.doc,.docx,.xls,.xlsx,.zip">
                <div id="upload-placeholder">
                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                    <div class="upload-label">Glissez un fichier ici ou cliquez pour parcourir</div>
                    <div class="upload-sub">Images JPG/PNG/WEBP ou documents PDF, PPT, DOCX, ZIP · Max 10 Mo</div>
                </div>
                <div class="preview-area" id="file-preview" style="display:none"></div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="button" onclick="loadContent('{{ route('admin.ressources.index') }}')" class="btn-cancel">
                Annuler
            </button>
            <button type="submit" class="btn-save" id="rform-submit">
                <i class="fas fa-save"></i> {{ $ressource ? 'Enregistrer les modifications' : 'Créer la ressource' }}
            </button>
        </div>
    </form>
</div>

<script>
const csrfFrm = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/* ── toggle categorie ── */
document.getElementById('res-type').addEventListener('change', function () {
    const cat = document.getElementById('doc-categorie');
    if (this.value === 'document') {
        cat.style.opacity = '1';
        cat.style.pointerEvents = 'all';
    } else {
        cat.style.opacity = '.4';
        cat.style.pointerEvents = 'none';
    }
});

/* ── file preview ── */
document.getElementById('fichier-input').addEventListener('change', function () {
    const file = this.files[0];
    const preview = document.getElementById('file-preview');
    const placeholder = document.getElementById('upload-placeholder');
    if (!file) { preview.style.display = 'none'; placeholder.style.display = 'block'; return; }

    preview.style.display = 'block';
    placeholder.style.display = 'none';

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `<img src="${e.target.result}" class="preview-img" alt="Aperçu">
                <p style="font-size:11.5px;color:#94a3b8;margin-top:8px">${file.name} · ${(file.size/1024/1024).toFixed(2)} Mo</p>`;
        };
        reader.readAsDataURL(file);
    } else {
        const icons = { pdf:'📕', ppt:'📊', pptx:'📊', docx:'📝', doc:'📝', xlsx:'📊', zip:'🗜️' };
        const ext = file.name.split('.').pop().toLowerCase();
        preview.innerHTML = `
            <div class="preview-file">
                <span class="preview-file-icon">${icons[ext] || '📄'}</span>
                <div><div class="preview-file-name">${file.name}</div>
                <div style="font-size:11px;color:#94a3b8">${(file.size/1024/1024).toFixed(2)} Mo</div></div>
            </div>`;
    }
});

/* ── drag & drop ── */
const zone = document.getElementById('upload-zone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
zone.addEventListener('drop', e => {
    e.preventDefault(); zone.classList.remove('drag-over');
    const dt = e.dataTransfer;
    if (dt.files.length) {
        const input = document.getElementById('fichier-input');
        input.files = dt.files;
        input.dispatchEvent(new Event('change'));
    }
});

/* ── form submit ── */
document.getElementById('rform').addEventListener('submit', function (e) {
    e.preventDefault();
    const alertEl = document.getElementById('rform-alert');
    const btn = document.getElementById('rform-submit');
    const url = '{{ $ressource ? route("admin.ressources.update", $ressource->id) : route("admin.ressources.store") }}';
    const body = new FormData(this);
    @if($ressource) body.append('_method', 'PUT'); @endif

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement…';
    alertEl.style.display = 'none';

    fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfFrm, 'X-Requested-With': 'XMLHttpRequest' },
        body,
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            alertEl.className = 'alert alert-success';
            alertEl.textContent = data.message || 'Ressource enregistrée avec succès.';
            alertEl.style.display = 'block';
            setTimeout(() => loadContent('{{ route('admin.ressources.index') }}'), 1200);
        } else {
            alertEl.className = 'alert alert-error';
            alertEl.textContent = data.message || 'Une erreur est survenue.';
            alertEl.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save"></i> {{ $ressource ? "Enregistrer les modifications" : "Créer la ressource" }}';
        }
    })
    .catch(() => {
        alertEl.className = 'alert alert-error';
        alertEl.textContent = 'Erreur réseau. Veuillez réessayer.';
        alertEl.style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save"></i> {{ $ressource ? "Enregistrer les modifications" : "Créer la ressource" }}';
    });
});
</script>
