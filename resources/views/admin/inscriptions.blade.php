<div class="p-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Inscriptions</h1>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('admin.programmeurs.create') }}" class="menu-link bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Programmeur
            </a>
            <a href="{{ route('admin.projets.create') }}" class="menu-link bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Projet Digital
            </a>
            <a href="{{ route('admin.hackathons.create') }}" class="menu-link bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Hackathon
            </a>
            <a href="{{ route('admin.stands.create') }}" class="menu-link bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Stand
            </a>
        </div>
    </div>

    {{-- Filtres --}}
    <form action="{{ route('admin.inscriptions') }}" method="GET" id="search-form" class="flex flex-wrap gap-3 mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="all"        {{ $type === 'all'        ? 'selected' : '' }}>Tous les types</option>
            <option value="programmeur"{{ $type === 'programmeur'? 'selected' : '' }}>Programmeurs</option>
            <option value="projet"     {{ $type === 'projet'     ? 'selected' : '' }}>Projets Digitaux</option>
            <option value="hackathon"  {{ $type === 'hackathon'  ? 'selected' : '' }}>Hackathons</option>
            <option value="stand"      {{ $type === 'stand'      ? 'selected' : '' }}>Stands</option>
        </select>
        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="all"     {{ $status === 'all'     ? 'selected' : '' }}>Tous les statuts</option>
            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>En attente</option>
            <option value="approved"{{ $status === 'approved'? 'selected' : '' }}>Approuvé</option>
            <option value="rejected"{{ $status === 'rejected'? 'selected' : '' }}>Rejeté</option>
        </select>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            <i class="fas fa-filter"></i> Filtrer
        </button>
    </form>

    {{-- Stats rapides --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @php
            $total    = $inscriptions->count();
            $pending  = $inscriptions->where('status', 'pending')->count();
            $approved = $inscriptions->where('status', 'approved')->count();
            $rejected = $inscriptions->where('status', 'rejected')->count();
        @endphp
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 text-center">
            <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
            <p class="text-xs text-gray-500 mt-1">Total</p>
        </div>
        <div class="bg-yellow-50 rounded-xl p-4 shadow-sm border border-yellow-200 text-center">
            <p class="text-2xl font-bold text-yellow-700">{{ $pending }}</p>
            <p class="text-xs text-yellow-600 mt-1">En attente</p>
        </div>
        <div class="bg-green-50 rounded-xl p-4 shadow-sm border border-green-200 text-center">
            <p class="text-2xl font-bold text-green-700">{{ $approved }}</p>
            <p class="text-xs text-green-600 mt-1">Approuvés</p>
        </div>
        <div class="bg-red-50 rounded-xl p-4 shadow-sm border border-red-200 text-center">
            <p class="text-2xl font-bold text-red-700">{{ $rejected }}</p>
            <p class="text-xs text-red-600 mt-1">Rejetés</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Participant / Équipe</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Détail</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Compte</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($inscriptions as $ins)
                    <tr class="hover:bg-gray-50 transition-colors" data-id="{{ $ins->id }}" data-type="{{ $ins->type }}">
                        <td class="px-4 py-3">
                            @php
                                $typeColors = [
                                    'programmeur' => 'bg-blue-100 text-blue-700',
                                    'projet'      => 'bg-purple-100 text-purple-700',
                                    'hackathon'   => 'bg-green-100 text-green-700',
                                    'stand'       => 'bg-orange-100 text-orange-700',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $typeColors[$ins->type] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ $ins->label }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $ins->nom }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $ins->email }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $ins->detail }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($ins->user)
                                <span class="text-green-600 font-medium">{{ $ins->user->name }}</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $statusCss = [
                                    'pending'  => 'bg-yellow-100 text-yellow-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabel = [
                                    'pending'  => 'En attente',
                                    'approved' => 'Approuvé',
                                    'rejected' => 'Rejeté',
                                ];
                            @endphp
                            <span class="status-badge px-2 py-1 rounded-full text-xs font-semibold {{ $statusCss[$ins->status] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ $statusLabel[$ins->status] ?? $ins->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-1">
                                <button onclick="changeStatus('{{ $ins->type }}', {{ $ins->id }}, 'approved', this)"
                                    title="Approuver"
                                    class="action-btn bg-green-500 hover:bg-green-600 text-white text-xs px-2 py-1 rounded-lg {{ $ins->status === 'approved' ? 'opacity-40 cursor-not-allowed' : '' }}"
                                    {{ $ins->status === 'approved' ? 'disabled' : '' }}>
                                    <i class="fas fa-check"></i>
                                </button>
                                <button onclick="changeStatus('{{ $ins->type }}', {{ $ins->id }}, 'rejected', this)"
                                    title="Rejeter"
                                    class="action-btn bg-red-500 hover:bg-red-600 text-white text-xs px-2 py-1 rounded-lg {{ $ins->status === 'rejected' ? 'opacity-40 cursor-not-allowed' : '' }}"
                                    {{ $ins->status === 'rejected' ? 'disabled' : '' }}>
                                    <i class="fas fa-times"></i>
                                </button>
                                <button onclick="changeStatus('{{ $ins->type }}', {{ $ins->id }}, 'pending', this)"
                                    title="Remettre en attente"
                                    class="action-btn bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-2 py-1 rounded-lg {{ $ins->status === 'pending' ? 'opacity-40 cursor-not-allowed' : '' }}"
                                    {{ $ins->status === 'pending' ? 'disabled' : '' }}>
                                    <i class="fas fa-clock"></i>
                                </button>
                                <button onclick="deleteInscription('{{ $ins->type }}', {{ $ins->id }}, this)"
                                    title="Supprimer"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs px-2 py-1 rounded-lg">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-400">
                            <i class="fas fa-inbox text-4xl mb-3 block"></i>
                            Aucune inscription trouvée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Notification toast --}}
    <div id="ins-toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
            <i id="ins-toast-icon" class="fas fa-check-circle text-green-400"></i>
            <span id="ins-toast-msg"></span>
        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showToast(msg, success = true) {
    const toast = document.getElementById('ins-toast');
    const icon  = document.getElementById('ins-toast-icon');
    const text  = document.getElementById('ins-toast-msg');
    icon.className = success ? 'fas fa-check-circle text-green-400' : 'fas fa-exclamation-circle text-red-400';
    text.textContent = msg;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}

