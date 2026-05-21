<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrackerController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $today = Carbon::today();

        // Log hari ini berdasarkan log_date
        $todayLogs = DailyLog::where('user_id', $user->id)
            ->whereDate('log_date', $today)
            ->latest()
            ->get();

        // Stat cards hari ini
        $todayStats = [
            'calories' => $todayLogs->where('type', 'food')
                ->sum(fn($l) => $l->data['calories'] ?? 0),
            'water'    => $todayLogs->where('type', 'water')
                ->sum(fn($l) => $l->data['amount'] ?? 0),
            'exercise' => $todayLogs->where('type', 'exercise')
                ->sum(fn($l) => $l->data['duration'] ?? 0),
            'sleep'    => $todayLogs->where('type', 'sleep')
                ->sum(function ($l) {
                    if (!isset($l->data['bedtime'], $l->data['waketime'])) return 0;
                    [$bh, $bm] = explode(':', $l->data['bedtime']);
                    [$wh, $wm] = explode(':', $l->data['waketime']);
                    return round((($wh * 60 + $wm) - ($bh * 60 + $bm) + 1440) % 1440 / 60, 1);
                }),
        ];

        // Riwayat 7 hari sebelumnya, dikelompokkan per tanggal
        $historyLogs = DailyLog::where('user_id', $user->id)
            ->where('log_date', '<', $today)
            ->where('log_date', '>=', $today->copy()->subDays(7))
            ->latest('log_date')
            ->get()
            ->groupBy(fn($l) => $l->log_date->toDateString());

        return view('user.tracker', compact('todayLogs', 'todayStats', 'historyLogs'));
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        $data = match ($type) {
            'food' => $request->validate([
                'meal_type' => 'required|string',
                'food_name' => 'required|string|max:255',
                'calories'  => 'required|numeric|min:0',
                'protein'   => 'required|numeric|min:0',
                'carbs'     => 'required|numeric|min:0',
                'fat'       => 'required|numeric|min:0',
            ]),
            'water' => $request->validate([
                'amount'     => 'required|numeric|min:0',
                'time'       => 'required|string',
                'drink_type' => 'required|string',
            ]),
            'exercise' => $request->validate([
                'exercise_type' => 'required|string',
                'duration'      => 'required|numeric|min:1',
                'burned'        => 'required|numeric|min:0',
                'intensity'     => 'required|string',
            ]),
            'sleep' => $request->validate([
                'bedtime'  => 'required|string',
                'waketime' => 'required|string',
                'quality'  => 'required|numeric|min:1|max:10',
                'notes'    => 'nullable|string|max:500',
            ]),
            default => abort(422, 'Tipe tidak valid'),
        };

        DailyLog::create([
            'user_id'  => Auth::id(),
            'log_date' => Carbon::today(),
            'type'     => $type,
            'data'     => $data,
        ]);

        $labels = ['food' => 'Makanan', 'water' => 'Minuman', 'exercise' => 'Olahraga', 'sleep' => 'Tidur'];
        return back()->with('success', '✅ Log ' . ($labels[$type] ?? $type) . ' berhasil disimpan!');
    }

    public function destroy(DailyLog $log)
    {
        abort_if($log->user_id !== Auth::id(), 403);
        $log->delete();
        return back()->with('success', '🗑️ Log berhasil dihapus.');
    }
}
