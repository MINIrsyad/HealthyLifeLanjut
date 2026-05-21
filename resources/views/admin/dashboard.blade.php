<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — HealthyLife</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: {
                pearl:'#FFFADD', herb:'#6A8042', radiate:'#ED7A13', moss:'#1E3006', gleam:'#FFE787'
            }, fontFamily: { poppins:['Poppins','sans-serif'] } } }
        }
    </script>
    <style>
        body{font-family:'Poppins',sans-serif;background:#1E3006;margin:0;}
        .sidebar{position:fixed;left:0;top:0;width:220px;height:100vh;background:#152204;
        display:flex;flex-direction:column;padding:2rem 1.5rem;z-index:100;box-shadow:4px 0 20px rgba(0,0,0,.3);}
        .sidebar-logo{color:#FFE787;font-size:1.3rem;font-weight:800;margin-bottom:2.5rem;display:flex;align-items:center;gap:.5rem;}
        .sidebar-label{color:rgba(255,231,135,.5);font-size:.7rem;text-transform:uppercase;letter-spacing:2px;margin-bottom:.8rem;margin-top:1rem;}
        .sidebar-link{display:flex;align-items:center;gap:.8rem;padding:.8rem 1rem;border-radius:12px;
        color:rgba(255,231,135,.7);text-decoration:none;font-weight:600;font-size:.9rem;transition:all .2s;margin-bottom:.3rem;}
        .sidebar-link:hover,.sidebar-link.active{background:#6A8042;color:#FFE787;}
        .sidebar-bottom{margin-top:auto;}
        .sidebar-user{background:rgba(255,231,135,.1);border-radius:12px;padding:.8rem 1rem;margin-bottom:.8rem;}
        .sidebar-user-name{color:#FFE787;font-weight:700;font-size:.85rem;}
        .sidebar-user-role{color:rgba(255,231,135,.6);font-size:.75rem;}
        .logout-btn{display:block;width:100%;background:#ED7A13;color:#fff;border:none;
        border-radius:12px;padding:.8rem;font-weight:700;font-size:.9rem;cursor:pointer;
        font-family:'Poppins',sans-serif;transition:all .2s;text-align:center;}
        .logout-btn:hover{background:#d4690f;}

        .main{margin-left:220px;padding:2rem;min-height:100vh;background:#f0f4e8;}
        .topbar{display:flex;justify-content:space-between;align-items:center;
        background:#fff;padding:1.2rem 2rem;border-radius:20px;margin-bottom:2rem;box-shadow:0 4px 20px rgba(0,0,0,.08);}
        .topbar h1{font-size:1.5rem;font-weight:800;color:#1E3006;}
        .topbar-time{color:#6A8042;font-size:.85rem;font-weight:600;}

        /* stat cards */
        .stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-bottom:2rem;}
        .stat-card{background:#fff;border-radius:20px;padding:1.5rem 2rem;box-shadow:0 4px 20px rgba(0,0,0,.08);
        border-top:4px solid transparent;transition:transform .2s;}
        .stat-card:hover{transform:translateY(-4px);}
        .stat-card.border-herb{border-top-color:#6A8042;}
        .stat-card.border-radiate{border-top-color:#ED7A13;}
        .stat-card.border-moss{border-top-color:#1E3006;}
        .stat-card.border-gleam{border-top-color:#FFE787;}
        .stat-num{font-size:2.5rem;font-weight:800;color:#1E3006;}
        .stat-label{color:#6A8042;font-size:.85rem;font-weight:600;margin-top:.2rem;}

        /* chart */
        .chart-section{display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;margin-bottom:2rem;}
        .card{background:#fff;border-radius:20px;padding:1.8rem;box-shadow:0 4px 20px rgba(0,0,0,.08);}
        .card-title{font-size:1.1rem;font-weight:800;color:#1E3006;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem;}
        .bar-chart{display:flex;align-items:flex-end;gap:.8rem;height:150px;}
        .bar-item{flex:1;display:flex;flex-direction:column;align-items:center;gap:.4rem;}
        .bar{width:100%;background:linear-gradient(180deg,#6A8042,#1E3006);border-radius:8px 8px 0 0;transition:height .6s;}
        .bar-label{font-size:.7rem;color:#6A8042;font-weight:600;}
        .bar-val{font-size:.72rem;color:#1E3006;font-weight:700;}

        .type-breakdown{}
        .type-row{display:flex;justify-content:space-between;align-items:center;
        padding:.8rem 1rem;border-radius:12px;margin-bottom:.5rem;background:#f0f4e8;}
        .type-row-label{display:flex;align-items:center;gap:.5rem;font-weight:600;color:#1E3006;font-size:.9rem;}
        .type-count{background:#1E3006;color:#FFE787;border-radius:50px;padding:.2rem .8rem;font-size:.75rem;font-weight:700;}

        /* table */
        .table-section{background:#fff;border-radius:20px;padding:2rem;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:2rem;}
        .table-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;}
        .badge-count{background:#6A8042;color:#fff;padding:.3rem .8rem;border-radius:50px;font-size:.8rem;font-weight:700;}
        table{width:100%;border-collapse:collapse;font-size:.88rem;}
        thead th{background:#f0f4e8;padding:.9rem 1rem;text-align:left;font-weight:700;
        color:#1E3006;font-size:.8rem;text-transform:uppercase;letter-spacing:.05em;}
        thead th:first-child{border-radius:10px 0 0 10px;}
        thead th:last-child{border-radius:0 10px 10px 0;}
        tbody tr{border-bottom:1px solid #f0f4e8;transition:background .15s;}
        tbody tr:hover{background:#fafdf5;}
        tbody td{padding:.85rem 1rem;color:#1E3006;vertical-align:middle;}
        .user-avatar{width:34px;height:34px;border-radius:50%;background:#6A8042;
        display:inline-flex;align-items:center;justify-content:center;color:#FFE787;font-weight:700;font-size:.9rem;margin-right:.6rem;}
        .status-badge{padding:.25rem .7rem;border-radius:50px;font-size:.72rem;font-weight:700;background:#6A8042;color:#fff;}

        /* log table */
        .log-table-section{background:#fff;border-radius:20px;padding:2rem;box-shadow:0 4px 20px rgba(0,0,0,.08);}
        .log-type-pill{padding:.2rem .6rem;border-radius:50px;font-size:.72rem;font-weight:700;}
        .pill-meal    {background:#6A8042;color:#fff;}
        .pill-water   {background:#3b82f6;color:#fff;}
        .pill-exercise{background:#ED7A13;color:#fff;}
        .pill-sleep   {background:#8b5cf6;color:#fff;}
        .pill-obesity {background:#ef4444;color:#fff;}
        .pill-mental  {background:#6366f1;color:#fff;}

        @media(max-width:1200px){.stats-row{grid-template-columns:repeat(2,1fr);}.chart-section{grid-template-columns:1fr;}}
        @media(max-width:768px){.sidebar{display:none;}.main{margin-left:0;}}
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-logo">🌿 HealthyLife<br><small style="font-size:.6rem;font-weight:400;opacity:.6;">Admin Panel</small></div>

    <div class="sidebar-label">Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">📊 Dashboard</a>
    <a href="{{ route('admin.articles.index') }}" class="sidebar-link">📰 Artikel</a>

    <div class="sidebar-bottom">
        <div class="sidebar-user">
            <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
            <div class="sidebar-user-role">Administrator</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">🚪 Keluar</button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<main class="main">
    {{-- TOPBAR --}}
    <div class="topbar">
        <h1>📊 Dashboard Pemantauan</h1>
        <div class="topbar-time">🕐 {{ now()->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB</div>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-row">
        <div class="stat-card border-herb">
            <div class="stat-num">{{ $totalUsers }}</div>
            <div class="stat-label">👥 Total Pengguna</div>
        </div>
        <div class="stat-card border-radiate">
            <div class="stat-num">{{ $totalLogs }}</div>
            <div class="stat-label">📋 Total Log</div>
        </div>
        <div class="stat-card border-moss">
            <div class="stat-num">{{ $todayLogs }}</div>
            <div class="stat-label">📅 Log Hari Ini</div>
        </div>
        <div class="stat-card border-gleam">
            <div class="stat-num">{{ $totalQuizzes }}</div>
            <div class="stat-label">🧪 Total Kuesioner</div>
        </div>
    </div>

    {{-- CHART + BREAKDOWN --}}
    <div class="chart-section">
        <div class="card">
            <div class="card-title">📈 Aktivitas 7 Hari Terakhir</div>
            <div class="bar-chart">
                @foreach($weeklyActivity as $day)
                @php $maxH = max(collect($weeklyActivity)->pluck('count')->max(), 1); @endphp
                <div class="bar-item">
                    <span class="bar-val">{{ $day['count'] }}</span>
                    <div class="bar" style="height:{{ max(8, ($day['count']/$maxH)*130) }}px;"></div>
                    <span class="bar-label">{{ $day['label'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-title">📊 Log Hari Ini</div>
            <div class="type-breakdown">
                @foreach([
                    ['🍽️','Makanan','meal','pill-meal'],
                    ['💧','Minuman','water','pill-water'],
                    ['💪','Olahraga','exercise','pill-exercise'],
                    ['😴','Tidur','sleep','pill-sleep'],
                ] as [$icon,$label,$type,$pill])
                <div class="type-row">
                    <div class="type-row-label">{{ $icon }} {{ $label }}</div>
                    <span class="type-count">{{ $todayBreakdown[$type] ?? 0 }}</span>
                </div>
                @endforeach
                <hr style="margin:1rem 0;border-color:#f0f4e8;">
                <div class="type-row">
                    <div class="type-row-label">🔴 Risiko Tinggi Obesitas</div>
                    <span class="type-count" style="background:#ef4444;">{{ $highRiskObesity }}</span>
                </div>
                <div class="type-row">
                    <div class="type-row-label">🔴 Risiko Tinggi Mental</div>
                    <span class="type-count" style="background:#6366f1;">{{ $highRiskMental }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- USER TABLE --}}
    <div class="table-section">
        <div class="table-header">
            <div class="card-title" style="margin:0;">👥 Daftar Pengguna</div>
            <span class="badge-count">{{ $totalUsers }} pengguna</span>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Total Log</th>
                        <th>Kuesioner</th>
                        <th>Bergabung</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td style="color:#6A8042;font-weight:700;">{{ $i+1 }}</td>
                        <td>
                            <span class="user-avatar">{{ strtoupper(substr($user->name,0,1)) }}</span>
                            <strong>{{ $user->name }}</strong>
                        </td>
                        <td style="color:#6A8042;">{{ $user->email }}</td>
                        <td><strong style="color:#1E3006;">{{ $user->daily_logs_count }}</strong></td>
                        <td>{{ $user->quiz_results_count }}</td>
                        <td style="color:#6A8042;font-size:.82rem;">{{ $user->created_at->locale('id')->isoFormat('D MMM Y') }}</td>
                        <td><span class="status-badge">Aktif</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- RECENT LOGS --}}
    <div class="log-table-section">
        <div class="table-header">
            <div class="card-title" style="margin:0;">📋 Log Aktivitas Terbaru</div>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Tipe</th>
                        <th>Detail</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentLogs as $log)
                    @php
                        $t = $log->type;
                        $detail = match($t) {
                            'food'     => ($log->data['meal_type']??'').': '.($log->data['food_name']??'').' ('.($log->data['calories']??0).' kkal)',
                            'water'    => ($log->data['drink_type']??'Air').': '.($log->data['amount']??0).' ml',
                            'exercise' => ($log->data['exercise_type']??'').': '.($log->data['duration']??0).' menit',
                            'sleep'    => 'Tidur '.($log->data['bedtime']??'').' — '.($log->data['waketime']??''),
                            default    => '-'
                        };
                        $pillMap = ['food'=>'pill-meal','water'=>'pill-water','exercise'=>'pill-exercise','sleep'=>'pill-sleep'];
                    @endphp
                    <tr>
                        <td><strong>{{ $log->user->name ?? 'N/A' }}</strong></td>
                        <td><span class="log-type-pill {{ $pillMap[$t] ?? 'pill-meal' }}">{{ ucfirst($t) }}</span></td>
                        <td style="font-size:.85rem;">{{ $detail }}</td>
                        <td style="color:#6A8042;font-size:.82rem;">{{ $log->created_at->locale('id')->isoFormat('D MMM, HH:mm') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- RECENT QUIZ --}}
    <div class="log-table-section" style="margin-top:1.5rem;">
        <div class="table-header">
            <div class="card-title" style="margin:0;">🧪 Hasil Kuesioner Terbaru</div>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr><th>Pengguna</th><th>Tipe</th><th>Skor / BMI</th><th>Risiko</th><th>Waktu</th></tr>
                </thead>
                <tbody>
                    @foreach($recentQuizzes as $qr)
                    @php
                        $rLevel = $qr->result_data['level'] ?? '-';
                        $rClass = ['Low Risk'=>'pill-meal','Moderate Risk'=>'pill-exercise','High Risk'=>'pill-obesity'][$rLevel] ?? 'pill-meal';
                        $detail = $qr->type === 'obesity'
                            ? 'BMI: '.($qr->result_data['bmi']??'-').' | Skor: '.($qr->result_data['score']??'-')
                            : 'Skor: '.($qr->result_data['score']??'-').'/20';
                    @endphp
                    <tr>
                        <td><strong>{{ $qr->user->name ?? 'N/A' }}</strong></td>
                        <td><span class="log-type-pill {{ $qr->type==='obesity' ? 'pill-obesity' : 'pill-mental' }}">{{ ucfirst($qr->type) }}</span></td>
                        <td style="font-size:.85rem;">{{ $detail }}</td>
                        <td><span class="log-type-pill {{ $rClass }}">{{ $rLevel }}</span></td>
                        <td style="color:#6A8042;font-size:.82rem;">{{ $qr->created_at->locale('id')->isoFormat('D MMM, HH:mm') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>
