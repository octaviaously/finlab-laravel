<?php

namespace App\Http\Controllers\Admin;

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

        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $completed = in_array($course->id, $user?->completed_quizzes ?? []);

        return view('feedback', [
            'course' => $course,
            'quizzes' => $quizzes,
            'sudahDikerjakan' => $completed,
        ]);
    }

    public function submitFeedback(Request $request, $slug)
    {
        $request->validate([
            'q1' => 'required|in:a,b,c,d',
            'q2' => 'required|in:a,b,c,d',
            'q3' => 'required|in:a,b,c,d',
            'q4' => 'required|in:a,b,c,d',
            'q5' => 'required|in:a,b,c,d',
        ]);

        $course = Course::where('slug', $slug)->firstOrFail();
        $quizzes = $course->quizzes->take(5);
        $correctAnswers = 0;

        foreach ($quizzes as $index => $quiz) {
            $answerKey = 'q' . ($index + 1);
            if ($request->input($answerKey) === $quiz->correct_answer) {
                $correctAnswers++;
            }
        }

        $pointsPerCorrect = match ($course->tingkat_kesulitan) {
            'pemula' => 2,
            'menengah' => 3,
            'lanjut' => 5,
            default => 0,
        };
        $totalPoints = $correctAnswers * $pointsPerCorrect;

        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if ($user) {
            $user->points = ($user->points ?? 0) + $totalPoints;

            $completed = $user->completed_quizzes ?? [];
            if (!in_array($course->id, $completed)) {
                $completed[] = $course->id;
                $user->completed_quizzes = $completed;
            }

            $user->save();
        }

        return redirect()
            ->route('course.show', $slug)
            ->with('success', "Kuis selesai! Anda menjawab $correctAnswers soal benar dan mendapat $totalPoints poin.");
    }
}
