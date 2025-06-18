<x-layout>
    <x-slot:title>Kuis Kursus</x-slot:title>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-3xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Kuis Kursus: {{ $course->judul }}</h2>
        @if ($quizzes->count() < 5)
            <div class="bg-red-100 p-4 rounded-lg text-red-700">
                Kuis belum tersedia. Harus ada minimal 5 soal untuk kursus ini.
            </div>
        @else
            <form method="POST" action="{{ route('feedback.submit', $course->slug) }}" id="quizForm" class="bg-white p-6 rounded-lg shadow-lg">
                @csrf
                <div class="space-y-6">
                    @foreach ($quizzes->take(5) as $index => $quiz)
                        <div>
                            <p class="text-gray-700 mb-2">{{ $index + 1 }}. {{ $quiz->question }}</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="q{{ $index + 1 }}" value="a" class="form-radio h-5 w-5 text-yellow-600" required>
                                    <span class="ml-2 text-gray-700">{{ $quiz->option_a }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q{{ $index + 1 }}" value="b" class="form-radio h-5 w-5 text-yellow-600" required>
                                    <span class="ml-2 text-gray-700">{{ $quiz->option_b }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q{{ $index + 1 }}" value="c" class="form-radio h-5 w-5 text-yellow-600" required>
                                    <span class="ml-2 text-gray-700">{{ $quiz->option_c }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q{{ $index + 1 }}" value="d" class="form-radio h-5 w-5 text-yellow-600" required>
                                    <span class="ml-2 text-gray-700">{{ $quiz->option_d }}</span>
                                </label>
                            </div>
                            @error("q{{ $index + 1 }}") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Selesai</button>
                </div>
            </form>
        @endif

        @if (session('success'))
<script>
    alert(@json(session('success')));
</script>
@endif

    </div>

    <script>
        document.getElementById('quizForm')?.addEventListener('submit', function(event) {
            const inputs = document.querySelectorAll('input[type="radio"]:checked');
            if (inputs.length < 5) {
                event.preventDefault();
                alert('Harap jawab semua pertanyaan sebelum mengirim.');
            }
        });
    </script>
</x-layout>