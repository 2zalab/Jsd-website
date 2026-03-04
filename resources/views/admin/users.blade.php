<div class="p-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h1>
        <span class="text-sm text-gray-500">{{ $users->total() }} utilisateur(s)</span>
    </div>

    {{-- Recherche --}}
    <form action="{{ route('admin.users') }}" method="GET" id="search-form" class="flex gap-3 mb-6">
        <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher par nom ou email..."
            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Utilisateur</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Téléphone</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Rôle</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Inscrit le</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50" data-user-id="{{ $user->id }}">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->phone ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="role-badge-{{ $user->id }} px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $user->role === 'admin' ? 'Admin' : 'Utilisateur' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2 items-center">
                                <select onchange="updateRole({{ $user->id }}, this.value, this)"
                                    class="border border-gray-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-blue-400">
                                    <option value="user"  {{ $user->role === 'user'  ? 'selected' : '' }}>Utilisateur</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @if($user->id !== auth()->id())
                                <button onclick="deleteUser({{ $user->id }}, this)"
                                    class="text-red-500 hover:text-red-700 text-xs px-2 py-1 border border-red-200 rounded-lg hover:bg-red-50">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-gray-400">
                            <i class="fas fa-users text-4xl mb-3 block"></i>
                            Aucun utilisateur trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 flex justify-between items-center">
            <span class="text-xs text-gray-500">
                {{ $users->firstItem() }}–{{ $users->lastItem() }} sur {{ $users->total() }}
            </span>
            {{ $users->links() }}
        </div>
        @endif
    </div>

    <div id="users-toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
            <i id="users-toast-icon" class="fas fa-check-circle text-green-400"></i>
            <span id="users-toast-msg"></span>
        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showUsersToast(msg, success = true) {
    const toast = document.getElementById('users-toast');
    document.getElementById('users-toast-icon').className = success
        ? 'fas fa-check-circle text-green-400'
        : 'fas fa-exclamation-circle text-red-400';
    document.getElementById('users-toast-msg').textContent = msg;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}

function updateRole(userId, role, select) {
    fetch(`/admin/utilisateurs/${userId}/role`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ role }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const badge = document.querySelector(`.role-badge-${userId}`);
            if (badge) {
                badge.textContent = role === 'admin' ? 'Admin' : 'Utilisateur';
                badge.className = `role-badge-${userId} px-2 py-1 rounded-full text-xs font-semibold ${role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700'}`;
            }
            showUsersToast('Rôle mis à jour');
        }
    })
    .catch(() => showUsersToast('Erreur réseau', false));
}

function deleteUser(userId, btn) {
    if (!confirm('Supprimer cet utilisateur ? Toutes ses données seront supprimées.')) return;
    fetch(`/admin/utilisateurs/${userId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.closest('tr').remove();
            showUsersToast('Utilisateur supprimé');
        } else {
            showUsersToast(data.message || 'Erreur', false);
        }
    })
    .catch(() => showUsersToast('Erreur réseau', false));
}
</script>
