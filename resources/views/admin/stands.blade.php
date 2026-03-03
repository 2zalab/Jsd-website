
    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Liste des réservations des Stands</h1>
                <a href="{{ route('stands.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Télécharger PDF
                </a>
            </div>

            <div class="mb-6">
                <form action="{{ route('admin.stands') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Rechercher un stand..." class="flex-grow p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($stands as $stand)
                            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $stand->nom_entreprise }}</h2>
                                    <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Secteur :</span> {{ $stand->secteur_activite }}</p>
                                    <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Taille :</span> {{ $stand->taille_stand }}</p>
                                    <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Effectif :</span> {{ $stand->effectif }} personnes</p>
                                    <p class="text-sm text-gray-600 mb-4"><span class="font-medium">Adresse :</span> {{ $stand->adresse }}</p>

                                    <div class="flex items-center justify-between mt-4">
                                        <a href="mailto:{{ $stand->email_contact }}" class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            Contact
                                        </a>
                                        <a href="tel:{{ $stand->telephone_contact }}" class="text-green-600 hover:text-green-800">
                                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            Appeler
                                        </a>
                                    </div>
                                </div>
                                @if($stand->besoins_specifiques)
                                    <div class="px-4 py-2 bg-yellow-100 text-yellow-800 text-sm">
                                        <span class="font-medium">Besoins spécifiques :</span> {{ $stand->besoins_specifiques }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full text-center py-4 text-gray-500">
                                Aucun stand trouvé.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

