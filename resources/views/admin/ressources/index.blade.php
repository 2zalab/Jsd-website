<div class="p-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ressources (Photos & Documents)</h1>
        <a href="{{ route('admin.ressources.create') }}" class="menu-link bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Ajouter une ressource
        </a>
    </div>

    {{-- Filtres --}}
    <form action="{{ route('admin.ressources.index') }}" method="GET" id="search-form" class="flex flex-wrap gap-3 mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <select name="edition" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <option value="all"  {{ $edition === 'all'  ? 'selected' : '' }}>Toutes les éditions</option>
            <option value="JSD23"{{ $edition === 'JSD23'? 'selected' : '' }}>JSD'23 — 1ère Édition</option>
            <option value="JSD26"{{ $edition === 'JSD26'? 'selected' : '' }}>JSD'26 — 3ème Édition</option>
        </select>
        <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <option value="all"     {{ $type === 'all'     ? 'selected' : '' }}>Tous les types</option>
            <option value="photo"   {{ $type === 'photo'   ? 'selected' : '' }}>Photos</option>
            <option value="document"{{ $type === 'document'? 'selected' : '' }}>Documents</option>
        </select>
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            <i class="fas fa-filter"></i> Filtrer
        </button>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aperçu</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Titre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Édition</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Catégorie</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Ordre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ressources as $r)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $r->type === 'photo' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ $r->type === 'photo' ? '📷 Photo' : '📄 Document' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($r->type === 'photo' && $r->fichier)
                                <img src="{{ asset('images/' . $r->fichier) }}" alt="{{ $r->titre }}"
                                    class="h-12 w-16 object-cover rounded" onerror="this.style.display='none'">
                            @elseif($r->type === 'document')
                                <div class="h-12 w-16 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                    <i class="fas fa-file-{{ strtolower($r->categorie ?? 'alt') === 'pdf' ? 'pdf text-red-400' : (strtolower($r->categorie ?? '') === 'ppt' ? 'powerpoint text-orange-400' : 'archive text-green-400') }} text-xl"></i>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm font-medium text-gray-900">{{ $r->titre }}</p>
                            @if($r->description)
                                <p class="text-xs text-gray-400 line-clamp-1 mt-0.5">{{ $r->description }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold {{ $r->edition === 'JSD23' ? 'text-blue-600' : 'text-green-600' }}">
                                {{ $r->edition === 'JSD23' ? "JSD'23" : "JSD'26" }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $r->categorie ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $r->ordre }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.ressources.edit', $r->id) }}" class="menu-link bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded-lg">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteRessource({{ $r->id }}, this)" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-lg">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-400">
                            <i class="fas fa-photo-video text-4xl mb-3 block"></i>
                            Aucune ressource trouvée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="res-toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
            <i id="res-toast-icon" class="fas fa-check-circle text-green-400"></i>
            <span id="res-toast-msg"></span>
        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showResToast(msg, ok = true) {
    const t = document.getElementById('res-toast');
    document.getElementById('res-toast-icon').className = ok ? 'fas fa-check-circle text-green-400' : 'fas fa-exclamation-circle text-red-400';
    document.getElementById('res-toast-msg').textContent = msg;
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

function deleteRessource(id, btn) {
    if (!confirm('Supprimer cette ressource ?')) return;
    fetch(`/admin/ressources/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { btn.closest('tr').remove(); showResToast('Ressource supprimée'); }
    });
}
</script>
