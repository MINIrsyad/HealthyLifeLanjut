<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /** Tampilkan halaman quiz */
    public function index()
    {
        $user = Auth::user();

        $obesityHistory = QuizResult::where('user_id', $user->id)
            ->where('quiz_type', 'obesity')
            ->latest()->take(5)->get();

        $mentalHistory = QuizResult::where('user_id', $user->id)
            ->where('quiz_type', 'mental')
            ->latest()->take(5)->get();

        return view('user.quiz', compact('obesityHistory','mentalHistory'));
    }

    /** Hitung risiko obesitas (port logika dari WEB.html JS) */
    public function calcObesity(Request $request)
    {
        $data = $request->validate([
            'height'   => 'required|numeric|min:100|max:250',
            'weight'   => 'required|numeric|min:20|max:300',
            'fastfood' => 'required|numeric|in:1,2,3,4',
            'exercise' => 'required|numeric|in:1,2,3,4',
            'sleep'    => 'required|numeric|in:1,2,3,4',
        ]);

        $h   = $data['height'] / 100;
        $bmi = $data['weight'] / ($h * $h);

        // Scoring (persis dari WEB.html)
        $score = 0;
        if ($bmi < 18.5)          $score += 1;
        elseif ($bmi >= 25 && $bmi < 30) $score += 2;
        elseif ($bmi >= 30)       $score += 3;

        $score += $data['fastfood'] + (5 - $data['exercise']) + (5 - $data['sleep']);

        [$level, $class, $message] = $score <= 6
            ? ['Low Risk',      'result-low',    'Bagus! Pertahankan gaya hidup sehat Anda.']
            : ($score <= 12
                ? ['Moderate Risk', 'result-medium', 'Perlu perhatian. Tingkatkan aktivitas fisik dan kurangi fast food.']
                : ['High Risk',     'result-high',   'Penting! Konsultasikan dengan dokter gizi dan mulai program olahraga rutin.']);

        $result = [
            'bmi'     => round($bmi, 1),
            'score'   => $score,
            'level'   => $level,
            'message' => $message,
        ];

        QuizResult::create([
            'user_id'     => Auth::id(),
            'quiz_type'   => 'obesity',
            'result_data' => $result,
        ]);

        $obesityResult  = $result + ['class' => $class];
        $obesityHistory = QuizResult::where('user_id', Auth::id())
            ->where('quiz_type','obesity')->latest()->take(5)->get();
        $mentalHistory  = QuizResult::where('user_id', Auth::id())
            ->where('quiz_type','mental')->latest()->take(5)->get();

        return view('user.quiz', compact('obesityResult','obesityHistory','mentalHistory'));
    }

    /** Hitung kesehatan mental (port logika dari WEB.html JS) */
    public function calcMental(Request $request)
    {
        $data = $request->validate([
            'anxiety'    => 'required|numeric|in:1,2,3,4',
            'sleepissue' => 'required|numeric|in:1,2,3,4',
            'depression' => 'required|numeric|in:1,2,3,4',
            'stress'     => 'required|numeric|in:1,2,3,4',
            'overwhelm'  => 'required|numeric|in:1,2,3,4',
        ]);

        $score = array_sum($data);

        [$level, $class, $message] = $score <= 8
            ? ['Low Risk',      'result-low',    'Kesehatan mental Anda baik! Pertahankan istirahat dan aktivitas positif.']
            : ($score <= 15
                ? ['Moderate Risk', 'result-medium', 'Ada beberapa gejala yang perlu perhatian. Coba teknik relaksasi dan berbicara dengan orang terdekat.']
                : ['High Risk',     'result-high',   'Sangat direkomendasikan untuk berkonsultasi dengan psikolog atau konselor profesional.']);

        $result = [
            'score'   => $score,
            'level'   => $level,
            'message' => $message,
        ];

        QuizResult::create([
            'user_id'     => Auth::id(),
            'quiz_type'   => 'mental',
            'result_data' => $result,
        ]);

        $mentalResult   = $result + ['class' => $class];
        $mentalHistory  = QuizResult::where('user_id', Auth::id())
            ->where('quiz_type','mental')->latest()->take(5)->get();
        $obesityHistory = QuizResult::where('user_id', Auth::id())
            ->where('quiz_type','obesity')->latest()->take(5)->get();

        return view('user.quiz', compact('mentalResult','mentalHistory','obesityHistory'));
    }
}
