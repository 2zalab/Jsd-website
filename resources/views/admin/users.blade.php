<style>
/* ── page shell ── */
.adm-page { padding: 28px 32px; }
.adm-page-header { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 24px; }
.adm-page-title { font-size: 22px; font-weight: 700; color: #0f172a; }
.adm-page-sub   { font-size: 13px; color: #94a3b8; margin-top: 2px; }

/* ── role tabs ── */
.role-tabs { display: flex; gap: 4px; background: #f1f5f9; border-radius: 10px; padding: 4px; }
.role-tab {
    padding: 6px 16px; border-radius: 7px; font-size: 12.5px; font-weight: 600;
    border: none; background: none; cursor: pointer; color: #64748b;
    transition: all .15s;
}
.role-tab.active { background: #fff; color: #4f46e5; box-shadow: 0 1px 4px rgba(0,0,0,.08); }

/* ── toolbar ── */
.adm-toolbar { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 20px; }
.search-box {
    flex: 1; min-width: 200px; position: relative;
}
.search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px; }
.search-box input {
    width: 100%; padding: 9px 12px 9px 36px;
    border: 1px solid #e2e8f0; border-radius: 9px;
    font-size: 13px; outline: none; background: #fff;
    transition: border-color .15s, box-shadow .15s;
}
.search-box input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.12); }

/* ── buttons ── */
.btn-primary {
    display: inline-flex; align-items: center; gap: 7px;
    background: #4f46e5; color: #fff; border: none; cursor: pointer;
    font-size: 13px; font-weight: 600; padding: 9px 18px; border-radius: 9px;
    transition: background .15s; text-decoration: none; white-space: nowrap;
}
.btn-primary:hover { background: #4338ca; }
.btn-outline {
    display: inline-flex; align-items: center; gap: 7px;
    background: #fff; color: #374151; border: 1px solid #e2e8f0; cursor: pointer;
    font-size: 13px; font-weight: 500; padding: 9px 14px; border-radius: 9px;
    transition: all .15s; white-space: nowrap;
}
.btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; }
.btn-danger-outline {
    display: inline-flex; align-items: center; gap: 6px;
    background: none; color: #ef4444; border: 1px solid #fecaca; cursor: pointer;
    font-size: 12px; padding: 5px 10px; border-radius: 7px;
    transition: all .15s;
}
.btn-danger-outline:hover { background: #fef2f2; }

/* ── table card ── */
.adm-card { background: #fff; border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; }
.adm-table { width: 100%; border-collapse: collapse; }
.adm-table thead th {
    background: #f8fafc; padding: 11px 16px;
    font-size: 11px; font-weight: 600; color: #64748b;
    text-transform: uppercase; letter-spacing: .05em;
    text-align: left; white-space: nowrap;
    border-bottom: 1px solid #f1f5f9;
}
.adm-table tbody tr { border-bottom: 1px solid #f8fafc; transition: background .1s; }
.adm-table tbody tr:last-child { border-bottom: none; }
.adm-table tbody tr:hover { background: #fafbfc; }
.adm-table td { padding: 12px 16px; font-size: 13.5px; color: #374151; }

/* user avatar */
.user-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 13px; flex-shrink: 0;
}
.user-name  { font-size: 13.5px; font-weight: 600; color: #0f172a; }
.user-email { font-size: 12px; color: #94a3b8; }

/* badges */
.badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 600; }
.badge-admin { background: #ede9fe; color: #5b21b6; }
.badge-user  { background: #eff6ff; color: #1d4ed8; }

/* ── role select ── */
.role-select {
    border: 1px solid #e2e8f0; border-radius: 7px; padding: 5px 8px;
    font-size: 12px; outline: none; background: #fff;
    transition: border-color .15s;
}
.role-select:focus { border-color: #6366f1; }

/* ── pagination ── */
.adm-pagination { display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; border-top: 1px solid #f1f5f9; }
.adm-pagination-info { font-size: 12px; color: #94a3b8; }

/* ── empty state ── */
.empty-state { text-align: center; padding: 56px 20px; color: #94a3b8; }
.empty-state i { font-size: 40px; margin-bottom: 12px; display: block; }
.empty-state p { font-size: 14px; }

/* ── modal ── */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,.45);
    display: flex; align-items: center; justify-content: center;
    z-index: 9999; opacity: 0; pointer-events: none;
    transition: opacity .2s;
}
.modal-overlay.open { opacity: 1; pointer-events: all; }
.modal-box {
    background: #fff; border-radius: 16px;
    width: 100%; max-width: 480px; margin: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,.18);
    transform: scale(.96); transition: transform .2s;
}
.modal-overlay.open .modal-box { transform: scale(1); }
.modal-header {
    padding: 20px 24px 16px;
    border-bottom: 1px solid #f1f5f9;
    display: flex; align-items: center; justify-content: space-between;
}
.modal-title { font-size: 17px; font-weight: 700; color: #0f172a; }
.modal-close { background: none; border: none; font-size: 18px; color: #94a3b8; cursor: pointer; padding: 4px; border-radius: 6px; }
.modal-close:hover { color: #374151; background: #f1f5f9; }
.modal-body { padding: 20px 24px; }
.modal-footer { padding: 14px 24px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 10px; }

/* form field */
.field-label { display: block; font-size: 12.5px; font-weight: 600; color: #374151; margin-bottom: 5px; }
.field-input {
    width: 100%; border: 1px solid #e2e8f0; border-radius: 9px;
    padding: 9px 12px; font-size: 13px; outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.field-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.12); }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.field-group { margin-bottom: 14px; }
.field-group:last-child { margin-bottom: 0; }

/* ── toast ── */
.toast-wrap {
    position: fixed; bottom: 24px; right: 24px; z-index: 9999;
    display: flex; flex-direction: column; gap: 8px; pointer-events: none;
}
.toast {
    background: #0f172a; color: #fff;
    padding: 12px 18px; border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,.18);
    font-size: 13px; font-weight: 500;
    display: flex; align-items: center; gap: 10px;
    transform: translateX(110%); transition: transform .3s ease;
    pointer-events: all;
}
.toast.show { transform: translateX(0); }
</style>

<div class="adm-page">

    {{-- ── Header ── --}}
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Gestion des Utilisateurs</h1>
            <p class="adm-page-sub">{{ $users->total() }} utilisateur(s) au total</p>
        </div>
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <a href="{{ route('admin.users.export.pdf') }}" target="_blank" class="btn-outline">
                <i class="fas fa-file-pdf" style="color:#ef4444"></i> PDF
            </a>
            <a href="{{ route('admin.users.export.csv') }}" class="btn-outline">
                <i class="fas fa-file-csv" style="color:#16a34a"></i> CSV
            </a>
            <button onclick="openAddUserModal()" class="btn-primary">
                <i class="fas fa-user-plus"></i> Ajouter un utilisateur
            </button>
        </div>
    </div>

    {{-- ── Role tabs ── --}}
    <div style="margin-bottom:20px">
        <div class="role-tabs" style="display:inline-flex">
            <button class="role-tab {{ $role === 'all'   ? 'active' : '' }}" onclick="filterRole('all')">
                <i class="fas fa-users" style="margin-right:6px"></i> Tous
            </button>
            <button class="role-tab {{ $role === 'admin' ? 'active' : '' }}" onclick="filterRole('admin')">
                <i class="fas fa-shield-alt" style="margin-right:6px"></i> Admins
            </button>
            <button class="role-tab {{ $role === 'user'  ? 'active' : '' }}" onclick="filterRole('user')">
                <i class="fas fa-user" style="margin-right:6px"></i> Utilisateurs
            </button>
        </div>
    </div>

    {{-- ── Search toolbar ── --}}
    <form action="{{ route('admin.users') }}" method="GET" id="search-form" class="adm-toolbar">
        <input type="hidden" name="role" value="{{ $role }}">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher par nom ou email…">
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-search"></i> Chercher</button>
        @if($search)
        <button type="button" class="btn-outline" onclick="loadContent('{{ route('admin.users') }}')">
            <i class="fas fa-times"></i> Effacer
        </button>
        @endif
    </form>

    {{-- ── Table ── --}}
    <div class="adm-card">
        <div style="overflow-x:auto">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr data-user-id="{{ $user->id }}">
                        <td>
                            <div style="display:flex;align-items:center;gap:12px">
                                <div class="user-avatar" style="background:{{ $user->role === 'admin' ? '#ede9fe' : '#eff6ff' }};color:{{ $user->role === 'admin' ? '#5b21b6' : '#1d4ed8' }}">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="color:#64748b">{{ $user->phone ?? '—' }}</td>
                        <td>
                            <span id="role-badge-{{ $user->id }}" class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                @if($user->role === 'admin')
                                    <i class="fas fa-shield-alt"></i> Admin
                                @else
                                    <i class="fas fa-user"></i> Utilisateur
                                @endif
                            </span>
                        </td>
                        <td style="color:#94a3b8;font-size:12.5px">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div style="display:flex;gap:8px;align-items:center">
                                <select onchange="updateRole({{ $user->id }}, this.value, this)" class="role-select">
                                    <option value="user"  {{ $user->role === 'user'  ? 'selected' : '' }}>Utilisateur</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @if($user->id !== auth()->id())
                                <button onclick="deleteUser({{ $user->id }}, this)" class="btn-danger-outline">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Aucun utilisateur trouvé.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="adm-pagination">
            <span class="adm-pagination-info">{{ $users->firstItem() }}–{{ $users->lastItem() }} sur {{ $users->total() }}</span>
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

{{-- ── Add user modal ── --}}
<div class="modal-overlay" id="add-user-modal">
    <div class="modal-box">
        <div class="modal-header">
            <span class="modal-title"><i class="fas fa-user-plus" style="color:#6366f1;margin-right:8px"></i>Ajouter un utilisateur</span>
            <button class="modal-close" onclick="closeAddUserModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div id="modal-alert" style="display:none;margin-bottom:12px;padding:10px 14px;border-radius:9px;font-size:13px"></div>
            <form id="add-user-form">
                @csrf
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Nom complet *</label>
                        <input type="text" name="name" class="field-input" placeholder="Jean Dupont" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Téléphone</label>
                        <input type="text" name="phone" class="field-input" placeholder="+237...">
                    </div>
                </div>
                <div class="field-group">
                    <label class="field-label">Email *</label>
                    <input type="email" name="email" class="field-input" placeholder="email@exemple.com" required>
                </div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Mot de passe *</label>
                        <input type="password" name="password" class="field-input" placeholder="Min. 6 caractères" required minlength="6">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Rôle *</label>
                        <select name="role" class="field-input" required>
                            <option value="user">Utilisateur</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button onclick="closeAddUserModal()" class="btn-outline">Annuler</button>
            <button onclick="submitAddUser()" class="btn-primary" id="submit-user-btn">
                <i class="fas fa-save"></i> Créer l'utilisateur
            </button>
        </div>
    </div>
</div>

{{-- ── Toast ── --}}
<div class="toast-wrap" id="toast-wrap"></div>

<script>
(function() {
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/* ── toast ── */
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

/* ── role filter ── */
function filterRole(role) {
    const url = new URL('{{ route("admin.users") }}', location.origin);
    url.searchParams.set('role', role);
    loadContent(url.toString(), 'Utilisateurs');
}

/* ── update role ── */
function updateRole(userId, role, select) {
    fetch(`/admin/utilisateurs/${userId}/role`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ role }),
    })
    .then(r => r.json())
    .then(d => {
        if (!d.success) return showToast(d.message || 'Erreur', false);
        const badge = document.getElementById(`role-badge-${userId}`);
        if (badge) {
            badge.className = `badge ${role === 'admin' ? 'badge-admin' : 'badge-user'}`;
            badge.innerHTML = role === 'admin'
                ? '<i class="fas fa-shield-alt"></i> Admin'
                : '<i class="fas fa-user"></i> Utilisateur';
        }
        showToast('Rôle mis à jour');
    })
    .catch(() => showToast('Erreur réseau', false));
}

/* ── delete user ── */
function deleteUser(userId, btn) {
    if (!confirm('Supprimer cet utilisateur ? Cette action est irréversible.')) return;
    fetch(`/admin/utilisateurs/${userId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) { btn.closest('tr').remove(); showToast('Utilisateur supprimé'); }
        else showToast(d.message || 'Erreur', false);
    })
    .catch(() => showToast('Erreur réseau', false));
}

/* ── modal ── */
function openAddUserModal() {
    document.getElementById('add-user-modal').classList.add('open');
    document.getElementById('add-user-form').reset();
    const alert = document.getElementById('modal-alert');
    alert.style.display = 'none';
}
function closeAddUserModal() {
    document.getElementById('add-user-modal').classList.remove('open');
}
document.getElementById('add-user-modal').addEventListener('click', function(e) {
    if (e.target === this) closeAddUserModal();
});

function submitAddUser() {
    const form = document.getElementById('add-user-form');
    const btn  = document.getElementById('submit-user-btn');
    const alert = document.getElementById('modal-alert');
    const body  = new FormData(form);

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Création…';

    fetch('{{ route("admin.users.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' },
        body,
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            closeAddUserModal();
            showToast('Utilisateur créé avec succès !');
            setTimeout(() => loadContent('{{ route("admin.users") }}', 'Utilisateurs'), 800);
        } else {
            alert.style.display = 'block';
            alert.style.background = '#fef2f2';
            alert.style.color = '#991b1b';
            alert.style.border = '1px solid #fecaca';
            alert.textContent = d.message || 'Erreur lors de la création.';
        }
    })
    .catch(() => showToast('Erreur réseau', false))
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save"></i> Créer l\'utilisateur';
    });
}

/* expose onclick handlers to global scope */
window.filterRole         = filterRole;
window.updateRole         = updateRole;
window.deleteUser         = deleteUser;
window.openAddUserModal   = openAddUserModal;
window.closeAddUserModal  = closeAddUserModal;
window.submitAddUser      = submitAddUser;
})();
</script>
