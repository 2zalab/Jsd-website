<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Messages</h1>
        <span class="text-sm text-gray-500">{{ $messages->count() }} message(s)</span>
    </div>

    <div class="mb-5">
        <form id="search-form" action="{{ route('admin.messages') }}" method="GET" class="flex max-w-md">
            <div class="relative flex-1">
                <input type="text" name="search" placeholder="Rechercher..."
                       class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       value="{{ request('search') }}">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700">
                Rechercher
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($messages as $message)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow" id="msg-{{ $message->id }}">
            <div class="p-5">
                <h2 class="text-base font-bold text-gray-800 mb-1">{{ $message->name }}</h2>
                <p class="text-sm text-indigo-600 mb-3">{{ $message->email }}</p>
                <p class="text-sm text-gray-700 mb-3 line-clamp-4">{{ $message->message }}</p>
                <p class="text-xs text-gray-400 mb-4">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                <div class="flex gap-3 pt-3 border-t border-gray-100">
                    <a href="mailto:{{ $message->email }}"
                       class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-3 py-2 rounded-lg text-center">
                        <i class="fas fa-reply mr-1"></i> Répondre
                    </a>
                    <button onclick="deleteMessage({{ $message->id }})"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-2 rounded-lg">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <i class="fas fa-inbox text-4xl mb-3 block"></i>
            Aucun message reçu.
        </div>
        @endforelse
    </div>
</div>

<div id="msg-toast" class="fixed bottom-6 right-6 z-50 hidden">
    <div class="bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl text-sm font-medium flex items-center gap-3">
        <i id="msg-toast-icon" class="fas fa-check-circle text-green-400"></i>
        <span id="msg-toast-msg"></span>
    </div>
</div>

<script>
function deleteMessage(id) {
    if (!confirm('Supprimer ce message ?')) return;
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/admin/messages/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        if (data.success) {
            const el = document.getElementById('msg-' + id);
            if (el) el.remove();
            const t = document.getElementById('msg-toast');
            document.getElementById('msg-toast-icon').className = 'fas fa-check-circle text-green-400';
            document.getElementById('msg-toast-msg').textContent = 'Message supprimé';
            t.classList.remove('hidden');
            setTimeout(() => t.classList.add('hidden'), 3000);
        }
    });
}
</script>
