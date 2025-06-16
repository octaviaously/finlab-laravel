<x-layout>
    <x-slot:title>Kursus Keuangan</x-slot:title>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
        <h2 class="text-2xl text-gray-600 mb-6">Kursus Terkini</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses as $course)
                <article class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="relative w-full h-48">
                        <img src="{{ preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $course->link_video, $matches) ? 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg' : asset('img/placeholder.jpg') }}" alt="{{ $course->judul }}" class="w-full h-full object-cover rounded aspect-[3/2]">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 mt-4">{{ $course->judul }}</h3>
                    <p class="text-gray-700 mb-4">{{ Str::limit($course->deskripsi, 150) }}</p>
                    <a href="/courses/{{ $course->slug }}" class="inline-block text-blue-600 hover:text-blue-700 hover:underline transition-colors">Lihat Kursus »</a>
                </article>
            @endforeach
        </div>
    </div>
</x-layout>