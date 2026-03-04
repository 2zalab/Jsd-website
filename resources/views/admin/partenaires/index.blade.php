<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Partenaires Officiels</h1>
        <a href="{{ route('admin.partenaires.create') }}" class="menu-link bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Ajouter un partenaire
        </a>
    </div>

    <div id="part-alert" class="hidden mb-4"></div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Ordre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Logo</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nom</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Lien</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($partenaires as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $p->ordre }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ asset('images/' . $p->logo) }}" alt="{{ $p->nom }}"
                                class="h-10 w-auto object-contain rounded" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 40 40%22><rect width=%2240%22 height=%2240%22 fill=%22%23e5e7eb%22/><text x=%2250%25%22 y=%2255%25%22 text-anchor=%22middle%22 fill=%22%239ca3af%22 font-size=%228%22>IMG</text></svg>'">
                        </td>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $p->nom ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($p->lien)
                                <a href="{{ $p->lien }}" target="_blank" class="text-blue-600 hover:underline text-xs">{{ $p->lien }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <button onclick="toggleActif({{ $p->id }}, this)"
                                class="px-2 py-1 rounded-full text-xs font-semibold {{ $p->actif ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $p->actif ? 'Actif' : 'Inactif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.partenaires.edit', $p->id) }}" class="menu-link bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded-lg">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deletePartenaire({{ $p->id }}, this)" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-lg">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                            <i class="fas fa-handshake text-4xl mb-3 block"></i>
                            Aucun partenaire enregistré.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="part-toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
            <i id="part-toast-icon" class="fas fa-check-circle text-green-400"></i>
            <span id="part-toast-msg"></span>
        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showPartToast(msg, ok = true) {
    const t = document.getElementById('part-toast');
    document.getElementById('part-toast-icon').className = ok ? 'fas fa-check-circle text-green-400' : 'fas fa-exclamation-circle text-red-400';
    document.getElementById('part-toast-msg').textContent = msg;
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

function toggleActif(id, btn) {
    fetch(`/admin/partenaires/${id}/toggle`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.textContent = data.actif ? 'Actif' : 'Inactif';
            btn.className = `px-2 py-1 rounded-full text-xs font-semibold ${data.actif ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600'}`;
            showPartToast(data.actif ? 'Partenaire activé' : 'Partenaire désactivé');
        }
    });
}

function deletePartenaire(id, btn) {
    if (!confirm('Supprimer ce partenaire ?')) return;
    fetch(`/admin/partenaires/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { btn.closest('tr').remove(); showPartToast('Partenaire supprimé'); }
    });
}
</script>
