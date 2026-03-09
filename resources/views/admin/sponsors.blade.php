<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Demandes de Sponsoring</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.sponsors.pdf') }}" target="_blank"
               class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <a href="{{ route('admin.sponsors.csv') }}"
               class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-file-csv"></i> CSV
            </a>
        </div>
    </div>

    <div class="flex items-center gap-3 mb-5">
        <form id="search-form" action="{{ route('admin.sponsors') }}" method="GET" class="flex flex-1 max-w-md">
            <input type="text" name="search" placeholder="Rechercher un sponsor..."
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   value="{{ request('search') }}">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <span class="text-sm text-gray-500">{{ $sponsors->count() }} demande(s)</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($sponsors as $sponsor)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="p-5">
                <div class="flex items-center justify-center mb-4 h-20">
                    <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->nom }}"
                         class="max-h-20 max-w-full object-contain"
                         onerror="this.style.display='none'">
                </div>
                <h2 class="text-lg font-bold text-gray-800 mb-3 text-center">{{ $sponsor->nom }}</h2>
                <div class="space-y-1.5 text-sm text-gray-600">
                    <p><span class="font-medium text-gray-700">Adresse :</span> {{ $sponsor->adresse }}</p>
                    <p><span class="font-medium text-gray-700">Téléphone :</span> {{ $sponsor->telephone }}</p>
                    <p><span class="font-medium text-gray-700">Email :</span> {{ $sponsor->email }}</p>
                    <p><span class="font-medium text-gray-700">Attentes :</span> {{ Str::limit($sponsor->motivation, 100) }}</p>
                </div>
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                    <button onclick="showSponsor({{ $sponsor->id }}, {{ json_encode(['nom'=>$sponsor->nom,'logo'=>$sponsor->logo_url,'adresse'=>$sponsor->adresse,'telephone'=>$sponsor->telephone,'email'=>$sponsor->email,'motivation'=>$sponsor->motivation,'date'=>$sponsor->created_at?->format('d/m/Y H:i')]) }})"
                            class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center gap-1">
                        <i class="fas fa-eye"></i> Détails
                    </button>
                    <a href="mailto:{{ $sponsor->email }}"
                       class="text-green-600 hover:text-green-800 text-sm flex items-center gap-1">
                        <i class="fas fa-envelope"></i> Contacter
                    </a>
                    <button onclick="deleteSponsor({{ $sponsor->id }}, this)"
                            class="text-red-600 hover:text-red-800 text-sm flex items-center gap-1">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <i class="fas fa-handshake text-4xl mb-3 block"></i>
            Aucune demande de sponsoring.
        </div>
        @endforelse
    </div>
</div>

{{-- Modal détails sponsor --}}
<div id="sp-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Détails du sponsor</h3>
            <button onclick="closeSponsorModal()" class="text-gray-400 hover:text-gray-700 transition text-xl leading-none">&times;</button>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex justify-center mb-2">
                <img id="sp-m-logo" src="" alt="" class="max-h-24 max-w-full object-contain rounded" onerror="this.style.display='none'">
            </div>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div><span class="font-semibold text-gray-600">Nom :</span><p id="sp-m-nom" class="text-gray-800 mt-0.5"></p></div>
                <div><span class="font-semibold text-gray-600">Date :</span><p id="sp-m-date" class="text-gray-800 mt-0.5"></p></div>
                <div><span class="font-semibold text-gray-600">Adresse :</span><p id="sp-m-adresse" class="text-gray-800 mt-0.5"></p></div>
                <div><span class="font-semibold text-gray-600">Téléphone :</span><p id="sp-m-telephone" class="text-gray-800 mt-0.5"></p></div>
                <div class="col-span-2"><span class="font-semibold text-gray-600">Email :</span><p id="sp-m-email" class="text-gray-800 mt-0.5 break-all"></p></div>
                <div class="col-span-2"><span class="font-semibold text-gray-600">Attentes / Motivation :</span><p id="sp-m-motivation" class="text-gray-800 mt-0.5 whitespace-pre-line"></p></div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 flex justify-end">
            <button onclick="closeSponsorModal()" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">Fermer</button>
        </div>
    </div>
</div>

<div id="sp-toast" class="fixed bottom-6 right-6 z-50 hidden">
    <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
        <i id="sp-toast-icon" class="fas fa-check-circle text-green-400"></i>
        <span id="sp-toast-msg"></span>
    </div>
</div>

<script>
function showSpToast(msg, ok = true) {
    const t = document.getElementById('sp-toast');
    document.getElementById('sp-toast-icon').className = ok ? 'fas fa-check-circle text-green-400' : 'fas fa-exclamation-circle text-red-400';
    document.getElementById('sp-toast-msg').textContent = msg;
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

function showSponsor(id, data) {
    document.getElementById('sp-m-logo').src        = data.logo || '';
    document.getElementById('sp-m-nom').textContent         = data.nom || '—';
    document.getElementById('sp-m-date').textContent        = data.date || '—';
    document.getElementById('sp-m-adresse').textContent     = data.adresse || '—';
    document.getElementById('sp-m-telephone').textContent   = data.telephone || '—';
    document.getElementById('sp-m-email').textContent       = data.email || '—';
    document.getElementById('sp-m-motivation').textContent  = data.motivation || '—';
    document.getElementById('sp-modal').classList.remove('hidden');
}
function closeSponsorModal() {
    document.getElementById('sp-modal').classList.add('hidden');
}

function deleteSponsor(id, btn) {
    if (!confirm('Supprimer cette demande de sponsoring ?')) return;
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/sponsors/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        if (data.success) {
            const card = btn.closest('.bg-white.rounded-xl') || btn.closest('[class*="rounded-xl"]');
            if (card) card.remove();
            showSpToast('Demande supprimée');
        } else {
            showSpToast('Erreur lors de la suppression', false);
        }
    }).catch(() => showSpToast('Erreur lors de la suppression', false));
}
</script>
