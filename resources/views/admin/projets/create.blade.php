<div class="p-6 max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <button onclick="loadContent('{{ route('admin.inscriptions') }}')" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un Projet Digital</h1>
    </div>

    <div id="proj-alert" class="hidden mb-4"></div>

    <form id="proj-form" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nom de l'équipe *</label>
                <input type="text" name="nom_equipe" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nom du chef d'équipe *</label>
                <input type="text" name="chef_equipe" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email du chef d'équipe *</label>
                <input type="email" name="email_chef_equipe" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Établissement *</label>
                <input type="text" name="etablissement" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Niveau d'étude *</label>
                <select name="niveau_etude" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <option value="">Choisir...</option>
                    <option value="Lycée">Lycée</option>
                    <option value="Licence">Licence</option>
                    <option value="Master">Master</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Classe *</label>
                <input type="text" name="classe" required placeholder="Ex: Terminale D, L2 Info" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Type de concours *</label>
                <select name="type_concours" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <option value="">Choisir...</option>
                    <option value="CMPDL">CMPDL — Lycée</option>
                    <option value="CMPDS">CMPDS — Senior</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Statut *</label>
                <select name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom du projet *</label>
            <input type="text" name="nom_projet" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description du projet *</label>
            <textarea name="description_projet" required rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"></textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lien YouTube (démonstration)</label>
            <input type="url" name="lien_youtube" placeholder="https://youtu.be/..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lier à un compte utilisateur</label>
            <select name="user_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
                <option value="">Aucun</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            <button type="reset" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm">
                Réinitialiser
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('proj-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('proj-alert');
    fetch('{{ route('admin.projets.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new FormData(this),
    })
    .then(r => r.json())
    .then(data => {
        alert.className = data.success
            ? 'bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm'
            : 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm';
        alert.textContent = data.message || (data.success ? 'Ajouté avec succès.' : 'Erreur.');
        alert.classList.remove('hidden');
        if (data.success) { this.reset(); setTimeout(() => loadContent('{{ route('admin.inscriptions') }}'), 1500); }
    })
    .catch(() => { alert.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm'; alert.textContent = 'Erreur réseau.'; alert.classList.remove('hidden'); });
});
</script>
