<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\QuizResult;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // ── Tracker: ringkasan hari ini ───────────────────────────────────────────
    public function trackerSummary(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $logs  = DailyLog::where('user_id', $request->user()->id)
                    ->whereDate('log_date', $today)
                    ->get();

        $foodLogs       = $logs->where('type', 'food');
        $caloriesIn     = $foodLogs->sum(fn($l) => $l->data['calories'] ?? 0);
        $protein        = $foodLogs->sum(fn($l) => $l->data['protein']  ?? 0);
        $carbs          = $foodLogs->sum(fn($l) => $l->data['carbs']    ?? 0);
        $fat            = $foodLogs->sum(fn($l) => $l->data['fat']      ?? 0);
        $waterMl        = $logs->where('type', 'water')->sum(fn($l) => $l->data['amount'] ?? 0);
        $exerciseLogs   = $logs->where('type', 'exercise');
        $exerciseMin    = $exerciseLogs->sum(fn($l) => $l->data['duration']        ?? 0);
        $caloriesBurned = $exerciseLogs->sum(fn($l) => $l->data['calories_burned'] ?? 0);
        $sleepLog       = $logs->where('type', 'sleep')->last();
        $sleepHours     = $sleepLog ? ($sleepLog->data['duration'] ?? null) : null;
        $sleepQuality   = $sleepLog ? ($sleepLog->data['quality']  ?? null) : null;

        return response()->json([
            'date'            => $today,
            'calories_in'     => $caloriesIn,
            'protein_g'       => $protein,
            'carbs_g'         => $carbs,
            'fat_g'           => $fat,
            'water_ml'        => $waterMl,
            'exercise_min'    => $exerciseMin,
            'calories_burned' => $caloriesBurned,
            'sleep_hours'     => $sleepHours,
            'sleep_quality'   => $sleepQuality,
        ]);
    }

    // ── Tracker: data hari ini (detail) ──────────────────────────────────────
    public function trackerToday(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $logs  = DailyLog::where('user_id', $request->user()->id)
                    ->whereDate('log_date', $today)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json([
            'date'     => $today,
            'food'     => $logs->where('type', 'food')->values(),
            'water'    => $logs->where('type', 'water')->values(),
            'exercise' => $logs->where('type', 'exercise')->values(),
            'sleep'    => $logs->where('type', 'sleep')->values(),
        ]);
    }

    // ── Tracker: riwayat 7 hari ───────────────────────────────────────────────
    public function trackerHistory(Request $request)
    {
        $days = $request->query('days', 7);
        $from = Carbon::today()->subDays($days)->toDateString();

        $logs = DailyLog::where('user_id', $request->user()->id)
                    ->where('log_date', '>=', $from)
                    ->orderBy('log_date', 'desc')
                    ->get();

        $grouped = $logs->groupBy(fn($l) => $l->log_date->toDateString())
            ->map(function ($dayLogs) {
                return [
                    'calories_in'     => $dayLogs->where('type','food')->sum(fn($l) => $l->data['calories'] ?? 0),
                    'water_ml'        => $dayLogs->where('type','water')->sum(fn($l) => $l->data['amount'] ?? 0),
                    'exercise_min'    => $dayLogs->where('type','exercise')->sum(fn($l) => $l->data['duration'] ?? 0),
                    'calories_burned' => $dayLogs->where('type','exercise')->sum(fn($l) => $l->data['calories_burned'] ?? 0),
                ];
            });

        return response()->json(['period_days' => $days, 'history' => $grouped]);
    }

    // ── Quiz: hasil terbaru ───────────────────────────────────────────────────
    public function quizLatest(Request $request)
    {
        $obesity = QuizResult::where('user_id', $request->user()->id)->where('quiz_type', 'obesity')->latest()->first();
        $mental  = QuizResult::where('user_id', $request->user()->id)->where('quiz_type', 'mental')->latest()->first();

        return response()->json([
            'obesity' => $obesity ? [
                'bmi'            => $obesity->bmi,
                'weight_kg'      => $obesity->weight_kg,
                'height_cm'      => $obesity->height_cm,
                'risk_level'     => $obesity->risk_level,
                'recommendation' => $obesity->recommendation,
                'date'           => $obesity->created_at->toDateString(),
            ] : null,
            'mental' => $mental ? [
                'anxiety'        => $mental->anxiety,
                'stress'         => $mental->stress,
                'depression'     => $mental->depression,
                'sleep_problem'  => $mental->sleep_problem,
                'overwhelmed'    => $mental->overwhelmed,
                'total_score'    => $mental->total_score,
                'risk_level'     => $mental->risk_level,
                'recommendation' => $mental->recommendation,
                'date'           => $mental->created_at->toDateString(),
            ] : null,
        ]);
    }

    // ── Quiz: semua hasil ─────────────────────────────────────────────────────
    public function quizResults(Request $request)
    {
        $results = QuizResult::where('user_id', $request->user()->id)
                    ->orderBy('created_at', 'desc')->get()
                    ->map(fn($r) => [
                        'id'             => $r->id,
                        'type'           => $r->quiz_type,
                        'risk_level'     => $r->risk_level,
                        'total_score'    => $r->total_score,
                        'recommendation' => $r->recommendation,
                        'date'           => $r->created_at->toDateString(),
                        'bmi'            => $r->bmi,
                        'height_cm'      => $r->height_cm,
                        'weight_kg'      => $r->weight_kg,
                        'anxiety'        => $r->anxiety,
                        'stress'         => $r->stress,
                        'depression'     => $r->depression,
                    ]);

        return response()->json(['results' => $results]);
    }

    // ── Overview lengkap ──────────────────────────────────────────────────────
    public function healthOverview(Request $request)
    {
        $user  = $request->user();
        $today = Carbon::today()->toDateString();
        $logs  = DailyLog::where('user_id', $user->id)->whereDate('log_date', $today)->get();

        $obesity = QuizResult::where('user_id', $user->id)->where('quiz_type', 'obesity')->latest()->first();
        $mental  = QuizResult::where('user_id', $user->id)->where('quiz_type', 'mental')->latest()->first();

        return response()->json([
            'user'  => ['name' => $user->name],
            'today' => [
                'calories_in'     => $logs->where('type','food')->sum(fn($l) => $l->data['calories'] ?? 0),
                'water_ml'        => $logs->where('type','water')->sum(fn($l) => $l->data['amount'] ?? 0),
                'exercise_min'    => $logs->where('type','exercise')->sum(fn($l) => $l->data['duration'] ?? 0),
                'calories_burned' => $logs->where('type','exercise')->sum(fn($l) => $l->data['calories_burned'] ?? 0),
            ],
            'obesity_risk'          => $obesity?->risk_level,
            'mental_risk'           => $mental?->risk_level,
            'bmi'                   => $obesity?->bmi,
            'latest_recommendation' => $obesity?->recommendation ?? $mental?->recommendation,
        ]);
    }
}