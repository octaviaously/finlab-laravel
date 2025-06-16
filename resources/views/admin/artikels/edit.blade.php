<x-layout>
      <div class="bg-finlab-bg min-h-screen text-gray-800">
          <div class="container mx-auto px-4 py-12 pt-20">
              <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Artikel</h2>
              <form action="{{ route('admin.artikels.update', $artikel->id) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                      <label for="title" class="block text-gray-700 font-semibold mb-2">Judul</label>
                      <input type="text" id="title" name="title" value="{{ old('title', $artikel->title) }}" class="w-full border rounded-lg px-4 py-2 @error('title') border-red-500 @enderror" required>
                      @error('title')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="mb-4">
                      <label for="author" class="block text-gray-700 font-semibold mb-2">Penulis</label>
                      <input type="text" id="author" name="author" value="{{ old('author', $artikel->author) }}" class="w-full border rounded-lg px-4 py-2 @error('author') border-red-500 @enderror" required>
                      @error('author')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="mb-4">
                      <label for="body" class="block text-gray-700 font-semibold mb-2">Isi Artikel</label>
                      <textarea id="body" name="body" class="w-full border rounded-lg px-4 py-2 @error('body') border-red-500 @enderror" rows="8" required>{{ old('body', $artikel->body) }}</textarea>
                      @error('body')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="mb-4">
                      <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar (opsional)</label>
                      @if ($artikel->image)
                          <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}" class="w-32 h-32 object-cover rounded mb-2">
                      @else
                          <p class="text-gray-600 mb-2">Tidak ada gambar</p>
                      @endif
                      <input type="file" id="image" name="image" accept="image/*" class="w-full border rounded-lg px-4 py-2 @error('image') border-red-500 @enderror">
                      @error('image')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="flex justify-end gap-4">
                      <a href="{{ route('admin.artikels.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                      <button type="submit" class="bg-finlab-yellow text-gray-900 px-4 py-2 rounded-lg hover:bg-finlab-yellow-dark">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
  </x-layout>