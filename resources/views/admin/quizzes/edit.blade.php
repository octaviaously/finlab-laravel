<x-layout>
    <x-slot:title>Edit Kuis</x-slot:title>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Kuis untuk {{ $course->judul }}</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.quizzes.update', $course->id) }}" method="POST" class="max-w-2xl mx-auto" id="edit-quiz-form">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kursus</label>
                <input type="text" value="{{ $course->judul }}" class="w-full border rounded-lg px-4 py-2 bg-gray-100" readonly>
            </div>

            @foreach ($quizzes as $index => $quiz)
                <div class="mb-6 border-t pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Soal {{ $index + 1 }}</h3>
                    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $quiz->id }}">
                    <div class="mb-4">
                        <label for="questions[{{ $index }}][soal]" class="block text-gray-700 font-semibold mb-2">Pertanyaan</label>
                        <input type="text" id="questions[{{ $index }}][soal]" name="questions[{{ $index }}][soal]" value="{{ old('questions.' . $index . '.soal', $quiz->soal) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $index . '.soal') border-red-500 @enderror" required>
                        @error('questions.' . $index . '.soal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Opsi Jawaban</label>
                        @foreach ($quiz->options as $optIndex => $option)
                            <div class="flex items-center mb-2">
                                <input type="hidden" name="questions[{{ $index }}][options][{{ $optIndex }}][id]" value="{{ $option->id }}">
                                <input type="text" id="questions[{{ $index }}][options][{{ $optIndex }}]" name="questions[{{ $index }}][options][{{ $optIndex }}][jawaban]" value="{{ old('questions.' . $index . '.options.' . $optIndex . '.jawaban', $option->jawaban) }}" class="w-full border rounded-lg px-4 py-2 mr-2 @error('questions.' . $index . '.options.' . $optIndex . '.jawaban') border-red-500 @enderror" required>
                                <label class="flex items-center">
                                    <input type="radio" name="questions[{{ $index }}][correct_option]" value="{{ $optIndex }}" {{ old('questions.' . $index . '.correct_option', $quiz->jawaban_benar == $option->id ? $optIndex : '') == $optIndex ? 'checked' : '' }} required>
                                    <span class="ml-2 text-gray-700">Benar</span>
                                </label>
                                @error('questions.' . $index . '.options.' . $optIndex . '.jawaban')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                        @error('questions.' . $index . '.correct_option')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endforeach

            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.quizzes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('edit-quiz-form').addEventListener('submit', function(event) {
            console.log('Form submitted to: ' + this.action);
            console.log('Method: ' + this.method);
            console.log('Data: ', new FormData(this));
        });
    </script>
</x-layout>