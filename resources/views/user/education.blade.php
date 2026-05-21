@extends('layouts.app')

@section('title', 'Edukasi Kesehatan')
@section('meta_description', 'Pelajari panduan nutrisi, defisit kalori, makronutrien, dan panduan olahraga untuk pemula.')

@push('styles')
<style>
    /* Article card hover */
    .article-card { transition: transform 0.2s, border-color 0.2s; }
    .article-card:hover { transform: translateY(-4px); border-color: #6A8042 !important; }

    /* Icon bubble */
    .icon-bubble {
        width: 56px; height: 56px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; flex-shrink: 0;
    }

    /* Macro bar */
    .macro-bar-fill { height: 8px; border-radius: 4px; transition: width 0.8s ease; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up { animation: fadeInUp 0.6s ease both; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>
@endpush

@section('content')

{{-- ════════════ HERO BANNER ════════════ --}}
<div class="bg-moss rounded-3xl p-8 md:p-12 mb-10 relative overflow-hidden fade-in-up">
    {{-- Decorative circles --}}
    <div class="absolute -top-8 -right-8 w-40 h-40 bg-herb rounded-full opacity-30"></div>
    <div class="absolute -bottom-6 right-24 w-24 h-24 bg-radiate rounded-full opacity-20"></div>

    <div class="relative z-10">
        <div class="inline-block bg-radiate text-white text-xs font-bold px-4 py-1.5 rounded-full mb-4">
            📚 Pusat Edukasi Kesehatan
        </div>
        <h1 class="text-gleam font-black text-3xl md:text-4xl leading-tight mb-3">
            Panduan Lengkap<br>
            <span class="text-radiate">Hidup Sehat</span> untuk Pemula
        </h1>
        <p class="text-pearl opacity-80 text-sm max-w-lg leading-relaxed">
            Mulai dari memahami nutrisi yang tepat, menghitung kebutuhan kalori,
            hingga panduan olahraga yang efektif — semua ada di sini.
        </p>
        <div class="flex flex-wrap gap-3 mt-6">
            @foreach(['#nutrisi','#kalori','#makronutrien','#kardio','#beban','#articles'] as $tag)
            <a href="{{ $tag }}" class="bg-herb text-pearl text-xs font-semibold px-4 py-2 rounded-full hover:bg-radiate transition-colors">
                {{ $tag }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ════════════ SECTION 1: NUTRISI SEIMBANG ════════════ --}}
<section id="nutrisi" class="mb-12">
    <div class="flex items-center gap-3 mb-6 fade-in-up">
        <div class="icon-bubble bg-herb text-white">🍎</div>
        <div>
            <h2 class="text-moss font-black text-2xl">Nutrisi Seimbang</h2>
            <p class="text-moss text-sm opacity-60">Fondasi utama kesehatan tubuh yang optimal</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        {{-- Card Utama - span 2 --}}
        <div class="md:col-span-2 bg-white rounded-2xl p-6 border-2 border-transparent article-card card-flat fade-in-up delay-1">
            <div class="flex items-start gap-4">
                <div class="icon-bubble bg-pearl">🥗</div>
                <div class="flex-1">
                    <h3 class="text-moss font-bold text-lg mb-2">Apa itu Nutrisi Seimbang?</h3>
                    <p class="text-moss text-sm leading-relaxed opacity-80 mb-4">
                        Nutrisi seimbang adalah pola makan yang mengandung semua zat gizi dalam jumlah yang tepat
                        sesuai kebutuhan tubuh. Terdiri dari <strong>karbohidrat</strong>, <strong>protein</strong>,
                        <strong>lemak sehat</strong>, <strong>vitamin</strong>, <strong>mineral</strong>, dan <strong>air</strong>.
                    </p>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([
                            ['🌾','Karbohidrat','50-60%','Energi utama','bg-gleam','text-moss'],
                            ['🥩','Protein','15-25%','Bangun otot','bg-herb','text-white'],
                            ['🥑','Lemak','20-30%','Hormon & otak','bg-moss','text-gleam'],
                        ] as [$icon,$name,$pct,$desc,$bg,$text])
                        <div class="{{ $bg }} {{ $text }} rounded-xl p-3 text-center">
                            <div class="text-xl mb-1">{{ $icon }}</div>
                            <div class="font-bold text-xs">{{ $name }}</div>
                            <div class="text-lg font-black">{{ $pct }}</div>
                            <div class="text-xs opacity-70">{{ $desc }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Side Card --}}
        <div class="bg-herb rounded-2xl p-6 text-white article-card border-2 border-transparent fade-in-up delay-2">
            <h3 class="font-bold text-base mb-4">🎯 Tips Piring Sehat</h3>
            <div class="space-y-3">
                @foreach([
                    ['½','Sayur & Buah','Isi setengah piring dengan warna-warni sayur dan buah segar'],
                    ['¼','Protein','Daging tanpa lemak, ikan, telur, atau tahu tempe'],
                    ['¼','Karbohidrat Kompleks','Nasi merah, oats, kentang, atau roti gandum'],
                ] as [$frac,$name,$desc])
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center font-black text-gleam text-sm flex-shrink-0">
                        {{ $frac }}
                    </div>
                    <div>
                        <div class="font-semibold text-sm">{{ $name }}</div>
                        <div class="text-xs opacity-70 mt-0.5">{{ $desc }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ════════════ SECTION 2: DEFISIT KALORI ════════════ --}}
