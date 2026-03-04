<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Concours Meilleurs Projets Digitaux — Supérieur (CMPDS)</h1>
        <a href="{{ route('admin.cmpds.pdf') }}" target="_blank"
           class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Télécharger PDF
        </a>
    </div>

    <div class="flex gap-3 mb-4">
        <input id="searchInput" placeholder="Rechercher (équipe, établissement, projet...)"
               class="w-full max-w-sm border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="cmpdsTable" class="min-w-full">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nom de l'équipe</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Chef d'équipe</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Établissement</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nom du projet</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($cmpds as $projet)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">{{ $projet->nom_equipe }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $projet->chef_equipe }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $projet->email_chef_equipe }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $projet->etablissement }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $projet->nom_projet }}</td>
                        <td class="px-5 py-4 text-sm flex gap-3">
                            @if($projet->lien_youtube)
                            <a href="{{ $projet->lien_youtube }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Voir la vidéo">
                                <i class="fas fa-play-circle"></i>
                            </a>
                            @endif
                            <a href="#" class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-gray-400">Aucun projet inscrit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 bg-gray-50 border-t flex items-center justify-between text-sm text-gray-600">
            <span>Total : <strong>{{ count($cmpds) }}</strong> projet(s)</span>
        </div>
    </div>
</div>

<script>
(function() {
    const table = document.getElementById('cmpdsTable');
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        const term = this.value.toLowerCase();
        table.querySelectorAll('tbody tr').forEach(row => {
            row.classList.toggle('hidden', !row.textContent.toLowerCase().includes(term));
        });
    });
})();
</script>
