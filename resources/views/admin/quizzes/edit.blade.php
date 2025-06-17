<x-layout>
    <div class="bg-finlab-bg min-h-screen text-gray-800">
        <div class="container mx-auto px-4 py-12 pt-20">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Kuis: {{ $course->judul }}</h2>
            <form action="{{ route('admin.quizzes.update', $course->id) }}" method="POST" class="max-w-2xl mx-auto">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="course_id" class="block text-gray-700 font-semibold mb-2">Kursus</label>
                    <input type="text" value="{{ $course->judul }}" class="w-full border rounded-lg px-4 py-2 bg-gray-100" disabled>
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                </div>
                @foreach ($quizzes as $index => $quiz)
                    <div class="mb-6 border-t pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Soal {{ $index + 1 }}</h3>
                        <input type="hidden" name="questions[{{ $index + 1 }}][id]" value="{{ $quiz->id }}">
                        <div class="mb-4">
                            <label for="question_{{ $index + 1 }}" class="block text-gray-700 font-semibold mb-2">Pertanyaan</label>
                            <input type="text" id="question_{{ $index + 1 }}" name="questions[{{ $index + 1 }}][question]" value="{{ old('questions.' . ($index + 1) . '.question', $quiz->question) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . ($index + 1) . '.question') border-red-500 @enderror" required>
                            @error('questions.' . ($index + 1) . '.question')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_a_{{ $index + 1 }}" class="block text-gray-700 font-semibold mb-2">Opsi A</label>
                            <input type="text" id="option_a_{{ $index + 1 }}" name="questions[{{ $index + 1 }}][option_a]" value="{{ old('questions.' . ($index + 1) . '.option_a', $quiz->option_a) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . ($index + 1) . '.option_a') border-red-500 @enderror" required>
                            @error('questions.' . ($index + 1) . '.option_a')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_b_{{ $index + 1 }}" class="block text-gray-700 font-semibold mb-2">Opsi B</label>
                            <input type="text" id="option_b_{{ $index + 1 }}" name="questions[{{ $index + 1 }}][option_b]" value="{{ old('questions.' . ($index + 1) . '.option_b', $quiz->option_b) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . ($index + 1) . '.option_b') border-red-500 @enderror" required>
                            @error('questions.' . ($index + 1) . '.option_b')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_c_{{ $index + 1 }}" class="block text-gray-700 font-semibold mb-2">Opsi C</label>
                            <input type="text" id="option_c_{{ $index + 1 }}" name="questions[{{ $index + 1 }}][option_c]" value="{{ old('questions.' . ($index + 1) . '.option_c', $quiz->option_c) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . ($index + 1) . '.option_c') border-red-500 @enderror" required>
                            @error('questions.' . ($index + 1) . '.option_c')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_d_{{ $index + 1 }}" class="block text-gray-700 font-semibold mb-2">Opsi D</label>
                            <input type="text" id="option_d_{{ $index + 1 }}" name="questions[{{ $index + 1 }}][option_d]" value="{{ old('questions.' . ($index + 1) . '.option_d', $quiz->option_d) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . ($index + 1) . '.option_d') border-red-500 @enderror" required>
                            @error('questions.' . ($index + 1) . '.option_d')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="correct_answer_{{ $index + 1 }}" class="block text-gray-700 font-semibold mb-2">Jawaban Benar</label>
                            <select id="correct_answer_{{ $index + 1 }}" name="questions[{{ $index + 1 }}][correct_answer]" class="w-full border rounded-lg px-4 py-2 @error('questions.' . ($index + 1) . '.correct_answer') border-red-500 @enderror" required>
                                <option value="a" {{ old('questions.' . ($index + 1) . '.correct_answer', $quiz->correct_answer) == 'a' ? 'selected' : '' }}>A</option>
                                <option value="b" {{ old('questions.' . ($index + 1) . '.correct_answer', $quiz->correct_answer) == 'b' ? 'selected' : '' }}>B</option>
                                <option value="c" {{ old('questions.' . ($index + 1) . '.correct_answer', $quiz->correct_answer) == 'c' ? 'selected' : '' }}>C</option>
                                <option value="d" {{ old('questions.' . ($index + 1) . '.correct_answer', $quiz->correct_answer) == 'd' ? 'selected' : '' }}>D</option>
                            </select>
                            @error('questions.' . ($index + 1) . '.correct_answer')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.quizzes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                    <button type="submit" class="bg-finlab-yellow text-gray-900 px-4 py-2 rounded-lg hover:bg-finlab-yellow-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>