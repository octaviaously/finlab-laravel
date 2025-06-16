<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\UserQuizScore;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{
    public function submit(Request $request, $course_id)
    {
        $quizzes = Quiz::where('course_id', $course_id)->get();
        $totalScore = 0;

        $request->validate([
            'answers' => 'required|array|size:' . $quizzes->count(),
            'answers.*' => 'required|exists:quiz_options,id',
        ], [
            'answers.required' => 'Semua soal harus dijawab.',
            'answers.size' => 'Jumlah jawaban tidak sesuai dengan jumlah soal.',
            'answers.*.required' => 'Jawaban untuk soal ke-:index wajib diisi.',
            'answers.*.exists' => 'Jawaban untuk soal ke-:index tidak valid.',
        ]);

        foreach ($quizzes as $index => $quiz) {
            $score = $request->answers[$index] == $quiz->jawaban_benar ? 10 : 0; // 10 poin per jawaban benar
            $totalScore += $score;

            UserQuizScore::updateOrCreate(
                ['user_id' => Auth::id(), 'quiz_id' => $quiz->id],
                ['score' => $score]
            );
        }

        return redirect()->back()->with('success', 'Kuis selesai! Skor Anda: ' . $totalScore);
    }
}