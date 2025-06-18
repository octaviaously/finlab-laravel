<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function index()
    {
        $courses = Course::with('quizzes')->get();
        return view('admin.quizzes.index', compact('courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'questions' => 'required|array|size:5',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.option_a' => 'required|string|max:255',
            'questions.*.option_b' => 'required|string|max:255',
            'questions.*.option_c' => 'required|string|max:255',
            'questions.*.option_d' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|in:a,b,c,d',
        ], [
            'course_id.required' => 'Kursus wajib dipilih.',
            'questions.size' => 'Harus ada tepat 5 soal.',
            'questions.*.question.required' => 'Pertanyaan untuk soal :index wajib diisi.',
            'questions.*.option_a.required' => 'Opsi A untuk soal :index wajib diisi.',
            'questions.*.option_b.required' => 'Opsi B untuk soal :index wajib diisi.',
            'questions.*.option_c.required' => 'Opsi C untuk soal :index wajib diisi.',
            'questions.*.option_d.required' => 'Opsi D untuk soal :index wajib diisi.',
            'questions.*.correct_answer.required' => 'Jawaban benar untuk soal :index wajib diisi.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->questions as $question) {
                    Quiz::create([
                        'course_id' => $request->course_id,
                        'question' => $question['question'],
                        'option_a' => $question['option_a'],
                        'option_b' => $question['option_b'],
                        'option_c' => $question['option_c'],
                        'option_d' => $question['option_d'],
                        'correct_answer' => $question['correct_answer'],
                    ]);
                }
            });
            Log::info("Created 5 quizzes for course ID {$request->course_id}.");
            return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Failed to create quizzes for course ID {$request->course_id}: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Gagal menambahkan kuis: ' . $e->getMessage());
        }
    }

    public function show(Course $course)
    {
        $quizzes = $course->quizzes()->get();
        Log::info("Showing quizzes for course ID {$course->id}. Found {$quizzes->count()} quizzes.");
        return view('admin.quizzes.show', compact('course', 'quizzes'));
    }

    public function edit(Quiz $quiz)
    {
        $courses = Course::all();
        Log::info("Editing quiz ID {$quiz->id} for course ID {$quiz->course_id}.");
        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        Log::info("Attempting to update quiz ID {$quiz->id}. Request data: " . json_encode($request->all()));
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'question' => 'required|string|max:255',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:a,b,c,d',
        ], [
            'course_id.required' => 'Kursus wajib dipilih.',
            'question.required' => 'Pertanyaan wajib diisi.',
            'option_a.required' => 'Opsi A wajib diisi.',
            'option_b.required' => 'Opsi B wajib diisi.',
            'option_c.required' => 'Opsi C wajib diisi.',
            'option_d.required' => 'Opsi D wajib diisi.',
            'correct_answer.required' => 'Jawaban benar wajib diisi.',
        ]);

        try {
            $quiz->update([
                'course_id' => $request->course_id,
                'question' => $request->question,
                'option_a' => $request->option_a,
                'option_b' => $request->option_b,
                'option_c' => $request->option_c,
                'option_d' => $request->option_d,
                'correct_answer' => $request->correct_answer,
            ]);
            Log::info("Updated quiz ID {$quiz->id} for course ID {$request->course_id}.");
            return redirect()->route('admin.quizzes.show', $quiz->course_id)->with('success', 'Kuis berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Failed to update quiz ID {$quiz->id}: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Gagal memperbarui kuis: ' . $e->getMessage());
        }
    }

    public function destroy(Course $course)
    {
        try {
            $quizCount = $course->quizzes()->count();
            if ($quizCount === 0) {
                Log::warning("No quizzes found for course ID {$course->id} to delete.");
                return redirect()->route('admin.quizzes.index')->with('error', 'Tidak ada kuis untuk dihapus.');
            }
            $course->quizzes()->delete();
            Log::info("Deleted {$quizCount} quizzes for course ID {$course->id}.");
            return redirect()->route('admin.quizzes.index')->with('success', 'Semua kuis untuk kursus berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Failed to delete quizzes for course ID {$course->id}: {$e->getMessage()}");
            return redirect()->route('admin.quizzes.index')->with('error', 'Gagal menghapus kuis: ' . $e->getMessage());
        }
    }

    public function destroyOne(Quiz $quiz)
    {
        Log::info("Attempting to delete quiz ID {$quiz->id} for course ID {$quiz->course_id}.");
        try {
            $course_id = $quiz->course_id;
            $quiz->delete();
            Log::info("Deleted quiz ID {$quiz->id} for course ID {$course_id}.");
            return redirect()->route('admin.quizzes.show', $course_id)->with('success', 'Kuis berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Failed to delete quiz ID {$quiz->id}: {$e->getMessage()}");
            return redirect()->route('admin.quizzes.show', $quiz->course_id)->with('error', 'Gagal menghapus kuis: ' . $e->getMessage());
        }
    }
}