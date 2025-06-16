<?php
namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\QuizOption;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('course')->groupBy('course_id')->latest()->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::whereNotExists(function ($query) {
            $query->select('id')
                  ->from('quizzes')
                  ->whereColumn('quizzes.course_id', 'courses.id');
        })->get();
        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        Log::info('Quiz store called', ['input' => $request->all()]);

        try {
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id|unique:quizzes,course_id',
                'questions' => 'required|array|size:10',
                'questions.*.soal' => 'required|string|max:255',
                'questions.*.options' => 'required|array|size:3',
                'questions.*.options.*' => 'required|string|max:255',
                'questions.*.correct_option' => 'required|integer|between:0,2',
            ], [
                'course_id.required' => 'Kursus wajib dipilih.',
                'course_id.exists' => 'Kursus tidak valid.',
                'course_id.unique' => 'Kursus ini sudah memiliki kuis.',
                'questions.size' => 'Harus ada tepat 10 soal.',
                'questions.*.soal.required' => 'Soal tidak boleh kosong.',
                'questions.*.options.size' => 'Setiap soal harus memiliki 3 opsi.',
                'questions.*.options.*.required' => 'Opsi jawaban tidak boleh kosong.',
                'questions.*.correct_option.required' => 'Jawaban benar harus dipilih.',
                'questions.*.correct_option.between' => 'Jawaban benar harus antara opsi 1 hingga 3.',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            foreach ($validated['questions'] as $index => $question) {
                $slug = Str::slug($question['soal'] . '-' . $validated['course_id'] . '-' . ($index + 1));
                $existingSlug = Quiz::where('slug', $slug)->exists();
                $counter = 1;
                $baseSlug = $slug;
                while ($existingSlug) {
                    $slug = $baseSlug . '-' . $counter++;
                    $existingSlug = Quiz::where('slug', $slug)->exists();
                }

                $quiz = Quiz::create([
                    'course_id' => $validated['course_id'],
                    'slug' => $slug,
                    'soal' => $question['soal'],
                ]);

                $options = [];
                foreach ($question['options'] as $optIndex => $option) {
                    $options[] = QuizOption::create([
                        'quiz_id' => $quiz->id,
                        'jawaban' => $option,
                    ]);
                }

                $quiz->update([
                    'jawaban_benar' => $options[$question['correct_option']]->id,
                ]);

                Log::info('Quiz created', ['quiz_id' => $quiz->id, 'soal' => $question['soal']]);
            }

            return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan kuis: ' . $e->getMessage(), ['input' => $request->all()]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan kuis: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($course_id)
    {
        $quizzes = Quiz::with('options')->where('course_id', $course_id)->get();
        if ($quizzes->count() !== 10) {
            return redirect()->route('admin.quizzes.index')->withErrors(['error' => 'Kuis tidak valid, harus 10 soal.']);
        }
        $course = Course::findOrFail($course_id);
        return view('admin.quizzes.edit', compact('quizzes', 'course'));
    }

    public function update(Request $request, $course_id)
    {
        Log::info('Quiz update called', ['input' => $request->all()]);

        try {
            $validated = $request->validate([
                'questions' => 'required|array|size:10',
                'questions.*.id' => 'required|exists:quizzes,id',
                'questions.*.soal' => 'required|string|max:255',
                'questions.*.options' => 'required|array|size:3',
                'questions.*.options.*.id' => 'required|exists:quiz_options,id',
                'questions.*.options.*.jawaban' => 'required|string|max:255',
                'questions.*.correct_option' => 'required|integer|between:0,2',
            ], [
                'questions.size' => 'Harus ada tepat 10 soal.',
                'questions.*.id.exists' => 'ID soal tidak valid.',
                'questions.*.soal.required' => 'Soal tidak boleh kosong.',
                'questions.*.options.size' => 'Setiap soal harus memiliki 3 opsi.',
                'questions.*.options.*.id.exists' => 'ID opsi tidak valid.',
                'questions.*.options.*.jawaban.required' => 'Opsi jawaban tidak boleh kosong.',
                'questions.*.correct_option.required' => 'Jawaban benar harus dipilih.',
                'questions.*.correct_option.between' => 'Jawaban benar harus antara opsi 1 hingga 3.',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            foreach ($validated['questions'] as $index => $question) {
                $quiz = Quiz::findOrFail($question['id']);
                if ($quiz->course_id != $course_id) {
                    throw new \Exception('Soal tidak cocok dengan kursus.');
                }

                $slug = Str::slug($question['soal'] . '-' . $course_id . '-' . ($index + 1));
                $existingSlug = Quiz::where('slug', $slug)->where('id', '!=', $quiz->id)->exists();
                $counter = 1;
                $baseSlug = $slug;
                while ($existingSlug) {
                    $slug = $baseSlug . '-' . $counter++;
                    $existingSlug = Quiz::where('slug', $slug)->where('id', '!=', $quiz->id)->exists();
                }

                $quiz->update([
                    'soal' => $question['soal'],
                    'slug' => $slug,
                ]);

                $options = [];
                foreach ($question['options'] as $optIndex => $option) {
                    $quizOption = QuizOption::findOrFail($option['id']);
                    $quizOption->update([
                        'jawaban' => $option['jawaban'],
                    ]);
                    $options[] = $quizOption;
                }

                $quiz->update([
                    'jawaban_benar' => $options[$question['correct_option']]->id,
                ]);

                Log::info('Quiz updated', ['quiz_id' => $quiz->id, 'soal' => $question['soal']]);
            }

            return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui kuis: ' . $e->getMessage(), ['input' => $request->all()]);
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui kuis: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($course_id)
    {
        try {
            $quizzes = Quiz::where('course_id', $course_id)->get();
            if ($quizzes->count() !== 10) {
                return redirect()->route('admin.quizzes.index')->withErrors(['error' => 'Kuis tidak valid, harus 10 soal.']);
            }
            foreach ($quizzes as $quiz) {
                $quiz->delete(); // Cascade akan hapus quiz_options
            }
            Log::info('Quiz deleted', ['course_id' => $course_id]);
            return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kuis: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus kuis: ' . $e->getMessage()]);
        }
    }
}