<section id="kalori" class="mb-12">
    <div class="flex items-center gap-3 mb-6 fade-in-up">
        <div class="icon-bubble bg-radiate text-white">🔥</div>
        <div>
            <h2 class="text-moss font-black text-2xl">Defisit Kalori</h2>
            <p class="text-moss text-sm opacity-60">Prinsip dasar penurunan berat badan yang efektif</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white rounded-2xl p-6 border-2 border-transparent article-card card-flat fade-in-up delay-1">
            <div class="icon-bubble bg-pearl mb-3">⚖️</div>
            <h3 class="text-moss font-bold text-base mb-2">Kalori Masuk vs Keluar</h3>
            <p class="text-moss text-sm opacity-75 leading-relaxed">
                Penurunan berat badan terjadi saat kalori yang dikonsumsi <strong>lebih sedikit</strong>
                dari kalori yang dibakar. Defisit ideal: <span class="text-radiate font-bold">300–500 kkal/hari</span>.
            </p>
            <div class="mt-4 bg-pearl rounded-xl p-3 flex justify-between text-center">
                <div>
                    <div class="text-radiate font-black text-lg">🍽️</div>
                    <div class="text-xs text-moss font-semibold">Kalori Masuk</div>
                </div>
                <div class="self-center text-moss font-black text-xl">−</div>
                <div>
                    <div class="text-herb font-black text-lg">💪</div>
                    <div class="text-xs text-moss font-semibold">Kalori Keluar</div>
                </div>
                <div class="self-center text-moss font-black text-xl">=</div>
                <div>
                    <div class="text-moss font-black text-lg">📉</div>
                    <div class="text-xs text-moss font-semibold">Defisit</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border-2 border-transparent article-card card-flat fade-in-up delay-2">
            <div class="icon-bubble bg-pearl mb-3">🧮</div>
            <h3 class="text-moss font-bold text-base mb-2">Hitung TDEE Anda</h3>
            <p class="text-moss text-sm opacity-75 leading-relaxed mb-3">
                Total Daily Energy Expenditure (TDEE) = BMR × Faktor Aktivitas
            </p>
            <div class="space-y-2">
                @foreach([
                    ['Tidak aktif', '× 1.2'],
                    ['Ringan (1–3x/mgg)', '× 1.375'],
                    ['Sedang (3–5x/mgg)', '× 1.55'],
                    ['Aktif (6–7x/mgg)', '× 1.725'],
                ] as [$level,$factor])
                <div class="flex justify-between items-center bg-pearl rounded-lg px-3 py-2">
                    <span class="text-moss text-xs">{{ $level }}</span>
                    <span class="text-herb font-bold text-sm">{{ $factor }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-moss rounded-2xl p-6 text-white article-card border-2 border-transparent fade-in-up delay-3">
            <div class="text-gleam text-2xl mb-3">⚡</div>
            <h3 class="font-bold text-base mb-3">Panduan Defisit Aman</h3>
            <div class="space-y-3">
                @foreach([
                    ['🟢 Ringan', '-300 kkal', 'Turun ~0.3kg/minggu'],
                    ['🟡 Sedang', '-500 kkal', 'Turun ~0.5kg/minggu'],
                    ['🔴 Agresif', '-750 kkal', 'Risiko kehilangan otot'],
                ] as [$label,$deficit,$desc])
                <div class="bg-herb bg-opacity-40 rounded-xl px-4 py-3">
                    <div class="flex justify-between mb-0.5">
                        <span class="text-xs">{{ $label }}</span>
                        <span class="font-black text-gleam text-sm">{{ $deficit }}</span>
                    </div>
                    <span class="text-xs opacity-70">{{ $desc }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ════════════ SECTION 3: MAKRONUTRIEN ════════════ --}}
