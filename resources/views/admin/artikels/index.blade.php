<x-layout>
    <div class="bg-finlab-bg min-h-screen text-gray-800">
        <div class="container mx-auto px-4 py-12 pt-20">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Artikel</h2>
            <div class="flex gap-4 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-block">Kembali</a>
                <a href="{{ route('admin.artikels.create') }}" class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg hover:bg-finlab-yellow-dark inline-block">Tambah Artikel</a>
            </div>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-left">Penulis</th>
                        <th class="py-3 px-6 text-left">Slug</th>
                        <th class="py-3 px-6 text-left">Gambar</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artikels as $artikel)
                        <tr>
                            <td class="py-3 px-6">{{ $artikel->title }}</td>
                            <td class="py-3 px-6">{{ $artikel->author }}</td>
                            <td class="py-3 px-6">{{ $artikel->slug }}</td>
                            <td class="py-3 px-6">
                                @if ($artikel->image)
                                    <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                <a href="{{ route('admin.artikels.edit', $artikel->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.artikels.destroy', $artikel->id) }}" method="POST" class="inline">
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
    </div>
</x-layout>