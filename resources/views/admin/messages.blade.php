
<div class="container mx-auto px-2 py-2">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">Messages</h1>

    <div class="mb-6 relative">
        <form id="search-form" action="{{ route('admin.messages') }}" method="GET" class="flex items-center">
            <div class="relative flex-grow">
                <input
                    type="text"
                    name="search"
                    placeholder="Rechercher..."
                    class="pl-10 pr-4 py-2 w-full rounded-l-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ request('search') }}"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                Rechercher
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($messages as $message)
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $message->name }}</h2>
                    <p class="text-sm text-gray-600 mb-2">{{ $message->email }}</p>
                    <p class="text-sm text-gray-700 mb-4">{{ $message->message }}</p>
                    <p class="text-xs text-gray-500 mb-4">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                    <div class="flex justify-between">
                        <a href="mailto:{{ $message->email }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-150 ease-in-out">
                            Répondre
                        </a>
                        <form action="{{ route('messages.destroy', $message) }}" method="POST" class="inline delete-message-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-150 ease-in-out">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
