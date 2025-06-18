<x-layout>
    <x-slot:title>Kelola Kuis</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Kuis</h2>
        <div class="flex gap-4 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-block">Kembali</a>
            <a href="{{ route('admin.quizzes.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 inline-block">Tambah Kuis</a>
        </div>
        @if (session('success'))
            <div id="success-notification" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
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
                    <th class="py-3 px-6 text-left">Jumlah Soal</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td class="py-3 px-6">{{ $course->judul }}</td>
                        <td class="py-3 px-6">{{ $course->quizzes->count() }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('admin.quizzes.show', $course->id) }}" class="text-blue-600 hover:underline mr-2">Lihat & Edit Kuis</a>
                            <form action="{{ route('admin.quizzes.destroy', $course->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus semua kuis untuk kursus {{ $course->judul }}?')">Hapus Semua Kuis</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-3 px-6 text-center">Belum ada kuis yang dibuat.</td>
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