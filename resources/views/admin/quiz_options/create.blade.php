<x-layout>
    <x-slot:title>Tambah Opsi Kuis</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Opsi Kuis</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.quiz_options.store') }}" method="POST" class="max-w-2xl mx-auto" id="create-option-form">
            @csrf
            <div class="mb-4">
                <label for="quiz_id" class="block text-gray-700 font-semibold mb-2">Soal</label>
                <select id="quiz_id" name="quiz_id" class="w-full border rounded-lg px-4 py-2 @error('quiz_id') border-red-500 @enderror" required>
                    <option value="" disabled selected>Pilih soal</option>
                    @foreach ($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->course->judul }} - {{ Str::limit($quiz->soal, 30) }}</option>
                    @endforeach
                </select>
                @error('quiz_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="jawaban" class="block text-gray-700 font-semibold mb-2">Jawaban</label>
                <input type="text" id="jawaban" name="jawaban" value="{{ old('jawaban') }}" class="w-full border rounded-lg px-4 py-2 @error('jawaban') border-red-500 @enderror" required>
                @error('jawaban')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.quiz_options.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('create-option-form').addEventListener('submit', function(event) {
            console.log('Form submitted to: ' + this.action);
            console.log('Method: ' + this.method);
            console.log('Data: ', new FormData(this));
        });
    </script>
</x-layout>