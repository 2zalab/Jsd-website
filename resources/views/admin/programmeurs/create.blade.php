<div class="p-6 max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <button onclick="loadContent('{{ route('admin.inscriptions') }}')" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un Programmeur</h1>
    </div>

    <div id="prog-alert" class="hidden mb-4"></div>

    <form id="prog-form" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nom complet *</label>
                <input type="text" name="nom" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone *</label>
                <input type="text" name="telephone" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Établissement *</label>
                <input type="text" name="etablissement" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Niveau d'étude *</label>
                <select name="niveau_etude" id="prog-niveau" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" onchange="progUpdateClasse()">
                    <option value="">Choisir...</option>
                    <option value="secondaire">Secondaire (Lycée)</option>
                    <option value="superieur">Supérieur</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Classe *</label>
                <select name="classe" id="prog-classe" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">— Choisir un niveau d'abord —</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Type de concours *</label>
                <select name="type_concours" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Choisir...</option>
                    <option value="CMPL">CMPL — Lycée</option>
                    <option value="CMPS">CMPS — Senior</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Statut *</label>
                <select name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Langages de programmation *</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach(['Python','JavaScript','Java','C','C++','C#','PHP','Go','Rust','Dart','Kotlin','SQL'] as $lang)
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="checkbox" name="langages[]" value="{{ $lang }}" class="rounded text-blue-600">
                    {{ $lang }}
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lier à un compte utilisateur</label>
            <select name="user_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Aucun</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            <button type="reset" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm">
                Réinitialiser
            </button>
        </div>
    </form>
</div>

<script>
const CLASSES_PROG = {
    secondaire: ['3ème','Seconde A','Seconde C','Première A','Première C','Première D','Première TI','Terminale A','Terminale C','Terminale D','Terminale TI'],
    superieur:  ['L1','L2','L3','M1','M2','BTS 1','BTS 2','DUT 1','DUT 2','Licence Pro','Master Pro','Doctorat'],
};
function progUpdateClasse() {
    const n = document.getElementById('prog-niveau').value;
    const sel = document.getElementById('prog-classe');
    const opts = CLASSES_PROG[n] || [];
    sel.innerHTML = opts.length
        ? opts.map(c => `<option value="${c}">${c}</option>`).join('')
        : '<option value="">— Choisir un niveau d\'abord —</option>';
}

document.getElementById('prog-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('prog-alert');
    const formData = new FormData(this);

    fetch('{{ route('admin.programmeurs.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    })
    .then(r => r.json())
    .then(data => {
        alert.className = data.success
            ? 'bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm'
            : 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm';
        alert.textContent = data.message || (data.success ? 'Ajouté avec succès.' : 'Une erreur est survenue.');
        alert.classList.remove('hidden');
        if (data.success) { this.reset(); setTimeout(() => loadContent('{{ route('admin.inscriptions') }}'), 1500); }
    })
    .catch(() => {
        alert.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm';
        alert.textContent = 'Erreur réseau.';
        alert.classList.remove('hidden');
    });
});
</script>
