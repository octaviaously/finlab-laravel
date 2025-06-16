<x-layout>
    <x-header title="Profil" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Profil Anda</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
            <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">Logout</button>
            </form>
        </div>
    </div>
</x-layout>