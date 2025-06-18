<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kuis</title>
    @vite('resources/css/app.css') {{-- atau sesuaikan jika kamu pakai CDN Tailwind --}}
</head>
<body class="bg-finlab-bg text-gray-800 min-h-screen">
    <div class="container mx-auto px-4 py-12 pt-20">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Kuis</h2>
        <form action="{{ route('admin.quizzes.update', $quiz->id) }}" method="POST" class="max-w-2xl mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="course_id" class="block text-gray-700 font-semibold mb-2">Kursus</label>
                <select id="course_id" name="course_id" class="w-full border rounded-lg px-4 py-2 @error('course_id') border-red-500 @enderror" required>
                    <option value="">Pilih Kursus</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $quiz->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->judul }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="question" class="block text-gray-700 font-semibold mb-2">Pertanyaan</label>
                <input type="text" id="question" name="question" value="{{ old('question', $quiz->question) }}" class="w-full border rounded-lg px-4 py-2 @error('question') border-red-500 @enderror" required>
                @error('question')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @foreach (['a', 'b', 'c', 'd'] as $option)
                <div class="mb-4">
                    <label for="option_{{ $option }}" class="block text-gray-700 font-semibold mb-2">Opsi {{ strtoupper($option) }}</label>
                    <input type="text" id="option_{{ $option }}" name="option_{{ $option }}" value="{{ old('option_'.$option, $quiz->{'option_'.$option}) }}" class="w-full border rounded-lg px-4 py-2 @error('option_'.$option) border-red-500 @enderror" required>
                    @error('option_'.$option)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="mb-4">
                <label for="correct_answer" class="block text-gray-700 font-semibold mb-2">Jawaban Benar</label>
                <select id="correct_answer" name="correct_answer" class="w-full border rounded-lg px-4 py-2 @error('correct_answer') border-red-500 @enderror" required>
                    @foreach (['a', 'b', 'c', 'd'] as $ans)
                        <option value="{{ $ans }}" {{ old('correct_answer', $quiz->correct_answer) == $ans ? 'selected' : '' }}>
                            {{ strtoupper($ans) }}
                        </option>
                    @endforeach
                </select>
                @error('correct_answer')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.quizzes.show', $quiz->course_id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-finlab-yellow text-gray-900 px-4 py-2 rounded-lg hover:bg-finlab-yellow-dark">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
