<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function showFeedback($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $quizzes = $course->quizzes;
        return view('feedback', compact('course', 'quizzes'));
    }

    public function submitFeedback(Request $request, $slug)
    {
        $request->validate([
            'q1' => 'required|in:a,b,c,d',
            'q2' => 'required|in:a,b,c,d',
            'q3' => 'required|in:a,b,c,d',
            'q4' => 'required|in:a,b,c,d',
            'q5' => 'required|in:a,b,c,d',
        ], [
            'q1.required' => 'Soal 1 wajib dijawab.',
            'q2.required' => 'Soal 2 wajib dijawab.',
            'q3.required' => 'Soal 3 wajib dijawab.',
            'q4.required' => 'Soal 4 wajib dijawab.',
            'q5.required' => 'Soal 5 wajib dijawab.',
        ]);

        $course = Course::where('slug', $slug)->firstOrFail();
        $quizzes = $course->quizzes->take(5);
        $correctAnswers = 0;

        // Periksa jawaban
        foreach ($quizzes as $index => $quiz) {
            $answerKey = 'q' . ($index + 1);
            if ($request->input($answerKey) === $quiz->correct_answer) {
                $correctAnswers++;
            }
        }

        // Hitung poin berdasarkan tingkat kesulitan
        $pointsPerCorrect = match ($course->tingkat_kesulitan) {
            'pemula' => 2,
            'menengah' => 3,
            'lanjut' => 5,
            default => 0,
        };
        $totalPoints = $correctAnswers * $pointsPerCorrect;

        // Tambahkan poin ke pengguna
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $user->points += $totalPoints;
            $user->save();
        }

        return redirect()->route('feedback.show', $slug)->with('success', "Kuis selesai! Anda menjawab $correctAnswers soal dengan benar dan mendapatkan $totalPoints poin.");
    }
}