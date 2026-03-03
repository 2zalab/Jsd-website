<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concours Meilleurs Programmeurs Lycée (CMPL)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-0">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold leading-tight">Concours Meilleurs Programmeurs Lycée (CMPL)</h2>
                <button id="downloadPdf" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-file-pdf mr-2"></i>Télécharger PDF
                </button>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select id="filterSelect" class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Tous</option>
                            <option value="nom">Nom</option>
                            <option value="etablissement">Établissement</option>
                            <option value="classe">Classe</option>
                            <option value="langages">Langages</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                        <input id="searchInput" placeholder="Rechercher..." class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table id="cmplTable" class="min-w-full leading-normal">
                        <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Nom
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Établissement
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Classe
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Langages
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cmpl as $programmeur)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $programmeur->nom }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $programmeur->etablissement }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $programmeur->classe }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        @php
                                            $langages = json_decode($programmeur->langages, true);
                                            echo is_array($langages) ? implode(', ', $langages) : $programmeur->langages;
                                        @endphp
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-2"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Affichage de <span id="startIndex">1</span> à <span id="endIndex">{{ count($cmpl) }}</span> sur <span id="totalEntries">{{ count($cmpl) }}</span> entrées
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button id="prevButton" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                Préc
                            </button>
                            <button id="nextButton" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                Suiv
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('cmplTable');
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');
        const downloadPdfButton = document.getElementById('downloadPdf');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        let currentPage = 1;
        const rowsPerPage = 10;

        // Tri
        table.querySelectorAll('th').forEach((headerCell, index) => {
            headerCell.addEventListener('click', () => {
                sortTableByColumn(table, index);
            });
        });

        // Recherche et filtre
        searchInput.addEventListener('input', filterTable);
        filterSelect.addEventListener('change', filterTable);

        // Téléchargement PDF
        downloadPdfButton.addEventListener('click', () => {
            // Ici, vous devriez appeler une route backend pour générer et télécharger le PDF
            window.location.href = '/download-pdf';
        });

        // Pagination
        prevButton.addEventListener('click', () => changePage(-1));
        nextButton.addEventListener('click', () => changePage(1));

        function sortTableByColumn(table, column) {
            const tBody = table.tBodies[0];
            const rows = Array.from(tBody.querySelectorAll('tr'));
            const currentIsAscending = table.querySelector(`th:nth-child(${column + 1})`).classList.contains('th-sort-asc');

            const sortedRows = rows.sort((a, b) => {
                const aColText = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
                const bColText = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();

                return currentIsAscending
                    ? bColText.localeCompare(aColText, 'fr', { sensitivity: 'base' })
                    : aColText.localeCompare(bColText, 'fr', { sensitivity: 'base' });
            });

            // Remove all existing rows from the table
            while (tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            // Re-add the newly sorted rows
            tBody.append(...sortedRows);

            // Remember how the column is currently sorted
            table.querySelectorAll('th').forEach(th => th.classList.remove('th-sort-asc', 'th-sort-desc'));
            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle('th-sort-asc', !currentIsAscending);
            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle('th-sort-desc', currentIsAscending);

            filterTable();
        }

        function filterTable() {
            const filterValue = filterSelect.value;
            const searchTerm = searchInput.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const filterCell = row.querySelector(`td:nth-child(${getFilterColumnIndex(filterValue)})`);
                const filterText = filterCell ? filterCell.textContent.toLowerCase() : '';
                const rowText = row.textContent.toLowerCase();

                if ((filterValue === '' || filterText.includes(searchTerm)) && rowText.includes(searchTerm)) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });

            updatePagination();
        }

        function getFilterColumnIndex(filterValue) {
            switch(filterValue) {
                case 'nom': return 1;
                case 'etablissement': return 2;
                case 'classe': return 3;
                case 'langages': return 4;
                default: return 0;
            }
        }

        function updatePagination() {
            const visibleRows = table.querySelectorAll('tbody tr:not(.hidden)');
            const totalPages = Math.ceil(visibleRows.length / rowsPerPage);

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, visibleRows.length);

            visibleRows.forEach((row, index) => {
                if (index >= startIndex && index < endIndex) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('startIndex').textContent = startIndex + 1;
            document.getElementById('endIndex').textContent = endIndex;
            document.getElementById('totalEntries').textContent = visibleRows.length;

            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages;
        }

        function changePage(direction) {
            currentPage += direction;
            updatePagination();
        }

        // Initial pagination
        updatePagination();
    });
    </script>
</body>
</html>
