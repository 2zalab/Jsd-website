<div class="p-6 max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <button onclick="loadContent('{{ route('admin.ressources.index') }}')" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $ressource ? 'Modifier la ressource' : 'Ajouter une ressource' }}
        </h1>
    </div>

    <div id="rform-alert" class="hidden mb-4"></div>

    <form id="rform" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Type *</label>
                <select name="type" required id="res-type"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <option value="photo"    {{ ($ressource?->type ?? '') === 'photo'    ? 'selected' : '' }}>📷 Photo</option>
                    <option value="document" {{ ($ressource?->type ?? '') === 'document' ? 'selected' : '' }}>📄 Document</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Édition *</label>
                <select name="edition" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <option value="JSD23" {{ ($ressource?->edition ?? 'JSD23') === 'JSD23' ? 'selected' : '' }}>JSD'23 — 1ère Édition</option>
                    <option value="JSD26" {{ ($ressource?->edition ?? '') === 'JSD26' ? 'selected' : '' }}>JSD'26 — 3ème Édition</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Titre *</label>
            <input type="text" name="titre" required value="{{ $ressource?->titre }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">{{ $ressource?->description }}</textarea>
        </div>

        <div id="doc-categorie" class="{{ ($ressource?->type ?? '') !== 'document' ? 'hidden' : '' }}">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Catégorie (pour documents)</label>
            <select name="categorie"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                <option value="">Choisir...</option>
                <option value="PDF"  {{ $ressource?->categorie === 'PDF'  ? 'selected' : '' }}>PDF</option>
                <option value="PPT"  {{ $ressource?->categorie === 'PPT'  ? 'selected' : '' }}>PPT / Présentation</option>
                <option value="ZIP"  {{ $ressource?->categorie === 'ZIP'  ? 'selected' : '' }}>ZIP / Archive</option>
                <option value="DOCX" {{ $ressource?->categorie === 'DOCX' ? 'selected' : '' }}>DOCX</option>
                <option value="XLSX" {{ $ressource?->categorie === 'XLSX' ? 'selected' : '' }}>XLSX</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Fichier (image ou document) {{ $ressource ? '— laisser vide pour garder l\'actuel' : '' }}
            </label>
            @if($ressource?->fichier && $ressource->type === 'photo')
                <img src="{{ asset('images/' . $ressource->fichier) }}" class="h-20 w-auto object-cover rounded mb-2 border border-gray-200">
            @endif
            <input type="file" name="fichier"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lien externe (facultatif)</label>
            <input type="url" name="lien" value="{{ $ressource?->lien }}"
                placeholder="https://... (URL YouTube, document en ligne, etc.)"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Ordre d'affichage</label>
            <input type="number" name="ordre" value="{{ $ressource?->ordre ?? 0 }}" min="0"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> {{ $ressource ? 'Mettre à jour' : 'Enregistrer' }}
            </button>
            <button type="button" onclick="loadContent('{{ route('admin.ressources.index') }}')"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm">
                Annuler
            </button>
        </div>
    </form>
</div>

<script>
// Afficher/masquer catégorie selon le type
document.getElementById('res-type').addEventListener('change', function() {
    document.getElementById('doc-categorie').classList.toggle('hidden', this.value !== 'document');
});

document.getElementById('rform').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('rform-alert');
    const url   = '{{ $ressource ? route("admin.ressources.update", $ressource->id) : route("admin.ressources.store") }}';
    const body  = new FormData(this);
    @if($ressource) body.append('_method', 'PUT'); @endif

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
        if (data.success) setTimeout(() => loadContent('{{ route('admin.ressources.index') }}'), 1200);
    })
    .catch(() => { alert.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm'; alert.textContent = 'Erreur réseau.'; alert.classList.remove('hidden'); });
});
</script>
