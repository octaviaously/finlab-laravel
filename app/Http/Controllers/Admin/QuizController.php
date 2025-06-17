<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $courses = Course::has('quizzes', '>=', 5)->with('quizzes')->get();
        return view('admin.quizzes.index', compact('courses'));
    }

    public function create()
    {
        $courses = Course::withCount('quizzes')
            ->having('quizzes_count', '<', 5)
            ->orHavingNull('quizzes_count')
            ->get();
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
        ]);

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

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        $quizzes = $course->quizzes()->take(5)->get();
        if ($quizzes->count() < 5) {
            return redirect()->route('admin.quizzes.index')->with('error', 'Kursus ini belum memiliki 5 soal kuis.');
        }
        return view('admin.quizzes.edit', compact('course', 'quizzes'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'questions' => 'required|array|size:5',
            'questions.*.id' => 'required|exists:quizzes,id',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.option_a' => 'required|string|max:255',
            'questions.*.option_b' => 'required|string|max:255',
            'questions.*.option_c' => 'required|string|max:255',
            'questions.*.option_d' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|in:a,b,c,d',
        ]);

        DB::transaction(function () use ($request, $course) {
            foreach ($request->questions as $question) {
                Quiz::where('id', $question['id'])
                    ->where('course_id', $course->id)
                    ->update([
                        'question' => $question['question'],
                        'option_a' => $question['option_a'],
                        'option_b' => $question['option_b'],
                        'option_c' => $question['option_c'],
                        'option_d' => $question['option_d'],
                        'correct_answer' => $question['correct_answer'],
                    ]);
            }
        });

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->quizzes()->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dihapus.');
    }
}