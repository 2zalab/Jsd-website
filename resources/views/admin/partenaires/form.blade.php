<div class="p-6 max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <button onclick="loadContent('{{ route('admin.partenaires.index') }}')" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $partenaire ? 'Modifier le partenaire' : 'Ajouter un partenaire' }}
        </h1>
    </div>

    <div id="pform-alert" class="hidden mb-4"></div>

    @if($partenaire)
    <div class="mb-4 flex justify-center">
        <img src="{{ asset('images/' . $partenaire->logo) }}" alt="{{ $partenaire->nom }}"
            class="h-20 w-auto object-contain border border-gray-200 rounded-xl p-2">
    </div>
    @endif

    <form id="pform" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Logo {{ $partenaire ? '(laisser vide pour garder l\'actuel)' : '*' }}
            </label>
            <input type="file" name="logo" {{ $partenaire ? '' : 'required' }} accept="image/*"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom du partenaire</label>
            <input type="text" name="nom" value="{{ $partenaire?->nom }}"
                placeholder="Ex: 2zaLab, MIT, Orange..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Site web</label>
            <input type="url" name="lien" value="{{ $partenaire?->lien }}"
                placeholder="https://..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ordre d'affichage</label>
                <input type="number" name="ordre" value="{{ $partenaire?->ordre ?? 0 }}" min="0"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="actif" value="1" {{ ($partenaire?->actif ?? true) ? 'checked' : '' }}
                        class="rounded text-blue-600 w-4 h-4">
                    <span class="text-sm font-semibold text-gray-700">Actif (visible sur le site)</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> {{ $partenaire ? 'Mettre à jour' : 'Enregistrer' }}
            </button>
            <button type="button" onclick="loadContent('{{ route('admin.partenaires.index') }}')"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm">
                Annuler
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('pform').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('pform-alert');
    const url   = '{{ $partenaire ? route("admin.partenaires.update", $partenaire->id) : route("admin.partenaires.store") }}';
    const body  = new FormData(this);
    @if($partenaire) body.append('_method', 'PUT'); @endif

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
        if (data.success) setTimeout(() => loadContent('{{ route('admin.partenaires.index') }}'), 1200);
    })
    .catch(() => { alert.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm'; alert.textContent = 'Erreur réseau.'; alert.classList.remove('hidden'); });
});
</script>