function changeStatus(type, id, status, btn) {
    if (btn.disabled) return;

    fetch('{{ route('admin.inscriptions.status') }}', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ type, id, status }),
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) { showToast('Erreur', false); return; }

        const row     = btn.closest('tr');
        const badge   = row.querySelector('.status-badge');
        const buttons = row.querySelectorAll('.action-btn');

        const labels = { pending: 'En attente', approved: 'Approuvé', rejected: 'Rejeté' };
        const css    = {
            pending:  'bg-yellow-100 text-yellow-800',
            approved: 'bg-green-100 text-green-800',
            rejected: 'bg-red-100 text-red-800',
        };

        badge.textContent = labels[status];
        badge.className   = `status-badge px-2 py-1 rounded-full text-xs font-semibold ${css[status]}`;

        buttons.forEach(b => {
            const bStatus = b.getAttribute('onclick').match(/'(\w+)', this\)$/)?.[1];
            b.disabled    = bStatus === status;
            b.classList.toggle('opacity-40', bStatus === status);
            b.classList.toggle('cursor-not-allowed', bStatus === status);
        });

        const msgs = { pending: 'Statut remis en attente', approved: 'Inscription approuvée — notification envoyée', rejected: 'Inscription rejetée — notification envoyée' };
        showToast(msgs[status] ?? 'Statut mis à jour');
    })
    .catch(() => showToast('Erreur réseau', false));
}

function deleteInscription(type, id, btn) {
    if (!confirm('Supprimer cette inscription ? Cette action est irréversible.')) return;

    const routes = {
        programmeur: '{{ route('admin.programmeurs.destroy', ':id') }}',
        projet:      '{{ route('admin.projets.destroy', ':id') }}',
        hackathon:   '{{ route('admin.hackathons.destroy', ':id') }}',
        stand:       '{{ route('admin.stands.destroy', ':id') }}',
    };

    fetch(routes[type].replace(':id', id), {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.closest('tr').remove();
            showToast('Inscription supprimée');
        }
    })
    .catch(() => showToast('Erreur réseau', false));
}
</script>
