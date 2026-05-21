<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Home / Landing setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// ─────────────────────────────────────────────
// Auth Routes (hanya untuk guest)
// ─────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])    ->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']) ->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─────────────────────────────────────────────
// User Routes (auth + role:user)
// ─────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Halaman Home/Landing
    Route::get('/home', [HomeController::class, 'index'])->name('home.user');

    // Halaman Edukasi
    Route::get('/education', [HomeController::class, 'education'])->name('education');

    // Daily Tracker
    Route::get('/tracker',          [TrackerController::class, 'index'])  ->name('tracker');
    Route::post('/tracker',         [TrackerController::class, 'store'])  ->name('tracker.store');
    Route::delete('/tracker/{log}', [TrackerController::class, 'destroy'])->name('tracker.destroy');

    // Quiz / Kuesioner
    Route::get('/quiz',              [QuizController::class, 'index'])       ->name('quiz');
    Route::post('/quiz/obesity',     [QuizController::class, 'calcObesity']) ->name('quiz.obesity');
    Route::post('/quiz/mental',      [QuizController::class, 'calcMental'])  ->name('quiz.mental');

});

// ─────────────────────────────────────────────
// Admin Routes (auth + role:admin)
// ─────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen Artikel
    Route::get('/articles',              [ArticleController::class, 'index'])  ->name('articles.index');
    Route::get('/articles/create',       [ArticleController::class, 'create']) ->name('articles.create');
    Route::post('/articles',             [ArticleController::class, 'store'])  ->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}',    [ArticleController::class, 'update']) ->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});
