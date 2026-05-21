<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\QuizResult;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        // Stat cards
        $totalUsers   = User::where('role', 'user')->count();
        $totalLogs    = DailyLog::count();
        $todayLogs    = DailyLog::whereDate('created_at', $today)->count();
        $totalQuizzes = QuizResult::count();

        // Today breakdown by type
        $todayAllLogs = DailyLog::whereDate('log_date', $today)->get();
        $todayBreakdown = [
            'meal'     => $todayAllLogs->where('type', 'food')->count(),
            'water'    => $todayAllLogs->where('type', 'water')->count(),
            'exercise' => $todayAllLogs->where('type', 'exercise')->count(),
            'sleep'    => $todayAllLogs->where('type', 'sleep')->count(),
        ];

        // High risk counts
        $highRiskObesity = QuizResult::where('quiz_type', 'obesity')
            ->get()->filter(fn($q) => ($q->result_data['level'] ?? '') === 'High Risk')->count();
        $highRiskMental  = QuizResult::where('quiz_type', 'mental')
            ->get()->filter(fn($q) => ($q->result_data['level'] ?? '') === 'High Risk')->count();

        // Weekly activity (7 days)
        $weeklyActivity = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            return [
                'label' => $date->locale('id')->isoFormat('D MMM'),
                'count' => DailyLog::whereDate('log_date', $date)->count(),
            ];
        })->toArray();

        // Users with counts
        $users = User::where('role', 'user')
            ->withCount(['dailyLogs', 'quizResults'])
            ->latest()->get();

        // Recent logs (20 terbaru)
        $recentLogs = DailyLog::with('user')->latest()->take(20)->get();

        // Recent quizzes (10 terbaru)
        $recentQuizzes = QuizResult::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalLogs', 'todayLogs', 'totalQuizzes',
            'todayBreakdown', 'highRiskObesity', 'highRiskMental',
            'weeklyActivity', 'users', 'recentLogs', 'recentQuizzes'
        ));
    }
}