<section id="makronutrien" class="mb-12">
    <div class="flex items-center gap-3 mb-6 fade-in-up">
        <div class="icon-bubble bg-gleam text-moss">📊</div>
        <div>
            <h2 class="text-moss font-black text-2xl">Pembagian Makronutrien</h2>
            <p class="text-moss text-sm opacity-60">Karbo, protein, lemak, vitamin, dan mineral — proporsi ideal untuk tubuh sehat</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
        {{-- Karbohidrat --}}
        <div class="bg-gleam rounded-2xl p-5 article-card border-2 border-transparent fade-in-up delay-1">
            <div class="flex items-center gap-2 mb-3">
                <div class="text-2xl">🌾</div>
                <div>
                    <h3 class="text-moss font-black text-base">Karbohidrat</h3>
                    <span class="text-moss text-xs opacity-60">4 kkal/gram</span>
                </div>
                <span class="text-moss ml-auto font-black text-lg opacity-90">45–65%</span>
            </div>
            <div class="h-2 bg-black bg-opacity-10 rounded-full mb-3">
                <div class="macro-bar-fill bg-white bg-opacity-60" style="width:55%"></div>
            </div>
            <p class="text-moss text-xs leading-relaxed opacity-80 mb-3">Sumber energi utama otak dan otot. Pilih karbohidrat kompleks untuk energi stabil.</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach(['🌾 Nasi merah','🌽 Kentang','🥣 Oats','🍠 Ubi'] as $f)
                <div class="bg-black bg-opacity-10 rounded-lg px-2 py-1 text-moss text-xs">{{ $f }}</div>
                @endforeach
            </div>
        </div>

        {{-- Protein --}}
        <div class="bg-herb rounded-2xl p-5 article-card border-2 border-transparent fade-in-up delay-2">
            <div class="flex items-center gap-2 mb-3">
                <div class="text-2xl">🥩</div>
                <div>
                    <h3 class="text-white font-black text-base">Protein</h3>
                    <span class="text-white text-xs opacity-60">4 kkal/gram</span>
                </div>
                <span class="text-white ml-auto font-black text-lg opacity-90">15–30%</span>
            </div>
            <div class="h-2 bg-black bg-opacity-10 rounded-full mb-3">
                <div class="macro-bar-fill bg-white bg-opacity-60" style="width:22%"></div>
            </div>
            <p class="text-white text-xs leading-relaxed opacity-80 mb-3">Pembangun jaringan otot. Kebutuhan: 1.6–2.2g per kg berat badan untuk yang aktif berolahraga.</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach(['🐟 Ikan','🥚 Telur','🫘 Tahu/tempe','🐔 Ayam'] as $f)
                <div class="bg-black bg-opacity-10 rounded-lg px-2 py-1 text-white text-xs">{{ $f }}</div>
                @endforeach
            </div>
        </div>

        {{-- Lemak Sehat --}}
        <div class="bg-moss rounded-2xl p-5 article-card border-2 border-transparent fade-in-up delay-3">
            <div class="flex items-center gap-2 mb-3">
                <div class="text-2xl">🥑</div>
                <div>
                    <h3 class="text-gleam font-black text-base">Lemak Sehat</h3>
                    <span class="text-gleam text-xs opacity-60">9 kkal/gram</span>
                </div>
                <span class="text-gleam ml-auto font-black text-lg opacity-90">20–35%</span>
            </div>
            <div class="h-2 bg-black bg-opacity-10 rounded-full mb-3">
                <div class="macro-bar-fill bg-white bg-opacity-40" style="width:25%"></div>
            </div>
            <p class="text-gleam text-xs leading-relaxed opacity-80 mb-3">Penting untuk hormon, penyerapan vitamin larut lemak, dan kesehatan otak. Fokus lemak tak jenuh.</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach(['🥑 Alpukat','🫒 Zaitun','🐟 Salmon','🥜 Kacang'] as $f)
                <div class="bg-black bg-opacity-10 rounded-lg px-2 py-1 text-gleam text-xs">{{ $f }}</div>
                @endforeach
            </div>
        </div>

        {{-- Vitamin (BARU) --}}
        <div class="bg-white border-2 border-moss rounded-2xl p-5 article-card fade-in-up delay-4">
            <div class="flex items-center gap-2 mb-3">
                <div class="text-2xl">💊</div>
                <div>
                    <h3 class="text-moss font-black text-base">Vitamin</h3>
                    <span class="text-moss text-xs opacity-60">Mikronutrien</span>
                </div>
                <span class="text-radiate ml-auto font-black text-xs">Esensial</span>
            </div>
            <div class="h-2 bg-moss bg-opacity-10 rounded-full mb-3">
                <div class="macro-bar-fill" style="width:80%;background:#ED7A13"></div>
            </div>
            <p class="text-moss text-xs leading-relaxed opacity-80 mb-3">Mendukung sistem imun, regulasi metabolisme sel, dan kesehatan kulit. Vitamin A, B-kompleks, C, D, E, K.</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach(['🍊 Jeruk','🫐 Beri','🥬 Bayam','🥕 Wortel'] as $f)
                <div class="bg-pearl rounded-lg px-2 py-1 text-moss text-xs">{{ $f }}</div>
                @endforeach
            </div>
            <div class="mt-2 bg-pearl rounded-lg px-2 py-1.5 text-center">
                <span class="text-moss text-xs font-semibold">Kebutuhan harian: 100% RDA</span>
            </div>
        </div>

        {{-- Mineral & Elektrolit (BARU) --}}
        <div class="bg-gleam border-2 border-herb rounded-2xl p-5 article-card fade-in-up" style="animation-delay:.5s">
            <div class="flex items-center gap-2 mb-3">
                <div class="text-2xl">⚡</div>
                <div>
                    <h3 class="text-moss font-black text-base">Mineral & Elektrolit</h3>
                    <span class="text-moss text-xs opacity-60">Mikronutrien</span>
                </div>
                <span class="text-herb ml-auto font-black text-xs">Vital</span>
            </div>
            <div class="h-2 bg-moss bg-opacity-10 rounded-full mb-3">
                <div class="macro-bar-fill" style="width:70%;background:#6A8042"></div>
            </div>
            <p class="text-moss text-xs leading-relaxed opacity-80 mb-3">Menjaga keseimbangan cairan tubuh, mendukung fungsi saraf, dan kontraksi otot. Kalsium, Magnesium, Kalium, Natrium.</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach(['🥥 Air Kelapa','🍌 Pisang','🥑 Alpukat','🥬 Sayuran Hijau'] as $f)
                <div class="bg-white bg-opacity-60 rounded-lg px-2 py-1 text-moss text-xs">{{ $f }}</div>
                @endforeach
            </div>
            <div class="mt-2 bg-herb rounded-lg px-2 py-1.5 text-center">
                <span class="text-white text-xs font-semibold">Na, K, Ca, Mg — Keseimbangan Elektrolit</span>
            </div>
        </div>
    </div>
