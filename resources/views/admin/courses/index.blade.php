<x-layout>
    <x-slot:title>Kelola Kursus</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Kursus</h2>
        <div class="flex gap-4 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-block">Kembali</a>
            <a href="{{ route('admin.courses.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 inline-block">Tambah Kursus</a>
        </div>
        @if (session('success'))
            <div id="success-notification" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Slug</th>
                    <th class="py-3 px-6 text-left">Tingkat Kesulitan</th>
                    <th class="py-3 px-6 text-left">Jenis Kursus</th>
                    <th class="py-3 px-6 text-left">Link Video</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td class="py-3 px-6">{{ $course->judul }}</td>
                        <td class="py-3 px-6">{{ $course->slug }}</td>
                        <td class="py-3 px-6">{{ ucfirst($course->tingkat_kesulitan) }}</td>
                        <td class="py-3 px-6">{{ ucfirst($course->jenis_kursus) }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ $course->link_video }}" target="_blank" class="text-blue-600 hover:underline">{{ Str::limit($course->link_video, 30) }}</a>
                        </td>
                        <td class="py-3 px-6">
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
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