<div class="p-6 max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <button onclick="loadContent('{{ route('admin.inscriptions') }}')" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1 class="text-2xl font-bold text-gray-800">Ajouter une Réservation de Stand</h1>
    </div>

    <div id="stand-alert" class="hidden mb-4"></div>

    <form id="stand-form" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nom de l'entreprise *</label>
                <input type="text" name="nom_entreprise" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Secteur d'activité *</label>
                <input type="text" name="secteur_activite" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email de contact *</label>
                <input type="email" name="email_contact" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone de contact *</label>
                <input type="text" name="telephone_contact" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Taille du stand *</label>
                <select name="taille_stand" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">Choisir...</option>
                    <option value="Small">Small (2m x 2m)</option>
                    <option value="Medium">Medium (3m x 3m)</option>
                    <option value="Large">Large (4m x 4m)</option>
                    <option value="Extra Large">Extra Large (5m x 5m)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Statut *</label>
                <select name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse *</label>
            <textarea name="adresse" required rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Besoins spécifiques</label>
            <textarea name="besoins_specifiques" rows="3" placeholder="Électricité, internet, écran, etc." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lier à un compte utilisateur</label>
            <select name="user_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Aucun</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            <button type="reset" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm">
                Réinitialiser
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('stand-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('stand-alert');
    fetch('{{ route('admin.stands.store') }}', {
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
