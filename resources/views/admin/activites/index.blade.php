<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Activités</h1>
        <a href="{{ route('admin.activites.create') }}" class="menu-link bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Ajouter une activité
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($activites as $a)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @if($a->image)
            <img src="{{ asset('storage/images/' . $a->image) }}" alt="{{ $a->titre }}"
                class="w-full h-40 object-cover"
                onerror="this.style.display='none'">
            @else
            <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                <i class="fas fa-image text-3xl"></i>
            </div>
            @endif

            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-900 text-sm">{{ $a->titre }}</h3>
                    <span class="ml-2 flex-shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold {{ $a->actif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $a->actif ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
                <p class="text-xs text-gray-500 line-clamp-2 mb-3">{{ $a->description }}</p>
                <p class="text-xs text-gray-400 mb-3">Ordre : {{ $a->ordre }}</p>

                <div class="flex gap-2">
                    <a href="{{ route('admin.activites.edit', $a->id) }}" class="menu-link flex-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1.5 rounded-lg text-center">
                        <i class="fas fa-edit mr-1"></i> Modifier
                    </a>
                    <button onclick="deleteActivite({{ $a->id }}, this)" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <i class="fas fa-calendar-alt text-4xl mb-3 block"></i>
            Aucune activité enregistrée.
        </div>
        @endforelse
    </div>

    <div id="act-toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
            <i id="act-toast-icon" class="fas fa-check-circle text-green-400"></i>
            <span id="act-toast-msg"></span>
        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showActToast(msg, ok = true) {
    const t = document.getElementById('act-toast');
    document.getElementById('act-toast-icon').className = ok ? 'fas fa-check-circle text-green-400' : 'fas fa-exclamation-circle text-red-400';
    document.getElementById('act-toast-msg').textContent = msg;
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

function deleteActivite(id, btn) {
    if (!confirm('Supprimer cette activité ?')) return;
    fetch(`/admin/activites/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { btn.closest('.bg-white').remove(); showActToast('Activité supprimée'); }
    });
}
</script>
