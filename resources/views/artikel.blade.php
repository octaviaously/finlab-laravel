<x-layout>
    <x-slot:title>{{ $artikel->title }}</x-slot:title>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-3xl pt-24">
        <article>
            <div class="relative w-full h-64">
                <img src="{{ asset($artikel->image) }}" alt="{{ $artikel->title }}" class="w-full h-full object-cover rounded aspect-[3/2]">
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4 mt-6 leading-tight">{{ $artikel->title }}</h1>
            <p class="text-gray-500 text-sm mb-8">{{ $artikel->author }} | {{ $artikel->created_at->diffForHumans() }}</p>

            <div class="prose prose-lg max-w-none text-gray-800">
                {!! nl2br(e($artikel->body)) !!}
            </div>
        </article>

        <div class="mt-10">
            <a href="/artikels" class="text-blue-600 hover:text-blue-700 hover:underline text-sm">« Kembali ke daftar artikel</a>
        </div>
    </div>
</x-layout>