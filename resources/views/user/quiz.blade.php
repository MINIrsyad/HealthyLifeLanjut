@extends('layouts.app')
@section('title','Health Assessment Quiz — HealthyLife')

@push('styles')
<style>
.quiz-hero{background:linear-gradient(135deg,#FFE787,#ED7A13);padding:7rem 5% 3rem;text-align:center;}
.quiz-hero h1{font-size:3.5rem;font-weight:800;color:#1E3006;margin-bottom:.5rem;}
.quiz-hero p{color:#1E3006;opacity:.85;font-size:1.1rem;}
.quiz-body{background:#FFE787;padding:4rem 5% 6rem;}
.quiz-container{max-width:900px;margin:0 auto;}

.quiz-card{background:#fff;padding:3rem;border-radius:30px;margin-bottom:3rem;
box-shadow:0 20px 60px rgba(0,0,0,.1);transition:box-shadow .3s;}
.quiz-card:hover{box-shadow:0 30px 80px rgba(106,128,66,.2);}
.quiz-card-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem;
padding-bottom:1.5rem;border-bottom:3px solid #FFFADD;}
.quiz-card-header .card-icon{font-size:2.5rem;background:#FFFADD;width:60px;height:60px;
border-radius:50%;display:flex;align-items:center;justify-content:center;}
.quiz-card-header h3{font-size:1.8rem;font-weight:800;color:#1E3006;margin:0;}
.quiz-card-header p{color:#6A8042;font-size:.9rem;margin:0;}

.input-group{margin-bottom:1.5rem;}
.input-group label{display:block;margin-bottom:.6rem;font-weight:700;color:#1E3006;font-size:.95rem;}
.input-group input,.input-group select{
width:100%;padding:1rem 1.2rem;border:2px solid #e0e0e0;border-radius:15px;
font-family:'Poppins',sans-serif;font-size:.95rem;transition:all .3s;outline:none;color:#1E3006;}
.input-group input:focus,.input-group select:focus{border-color:#6A8042;box-shadow:0 0 0 4px rgba(106,128,66,.1);}
.form-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;}
.bmi-preview{background:#FFFADD;border-radius:15px;padding:1rem 1.5rem;margin-top:1rem;
font-size:.9rem;color:#1E3006;font-weight:600;display:none;}
.bmi-preview.visible{display:block;}

.submit-btn{width:100%;padding:1.2rem;background:#ED7A13;color:#fff;border:none;
border-radius:50px;font-weight:700;font-size:1.1rem;cursor:pointer;transition:all .3s;
font-family:'Poppins',sans-serif;box-shadow:0 10px 30px rgba(237,122,19,.3);margin-top:1rem;}
.submit-btn:hover{transform:translateY(-3px);box-shadow:0 15px 40px rgba(237,122,19,.4);}

/* Result boxes */
.result-box{margin-top:2rem;padding:2.5rem;border-radius:20px;text-align:center;
animation:popIn .5s cubic-bezier(.175,.885,.32,1.275);}
@keyframes popIn{0%{transform:scale(0)}50%{transform:scale(1.05)}100%{transform:scale(1)}}
.result-box h2{font-size:1.8rem;font-weight:800;margin-bottom:.5rem;}
.result-box h3{font-size:1.3rem;margin-bottom:.8rem;}
.result-box p{font-size:1rem;line-height:1.7;margin-bottom:.5rem;}
.result-low   {background:#6A8042;color:#fff;}
.result-medium{background:#FFE787;color:#1E3006;}
.result-high  {background:#ED7A13;color:#fff;}

/* Scale slider visual */
.scale-options{display:flex;gap:.5rem;flex-wrap:wrap;}
.scale-opt{flex:1;min-width:60px;padding:.6rem .5rem;border:2px solid #e0e0e0;border-radius:12px;
text-align:center;cursor:pointer;transition:all .3s;font-weight:600;font-size:.85rem;color:#1E3006;}
.scale-opt:hover,.scale-opt.selected{border-color:#ED7A13;background:#ED7A13;color:#fff;}

/* History */
.quiz-history{background:rgba(255,255,255,.7);border-radius:20px;padding:2rem;margin-top:1rem;}
.quiz-history h4{color:#1E3006;font-weight:700;margin-bottom:1rem;}
.history-result{display:flex;justify-content:space-between;align-items:center;
padding:.7rem 1rem;border-radius:12px;margin-bottom:.5rem;background:#fff;}
.risk-badge{padding:.3rem .8rem;border-radius:50px;font-size:.75rem;font-weight:700;}
.risk-low   {background:#6A8042;color:#fff;}
.risk-medium{background:#FFE787;color:#1E3006;}
.risk-high  {background:#ED7A13;color:#fff;}

@media(max-width:768px){
.quiz-hero h1{font-size:2.5rem;}
.quiz-card{padding:1.5rem;}
.form-grid-2{grid-template-columns:1fr;}
}
</style>
@endpush

@section('content')

<div class="quiz-hero">
    <h1>🧪 Health Assessment</h1>
    <p>Evaluasi risiko kesehatan Anda dengan kalkulator berbasis data ilmiah</p>
</div>

<div class="quiz-body">
<div class="quiz-container">

    {{-- ── QUIZ OBESITAS ── --}}
    <div class="quiz-card">
        <div class="quiz-card-header">
            <div class="card-icon">⚖️</div>
            <div>
                <h3>Obesity Risk Calculator</h3>
                <p>Kalkulasi BMI dan faktor risiko obesitas Anda</p>
            </div>
        </div>

        <form method="POST" action="{{ route('user.quiz.obesity') }}" id="form-obesity">
            @csrf
            <div class="form-grid-2">
                <div class="input-group">
                    <label>Tinggi Badan (cm)</label>
                    <input type="number" name="height" id="height" placeholder="cth. 170" required min="100" max="250" oninput="calcBMIPreview()">
                </div>
                <div class="input-group">
                    <label>Berat Badan (kg)</label>
                    <input type="number" name="weight" id="weight" step="0.1" placeholder="cth. 65" required min="20" max="300" oninput="calcBMIPreview()">
                </div>
            </div>

            <div id="bmiPreview" class="bmi-preview">
                📊 BMI Anda: <strong id="bmiVal">-</strong> — <span id="bmiCat"></span>
            </div>

            <div class="input-group" style="margin-top:1.5rem;">
                <label>Frekuensi Fast Food per Minggu</label>
                <select name="fastfood" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="1">Jarang (&lt;1x/minggu)</option>
                    <option value="2">Kadang-kadang (1-2x/minggu)</option>
                    <option value="3">Sering (3-4x/minggu)</option>
                    <option value="4">Sangat Sering (&gt;4x/minggu)</option>
                </select>
            </div>
            <div class="input-group">
                <label>Frekuensi Olahraga per Minggu</label>
                <select name="exercise" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="4">5-7 kali</option>
                    <option value="3">3-4 kali</option>
                    <option value="2">1-2 kali</option>
                    <option value="1">Tidak pernah</option>
                </select>
            </div>
            <div class="input-group">
                <label>Jam Tidur per Malam</label>
                <select name="sleep" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="4">7-9 jam</option>
                    <option value="3">6-7 jam</option>
                    <option value="2">5-6 jam</option>
                    <option value="1">&lt;5 jam</option>
                </select>
            </div>

            <button type="submit" class="submit-btn" id="btn-hitung-obesitas">🔍 Hitung Risiko Obesitas</button>
        </form>

        {{-- Hasil Obesitas --}}
        @if(isset($obesityResult))
        <div class="result-box {{ $obesityResult['class'] }}">
            <h3>BMI Anda: <strong>{{ $obesityResult['bmi'] }}</strong></h3>
            <h2>Risiko Obesitas: {{ $obesityResult['level'] }}</h2>
            <p>{{ $obesityResult['message'] }}</p>
            <p><small>Skor total: {{ $obesityResult['score'] }}</small></p>
        </div>
        @endif

        {{-- Riwayat Quiz Obesitas --}}
        @if($obesityHistory->count())
        <div class="quiz-history">
            <h4>📜 Riwayat Kalkulator Obesitas (5 terakhir)</h4>
            @foreach($obesityHistory as $qr)
            @php $res = $qr->result_data; @endphp
            <div class="history-result">
                <div>
                    <span style="font-weight:600;color:#1E3006;">BMI {{ $res['bmi'] ?? '-' }}</span>
                    <small style="display:block;color:#6A8042;">{{ $qr->created_at->locale('id')->isoFormat('D MMM Y') }}</small>
                </div>
                @php $rc = ['Low Risk'=>'risk-low','Moderate Risk'=>'risk-medium','High Risk'=>'risk-high'][$res['level']??''] ?? 'risk-low'; @endphp
                <span class="risk-badge {{ $rc }}">{{ $res['level'] ?? '-' }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- ── QUIZ MENTAL HEALTH ── --}}
    <div class="quiz-card">
        <div class="quiz-card-header">
            <div class="card-icon">🧠</div>
            <div>
                <h3>Mental Health Assessment</h3>
                <p>Evaluasi kondisi kesehatan mental Anda</p>
            </div>
        </div>

        <form method="POST" action="{{ route('user.quiz.mental') }}" id="form-mental">
            @csrf
            @foreach([
                ['anxiety',    'Tingkat Kecemasan',         ['1'=>'Jarang','2'=>'Kadang','3'=>'Sering','4'=>'Sangat Sering']],
                ['sleepissue', 'Masalah Tidur',             ['1'=>'Tidak','2'=>'Kadang','3'=>'Sering','4'=>'Setiap Hari']],
                ['depression', 'Gejala Depresi',            ['1'=>'Jarang','2'=>'Kadang','3'=>'Sering','4'=>'Sangat Sering']],
                ['stress',     'Tingkat Stres',             ['1'=>'Rendah','2'=>'Sedang','3'=>'Tinggi','4'=>'Sangat Tinggi']],
                ['overwhelm',  'Merasa Kewalahan/Overwhelm',['1'=>'Tidak','2'=>'Kadang','3'=>'Sering','4'=>'Selalu']],
            ] as [$name,$label,$options])
            <div class="input-group">
                <label>{{ $label }}</label>
                <div class="scale-options">
                    @foreach($options as $val => $text)
                    <label class="scale-opt" style="cursor:pointer;">
                        <input type="radio" name="{{ $name }}" value="{{ $val }}" required style="display:none;">
                        {{ $text }}
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <button type="submit" class="submit-btn" id="btn-hitung-mental">🧠 Hitung Kesehatan Mental</button>
        </form>

        {{-- Hasil Mental --}}
        @if(isset($mentalResult))
        <div class="result-box {{ $mentalResult['class'] }}">
            <h2>Risiko Mental Health: {{ $mentalResult['level'] }}</h2>
            <p>{{ $mentalResult['message'] }}</p>
            <p><small>Skor: {{ $mentalResult['score'] }}/20</small></p>
        </div>
        @endif

        {{-- Riwayat Quiz Mental --}}
        @if($mentalHistory->count())
        <div class="quiz-history">
            <h4>📜 Riwayat Mental Assessment (5 terakhir)</h4>
            @foreach($mentalHistory as $qr)
            @php $res = $qr->result_data; @endphp
            <div class="history-result">
                <div>
                    <span style="font-weight:600;color:#1E3006;">Skor: {{ $res['score'] ?? '-' }}/20</span>
                    <small style="display:block;color:#6A8042;">{{ $qr->created_at->locale('id')->isoFormat('D MMM Y') }}</small>
                </div>
                @php $rc = ['Low Risk'=>'risk-low','Moderate Risk'=>'risk-medium','High Risk'=>'risk-high'][$res['level']??''] ?? 'risk-low'; @endphp
                <span class="risk-badge {{ $rc }}">{{ $res['level'] ?? '-' }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>
</div>
@endsection

@push('scripts')
<script>
// ── BMI Live Preview ──
function calcBMIPreview() {
    const h = parseFloat(document.getElementById('height').value) / 100;
    const w = parseFloat(document.getElementById('weight').value);
    const preview = document.getElementById('bmiPreview');
    if (h > 0 && w > 0) {
        const bmi = (w / (h * h)).toFixed(1);
        let cat = bmi < 18.5 ? '🔵 Kurus' : bmi < 25 ? '🟢 Normal' : bmi < 30 ? '🟡 Kelebihan BB' : '🔴 Obesitas';
        document.getElementById('bmiVal').textContent = bmi;
        document.getElementById('bmiCat').textContent = cat;
        preview.classList.add('visible');
    } else {
        preview.classList.remove('visible');
    }
}

// ── Scale option click effect ──
document.querySelectorAll('.scale-options').forEach(group => {
    group.querySelectorAll('.scale-opt').forEach(opt => {
        opt.addEventListener('click', () => {
            group.querySelectorAll('.scale-opt').forEach(o => o.classList.remove('selected'));
            opt.classList.add('selected');
            opt.querySelector('input[type=radio]').checked = true;
        });
    });
});

// ══════════════════════════════════════════════════════
// ── VALIDASI UNIVERSAL UNTUK SEMUA FORM QUIZ ──
// ══════════════════════════════════════════════════════
document.querySelectorAll('#form-obesity, #form-mental').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let isValid = true;

        // Validasi input dan select yang memiliki atribut required
        this.querySelectorAll('input[type="number"][required], select[required]').forEach(field => {
            const value = field.value ? field.value.trim() : '';
            if (value === '') {
                isValid = false;
            }
        });

        // Validasi radio button berdasarkan group name
        const radioGroups = new Set();
        this.querySelectorAll('input[type="radio"][required]').forEach(radio => {
            radioGroups.add(radio.name);
        });

        radioGroups.forEach(groupName => {
            const checked = this.querySelector(
                `input[name="${groupName}"]:checked`
            );
            if (!checked) {
                isValid = false;
            }
        });

        // Jika ada field atau pilihan yang belum diisi
        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Silakan isi semua data dan pilih semua opsi terlebih dahulu sebelum melanjutkan proses perhitungan.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Jika semua valid, lanjutkan submit
        this.submit();
    });
});
</script>
@endpush
