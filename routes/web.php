<?php
use App\Models\Course;
use App\Models\Artikel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ArtikelController;
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