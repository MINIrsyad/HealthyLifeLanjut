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
animation:popIn .5s cubic-bezier(.175,.885,.32,1.275); display:none;}
.result-box.visible{display:block;}
@keyframes popIn{0%{transform:scale(0)}50%{transform:scale(1.05)}100%{transform:scale(1)}}
.result-box h2{font-size:1.8rem;font-weight:800;margin-bottom:.5rem;}
.result-box h3{font-size:1.3rem;margin-bottom:.8rem;}
.result-box p{font-size:1rem;line-height:1.7;margin-bottom:.5rem;}
.result-low   {background:#6A8042;color:#fff;}
.result-medium{background:#ED7A13;color:#fff;}
.result-high  {background:#E53935;color:#fff;}

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
.risk-medium{background:#ED7A13;color:#fff;}
.risk-high  {background:#E53935;color:#fff;}

/* ── Error Banner (Flat 2D) ── */
.error-banner{
    display:none;
    background:#ED7A13;
    border:2.5px solid #c45e00;
    border-radius:14px;
    padding:1rem 1.4rem;
    margin-bottom:1.8rem;
    color:#1E3006;
    font-weight:700;
    font-size:.97rem;
    line-height:1.5;
    letter-spacing:.01em;
}
.error-banner.visible{display:flex;align-items:flex-start;gap:.7rem;}
.error-banner .banner-icon{font-size:1.4rem;flex-shrink:0;margin-top:.05rem;}
.error-banner .banner-text{flex:1;}
.error-banner .banner-text strong{display:block;font-size:1.05rem;margin-bottom:.25rem;color:#1E3006;}
.error-banner .banner-text span{color:#fff;font-weight:600;}

/* Highlight merah untuk grup radio yang belum dipilih */
.scale-options.input-error{
    outline:2.5px solid #e53935;
    border-radius:14px;
    padding:4px;
    background:rgba(229,57,53,.06);
    transition:outline .2s,background .2s;
}
.input-group.field-error > label{
    color:#c0392b;
    font-weight:800;
}
.input-group.field-error > label::after{
    content:" *";
    color:#e53935;
}

@media(max-width:768px){
.quiz-hero h1{font-size:2.5rem;}
.quiz-card{padding:1.5rem;}
.form-grid-2{grid-template-columns:1fr;}
.scale-options{flex-direction:column;}
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

        <form id="form-obesity" novalidate>
            @csrf
            <div class="error-banner" id="obesity-error-banner" role="alert">
                <div class="banner-icon">⚠️</div>
                <div class="banner-text">
                    <strong>Ups! Formulir Belum Lengkap</strong>
                    <span>Mohon isi semua data untuk melihat hasil analisis.</span>
                </div>
            </div>

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

            <div class="input-group" style="margin-top:1.5rem;" id="group-fastfood">
                <label>Berapa kali dalam seminggu Anda mengonsumsi makanan cepat saji atau gorengan?</label>
                <select name="fastfood" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="0">Tidak pernah</option>
                    <option value="1">1–2 kali</option>
                    <option value="2">3–4 kali</option>
                    <option value="3">Setiap hari</option>
                </select>
            </div>
            
            <div class="input-group" id="group-veggie">
                <label>Berapa porsi sayur dan buah yang Anda konsumsi per hari?</label>
                <select name="veggie" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="0">&gt;= 5 porsi</option>
                    <option value="1">3–4 porsi</option>
                    <option value="2">1–2 porsi</option>
                    <option value="3">Tidak ada</option>
                </select>
            </div>

            <div class="input-group" id="group-physical">
                <label>Seberapa sering Anda melakukan aktivitas fisik (olahraga &gt;= 30 menit)?</label>
                <select name="physical" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="0">5+ kali/minggu</option>
                    <option value="1">3–4 kali/minggu</option>
                    <option value="2">1–2 kali/minggu</option>
                    <option value="3">Tidak pernah</option>
                </select>
            </div>

            <div class="input-group" id="group-sitting">
                <label>Berapa jam rata-rata Anda duduk atau tidak aktif per hari?</label>
                <select name="sitting" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="0">&lt; 4 jam</option>
                    <option value="1">4–6 jam</option>
                    <option value="2">7–9 jam</option>
                    <option value="3">&gt; 9 jam</option>
                </select>
            </div>

            <div class="input-group" id="group-sugary">
                <label>Apakah Anda sering mengonsumsi minuman manis (soda, minuman kemasan, kopi bergula)?</label>
                <select name="sugary" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="0">Tidak pernah</option>
                    <option value="1">Jarang (&lt; 1x/minggu)</option>
                    <option value="2">Kadang (2–3x/minggu)</option>
                    <option value="3">Sering (setiap hari)</option>
                </select>
            </div>

            <div class="input-group" id="group-family">
                <label>Apakah ada anggota keluarga inti (orang tua/saudara kandung) yang mengalami obesitas?</label>
                <select name="family" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="0">Tidak ada</option>
                    <option value="1">Satu orang</option>
                    <option value="2">Dua orang atau lebih</option>
                </select>
            </div>

            <button type="submit" class="submit-btn" id="btn-hitung-obesitas">🔍 Hitung Risiko Obesitas</button>
        </form>

        {{-- Hasil Obesitas --}}
        <div id="obesity-result-box" class="result-box">
            <h3>BMI Anda: <strong id="obesity-result-bmi"></strong></h3>
            <h2>Risiko Obesitas: <span id="obesity-result-level"></span></h2>
            <p id="obesity-result-message"></p>
            <p><small>Skor total: <span id="obesity-result-score"></span>/21</small></p>
        </div>

        {{-- Riwayat Quiz Obesitas --}}
        <div class="quiz-history">
            <h4>📜 Riwayat Kalkulator Obesitas (5 terakhir)</h4>
            <div id="obesity-history-container">
            @if($obesityHistory->count())
                @foreach($obesityHistory as $qr)
                @php $res = $qr->result_data; @endphp
                <div class="history-result">
                    <div>
                        <span style="font-weight:600;color:#1E3006;">BMI {{ $res['bmi'] ?? '-' }}</span>
                        <small style="display:block;color:#6A8042;">{{ $qr->created_at->locale('id')->isoFormat('D MMM Y') }}</small>
                    </div>
                    @php $rc = ['Low Risk'=>'risk-low','Moderate Risk'=>'risk-medium','High Risk'=>'risk-high','Rendah'=>'risk-low','Sedang'=>'risk-medium','Tinggi'=>'risk-high'][$res['level']??''] ?? 'risk-low'; @endphp
                    <span class="risk-badge {{ $rc }}">{{ $res['level'] ?? '-' }}</span>
                </div>
                @endforeach
            @else
                <p style="color:#6A8042;font-size:0.9rem;">Belum ada riwayat.</p>
            @endif
            </div>
        </div>
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

        <form id="form-mental" novalidate>
            @csrf
            {{-- ── Error Banner ── --}}
            <div class="error-banner" id="mental-error-banner" role="alert">
                <div class="banner-icon">⚠️</div>
                <div class="banner-text">
                    <strong>Ups! Formulir Belum Lengkap</strong>
                    <span>Mohon isi semua opsi penilaian kesehatan mental terlebih dahulu sebelum melihat hasil analisis.</span>
                </div>
            </div>

            @php
            $mentalQuestions = [
                'q1' => ['label' => '1. Seberapa sering Anda merasa tidak mampu mengendalikan hal-hal penting dalam hidup?', 'reverse' => false],
                'q2' => ['label' => '2. Seberapa sering Anda merasa percaya diri dalam menangani masalah pribadi?', 'reverse' => true],
                'q3' => ['label' => '3. Seberapa sering Anda merasa kesulitan untuk berkonsentrasi atau fokus pada pekerjaan/studi?', 'reverse' => false],
                'q4' => ['label' => '4. Seberapa sering Anda mengalami gangguan tidur (susah tidur, tidur berlebihan, atau sering terbangun)?', 'reverse' => false],
                'q5' => ['label' => '5. Seberapa sering Anda merasa cemas, khawatir, atau gelisah tanpa alasan yang jelas?', 'reverse' => false],
                'q6' => ['label' => '6. Seberapa sering Anda merasa mudah marah, frustrasi, atau kehilangan kesabaran?', 'reverse' => false],
                'q7' => ['label' => '7. Seberapa sering Anda merasa lelah secara fisik maupun mental meskipun sudah beristirahat cukup?', 'reverse' => false],
                'q8' => ['label' => '8. Seberapa sering Anda merasa kesulitan untuk menikmati aktivitas atau hobi yang biasanya Anda sukai?', 'reverse' => false],
            ];
            @endphp

            @foreach($mentalQuestions as $name => $q)
            <div class="input-group" id="group-{{ $name }}">
                <label for="scale-{{ $name }}">{{ $q['label'] }}</label>
                <div class="scale-options" id="scale-{{ $name }}" data-group="{{ $name }}">
                    @if($q['reverse'])
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="4" required style="display:none;">Tidak pernah</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="3" required style="display:none;">Hampir tidak pernah</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="2" required style="display:none;">Kadang-kadang</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="1" required style="display:none;">Cukup sering</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="0" required style="display:none;">Sangat sering</label>
                    @else
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="0" required style="display:none;">Tidak pernah</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="1" required style="display:none;">Hampir tidak pernah</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="2" required style="display:none;">Kadang-kadang</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="3" required style="display:none;">Cukup sering</label>
                        <label class="scale-opt"><input type="radio" name="{{ $name }}" value="4" required style="display:none;">Sangat sering</label>
                    @endif
                </div>
            </div>
            @endforeach

            <button type="submit" class="submit-btn" id="btn-hitung-mental">🧠 Hitung Kesehatan Mental</button>
        </form>

        {{-- Hasil Mental --}}
        <div id="mental-result-box" class="result-box">
            <h2>Risiko Mental Health: <span id="mental-result-level"></span></h2>
            <p id="mental-result-message"></p>
            <p><small>Skor: <span id="mental-result-score"></span>/32</small></p>
        </div>

        {{-- Riwayat Quiz Mental --}}
        <div class="quiz-history">
            <h4>📜 Riwayat Mental Assessment (5 terakhir)</h4>
            <div id="mental-history-container">
            @if($mentalHistory->count())
                @foreach($mentalHistory as $qr)
                @php $res = $qr->result_data; @endphp
                <div class="history-result">
                    <div>
                        <span style="font-weight:600;color:#1E3006;">Skor: {{ $res['score'] ?? '-' }}{{ isset($res['score']) ? ($res['score'] <= 20 && !isset($res['max']) ? '/20' : '/32') : '' }}</span>
                        <small style="display:block;color:#6A8042;">{{ $qr->created_at->locale('id')->isoFormat('D MMM Y') }}</small>
                    </div>
                    @php $rc = ['Low Risk'=>'risk-low','Moderate Risk'=>'risk-medium','High Risk'=>'risk-high','Rendah'=>'risk-low','Sedang'=>'risk-medium','Tinggi'=>'risk-high'][$res['level']??''] ?? 'risk-low'; @endphp
                    <span class="risk-badge {{ $rc }}">{{ $res['level'] ?? '-' }}</span>
                </div>
                @endforeach
            @else
                <p style="color:#6A8042;font-size:0.9rem;">Belum ada riwayat.</p>
            @endif
            </div>
        </div>
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
// ── AJAX FORM SUBMISSIONS ──
// ══════════════════════════════════════════════════════

// Date Formatter helper
function formatDate(dateString) {
    const d = new Date(dateString);
    const months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"];
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

// Obesity Form
document.getElementById('form-obesity').addEventListener('submit', function (e) {
    e.preventDefault();
    let isValid = true;
    const banner = document.getElementById('obesity-error-banner');
    
    this.querySelectorAll('.input-group').forEach(el => el.classList.remove('field-error'));

    this.querySelectorAll('input[type="number"][required], select[required]').forEach(field => {
        const value = field.value ? field.value.trim() : '';
        if (value === '') {
            isValid = false;
            field.closest('.input-group').classList.add('field-error');
        }
    });

    if (!isValid) {
        banner.classList.add('visible');
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    banner.classList.remove('visible');

    const btn = document.getElementById('btn-hitung-obesitas');
    btn.textContent = 'Menghitung...';
    btn.disabled = true;

    const formData = new FormData(this);
    
    fetch("{{ route('user.quiz.obesity') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": formData.get("_token"),
            "Accept": "application/json"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        btn.textContent = '🔍 Hitung Risiko Obesitas';
        btn.disabled = false;
        
        const resultBox = document.getElementById('obesity-result-box');
        resultBox.className = 'result-box ' + data.class + ' visible';
        document.getElementById('obesity-result-bmi').innerText = data.bmi;
        document.getElementById('obesity-result-level').innerText = data.level;
        document.getElementById('obesity-result-message').innerText = data.message;
        document.getElementById('obesity-result-score').innerText = data.score;
        
        // Add to history
        const rc = data.level === 'Rendah' ? 'risk-low' : (data.level === 'Sedang' ? 'risk-medium' : 'risk-high');
        const historyHtml = `
            <div class="history-result">
                <div>
                    <span style="font-weight:600;color:#1E3006;">BMI ${data.bmi}</span>
                    <small style="display:block;color:#6A8042;">Baru saja</small>
                </div>
                <span class="risk-badge ${rc}">${data.level}</span>
            </div>
        `;
        const container = document.getElementById('obesity-history-container');
        // remove empty text if any
        if (container.querySelector('p')) container.innerHTML = '';
        container.insertAdjacentHTML('afterbegin', historyHtml);
        
        // keep only 5
        if (container.children.length > 5) {
            container.lastElementChild.remove();
        }
        
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    })
    .catch(error => {
        btn.textContent = '🔍 Hitung Risiko Obesitas';
        btn.disabled = false;
        console.error("Error:", error);
    });
});

document.querySelectorAll('#form-obesity input, #form-obesity select').forEach(el => {
    el.addEventListener('change', function() {
        this.closest('.input-group').classList.remove('field-error');
        const hasErrors = document.querySelectorAll('#form-obesity .field-error').length > 0;
        if (!hasErrors) document.getElementById('obesity-error-banner').classList.remove('visible');
    });
});

// Mental Form
document.getElementById('form-mental').addEventListener('submit', function (e) {
    e.preventDefault();

    const banner      = document.getElementById('mental-error-banner');
    const radioNames  = ['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8'];
    let   isValid     = true;

    radioNames.forEach(name => {
        const scaleEl = document.getElementById('scale-' + name);
        const groupEl = document.getElementById('group-' + name);
        if (scaleEl) scaleEl.classList.remove('input-error');
        if (groupEl) groupEl.classList.remove('field-error');
    });
    banner.classList.remove('visible');

    radioNames.forEach(name => {
        const checked = this.querySelector(`input[name="${name}"]:checked`);
        if (!checked) {
            isValid = false;
            const scaleEl = document.getElementById('scale-' + name);
            const groupEl = document.getElementById('group-' + name);
            if (scaleEl) scaleEl.classList.add('input-error');
            if (groupEl) groupEl.classList.add('field-error');
        }
    });

    if (!isValid) {
        banner.classList.add('visible');
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    banner.classList.remove('visible');

    const btn = document.getElementById('btn-hitung-mental');
    btn.textContent = 'Menghitung...';
    btn.disabled = true;

    const formData = new FormData(this);
    
    fetch("{{ route('user.quiz.mental') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": formData.get("_token"),
            "Accept": "application/json"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        btn.textContent = '🧠 Hitung Kesehatan Mental';
        btn.disabled = false;
        
        const resultBox = document.getElementById('mental-result-box');
        resultBox.className = 'result-box ' + data.class + ' visible';
        document.getElementById('mental-result-level').innerText = data.level;
        document.getElementById('mental-result-message').innerText = data.message;
        document.getElementById('mental-result-score').innerText = data.score;
        
        const rc = data.level === 'Rendah' ? 'risk-low' : (data.level === 'Sedang' ? 'risk-medium' : 'risk-high');
        const historyHtml = `
            <div class="history-result">
                <div>
                    <span style="font-weight:600;color:#1E3006;">Skor: ${data.score}/32</span>
                    <small style="display:block;color:#6A8042;">Baru saja</small>
                </div>
                <span class="risk-badge ${rc}">${data.level}</span>
            </div>
        `;
        const container = document.getElementById('mental-history-container');
        if (container.querySelector('p')) container.innerHTML = '';
        container.insertAdjacentHTML('afterbegin', historyHtml);
        
        if (container.children.length > 5) {
            container.lastElementChild.remove();
        }
        
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    })
    .catch(error => {
        btn.textContent = '🧠 Hitung Kesehatan Mental';
        btn.disabled = false;
        console.error("Error:", error);
    });
});

document.querySelectorAll('#form-mental .scale-opt').forEach(opt => {
    opt.addEventListener('click', function () {
        const scaleEl = this.closest('.scale-options');
        const groupEl = this.closest('.input-group');
        if (scaleEl) scaleEl.classList.remove('input-error');
        if (groupEl) groupEl.classList.remove('field-error');

        const allFilled = ['q1','q2','q3','q4','q5','q6','q7','q8']
            .every(n => document.querySelector(`#form-mental input[name="${n}"]:checked`));
        if (allFilled) {
            document.getElementById('mental-error-banner').classList.remove('visible');
        }
    });
});
</script>
@endpush
