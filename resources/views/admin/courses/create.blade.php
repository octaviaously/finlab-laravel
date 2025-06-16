<x-layout>
    <x-slot:title>Tambah Kursus</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Kursus</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.courses.store') }}" method="POST" class="max-w-2xl mx-auto" id="create-course-form">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="w-full border rounded-lg px-4 py-2 @error('judul') border-red-500 @enderror" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="w-full border rounded-lg px-4 py-2 @error('deskripsi') border-red-500 @enderror" rows="8" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tingkat_kesulitan" class="block text-gray-700 font-semibold mb-2">Tingkat Kesulitan</label>
                <select id="tingkat_kesulitan" name="tingkat_kesulitan" class="w-full border rounded-lg px-4 py-2 @error('tingkat_kesulitan') border-red-500 @enderror" required>
                    <option value="" disabled {{ old('tingkat_kesulitan') ? '' : 'selected' }}>Pilih tingkat kesulitan</option>
                    <option value="pemula" {{ old('tingkat_kesulitan') == 'pemula' ? 'selected' : '' }}>Pemula</option>
                    <option value="menengah" {{ old('tingkat_kesulitan') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                    <option value="lanjut" {{ old('tingkat_kesulitan') == 'lanjut' ? 'selected' : '' }}>Lanjutan</option>
                </select>
                @error('tingkat_kesulitan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="jenis_kursus" class="block text-gray-700 font-semibold mb-2">Jenis Kursus</label>
                <select id="jenis_kursus" name="jenis_kursus" class="w-full border rounded-lg px-4 py-2 @error('jenis_kursus') border-red-500 @enderror" required>
                    <option value="" disabled {{ old('tingkat_kesulitan') ? '' : 'selected' }}>Pilih jenis kursus</option>
                    <option value="gratis" {{ old('jenis_kursus') == 'gratis' ? 'selected' : '' }}>Gratis</option>
                    <option value="bayar" {{ old('jenis_kursus') == 'bayar' ? 'selected' : '' }}>Bayar</option>
                </select>
                @error('jenis_kursus')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="link_video" class="block text-gray-700 font-semibold mb-2">Link Video YouTube</label>
                <input type="url" id="link_video" name="link_video" value="{{ old('link_video') }}" class="w-full border rounded-lg px-4 py-2 @error('link_video') border-red-500 @enderror" required placeholder="https://youtu.be/VIDEO_ID atau https://youtube.com/watch?v=VIDEO_ID">
                <p class="text-gray-500 text-sm mt-1">Masukkan link YouTube, boleh dengan parameter tambahan (contoh: ?feature=shared).</p>
                @error('link_video')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.courses.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('create-course-form').addEventListener('submit', function(event) {
            console.log('Form submitted to: ' + this.action);
            console.log('Method: ' + this.method);
            console.log('Data: ', new FormData(this));
        });
    </script>
</x-layout>