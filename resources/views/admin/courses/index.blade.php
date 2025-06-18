<x-layout>
    <x-slot:title>Kelola Kursus</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Kursus</h2>

        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Kembali</a>
            <a href="{{ route('admin.courses.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Tambah Kursus</a>
        </div>

        @if (session('success'))
            <div id="success-notification" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-left">Slug</th>
                        <th class="py-3 px-6 text-left">Tingkat</th>
                        <th class="py-3 px-6 text-left">Link Video</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr class="border-t">
                            <td class="py-3 px-6">{{ $course->judul }}</td>
                            <td class="py-3 px-6">{{ $course->slug }}</td>
                            <td class="py-3 px-6 capitalize">{{ $course->tingkat_kesulitan }}</td>
                            <td class="py-3 px-6">
                                <a href="{{ $course->link_video }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ Str::limit($course->link_video, 35) }}
                                </a>
                            </td>
                            <td class="py-3 px-6 flex gap-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kursus ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-6 text-center text-gray-500">Belum ada kursus yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (session('success'))
        <script>
            setTimeout(() => {
                const notif = document.getElementById('success-notification');
                if (notif) notif.style.display = 'none';
            }, 3000);
        </script>
    @endif
</x-layout>
