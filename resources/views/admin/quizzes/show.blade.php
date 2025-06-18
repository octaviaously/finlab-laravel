<x-layout>
    <x-slot:title>Kuis untuk {{ $course->judul }}</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Kuis untuk {{ $course->judul }}</h2>
        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.quizzes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-block">Kembali ke Daftar Kursus</a>
            <a href="{{ route('admin.quizzes.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 inline-block">Tambah Kuis Baru</a>
        </div>

        @if (session('success'))
            <div id="success-notification" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
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
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Pertanyaan</th>
                    <th class="py-3 px-6 text-left">Jawaban Benar</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quizzes as $index => $quiz)
                    <tr>
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ Str::limit($quiz->question, 50) }}</td>
                        <td class="py-3 px-6">{{ strtoupper($quiz->correct_answer) }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.quizzes.destroyOne', $quiz->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus kuis: {{ Str::limit($quiz->question, 30) }}?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-6 text-center">Belum ada kuis untuk kursus ini. <a href="{{ route('admin.quizzes.create') }}" class="text-blue-600 hover:underline">Tambah kuis sekarang</a>.</td>
                    </tr>
                @endforelse
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