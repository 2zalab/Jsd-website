<div class="p-6 max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <button onclick="loadContent('{{ route('admin.activites.index') }}')" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $activite ? 'Modifier l\'activité' : 'Ajouter une activité' }}
        </h1>
    </div>

    <div id="aform-alert" class="hidden mb-4"></div>

    @if($activite?->image)
    <div class="mb-4">
        <img src="{{ asset('images/' . $activite->image) }}" alt="{{ $activite->titre }}"
            class="h-32 w-full object-cover rounded-xl border border-gray-200">
    </div>
    @endif

    <form id="aform" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Titre *</label>
            <input type="text" name="titre" required value="{{ $activite?->titre }}"
                placeholder="Ex: Hackathon, Conférences..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description *</label>
            <textarea name="description" required rows="4"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">{{ $activite?->description }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Image {{ $activite ? '(laisser vide pour garder l\'actuelle)' : '' }}
            </label>
            <input type="file" name="image" accept="image/*"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ordre d'affichage</label>
                <input type="number" name="ordre" value="{{ $activite?->ordre ?? 0 }}" min="0"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="actif" value="1" {{ ($activite?->actif ?? true) ? 'checked' : '' }}
                        class="rounded text-green-600 w-4 h-4">
                    <span class="text-sm font-semibold text-gray-700">Actif</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> {{ $activite ? 'Mettre à jour' : 'Enregistrer' }}
            </button>
            <button type="button" onclick="loadContent('{{ route('admin.activites.index') }}')"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm">
                Annuler
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('aform').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('aform-alert');
    const url   = '{{ $activite ? route("admin.activites.update", $activite->id) : route("admin.activites.store") }}';
    const body  = new FormData(this);
    @if($activite) body.append('_method', 'PUT'); @endif

    fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'X-Requested-With': 'XMLHttpRequest' },
        body,
    })
    .then(r => r.json())
    .then(data => {
        alert.className = data.success
            ? 'bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm'
            : 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm';
        alert.textContent = data.message || (data.success ? 'Succès.' : 'Erreur.');
        alert.classList.remove('hidden');
        if (data.success) setTimeout(() => loadContent('{{ route('admin.activites.index') }}'), 1200);
    })
    .catch(() => { alert.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm'; alert.textContent = 'Erreur réseau.'; alert.classList.remove('hidden'); });
});
</script>
