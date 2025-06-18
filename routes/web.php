<?php

use App\Models\Course;
use App\Models\Artikel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\QuizOptionController;

Route::get('/', function () {
    $artikels = Artikel::latest()->take(3)->get();
    $courses = Course::latest()->take(3)->get();
    return view('home', compact('artikels', 'courses'));
})->name('home');

Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.sendOtp');
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('password.verify');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/artikels', function () {
        $artikels = Artikel::latest()->get();
        return view('artikels', compact('artikels'));
    })->name('artikels');

    Route::get('/artikels/{slug}', function ($slug) {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        return view('artikel', compact('artikel'));
    })->name('artikel.show');

    Route::get('/courses', function () {
        $courses = Course::latest()->get();
        return view('courses', compact('courses'));
    })->name('courses');

    Route::get('/courses/{slug}', function ($slug) {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('course', compact('course'));
    })->name('course.show');

    Route::get('/courses/{slug}/feedback', [FeedbackController::class, 'showFeedback'])->name('feedback.show');
    Route::post('/courses/{slug}/feedback', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');

    Route::get('/budget', function () {
        return view('budget');
    })->name('budget');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('admin/artikels', ArtikelController::class)->names('admin.artikels');
    Route::resource('admin/courses', CourseController::class)->names('admin.courses');
    Route::resource('admin/quizzes', QuizController::class)->names('admin.quizzes');
    Route::resource('admin/quiz_options', QuizOptionController::class)->names('admin.quiz_options');
});

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('admin.quizzes.index');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('admin.quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('admin.quizzes.store');
    Route::get('/quizzes/{course}', [QuizController::class, 'show'])->name('admin.quizzes.show');
    Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('admin.quizzes.edit');
    Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->name('admin.quizzes.update');
    Route::delete('/quizzes/{course}', [QuizController::class, 'destroy'])->name('admin.quizzes.destroy');
    Route::delete('/quizzes/one/{quiz}', [QuizController::class, 'destroyOne'])->name('admin.quizzes.destroyOne');
});