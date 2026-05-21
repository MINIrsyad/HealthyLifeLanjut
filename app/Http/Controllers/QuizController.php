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

    /** Hitung risiko obesitas */
    public function calcObesity(Request $request)
    {
        $data = $request->validate([
            'height'   => 'required|numeric|min:100|max:250',
            'weight'   => 'required|numeric|min:20|max:300',
            'fastfood' => 'required|numeric|in:0,1,2,3',
            'veggie'   => 'required|numeric|in:0,1,2,3',
            'physical' => 'required|numeric|in:0,1,2,3',
            'sitting'  => 'required|numeric|in:0,1,2,3',
            'sugary'   => 'required|numeric|in:0,1,2,3',
            'family'   => 'required|numeric|in:0,1,2',
        ]);

        $h   = $data['height'] / 100;
        $bmi = $data['weight'] / ($h * $h);

        $bmi_score = 0;
        if ($bmi >= 30) {
            $bmi_score = 4;
        } elseif ($bmi >= 25) {
            $bmi_score = 2;
        }

        $score = $bmi_score + $data['fastfood'] + $data['veggie'] + $data['physical'] + $data['sitting'] + $data['sugary'] + $data['family'];

        if ($score <= 5) {
            $level = 'Rendah';
            $class = 'result-low';
            $message = 'Pertahankan pola makan seimbang dan rutinitas olahraga. Lanjutkan kebiasaan sehat yang sudah baik.';
        } elseif ($score <= 13) {
            $level = 'Sedang';
            $class = 'result-medium';
            $message = 'Perhatikan pola makan dan tingkatkan aktivitas fisik. Pertimbangkan konsultasi dengan ahli gizi untuk panduan diet yang lebih terstruktur.';
        } else {
            $level = 'Tinggi';
            $class = 'result-high';
            $message = 'Sangat disarankan untuk segera berkonsultasi dengan dokter atau ahli gizi. Perubahan gaya hidup signifikan diperlukan dan sebaiknya didampingi oleh profesional kesehatan.';
        }

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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(array_merge($result, ['class' => $class]));
        }

        return redirect()->back();
    }

    /** Hitung kesehatan mental */
    public function calcMental(Request $request)
    {
        $data = $request->validate([
            'q1' => 'required|numeric|in:0,1,2,3,4',
            'q2' => 'required|numeric|in:0,1,2,3,4',
            'q3' => 'required|numeric|in:0,1,2,3,4',
            'q4' => 'required|numeric|in:0,1,2,3,4',
            'q5' => 'required|numeric|in:0,1,2,3,4',
            'q6' => 'required|numeric|in:0,1,2,3,4',
            'q7' => 'required|numeric|in:0,1,2,3,4',
            'q8' => 'required|numeric|in:0,1,2,3,4',
        ]);

        $score = array_sum($data);

        if ($score <= 10) {
            $level = 'Rendah';
            $class = 'result-low';
            $message = 'Kondisi mental relatif baik. Pertahankan kebiasaan positif seperti olahraga, tidur cukup, dan manajemen waktu yang sehat.';
        } elseif ($score <= 21) {
            $level = 'Sedang';
            $class = 'result-medium';
            $message = 'Terdapat indikasi stres yang perlu diperhatikan. Terapkan teknik relaksasi, batasi paparan stresor, dan pertimbangkan berbicara dengan orang terpercaya atau konselor.';
        } else {
            $level = 'Tinggi';
            $class = 'result-high';
            $message = 'Indikasi stres atau gangguan mental yang signifikan. Sangat disarankan untuk segera mencari bantuan dari psikolog atau psikiater profesional. Jangan abaikan kondisi ini.';
        }

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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(array_merge($result, ['class' => $class]));
        }

        return redirect()->back();
    }
}
