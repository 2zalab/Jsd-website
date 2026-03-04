<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Concours Meilleurs Programmeurs — Supérieur (CMPS)</h1>
        <a href="{{ route('admin.cmps.pdf') }}" target="_blank"
           class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Télécharger PDF
        </a>
    </div>

    <div class="flex gap-3 mb-4">
        <select id="filterSelect" class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Tous les champs</option>
            <option value="nom">Nom</option>
            <option value="etablissement">Établissement</option>
            <option value="niveau">Niveau d'étude</option>
            <option value="langages">Langages</option>
        </select>
        <input id="searchInput" placeholder="Rechercher..."
               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="cmpsTable" class="min-w-full">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Nom</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Établissement</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Niveau d'étude</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer">Langages</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($cmps as $programmeur)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">{{ $programmeur->nom }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $programmeur->etablissement }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $programmeur->niveau_etude }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">
                            {{ is_array($programmeur->langages) ? implode(', ', $programmeur->langages) : $programmeur->langages }}
                        </td>
                        <td class="px-5 py-4 text-sm flex gap-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucun participant inscrit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 bg-gray-50 border-t flex items-center justify-between text-sm text-gray-600">
            <span>Affichage de <span id="startIndex">1</span> à <span id="endIndex">{{ count($cmps) }}</span> sur <span id="totalEntries">{{ count($cmps) }}</span> entrées</span>
            <div class="flex gap-2">
                <button id="prevButton" class="px-3 py-1 bg-white border rounded hover:bg-gray-100 disabled:opacity-40">Préc</button>
                <button id="nextButton" class="px-3 py-1 bg-white border rounded hover:bg-gray-100 disabled:opacity-40">Suiv</button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const table = document.getElementById('cmpsTable');
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');
    const prevBtn = document.getElementById('prevButton');
    const nextBtn = document.getElementById('nextButton');
    let currentPage = 1;
    const rowsPerPage = 10;

    table.querySelectorAll('thead th').forEach((th, i) => {
        th.addEventListener('click', () => {
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

    const colMap = {nom:0, etablissement:1, niveau:2, langages:3};

    function filterTable() {
        const col = filterSelect.value;
        const term = searchInput.value.toLowerCase();
        table.querySelectorAll('tbody tr').forEach(row => {
            const idx = col ? colMap[col] : -1;
            const text = (idx >= 0 && row.cells[idx]) ? row.cells[idx].textContent.toLowerCase() : row.textContent.toLowerCase();
            row.classList.toggle('hidden', !text.includes(term));
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
