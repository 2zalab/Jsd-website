<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants Hackathon Lycée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-8 max-w-6xl">
        <div class="py-0">
            <h1 class="text-3xl font-bold leading-tight text-gray-900 mb-4">Participants Hackathon Lycée</h1>
            <div class="p-4">
                    <div class="flex flex-wrap items-center justify-between mb-4">
                        <div class="w-full md:w-1/3 mb-4 md:mb-0">
                            <input id="searchInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Rechercher...">
                        </div>
                        <div class="w-full md:w-1/3 mb-4 md:mb-0">
                            <select id="filterSelect" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Tous les établissements</option>
                                <!-- Les options seront ajoutées dynamiquement via JavaScript -->
                            </select>
                        </div>
                        <div class="w-full md:w-1/3 text-right">
                            <button id="downloadPdf" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                <i class="fas fa-file-pdf mr-2"></i>Télécharger PDF
                            </button>
                        </div>
                    </div>
                </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">

                <div class="overflow-x-auto">
                    <table id="hackathonTable" class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Nom de l'équipe
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Chef d'équipe
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Nombre de participants
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                    Établissement
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Membres de l'équipe
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hackathonsLycee as $hackathon)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $hackathon->nom_equipe }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $hackathon->nom_chef_equipe }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $hackathon->nombre_participants }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $hackathon->etablissement }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <!--button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs show-members">
                                        Voir les membres
                                    </button-->
                                    <div class="members-list">
                                        <ol class="list-decimal list-inside text-gray-900 mt-2">
                                            @foreach($hackathon->membres as $membre)
                                                <li>{{ $membre }}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <span class="text-xs xs:text-sm text-gray-900">
                        Affichage de <span id="startIndex">1</span> à <span id="endIndex">{{ count($hackathonsLycee) }}</span> sur <span id="totalEntries">{{ count($hackathonsLycee) }}</span> équipes
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('hackathonTable');
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');
        const downloadPdfButton = document.getElementById('downloadPdf');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        let currentPage = 1;
        const rowsPerPage = 10;

        // Populate filter options
        const establishments = [...new Set(Array.from(table.querySelectorAll('tbody tr')).map(row => row.cells[3].textContent.trim()))];
        establishments.forEach(establishment => {
            const option = document.createElement('option');
            option.value = establishment;
            option.textContent = establishment;
            filterSelect.appendChild(option);
        });

        // Tri
        table.querySelectorAll('th').forEach((headerCell, index) => {
            if (index < 4) {  // Ne pas ajouter de tri sur la colonne "Membres de l'équipe"
                headerCell.addEventListener('click', () => {
                    sortTableByColumn(table, index);
                });
            }
        });

        // Recherche et filtre
        searchInput.addEventListener('input', filterTable);
        filterSelect.addEventListener('change', filterTable);

    // Téléchargement PDF
    const downloadPdfButton = document.getElementById('downloadPdf');
    downloadPdfButton.addEventListener('click', () => {
        fetch('/generate-pdf-lycee', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            throw new Error('Erreur lors de la génération du PDF');
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'participants_hackathon_lycee.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors du téléchargement du PDF.');
        });
    });

        // Pagination
        prevButton.addEventListener('click', () => changePage(-1));
        nextButton.addEventListener('click', () => changePage(1));

        // Toggle members list
        document.querySelectorAll('.show-members').forEach(button => {
            button.addEventListener('click', function() {
                const membersList = this.nextElementSibling;
                membersList.classList.toggle('hidden');
                this.textContent = membersList.classList.contains('hidden') ? 'Voir les membres' : 'Cacher les membres';
            });
        });

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

            while (tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            tBody.append(...sortedRows);

            table.querySelectorAll('th').forEach(th => th.classList.remove('th-sort-asc', 'th-sort-desc'));
            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle('th-sort-asc', !currentIsAscending);
            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle('th-sort-desc', currentIsAscending);

            filterTable();
        }

        function filterTable() {
            const filterValue = filterSelect.value.toLowerCase();
            const searchTerm = searchInput.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const establishmentText = row.cells[3].textContent.toLowerCase();
                const rowText = row.textContent.toLowerCase();

                if ((filterValue === '' || establishmentText.includes(filterValue)) && rowText.includes(searchTerm)) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });

            updatePagination();
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
