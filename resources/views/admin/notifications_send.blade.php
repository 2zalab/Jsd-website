<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Envoyer une Notification</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Formulaire d'envoi --}}
        <div>
            <div id="notif-alert" class="hidden mb-4"></div>

            <form id="notif-form" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Destinataire *</label>
                    <select name="target" id="target-select" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="all">Tous les utilisateurs</option>
                        <option value="user">Un utilisateur spécifique</option>
                    </select>
                </div>

                <div id="user-select-wrap" class="hidden">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Choisir l'utilisateur *</label>
                    <select name="user_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">Sélectionner...</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Type *</label>
                    <select name="type" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="info">ℹ️ Information</option>
                        <option value="success">✅ Succès</option>
                        <option value="warning">⚠️ Avertissement</option>
                        <option value="error">❌ Erreur</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Titre *</label>
                    <input type="text" name="title" required maxlength="255"
                        placeholder="Titre de la notification"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Message *</label>
                    <textarea name="message" required rows="5"
                        placeholder="Contenu de la notification..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i> Envoyer la notification
                </button>
            </form>
        </div>

        {{-- Notifications récentes --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Notifications récentes</h2>
            <div class="space-y-3 max-h-[600px] overflow-y-auto pr-1">
                @forelse($recent as $notif)
                @php
                    $typeCss = [
                        'info'    => 'bg-blue-50 border-blue-200',
                        'success' => 'bg-green-50 border-green-200',
                        'warning' => 'bg-yellow-50 border-yellow-200',
                        'error'   => 'bg-red-50 border-red-200',
                    ][$notif->type] ?? 'bg-gray-50 border-gray-200';
                    $iconCss = [
                        'info'    => 'text-blue-500',
                        'success' => 'text-green-500',
                        'warning' => 'text-yellow-500',
                        'error'   => 'text-red-500',
                    ][$notif->type] ?? 'text-gray-500';
                @endphp
                <div class="rounded-xl border p-4 {{ $typeCss }}">
                    <div class="flex items-start gap-3">
                        <i class="{{ $notif->icon ?? 'fas fa-bell' }} {{ $iconCss }} mt-0.5 text-base flex-shrink-0"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">{{ $notif->title }}</p>
                            <p class="text-xs text-gray-600 mt-0.5 line-clamp-2">{{ $notif->message }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                → {{ $notif->user->name ?? 'Inconnu' }}
                                &nbsp;·&nbsp;
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-bell-slash text-3xl mb-2 block"></i>
                    Aucune notification envoyée.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
// Afficher/masquer le select utilisateur selon la cible
document.getElementById('target-select').addEventListener('change', function() {
    const wrap = document.getElementById('user-select-wrap');
    wrap.classList.toggle('hidden', this.value !== 'user');
    wrap.querySelector('select').required = this.value === 'user';
});

document.getElementById('notif-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('notif-alert');
    const btn   = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';

    fetch('{{ route('admin.notifications.send') }}', {
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
        alert.textContent = data.message || (data.success ? 'Envoyé !' : 'Erreur.');
        alert.classList.remove('hidden');
        if (data.success) {
            this.reset();
            document.getElementById('user-select-wrap').classList.add('hidden');
            setTimeout(() => loadContent('{{ route('admin.notifications') }}'), 1500);
        }
    })
    .catch(() => {
        alert.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm';
        alert.textContent = 'Erreur réseau.';
        alert.classList.remove('hidden');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-paper-plane"></i> Envoyer la notification';
    });
});
</script>
