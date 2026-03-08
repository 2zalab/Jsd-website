<style>
.adm-page { padding: 28px 32px; }
.adm-page-header { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 24px; }
.adm-page-title { font-size: 22px; font-weight: 700; color: #0f172a; }
.adm-page-sub { font-size: 13px; color: #94a3b8; margin-top: 2px; }

.btn-primary { display:inline-flex;align-items:center;gap:7px;background:#7c3aed;color:#fff;border:none;cursor:pointer;font-size:13px;font-weight:600;padding:9px 18px;border-radius:9px;transition:background .15s;text-decoration:none;white-space:nowrap; }
.btn-primary:hover { background:#6d28d9; }
.btn-outline { display:inline-flex;align-items:center;gap:7px;background:#fff;color:#374151;border:1px solid #e2e8f0;cursor:pointer;font-size:13px;font-weight:500;padding:9px 14px;border-radius:9px;transition:all .15s;text-decoration:none;white-space:nowrap; }
.btn-outline:hover { background:#f8fafc;border-color:#cbd5e1; }
.btn-icon { display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;border:none;cursor:pointer;font-size:13px;transition:all .15s; }
.btn-edit   { background:#fef9c3;color:#92400e; } .btn-edit:hover   { background:#fef08a; }
.btn-delete { background:#fef2f2;color:#b91c1c; } .btn-delete:hover { background:#fee2e2; }

.filter-bar { background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 18px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:10px;align-items:center; }
.filter-select { border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:12.5px;outline:none;background:#fff;transition:border-color .15s; }
.filter-select:focus { border-color:#7c3aed; }

.adm-card { background:#fff;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden; }
.adm-table { width:100%;border-collapse:collapse; }
.adm-table thead th { background:#f8fafc;padding:11px 14px;font-size:10.5px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;text-align:left;border-bottom:1px solid #f1f5f9;white-space:nowrap; }
.adm-table tbody tr { border-bottom:1px solid #f8fafc;transition:background .1s; }
.adm-table tbody tr:last-child { border-bottom:none; }
.adm-table tbody tr:hover { background:#fafbfc; }
.adm-table td { padding:11px 14px;font-size:13px;color:#374151; }

.badge { display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600; }
.badge-photo { background:#eff6ff;color:#1d4ed8; }
.badge-doc   { background:#fff7ed;color:#c2410c; }
.badge-23 { background:#eff6ff;color:#1d4ed8;padding:2px 8px;border-radius:6px;font-size:11px;font-weight:600; }
.badge-26 { background:#f0fdf4;color:#15803d;padding:2px 8px;border-radius:6px;font-size:11px;font-weight:600; }

.thumb { width:52px;height:40px;border-radius:6px;object-fit:cover; }
.doc-thumb { width:52px;height:40px;border-radius:6px;display:flex;align-items:center;justify-content:center;background:#f8fafc;font-size:18px; }

.empty-state { text-align:center;padding:56px 20px;color:#94a3b8; }
.empty-state i { font-size:40px;margin-bottom:12px;display:block; }

.toast-wrap { position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px;pointer-events:none; }
.toast { background:#0f172a;color:#fff;padding:12px 18px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.18);font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;transform:translateX(110%);transition:transform .3s ease;pointer-events:all; }
.toast.show { transform:translateX(0); }
</style>

<div class="adm-page">
    {{-- Header --}}
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Ressources</h1>
            <p class="adm-page-sub">Photos et documents par édition</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center">
            <a href="{{ route('admin.ressources.export.pdf', request()->only(['edition','type'])) }}" target="_blank" class="btn-outline">
                <i class="fas fa-file-pdf" style="color:#ef4444"></i> PDF
            </a>
            <a href="{{ route('admin.ressources.export.csv', request()->only(['edition','type'])) }}" class="btn-outline">
                <i class="fas fa-file-csv" style="color:#16a34a"></i> CSV
            </a>
            <a href="{{ route('admin.ressources.create') }}" class="btn-primary menu-link">
                <i class="fas fa-plus"></i> Ajouter
            </a>
        </div>
    </div>

    {{-- Filters --}}
    <form action="{{ route('admin.ressources.index') }}" method="GET" id="search-form" class="filter-bar">
        <select name="edition" id="filter-edition" class="filter-select">
            <option value="all" {{ $edition === 'all' ? 'selected' : '' }}>Toutes les éditions</option>
            @foreach($editions as $ed)
            <option value="{{ $ed->nom }}" {{ $edition === $ed->nom ? 'selected' : '' }}>
                {{ $ed->nom }} — {{ $ed->numero }}{{ $ed->numero == 1 ? 'ère' : 'ème' }} Édition
            </option>
            @endforeach
        </select>
        <select name="type" id="filter-type" class="filter-select">
            <option value="all"      {{ $type === 'all'      ? 'selected' : '' }}>Tous les types</option>
            <option value="photo"    {{ $type === 'photo'    ? 'selected' : '' }}>📷 Photos</option>
            <option value="document" {{ $type === 'document' ? 'selected' : '' }}>📄 Documents</option>
        </select>
        <button type="submit" class="btn-primary" style="padding:7px 16px;font-size:12.5px">
            <i class="fas fa-filter"></i> Filtrer
        </button>
        <button type="button" onclick="resetFilters()" class="btn-outline" style="padding:7px 12px;font-size:12.5px">
            <i class="fas fa-times"></i> Réinitialiser
        </button>
        <span style="margin-left:auto;font-size:12.5px;color:#94a3b8">{{ $ressources->count() }} résultat(s)</span>
    </form>

    {{-- Table --}}
    <div class="adm-card">
        <div style="overflow-x:auto">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Aperçu</th>
                        <th>Titre</th>
                        <th>Édition</th>
                        <th>Catégorie</th>
                        <th>Ordre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ressources as $r)
                    <tr>
                        <td>
                            <span class="badge {{ $r->type === 'photo' ? 'badge-photo' : 'badge-doc' }}">
                                {{ $r->type === 'photo' ? '📷 Photo' : '📄 Document' }}
                            </span>
                        </td>
                        <td>
                            @if($r->type === 'photo' && $r->fichier)
                                <img src="{{ asset('images/' . $r->fichier) }}" alt="{{ $r->titre }}" class="thumb" onerror="this.style.display='none'">
                            @elseif($r->type === 'document')
                                <div class="doc-thumb">
                                    @if(strtolower($r->categorie ?? '') === 'pdf') <span style="color:#ef4444">📕</span>
                                    @elseif(strtolower($r->categorie ?? '') === 'ppt') <span style="color:#ea580c">📊</span>
                                    @elseif(strtolower($r->categorie ?? '') === 'zip') <span style="color:#16a34a">🗜️</span>
                                    @else <span style="color:#64748b">📄</span>
                                    @endif
                                </div>
                            @else
                                <span style="color:#cbd5e1;font-size:20px">—</span>
                            @endif
                        </td>
                        <td>
                            <p style="font-weight:600;color:#0f172a;font-size:13px">{{ $r->titre }}</p>
                            @if($r->description)
                            <p style="font-size:11.5px;color:#94a3b8;margin-top:2px;max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $r->description }}</p>
                            @endif
                        </td>
                        <td>
                            <span style="background:#f0fdf4;color:#15803d;padding:2px 8px;border-radius:6px;font-size:11px;font-weight:600;">
                                {{ $r->edition }}
                            </span>
                        </td>
                        <td style="color:#64748b;font-size:12.5px">{{ $r->categorie ?? '—' }}</td>
                        <td style="color:#94a3b8;font-size:12.5px">{{ $r->ordre }}</td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.ressources.edit', $r->id) }}" class="btn-icon btn-edit menu-link" title="Modifier">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button onclick="deleteRessource({{ $r->id }}, this)" class="btn-icon btn-delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-photo-video"></i>
                                <p>Aucune ressource trouvée. <a href="{{ route('admin.ressources.create') }}" class="menu-link" style="color:#7c3aed;text-decoration:none;font-weight:600">Ajouter la première</a></p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="toast-wrap" id="toast-wrap"></div>

<script>
const csrfR = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function resetFilters() {
    document.getElementById('filter-edition').value = 'all';
    document.getElementById('filter-type').value    = 'all';
    const url = '{{ route('admin.ressources.index') }}';
    if (typeof loadContent === 'function') {
        loadContent(url, 'Ressources');
    } else {
        document.getElementById('search-form').submit();
    }
}

function showToast(msg, ok = true) {
    const wrap = document.getElementById('toast-wrap');
    const t = document.createElement('div');
    t.className = 'toast';
    t.style.borderLeft = `3px solid ${ok ? '#22c55e' : '#ef4444'}`;
    t.innerHTML = `<i class="fas ${ok ? 'fa-check-circle' : 'fa-exclamation-circle'}" style="color:${ok ? '#22c55e' : '#ef4444'}"></i>${msg}`;
    wrap.appendChild(t);
    setTimeout(() => t.classList.add('show'), 10);
    setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3200);
}

function deleteRessource(id, btn) {
    if (!confirm('Supprimer cette ressource définitivement ?')) return;
    fetch(`/admin/ressources/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfR, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) { btn.closest('tr').remove(); showToast('Ressource supprimée'); }
        else showToast('Erreur', false);
    })
    .catch(() => showToast('Erreur réseau', false));
}
</script>
