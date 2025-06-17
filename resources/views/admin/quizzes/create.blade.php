<x-layout>
    <div class="bg-finlab-bg min-h-screen text-gray-800">
        <div class="container mx-auto px-4 py-12 pt-20">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Kuis (5 Soal)</h2>
            <form action="{{ route('admin.quizzes.store') }}" method="POST" class="max-w-2xl mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="course_id" class="block text-gray-700 font-semibold mb-2">Kursus</label>
                    <select id="course_id" name="course_id" class="w-full border rounded-lg px-4 py-2 @error('course_id') border-red-500 @enderror" required>
                        <option value="">Pilih Kursus</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->judul }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                @for ($i = 1; $i <= 5; $i++)
                    <div class="mb-6 border-t pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Soal {{ $i }}</h3>
                        <div class="mb-4">
                            <label for="question_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Pertanyaan</label>
                            <input type="text" id="question_{{ $i }}" name="questions[{{ $i }}][question]" value="{{ old('questions.' . $i . '.question') }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.question') border-red-500 @enderror" required>
                            @error('questions.' . $i . '.question')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_a_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Opsi A</label>
                            <input type="text" id="option_a_{{ $i }}" name="questions[{{ $i }}][option_a]" value="{{ old('questions.' . $i . '.option_a') }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.option_a') border-red-500 @enderror" required>
                            @error('questions.' . $i . '.option_a')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_b_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Opsi B</label>
                            <input type="text" id="option_b_{{ $i }}" name="questions[{{ $i }}][option_b]" value="{{ old('questions.' . $i . '.option_b') }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.option_b') border-red-500 @enderror" required>
                            @error('questions.' . $i . '.option_b')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="option_c_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Opsi C</label>
                            <input type="text" id="option_c_{{ $i }}" name="questions[{{ $i }}][option_c]" value="{{ old('questions.' . $i . '.option_c') }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.option_c') border-red-500 @enderror" required>
                            @error('questions.' . $i . '.option_c')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb- Bateman4">
                            <label for="option_d_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Opsi D</label>
                            <input type="text" id="option_d_{{ $i }}" name="questions[{{ $i }}][option_d]" value="{{ old('questions.' . $i . '.option_d') }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.option_d') border-red-500 @enderror" required>
                            @error('questions.' . $i . '.option_d')
                                <p class="text-red-500 text-sm mt-1">{{ $course->judul }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="correct_answer_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Jawaban Benar</label>
                            <select id="correct_answer_{{ $i }}" name="questions[{{ $i }}][correct_answer]" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.correct_answer') border-red-500 @enderror" required>
                                <option value="a" {{ old('questions.' . $i . '.correct_answer') == 'a' ? 'selected' : '' }}>A</option>
                                <option value="b" {{ old('questions.' . $i . '.correct_answer') == 'b' ? 'selected' : '' }}>B</option>
                                <option value="c" {{ old('questions.' . $i . '.correct_answer') == 'c' ? 'selected' : '' }}>C</option>
                                <option value="d" {{ old('questions.' . $i . '.correct_answer') == 'd' ? 'selected' : '' }}>D</option>
                            </select>
                            @error('questions.' . $i . '.correct_answer')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endfor
                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.quizzes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                    <button type="submit" class="bg-finlab-yellow text-gray-900 px-4 py-2 rounded-lg hover:bg-finlab-yellow-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>