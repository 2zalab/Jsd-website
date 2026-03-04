<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Abonnés à la Newsletter</h1>
        <a href="{{ route('admin.newsletter.csv') }}"
           class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-file-csv"></i> Exporter CSV
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($letters as $letter)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $letter->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $letter->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-sm flex gap-4">
                        <a href="mailto:{{ $letter->email }}" class="text-indigo-600 hover:text-indigo-800">
                            <i class="fas fa-envelope mr-1"></i> Envoyer un email
                        </a>
                        <button onclick="unsubscribe({{ $letter->id }}, this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-user-times mr-1"></i> Désabonner
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-400">Aucun abonné à la newsletter.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function unsubscribe(id, btn) {
    if (!confirm('Désabonner cet email ?')) return;
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/admin/newsletter/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        if (data.success) btn.closest('tr').remove();
    });
}
</script>
