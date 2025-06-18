<x-layout>
    <x-slot:title>Tambah Kursus</x-slot:title>

    <div class="bg-finlab-bg min-h-screen text-gray-800">
        <div class="container mx-auto px-4 py-12 pt-20">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Kursus</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
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
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        class="w-full border rounded-lg px-4 py-2 @error('judul') border-red-500 @enderror" required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="8"
                        class="w-full border rounded-lg px-4 py-2 @error('deskripsi') border-red-500 @enderror" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tingkat_kesulitan" class="block text-gray-700 font-semibold mb-2">Tingkat Kesulitan</label>
                    <select id="tingkat_kesulitan" name="tingkat_kesulitan"
                        class="w-full border rounded-lg px-4 py-2 @error('tingkat_kesulitan') border-red-500 @enderror" required>
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
                    <label for="link_video" class="block text-gray-700 font-semibold mb-2">Link Video YouTube</label>
                    <input type="url" id="link_video" name="link_video" value="{{ old('link_video') }}"
                        class="w-full border rounded-lg px-4 py-2 @error('link_video') border-red-500 @enderror" required
                        placeholder="https://youtu.be/VIDEO_ID atau https://youtube.com/watch?v=VIDEO_ID">
                    <p class="text-gray-500 text-sm mt-1">Masukkan link YouTube, boleh dengan parameter tambahan (contoh: ?feature=shared).</p>
                    @error('link_video')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.courses.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Batal</a>
                    <button type="submit"
                        class="bg-finlab-yellow text-gray-900 px-4 py-2 rounded-lg hover:bg-finlab-yellow-dark transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('create-course-form').addEventListener('submit', function(event) {
            console.log('Form submitted to: ' + this.action);
            console.log('Method: ' + this.method);
            console.log('Data: ', Object.fromEntries(new FormData(this)));
        });
    </script>
</x-layout>
