<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Liste de demandes de Sponsoring</h1>

               <!-- Barre de recherche et boutons d'export -->
               <div class="flex justify-between items-center mb-5">
                    <div class="flex items-center">
                        <form id="search-form" action="{{ route('admin.sponsors') }}" method="GET" class="flex items-center">
                            <div class="flex-1 mr-0">
                                <input
                                    type="text"
                                    placeholder="Rechercher un sponsor..."
                                    class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ request('search') }}"
                                    >
                            </div>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>


                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Exporter en PDF
                        </button>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Exporter en CSV
                        </button>
                    </div>
                </div>

                <!-- Nombre de demandes -->
                <p class="text-gray-600 mb-4">Nombre total de demandes : {{ $sponsors->count() }}</p>

        <!--div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"-->
            <!--div class="p-6 bg-white border-b border-gray-200"-->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($sponsors as $sponsor)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="p-4">
                                <div class="flex items-center justify-center mb-4">
                                    <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->nom }}" class="h-24 object-contain">
                                </div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2 text-center">{{ $sponsor->nom }}</h2>
                                <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Adresse :</span> {{ $sponsor->adresse }}</p>
                                <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Téléphone :</span> {{ $sponsor->telephone }}</p>
                                <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Email :</span> {{ $sponsor->email }}</p>
                                <p class="text-sm text-gray-600 mb-4"><span class="font-medium">Attentes :</span> {{ Str::limit($sponsor->motivation, 100) }}</p>

                                <div class="flex items-center justify-between mt-4">
                                    <a href="mailto:{{ $sponsor->email }}" class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        Contacter
                                    </a>
                                    <form action="{{ route('sponsors.destroy', $sponsors) }}" method="POST" class="inline delete-message-form">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="text-red-600 hover:text-red-800" >
                                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Supprimer
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-4 text-gray-500">
                            Aucun sponsor trouvé.
                        </div>
                    @endforelse
                </div>
            <!--/div-->
        <!--/div-->
    </div>
</div>
