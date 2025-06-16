<x-layout>
    <x-slot:title>Artikel Artikel Finansial</x-slot:title>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
        <h2 class="text-2xl text-gray-600 mb-6">Artikel Terkini</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($artikels as $artikel)
                <article class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="relative w-full h-48">
                        <img src="{{ asset($artikel->image) }}" alt="{{ $artikel->title }}" class="w-full h-full object-cover rounded aspect-[3/2]">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 mt-4">{{ $artikel->title }}</h3>
                    <p class="text-gray-600 mb-2">{{ $artikel->author }} | {{ $artikel->created_at->diffForHumans() }}</p>
                    <p class="text-gray-700 mb-4">{{ Str::limit($artikel->body, 150) }}</p>
                    <a href="/artikels/{{ $artikel->slug }}" class="inline-block text-blue-600 hover:text-blue-700 hover:underline transition-colors">Baca Selengkapnya</a>
                </article>
            @endforeach
        </div>
    </div>
</x-layout>