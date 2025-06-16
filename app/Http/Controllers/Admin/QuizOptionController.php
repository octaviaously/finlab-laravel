<?php
namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class QuizOptionController extends Controller
{
    public function index()
    {
        $quizOptions = QuizOption::with('quiz')->latest()->get();
        return view('admin.quiz_options.index', compact('quizOptions'));
    }

    public function create()
    {
        $quizzes = Quiz::with('course')->get();
        return view('admin.quiz_options.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        Log::info('QuizOption store called', ['input' => $request->all()]);

        try {
            $validated = $request->validate([
                'quiz_id' => 'required|exists:quizzes,id',
                'jawaban' => 'required|string|max:255',
            ], [
                'quiz_id.required' => 'Soal wajib dipilih.',
                'quiz_id.exists' => 'Soal tidak valid.',
                'jawaban.required' => 'Jawaban tidak boleh kosong.',
            ]);

            QuizOption::create([
                'quiz_id' => $validated['quiz_id'],
                'jawaban' => $validated['jawaban'],
            ]);

            Log::info('QuizOption created', ['quiz_id' => $validated['quiz_id'], 'jawaban' => $validated['jawaban']]);

            return redirect()->route('admin.quiz_options.index')->with('success', 'Opsi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan opsi: ' . $e->getMessage(), ['input' => $request->all()]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan opsi: ' . $e->getMessage()])->withInput();
        }
    }
}