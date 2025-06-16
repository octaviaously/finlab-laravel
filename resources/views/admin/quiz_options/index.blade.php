<x-layout>
    <x-slot:title>Kelola Opsi Kuis</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Opsi Kuis</h2>
        <div class="flex gap-4 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-block">Kembali</a>
            <a href="{{ route('admin.quiz_options.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 inline-block">Tambah Opsi</a>
        </div>
        @if (session('success'))
            <div id="success-notification" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-3 px-6 text-left">Kursus</th>
                    <th class="py-3 px-6 text-left">Soal</th>
                    <th class="py-3 px-6 text-left">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizOptions as $option)
                    <tr>
                        <td class="py-3 px-6">{{ $option->quiz->course->judul }}</td>
                        <td class="py-3 px-6">{{ Str::limit($option->quiz->soal, 30) }}</td>
                        <td class="py-3 px-6">{{ Str::limit($option->jawaban, 30) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session('success'))
        <script>
            setTimeout(() => {
                document.getElementById('success-notification').style.display = 'none';
            }, 3000);
        </script>
    @endif
</x-layout>