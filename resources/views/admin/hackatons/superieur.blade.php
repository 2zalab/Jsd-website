<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Participants Hackathon — Supérieur</h1>
        <a href="{{ route('admin.hackaton.superieur.pdf') }}" target="_blank"
           class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Télécharger PDF
        </a>
    </div>

    <div class="flex flex-wrap gap-3 mb-4">
        <input id="searchInput" placeholder="Rechercher..."
               class="flex-1 min-w-[200px] border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <select id="filterSelect" class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Tous les établissements</option>
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="hackathonTable" class="min-w-full">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Nom de l'équipe</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Chef d'équipe</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Participants</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Établissement</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Membres</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($hackathonsSuperieur as $hackathon)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">{{ $hackathon->nom_equipe }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $hackathon->nom_chef_equipe }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $hackathon->nombre_participants }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $hackathon->etablissement }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">
                            <ol class="list-decimal list-inside space-y-0.5">
                                @foreach($hackathon->membres ?? [] as $membre)
                                    <li>{{ $membre }}</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucune équipe inscrite.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 bg-gray-50 border-t flex items-center justify-between text-sm text-gray-600">
            <span>Affichage de <span id="startIndex">1</span> à <span id="endIndex">{{ count($hackathonsSuperieur) }}</span> sur <span id="totalEntries">{{ count($hackathonsSuperieur) }}</span> équipes</span>
            <div class="flex gap-2">
                <button id="prevButton" class="px-3 py-1 bg-white border rounded hover:bg-gray-100 disabled:opacity-40">Préc</button>
                <button id="nextButton" class="px-3 py-1 bg-white border rounded hover:bg-gray-100 disabled:opacity-40">Suiv</button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const table = document.getElementById('hackathonTable');
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');
    const prevBtn = document.getElementById('prevButton');
    const nextBtn = document.getElementById('nextButton');
    let currentPage = 1;
    const rowsPerPage = 10;

    // Populate establishment filter
    const establishments = [...new Set(Array.from(table.querySelectorAll('tbody tr')).map(r => r.cells[3] ? r.cells[3].textContent.trim() : ''))].filter(Boolean);
    establishments.forEach(e => {
        const opt = document.createElement('option');
        opt.value = e; opt.textContent = e;
        filterSelect.appendChild(opt);
    });

    table.querySelectorAll('thead th').forEach((th, i) => {
        if (i < 4) th.addEventListener('click', () => {
            const asc = !th.classList.contains('th-sort-asc');
            const rows = Array.from(table.tBodies[0].querySelectorAll('tr'));
            rows.sort((a, b) => {
                const at = (a.cells[i]||{textContent:''}).textContent.trim();
                const bt = (b.cells[i]||{textContent:''}).textContent.trim();
                return asc ? at.localeCompare(bt,'fr',{sensitivity:'base'}) : bt.localeCompare(at,'fr',{sensitivity:'base'});
            });
            while (table.tBodies[0].firstChild) table.tBodies[0].removeChild(table.tBodies[0].firstChild);
            table.tBodies[0].append(...rows);
            table.querySelectorAll('thead th').forEach(t => t.classList.remove('th-sort-asc','th-sort-desc'));
            th.classList.toggle('th-sort-asc', asc);
            th.classList.toggle('th-sort-desc', !asc);
            filterTable();
        });
    });

    searchInput.addEventListener('input', filterTable);
    filterSelect.addEventListener('change', filterTable);
    prevBtn.addEventListener('click', () => { currentPage--; updatePagination(); });
    nextBtn.addEventListener('click', () => { currentPage++; updatePagination(); });

    function filterTable() {
        const etablissement = filterSelect.value.toLowerCase();
        const term = searchInput.value.toLowerCase();
        table.querySelectorAll('tbody tr').forEach(row => {
            const etabText = row.cells[3] ? row.cells[3].textContent.toLowerCase() : '';
            const rowText = row.textContent.toLowerCase();
            const match = (etablissement === '' || etabText.includes(etablissement)) && rowText.includes(term);
            row.classList.toggle('hidden', !match);
        });
        currentPage = 1;
        updatePagination();
    }

    function updatePagination() {
        const visible = Array.from(table.querySelectorAll('tbody tr:not(.hidden)'));
        const total = visible.length;
        const totalPages = Math.max(1, Math.ceil(total / rowsPerPage));
        currentPage = Math.min(Math.max(1, currentPage), totalPages);
        const start = (currentPage - 1) * rowsPerPage;
        visible.forEach((r, i) => r.style.display = (i >= start && i < start + rowsPerPage) ? '' : 'none');
        document.getElementById('startIndex').textContent = total ? start + 1 : 0;
        document.getElementById('endIndex').textContent = Math.min(start + rowsPerPage, total);
        document.getElementById('totalEntries').textContent = total;
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
    }

    updatePagination();
})();
</script>
