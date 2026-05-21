<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// ── Auth check ────────────────────────────────────────────────────────────────
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ── HealthyLife API (auth required) ──────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Tracker
    Route::get('/tracker/today',   [ApiController::class, 'trackerToday']);
    Route::get('/tracker/history', [ApiController::class, 'trackerHistory']);
    Route::get('/tracker/summary', [ApiController::class, 'trackerSummary']);

    // Quiz
    Route::get('/quiz/results',    [ApiController::class, 'quizResults']);
    Route::get('/quiz/latest',     [ApiController::class, 'quizLatest']);

    // Combined
    Route::get('/health/overview', [ApiController::class, 'healthOverview']);
});