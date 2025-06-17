<x-layout>
    <x-slot:title>Profil</x-slot:title>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Profil Anda</h2>
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
            <div class="flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h3>
            </div>
            <div class="space-y-4">
                <p class="text-gray-700"><strong>Username:</strong> {{ Auth::user()->username }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <div class="flex items-center bg-yellow-100 p-4 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <p class="text-gray-700"><strong>Poin Anda:</strong> {{ Auth::user()->points }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-700 transition-colors">Logout</button>
            </form>
        </div>
    </div>
</x-layout>