</section>


{{-- ════════════ SECTION 4: PANDUAN OLAHRAGA ════════════ --}}
<section id="kardio" class="mb-12">
    <div class="flex items-center gap-3 mb-6 fade-in-up">
        <div class="icon-bubble bg-radiate text-white">🏃</div>
        <div>
            <h2 class="text-moss font-black text-2xl">Panduan Olahraga Kardio</h2>
            <p class="text-moss text-sm opacity-60">Meningkatkan kesehatan jantung dan membakar kalori efektif</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            [
                'icon'=>'🚶','name'=>'Jalan Kaki','level'=>'Pemula',
                'duration'=>'20–30 menit','freq'=>'3–5x/minggu','intensity'=>'Ringan',
                'benefits'=>['Meningkatkan sirkulasi darah','Membakar 150–250 kkal/sesi','Rendah risiko cedera sendi','Cocok segala usia'],
                'desc'=>'Mulai dengan jalan kaki cepat 30 menit. Ideal untuk pemula yang baru memulai perjalanan sehat.'
            ],
            [
                'icon'=>'🏃','name'=>'Jogging','level'=>'Menengah',
                'duration'=>'25–45 menit','freq'=>'3–4x/minggu','intensity'=>'Sedang',
                'benefits'=>['Meningkatkan kapasitas paru-paru','Pembakaran lemak efisien 400–600 kkal/jam','Melatih daya tahan kardiovaskular','Meningkatkan kepadatan tulang'],
                'desc'=>'Lari ringan konsisten. Bakar lebih banyak kalori sambil melatih daya tahan jantung secara progresif.'
            ],
            [
                'icon'=>'🚴','name'=>'Bersepeda','level'=>'Semua Level',
                'duration'=>'30–60 menit','freq'=>'3–5x/minggu','intensity'=>'Ringan–Sedang',
                'benefits'=>['Low-impact, aman untuk sendi','Melatih otot paha & gluteus','Bakar 400–800 kkal/jam','Bisa indoor atau outdoor'],
                'desc'=>'Low-impact, cocok semua usia. Bisa indoor (sepeda statis) maupun outdoor di berbagai medan.'
            ],
            [
                'icon'=>'🏊','name'=>'Renang','level'=>'Semua Level',
                'duration'=>'20–45 menit','freq'=>'2–4x/minggu','intensity'=>'Sedang',
                'benefits'=>['Melatih seluruh otot tubuh','Sangat aman untuk sendi & tulang','Meningkatkan fleksibilitas','Ideal rehabilitasi cedera'],
                'desc'=>'Latihan seluruh tubuh yang menyenangkan. Ideal untuk yang memiliki masalah sendi atau cedera.'
            ],
        ] as $data)
        @php extract($data); @endphp
        <div class="bg-white rounded-2xl p-5 border-2 border-transparent article-card card-flat fade-in-up delay-1">
            <div class="text-3xl mb-2">{{ $icon }}</div>
            <h3 class="text-moss font-bold text-base mb-1">{{ $name }}</h3>
            <div class="inline-block bg-herb text-white text-xs font-semibold px-2.5 py-0.5 rounded-full mb-3">{{ $level }}</div>
            <p class="text-moss text-xs opacity-70 leading-relaxed mb-3">{{ $desc }}</p>
            <div class="space-y-1.5 mb-3">
                <div class="flex justify-between bg-pearl rounded-lg px-3 py-1.5">
                    <span class="text-moss text-xs opacity-60">⏱ Durasi</span>
                    <span class="text-moss font-semibold text-xs">{{ $duration }}</span>
                </div>
                <div class="flex justify-between bg-pearl rounded-lg px-3 py-1.5">
                    <span class="text-moss text-xs opacity-60">📅 Frekuensi</span>
                    <span class="text-moss font-semibold text-xs">{{ $freq }}</span>
                </div>
                <div class="flex justify-between bg-gleam rounded-lg px-3 py-1.5">
                    <span class="text-moss text-xs opacity-60">⚡ Intensitas</span>
                    <span class="text-moss font-semibold text-xs">{{ $intensity }}</span>
                </div>
            </div>
            <div class="bg-moss bg-opacity-5 rounded-xl p-3">
                <div class="text-moss text-xs font-bold mb-1.5">✅ Manfaat Utama:</div>
                <ul class="space-y-1">
                    @foreach($benefits as $b)
                    <li class="text-moss text-xs opacity-75 flex gap-1.5"><span class="text-herb">•</span>{{ $b }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</section>


{{-- ════════════ SECTION 5: PROGRAM GYM BERDASARKAN GOAL ════════════ --}}
<section id="beban" class="mb-12">
    <div class="flex items-center gap-3 mb-6 fade-in-up">
        <div class="icon-bubble bg-moss text-gleam">💪</div>
        <div>
            <h2 class="text-moss font-black text-2xl">Program Gym Berdasarkan Goal</h2>
            <p class="text-moss text-sm opacity-60">Pilih program latihan sesuai kondisi dan tujuan tubuh Anda</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

        {{-- KATEGORI 1: UNDERWEIGHT --}}
        <div class="bg-white rounded-2xl p-6 border-2 border-herb article-card fade-in-up delay-1">
            <div class="flex items-center gap-3 mb-4">
                <div class="icon-bubble bg-herb text-white">📈</div>
                <div>
                    <h3 class="text-moss font-bold text-base">Underweight</h3>
                    <span class="text-xs text-herb font-semibold">Fokus Bulking & Massa Otot</span>
                </div>
            </div>
            <div class="bg-herb bg-opacity-10 rounded-xl px-3 py-2 mb-4 flex gap-4 text-xs">
                <span class="text-moss"><strong>Set:</strong> 3–4 x 8–10 rep</span>
                <span class="text-moss"><strong>Istirahat:</strong> 90–120 dtk</span>
                <span class="text-radiate font-bold">Intensitas Tinggi</span>
            </div>
            <div class="space-y-2">
                @foreach([
                    ['Barbell Squat','barbell_squat.png','Compound — Paha & Glute'],
                    ['Bench Press','bench_press.png','Compound — Dada & Trisep'],
                    ['Overhead Press','overhead_press.png','Compound — Bahu & Trisep'],
                    ['Deadlift','deadlift.png','Compound — Punggung & Paha'],
                ] as [$move,$img,$muscle])
                <div class="flex items-center gap-3 bg-pearl rounded-xl px-3 py-2">
                    <img src="{{ asset('images/'.$img) }}" class="w-10 h-10 object-contain rounded-lg bg-white flex-shrink-0" alt="{{ $move }}" onerror="this.src='https://placehold.co/40x40/6A8042/fff?text=GYM'">
                    <div class="flex-1">
                        <div class="text-moss font-semibold text-xs">{{ $move }}</div>
                        <div class="text-herb text-xs opacity-70">{{ $muscle }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- KATEGORI 2: OBESE --}}
        <div class="bg-white rounded-2xl p-6 border-2 border-radiate article-card fade-in-up delay-2">
            <div class="flex items-center gap-3 mb-4">
                <div class="icon-bubble bg-radiate text-white">🔥</div>
                <div>
                    <h3 class="text-moss font-bold text-base">Obesitas</h3>
                    <span class="text-xs text-radiate font-semibold">Fokus Fat Loss & Proteksi Sendi</span>
                </div>
            </div>
            <div class="bg-radiate bg-opacity-10 rounded-xl px-3 py-2 mb-4 flex gap-4 text-xs">
                <span class="text-moss"><strong>Set:</strong> 3 x 12–15 rep</span>
                <span class="text-moss"><strong>Istirahat:</strong> 45–60 dtk</span>
                <span class="text-radiate font-bold">Intensitas Moderat</span>
            </div>
            <div class="space-y-2">
                @foreach([
                    ['Leg Press','leg_press.png','Mesin — Paha, aman sendi'],
                    ['Lat Pulldown','lat_pulldown.png','Mesin — Punggung atas'],
                    ['Seated Row','seated_row.png','Mesin — Punggung tengah'],
                    ['Chest Press Machine','chest_press.png','Mesin — Dada'],
                ] as [$move,$img,$muscle])
                <div class="flex items-center gap-3 bg-pearl rounded-xl px-3 py-2">
                    <img src="{{ asset('images/'.$img) }}" class="w-10 h-10 object-contain rounded-lg bg-white flex-shrink-0" alt="{{ $move }}" onerror="this.src='https://placehold.co/40x40/ED7A13/fff?text=GYM'">
                    <div class="flex-1">
                        <div class="text-moss font-semibold text-xs">{{ $move }}</div>
                        <div class="text-radiate text-xs opacity-70">{{ $muscle }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- KATEGORI 3: NORMAL (SIXPACK) --}}
        <div class="bg-white rounded-2xl p-6 border-2 border-moss article-card fade-in-up delay-3">
            <div class="flex items-center gap-3 mb-4">
                <div class="icon-bubble bg-moss text-gleam">⭐</div>
                <div>
                    <h3 class="text-moss font-bold text-base">Normal Weight</h3>
                    <span class="text-xs text-moss font-semibold">Fokus Rekomposisi & Sixpack</span>
                </div>
            </div>
            <div class="bg-moss bg-opacity-10 rounded-xl px-3 py-2 mb-4 flex gap-4 text-xs">
                <span class="text-moss"><strong>Set:</strong> 3 x 10–12 rep</span>
                <span class="text-moss"><strong>Core:</strong> sampai failure</span>
                <span class="text-herb font-bold">Mind-Muscle Focus</span>
            </div>
            <div class="space-y-2">
                @foreach([
                    ['Weighted Crunch','weighted_crunch.png','Core — Perut atas'],
                    ['Hanging Leg Raise','hanging_leg_raise.png','Core — Perut bawah'],
                    ['Plank Twist','plank_twist.png','Core — Oblique'],
                    ['Cable Crunch','cable_crunch.png','Core — Kontraksi maksimal'],
                ] as [$move,$img,$muscle])
                <div class="flex items-center gap-3 bg-pearl rounded-xl px-3 py-2">
                    <img src="{{ asset('images/'.$img) }}" class="w-10 h-10 object-contain rounded-lg bg-white flex-shrink-0" alt="{{ $move }}" onerror="this.src='https://placehold.co/40x40/1E3006/FFE787?text=GYM'">
                    <div class="flex-1">
                        <div class="text-moss font-semibold text-xs">{{ $move }}</div>
                        <div class="text-moss text-xs opacity-60">{{ $muscle }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- PRINSIP + STRUKTUR SESI (Sidebar bawah) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-moss rounded-2xl p-6 text-white">
            <h3 class="text-gleam font-bold text-base mb-4">📋 Prinsip Dasar Gym</h3>
                <div class="space-y-3">
                    @foreach([
                        ['Progressive Overload', 'Tingkatkan beban secara bertahap agar otot terus berkembang'],
                        ['Rest & Recovery', 'Otot tumbuh saat istirahat, bukan saat latihan'],
                        ['Form > Weight', 'Teknik benar lebih penting dari beban berat'],
                        ['Konsistensi', 'Latihan 3x/minggu secara konsisten lebih baik dari 7x tidak rutin'],
                    ] as [$title,$desc])
                    <div class="flex gap-3">
                        <div class="w-1.5 bg-radiate rounded-full flex-shrink-0 mt-1"></div>
                        <div>
                            <div class="font-semibold text-sm text-gleam">{{ $title }}</div>
                            <div class="text-xs opacity-70 mt-0.5">{{ $desc }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-radiate rounded-2xl p-5 text-white">
                <div class="text-2xl mb-2">⏱️</div>
                <h3 class="font-bold text-base mb-1">Struktur Sesi Latihan</h3>
                <div class="space-y-2 mt-3">
                    @foreach([
                        ['Warm Up', '5–10 menit', 'bg-white bg-opacity-20'],
                        ['Latihan Inti', '30–45 menit', 'bg-white bg-opacity-30'],
                        ['Cool Down', '5–10 menit', 'bg-white bg-opacity-20'],
                    ] as [$phase,$dur,$bg])
                    <div class="{{ $bg }} rounded-xl px-4 py-2.5 flex justify-between">
                        <span class="text-sm font-semibold">{{ $phase }}</span>
                        <span class="text-sm font-black">{{ $dur }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════ SECTION: ARTIKEL KESEHATAN ════════════ --}}
<section id="articles" class="mb-12">
    <div class="flex items-center gap-3 mb-6 fade-in-up">
        <div class="icon-bubble bg-radiate text-white">📰</div>
        <div>
            <h2 class="text-moss font-black text-2xl">Artikel Kesehatan</h2>
            <p class="text-moss text-sm opacity-60">Kumpulan berita dan informasi kesehatan terkini</p>
        </div>
    </div>

    @if($articles->count())
        <div class="space-y-6">
            @foreach($articles as $article)
            <div id="article-{{ $article->id }}"
                 class="bg-white rounded-2xl border-2 border-transparent hover:border-herb article-card overflow-hidden fade-in-up"
                 style="scroll-margin-top: 100px;">
                <div class="flex flex-col md:flex-row">
                    {{-- Gambar --}}
                    @if($article->image)
                        <div class="md:w-72 flex-shrink-0">
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                 class="w-full h-48 md:h-full object-cover">
                        </div>
                    @endif

                    {{-- Konten --}}
                    <div class="flex-1 p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-gleam text-moss text-xs font-bold px-3 py-1 rounded-full">
                                📅 {{ $article->published_at?->locale('id')->isoFormat('D MMMM Y') }}
                            </span>
                        </div>

                        <h3 class="text-moss font-extrabold text-xl mb-3 leading-tight">{{ $article->title }}</h3>

                        <div class="text-moss text-sm leading-relaxed opacity-80 whitespace-pre-line">{{ $article->content }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl p-12 text-center border-2 border-gray-100 fade-in-up">
            <div class="text-5xl mb-4">📰</div>
            <p class="text-moss font-bold text-lg">Belum ada artikel</p>
            <p class="text-herb text-sm mt-1 opacity-70">Artikel kesehatan akan muncul di sini setelah admin menambahkan konten</p>
        </div>
    @endif
</section>

{{-- ════════════ CTA TRACKER ════════════ --}}
<div class="bg-herb rounded-3xl p-8 text-center fade-in-up">
    <div class="text-4xl mb-3">📊</div>
    <h2 class="text-white font-black text-2xl mb-2">Siap Mulai Tracking?</h2>
    <p class="text-pearl opacity-80 text-sm mb-6 max-w-md mx-auto">
        Catat makanan, minuman, olahraga, dan tidur Anda hari ini untuk memulai perjalanan sehat yang terukur.
    </p>
    <a href="{{ route('user.tracker') }}"
       class="inline-block bg-radiate hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-full transition-colors text-sm">
        Buka Daily Tracker →
    </a>
</div>

@endsection


