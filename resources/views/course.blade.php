<x-layout>
    <x-slot:title>{{ $course->judul }}</x-slot:title>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-3xl">
        <article>
            <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $course->judul }}</h1>
            <div class="relative w-full h-96">
                @php
                    $video_id = '';
                    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $course->link_video, $matches)) {
                        $video_id = $matches[1];
                    }
                @endphp
                @if ($video_id)
                    <iframe class="w-full h-full rounded" src="https://www.youtube.com/embed/{{ $video_id }}?rel=0" title="{{ $course->judul }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                        <p class="text-red-600">Video tidak tersedia. Periksa link video: {{ $course->link_video }}</p>
                    </div>
                @endif
            </div>
            <div class="mt-6 bg-gray-100 p-4 rounded-lg">
                <p class="text-gray-600"><strong>Durasi:</strong> {{ $course->durasi ?? 'Tidak tersedia' }}</p>
                <p class="text-gray-600"><strong>Tingkat Kesulitan:</strong> {{ ucfirst($course->tingkat_kesulitan) }}</p>
            </div>
            <div class="prose prose-lg max-w-none text-gray-800 mt-6">
                {!! nl2br(e($course->deskripsi)) !!}
            </div>
            <div class="mt-8">
    @if ($sudahDikerjakan ?? false)
        <button class="inline-block bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed" disabled>
            Kuis sudah dikerjakan
        </button>
    @else
        <a href="{{ route('feedback.show', $course->slug) }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
            Kerjakan Kuis
        </a>
    @endif
</div>
        </article>

        <div class="mt-10">
            <a href="/courses" class="text-blue-600 hover:text-blue-700 hover:underline text-sm">« Kembali ke daftar kursus</a>
        </div>
    </div>
    @if (session('success'))
    <script>
        alert(@json(session('success')));
    </script>
@endif

</x-layout>