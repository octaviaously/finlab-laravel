<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kuis</title>
    @vite('resources/css/app.css') {{-- atau sesuaikan jika pakai link CSS biasa --}}
</head>
<body class="bg-finlab-bg text-gray-800 min-h-screen">
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

                    @foreach (['a', 'b', 'c', 'd'] as $option)
                        <div class="mb-4">
                            <label for="option_{{ $option }}_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Opsi {{ strtoupper($option) }}</label>
                            <input type="text" id="option_{{ $option }}_{{ $i }}" name="questions[{{ $i }}][option_{{ $option }}]" value="{{ old('questions.' . $i . '.option_' . $option) }}" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.option_' . $option) border-red-500 @enderror" required>
                            @error('questions.' . $i . '.option_' . $option)
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="mb-4">
                        <label for="correct_answer_{{ $i }}" class="block text-gray-700 font-semibold mb-2">Jawaban Benar</label>
                        <select id="correct_answer_{{ $i }}" name="questions[{{ $i }}][correct_answer]" class="w-full border rounded-lg px-4 py-2 @error('questions.' . $i . '.correct_answer') border-red-500 @enderror" required>
                            @foreach (['a', 'b', 'c', 'd'] as $ans)
                                <option value="{{ $ans }}" {{ old('questions.' . $i . '.correct_answer') == $ans ? 'selected' : '' }}>{{ strtoupper($ans) }}</option>
                            @endforeach
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
</body>
</html>
