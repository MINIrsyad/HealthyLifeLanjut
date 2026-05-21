@extends('layouts.app')
@section('title','Daily Tracker — HealthyLife')

@push('styles')
<style>
.tracker-hero{background:linear-gradient(135deg,#6A8042,#1E3006);padding:7rem 5% 3rem;text-align:center;color:#fff;}
.tracker-hero h1{font-size:3.5rem;font-weight:800;margin-bottom:.5rem;}
.tracker-hero p{opacity:.9;font-size:1.1rem;}
.tracker-body{background:#FFFADD;padding:3rem 5% 6rem;}

/* stat cards */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;max-width:1200px;margin:0 auto 3rem;}
.stat-card{background:#6A8042;padding:2rem;border-radius:20px;text-align:center;color:#fff;transition:transform .3s;box-shadow:0 10px 30px rgba(0,0,0,.2);}
.stat-card:hover{transform:scale(1.05);}
.stat-card h3{font-size:2.8rem;font-weight:800;margin-bottom:.4rem;}
.stat-card p{opacity:.9;font-size:.9rem;}
.stat-card .target{font-size:.75rem;opacity:.7;margin-top:.3rem;}

/* tabs */
.log-interface{max-width:1200px;margin:0 auto;}
.log-tabs{display:flex;justify-content:center;gap:1.5rem;margin-bottom:2.5rem;flex-wrap:wrap;}
.tab-btn{padding:1rem 2.5rem;border:none;background:#fff;color:#1E3006;border-radius:50px;
font-weight:600;font-size:1rem;cursor:pointer;transition:all .3s;box-shadow:0 5px 20px rgba(0,0,0,.1);
font-family:'Poppins',sans-serif;}
.tab-btn:hover{transform:translateY(-3px);box-shadow:0 8px 30px rgba(0,0,0,.15);}
.tab-btn.active{background:#6A8042;color:#fff;transform:scale(1.05);}

/* panel */
.log-panel{background:#fff;padding:3rem;border-radius:30px;box-shadow:0 20px 60px rgba(0,0,0,.1);}
.tab-content{display:none;animation:fadeIn .5s;}
.tab-content.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}

.log-panel h3{font-size:1.6rem;font-weight:800;color:#1E3006;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem;}
.form-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.5rem;margin-bottom:2rem;}
.input-group label{display:block;margin-bottom:.5rem;font-weight:600;color:#6A8042;font-size:.9rem;}
.input-group input,.input-group select,.input-group textarea{
width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:15px;
font-family:'Poppins',sans-serif;font-size:.95rem;transition:all .3s;outline:none;}
.input-group input:focus,.input-group select:focus,.input-group textarea:focus{
border-color:#6A8042;box-shadow:0 0 0 4px rgba(106,128,66,.1);}
.submit-btn{width:100%;padding:1.2rem;background:#ED7A13;color:#fff;border:none;
border-radius:50px;font-weight:700;font-size:1.1rem;cursor:pointer;transition:all .3s;
font-family:'Poppins',sans-serif;box-shadow:0 10px 30px rgba(237,122,19,.3);}
.submit-btn:hover{transform:translateY(-3px);box-shadow:0 15px 40px rgba(237,122,19,.4);}

/* log entries */
.log-entries{margin-top:2rem;}
.log-entries h4{color:#1E3006;font-weight:700;margin-bottom:1rem;font-size:1rem;}
.log-entry{background:linear-gradient(135deg,#FFFADD,#FFE787);padding:1.2rem 1.5rem;
border-radius:15px;margin-bottom:.8rem;border-left:5px solid #ED7A13;
animation:slideIn .3s;display:flex;justify-content:space-between;align-items:center;}
@keyframes slideIn{from{opacity:0;transform:translateX(-20px)}to{opacity:1;transform:translateX(0)}}
.log-entry-text strong{color:#1E3006;font-size:.95rem;}
.log-entry-text small{color:#6A8042;font-size:.82rem;display:block;margin-top:.2rem;}
.delete-btn{background:none;border:none;color:#ED7A13;cursor:pointer;font-size:1.1rem;
padding:.3rem .5rem;border-radius:8px;transition:all .2s;}
.delete-btn:hover{background:#ED7A13;color:#fff;}
.empty-state{text-align:center;padding:3rem;color:#6A8042;opacity:.6;}
.empty-state .empty-icon{font-size:3rem;margin-bottom:.5rem;}

/* history */
.history-section{max-width:1200px;margin:3rem auto 0;}
.history-title{font-size:1.8rem;font-weight:800;color:#1E3006;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem;}
.history-day{background:#fff;border-radius:20px;padding:2rem;margin-bottom:1.5rem;box-shadow:0 8px 30px rgba(0,0,0,.08);}
.history-day-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;padding-bottom:1rem;border-bottom:2px solid #FFFADD;}
.history-day-header h4{font-weight:700;color:#1E3006;}
.history-day-header .day-stats{display:flex;gap:1rem;font-size:.8rem;color:#6A8042;font-weight:600;}
.history-item{padding:.6rem .8rem;margin-bottom:.4rem;border-radius:10px;font-size:.85rem;
background:#FFFADD;display:flex;justify-content:space-between;}
.badge{padding:.2rem .7rem;border-radius:50px;font-size:.72rem;font-weight:700;}
.badge-meal{background:#6A8042;color:#fff;}
.badge-water{background:#3b82f6;color:#fff;}
.badge-exercise{background:#ED7A13;color:#fff;}
.badge-sleep{background:#8b5cf6;color:#fff;}

@media(max-width:768px){
.tracker-hero h1{font-size:2.5rem;}
.log-tabs{gap:.8rem;}
.tab-btn{padding:.8rem 1.5rem;font-size:.9rem;}
.log-panel{padding:1.5rem;}
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="tracker-hero">
    <h1>📊 Daily Tracker</h1>
    <p>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }} — Catat aktivitas sehat Anda hari ini</p>
</div>

<div class="tracker-body">

    {{-- STAT CARDS (realtime dari log hari ini) --}}
    <div class="stats-grid">
        <div class="stat-card">
            <h3>{{ $todayStats['calories'] }}</h3>
            <p>🍽️ Kalori Masuk</p>
            <div class="target">Target: 2000 kkal</div>
        </div>
        <div class="stat-card">
            <h3>{{ $todayStats['water'] }}</h3>
            <p>💧 Air Minum (ml)</p>
            <div class="target">Target: 2000 ml</div>
        </div>
        <div class="stat-card">
            <h3>{{ $todayStats['exercise'] }}</h3>
            <p>💪 Olahraga (menit)</p>
            <div class="target">Target: 30 menit</div>
        </div>
        <div class="stat-card">
            <h3>{{ $todayStats['sleep'] }}</h3>
            <p>😴 Tidur (jam)</p>
            <div class="target">Target: 8 jam</div>
        </div>
    </div>

    <div class="log-interface">
        {{-- TABS --}}
        <div class="log-tabs">
            <button class="tab-btn active" onclick="switchTab('food',this)">🍽️ Makanan</button>
            <button class="tab-btn" onclick="switchTab('water',this)">💧 Minuman</button>
            <button class="tab-btn" onclick="switchTab('exercise',this)">💪 Olahraga</button>
            <button class="tab-btn" onclick="switchTab('sleep',this)">😴 Istirahat</button>
        </div>

        <div class="log-panel">

            {{-- ── TAB MAKANAN ── --}}
            <div id="food-tab" class="tab-content active">
                <h3>🍽️ Log Makanan</h3>
                <form method="POST" action="{{ route('user.tracker.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="food">
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Tipe Hidangan</label>
                            <select name="meal_type" required>
                                <option value="Sarapan">🌅 Sarapan</option>
                                <option value="Makan Siang">☀️ Makan Siang</option>
                                <option value="Makan Malam">🌙 Makan Malam</option>
                                <option value="Camilan">🍪 Camilan</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Nama Makanan</label>
                            <input type="text" name="food_name" placeholder="cth. Nasi goreng" required>
                        </div>
                        <div class="input-group">
                            <label>Kalori (kkal)</label>
                            <input type="number" name="calories" placeholder="350" required min="0">
                        </div>
                        <div class="input-group">
                            <label>Protein (g)</label>
                            <input type="number" step="0.1" name="protein" placeholder="20" required min="0">
                        </div>
                        <div class="input-group">
                            <label>Karbohidrat (g)</label>
                            <input type="number" step="0.1" name="carbs" placeholder="45" required min="0">
                        </div>
                        <div class="input-group">
                            <label>Lemak (g)</label>
                            <input type="number" step="0.1" name="fat" placeholder="12" required min="0">
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">+ Tambah Makanan</button>
                </form>
                <div class="log-entries">
                    @if($todayLogs->where('type','food')->count())
                        <h4>Hari Ini:</h4>
                        @foreach($todayLogs->where('type','food') as $log)
                        <div class="log-entry">
                            <div class="log-entry-text">
                                <strong>{{ $log->data['meal_type'] ?? '' }} — {{ $log->data['food_name'] ?? '' }}</strong>
                                <small>{{ $log->data['calories'] ?? 0 }} kkal · P:{{ $log->data['protein'] ?? 0 }}g · K:{{ $log->data['carbs'] ?? 0 }}g · L:{{ $log->data['fat'] ?? 0 }}g</small>
                            </div>
                            <form method="POST" action="{{ route('user.tracker.destroy', $log->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn" title="Hapus">✕</button>
                            </form>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state"><div class="empty-icon">🍽️</div><p>Belum ada log makanan hari ini</p></div>
                    @endif
                </div>
            </div>

            {{-- ── TAB MINUMAN ── --}}
            <div id="water-tab" class="tab-content">
                <h3>💧 Log Minuman</h3>
                <form method="POST" action="{{ route('user.tracker.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="water">
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Jumlah (ml)</label>
                            <input type="number" name="amount" value="250" step="50" required min="0">
                        </div>
                        <div class="input-group">
                            <label>Waktu</label>
                            <input type="time" name="time" value="{{ now()->format('H:i') }}" required>
                        </div>
                        <div class="input-group">
                            <label>Jenis Minuman</label>
                            <select name="drink_type">
                                <option value="Air Putih">💧 Air Putih</option>
                                <option value="Jus Buah">🍹 Jus Buah</option>
                                <option value="Teh">🍵 Teh</option>
                                <option value="Susu">🥛 Susu</option>
                                <option value="Lainnya">🥤 Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">+ Tambah Minuman</button>
                </form>
                <div class="log-entries">
                    @if($todayLogs->where('type','water')->count())
                        <h4>Hari Ini:</h4>
                        @foreach($todayLogs->where('type','water') as $log)
                        <div class="log-entry">
                            <div class="log-entry-text">
                                <strong>{{ $log->data['drink_type'] ?? 'Air' }} — {{ $log->data['amount'] ?? 0 }} ml</strong>
                                <small>Pukul {{ $log->data['time'] ?? '' }}</small>
                            </div>
                            <form method="POST" action="{{ route('user.tracker.destroy', $log->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn">✕</button>
                            </form>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state"><div class="empty-icon">💧</div><p>Belum ada log minuman hari ini</p></div>
                    @endif
                </div>
            </div>

            {{-- ── TAB OLAHRAGA ── --}}
            <div id="exercise-tab" class="tab-content">
                <h3>💪 Log Olahraga</h3>
                <form method="POST" action="{{ route('user.tracker.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="exercise">
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Jenis Olahraga</label>
                            <select name="exercise_type" required>
                                <option value="Lari">🏃 Lari / Jogging</option>
                                <option value="Yoga">🧘 Yoga</option>
                                <option value="Gym">💪 Gym / Beban</option>
                                <option value="Renang">🏊 Renang</option>
                                <option value="Sepeda">🚴 Bersepeda</option>
                                <option value="Jalan Kaki">🚶 Jalan Kaki</option>
                                <option value="Lainnya">⚡ Lainnya</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Durasi (menit)</label>
                            <input type="number" name="duration" placeholder="30" required min="1">
                        </div>
                        <div class="input-group">
                            <label>Kalori Terbakar</label>
                            <input type="number" name="burned" placeholder="200" required min="0">
                        </div>
                        <div class="input-group">
                            <label>Intensitas</label>
                            <select name="intensity" required>
                                <option value="Ringan">🟢 Ringan</option>
                                <option value="Sedang">🟡 Sedang</option>
                                <option value="Berat">🔴 Berat</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">+ Tambah Olahraga</button>
                </form>
                <div class="log-entries">
                    @if($todayLogs->where('type','exercise')->count())
                        <h4>Hari Ini:</h4>
                        @foreach($todayLogs->where('type','exercise') as $log)
                        <div class="log-entry">
                            <div class="log-entry-text">
                                <strong>{{ $log->data['exercise_type'] ?? '' }} — {{ $log->data['duration'] ?? 0 }} menit</strong>
                                <small>{{ $log->data['burned'] ?? 0 }} kkal terbakar · Intensitas: {{ $log->data['intensity'] ?? '' }}</small>
                            </div>
                            <form method="POST" action="{{ route('user.tracker.destroy', $log->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn">✕</button>
                            </form>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state"><div class="empty-icon">💪</div><p>Belum ada log olahraga hari ini</p></div>
                    @endif
                </div>
            </div>

            {{-- ── TAB TIDUR ── --}}
            <div id="sleep-tab" class="tab-content">
                <h3>😴 Log Istirahat</h3>
                <form method="POST" action="{{ route('user.tracker.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="sleep">
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Jam Tidur</label>
                            <input type="time" name="bedtime" required>
                        </div>
                        <div class="input-group">
                            <label>Jam Bangun</label>
                            <input type="time" name="waketime" required>
                        </div>
                        <div class="input-group">
                            <label>Kualitas Tidur (1-10)</label>
                            <input type="number" name="quality" min="1" max="10" placeholder="7" required>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom:2rem;">
                        <label>Catatan</label>
                        <textarea name="notes" rows="3" placeholder="Mimpi buruk? Insomnia? Tidur nyenyak?"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">+ Tambah Log Tidur</button>
                </form>
                <div class="log-entries">
                    @if($todayLogs->where('type','sleep')->count())
                        <h4>Hari Ini:</h4>
                        @foreach($todayLogs->where('type','sleep') as $log)
                        @php
                            $bed = $log->data['bedtime'] ?? '00:00';
                            $wake = $log->data['waketime'] ?? '00:00';
                            [$bh,$bm] = explode(':',$bed);
                            [$wh,$wm] = explode(':',$wake);
                            $dur = (($wh*60+$wm)-($bh*60+$bm)+1440)%1440/60;
                        @endphp
                        <div class="log-entry">
                            <div class="log-entry-text">
                                <strong>Tidur {{ $bed }} — Bangun {{ $wake }} ({{ number_format($dur,1) }} jam)</strong>
                                <small>Kualitas: {{ $log->data['quality'] ?? '-' }}/10{{ isset($log->data['notes']) && $log->data['notes'] ? ' · '.$log->data['notes'] : '' }}</small>
                            </div>
                            <form method="POST" action="{{ route('user.tracker.destroy', $log->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn">✕</button>
                            </form>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state"><div class="empty-icon">😴</div><p>Belum ada log tidur hari ini</p></div>
                    @endif
                </div>
            </div>

        </div>{{-- end log-panel --}}
    </div>{{-- end log-interface --}}

    {{-- HISTORY HARI SEBELUMNYA --}}
    @if($historyLogs->count())
    <div class="history-section">
        <h2 class="history-title">📅 Riwayat Hari Sebelumnya</h2>
        @foreach($historyLogs as $date => $dayLogs)
        @php
            $dayCal  = $dayLogs->where('type','food')->sum(fn($l) => $l->data['calories'] ?? 0);
            $dayWater= $dayLogs->where('type','water')->sum(fn($l) => $l->data['amount'] ?? 0);
            $dayExer = $dayLogs->where('type','exercise')->sum(fn($l) => $l->data['duration'] ?? 0);
        @endphp
        <div class="history-day">
            <div class="history-day-header">
                <h4>📅 {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h4>
                <div class="day-stats">
                    <span>🍽️ {{ $dayCal }} kkal</span>
                    <span>💧 {{ $dayWater }} ml</span>
                    <span>💪 {{ $dayExer }} mnt</span>
                </div>
            </div>
            @foreach($dayLogs as $log)
            @php
                $typeMap = ['food'=>['badge-meal','🍽️'],'water'=>['badge-water','💧'],'exercise'=>['badge-exercise','💪'],'sleep'=>['badge-sleep','😴']];
                [$badgeClass,$icon] = $typeMap[$log->type] ?? ['badge-meal','📝'];
                $label = match($log->type) {
                    'food'     => ($log->data['meal_type']??'').' — '.($log->data['food_name']??'').' ('.($log->data['calories']??0).' kkal)',
                    'water'    => ($log->data['drink_type']??'Air').' — '.($log->data['amount']??0).' ml',
                    'exercise' => ($log->data['exercise_type']??'').' — '.($log->data['duration']??0).' menit',
                    'sleep'    => 'Tidur '.($log->data['bedtime']??'').' s/d '.($log->data['waketime']??''),
                    default    => '-'
                };
            @endphp
            <div class="history-item">
                <span>{{ $icon }} {{ $label }}</span>
                <span class="badge {{ $badgeClass }}">{{ ucfirst($log->type) }}</span>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @else
    <div class="history-section">
        <div class="empty-state" style="background:#fff;border-radius:20px;padding:3rem;">
            <div class="empty-icon">📋</div>
            <p>Belum ada riwayat hari sebelumnya<br><small>Mulai catat aktivitas Anda hari ini!</small></p>
        </div>
    </div>
    @endif

</div>{{-- end tracker-body --}}
@endsection

@push('scripts')
<script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(tab + '-tab').classList.add('active');
    btn.classList.add('active');
}

// Buka tab dari URL hash (misal /tracker#water)
const hash = window.location.hash.replace('#','');
if (['food','water','exercise','sleep'].includes(hash)) {
    document.querySelectorAll('.tab-btn').forEach(b => {
        if (b.getAttribute('onclick') && b.getAttribute('onclick').includes("'"+hash+"'")) b.click();
    });
}
</script>
@endpush
