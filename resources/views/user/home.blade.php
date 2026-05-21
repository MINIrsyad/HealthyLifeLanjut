@extends('layouts.app')
@section('title','HealthyLife — Pola Hidup Sehat Modern')

@push('styles')
<style>
/* ── HERO ── */
.hero{min-height:100vh;display:flex;align-items:center;justify-content:center;
background:linear-gradient(135deg,#6A8042 0%,#1E3006 100%);position:relative;overflow:hidden;}
.hero-content{text-align:center;z-index:2;padding:2rem;animation:fadeInUp 1s ease;color:#fff;}
.hero h1{font-size:5rem;font-weight:800;line-height:1.2;margin-bottom:1rem;}
.gradient-text{color:#FFE787;}
.hero p{font-size:1.3rem;margin-bottom:2rem;opacity:.95;max-width:600px;margin-left:auto;margin-right:auto;}
.cta-button{display:inline-block;padding:1rem 3rem;background:#ED7A13;color:#fff;
border-radius:50px;font-weight:700;transition:all .3s;box-shadow:0 10px 30px rgba(0,0,0,.3);
border:none;cursor:pointer;font-size:1rem;text-decoration:none;}
.cta-button:hover{transform:translateY(-5px);box-shadow:0 15px 40px rgba(237,122,19,.5);}
@keyframes fadeInUp{from{opacity:0;transform:translateY(50px)}to{opacity:1;transform:translateY(0)}}

/* ── INTERACTIVE ── */
.interactive-section{min-height:750px;background-image:url('/images/BackgroundJelajahi.png');
background-size:cover;background-position:center bottom;background-repeat:no-repeat;
display:flex;align-items:center;justify-content:center;position:relative;overflow:visible;}
.interactive-section::before{content:'';position:absolute;inset:0;background:rgba(255,250,221,.15);}
.interactive-content{position:absolute;top:8%;left:50%;transform:translateX(-50%);
text-align:center;z-index:2;padding:0 2rem;max-width:1200px;width:100%;}
.interactive-content h2{font-size:3.5rem;font-weight:800;color:#1E3006;
text-shadow:0 0 30px rgba(255,255,255,.8),0 0 30px rgba(255,255,255,.8);}
.instruction-text{background:#ED7A13;color:#fff;padding:1rem 2rem;border-radius:50px;
display:inline-block;font-weight:600;animation:pulse 2s infinite;margin-top:.8rem;}
@keyframes pulse{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}

.interactive-icons{position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;overflow:visible;}
.icon-link{position:absolute;text-decoration:none;color:#1E3006;
transition:all .4s cubic-bezier(.175,.885,.32,1.275);cursor:pointer;pointer-events:auto;
display:flex;flex-direction:column-reverse;align-items:center;transform:translate(-50%,-50%);}
.icon-link:hover{transform:translate(-50%,-50%) scale(1.12);}
.icon-link img{object-fit:contain;filter:drop-shadow(0 8px 16px rgba(0,0,0,.45));
transition:all .4s cubic-bezier(.175,.885,.32,1.275);}
.icon-link:hover img{filter:drop-shadow(0 10px 20px rgba(237,122,19,.6));}
.icon-label{margin-bottom:8px;background:#ED7A13;color:#fff;padding:4px 14px;
border-radius:20px;font-weight:700;font-size:.85rem;opacity:0;transform:translateY(-6px);
transition:all .3s ease;white-space:nowrap;box-shadow:0 4px 12px rgba(0,0,0,.2);}
.icon-link:hover .icon-label{opacity:1;transform:translateY(0);}
.link-nutrition{top:72%;left:20%;}.link-nutrition img{width:390px;height:390px;}
.link-exercise{top:56%;left:76%;}.link-exercise img{width:200px;height:200px;}
.link-tracker{top:53%;left:55%;}.link-tracker img{width:200px;height:200px;}
.link-quiz{top:56%;left:86%;}.link-quiz img{width:280px;height:280px;}

.character-container{position:absolute;bottom:10%;left:50%;transform:translateX(-50%);
width:250px;height:250px;transition:none;z-index:1;}
.character{width:100%;height:100%;background-size:contain;background-repeat:no-repeat;
background-position:center bottom;background-image:url('/images/child.png');transition:transform .1s ease;}
.character.facing-right{transform:scaleX(-1);}
.character.facing-left{transform:scaleX(1);}

/* ── ABOUT ── */
.about{background:#FFFADD;padding:8rem 5%;}
.section-title{font-size:3.5rem;font-weight:800;text-align:center;margin-bottom:4rem;color:#1E3006;}
.about-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem;max-width:1400px;margin:0 auto;}
.about-card{background:#fff;padding:3rem 2rem;border-radius:20px;text-align:center;
transition:all .4s cubic-bezier(.175,.885,.32,1.275);box-shadow:0 10px 40px rgba(0,0,0,.1);
position:relative;overflow:hidden;}
.about-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:5px;
background:#ED7A13;transform:scaleX(0);transition:transform .3s;}
.about-card:hover::before{transform:scaleX(1);}
.about-card:hover{transform:translateY(-15px);box-shadow:0 20px 60px rgba(106,128,66,.2);}
.about-card .icon{font-size:4rem;margin-bottom:1rem;}
.about-card h3{font-size:1.5rem;margin-bottom:1rem;color:#6A8042;}

/* ── EXERCISE SLIDER ── */
.exercise-section{background:#6A8042;overflow:hidden;padding:8rem 5%;}
.exercise-section .section-title{color:#FFE787;}
.slider-wrapper{position:relative;max-width:1200px;margin:0 auto;perspective:1000px;}
.exercise-slider{display:flex;transition:transform .6s cubic-bezier(.68,-.55,.265,1.55);gap:2rem;}
.exercise-slide{min-width:100%;height:500px;border-radius:30px;position:relative;
overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3);color:#fff;}
.exercise-slide .slide-bg{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;
transition:transform .6s ease;}
.exercise-slide:hover .slide-bg{transform:scale(1.05);}
.exercise-slide .slide-overlay{position:absolute;inset:0;background:rgba(0,0,0,.45);z-index:10;}
.exercise-slide .exercise-content{position:relative;z-index:20;display:flex;flex-direction:column;
justify-content:center;align-items:center;text-align:center;height:100%;padding:2rem 3rem;}
.exercise-content h3{font-size:2.5rem;margin-bottom:1.2rem;text-shadow:0 2px 12px rgba(0,0,0,.4);}
.exercise-content p{font-size:1.1rem;line-height:1.8;opacity:.95;max-width:650px;
text-shadow:0 1px 6px rgba(0,0,0,.3);}
.slider-controls{display:flex;justify-content:center;gap:1rem;margin-top:3rem;}
.slider-btn{width:60px;height:60px;border-radius:50%;border:none;background:#FFE787;
color:#1E3006;font-size:1.5rem;cursor:pointer;transition:all .3s;box-shadow:0 5px 20px rgba(0,0,0,.2);}
.slider-btn:hover{transform:scale(1.1);}
.slider-dots{display:flex;justify-content:center;gap:.8rem;margin-top:2rem;}
.dot{width:12px;height:12px;border-radius:50%;background:rgba(255,231,135,.3);cursor:pointer;transition:all .3s;}
.dot.active{width:40px;border-radius:10px;background:#FFE787;}

/* ── NUTRITION STICKER SECTION ── */
.nutrition-section{background-color:#2b5c3a;min-height:100vh;position:relative;
overflow:hidden;padding:1rem 0 3rem 0;display:flex;flex-direction:column;align-items:center;}
.nutrition-header{text-align:center;position:relative;z-index:10;}
.nutrition-title{color:#fff;font-size:5.5rem;font-weight:900;text-transform:uppercase;
letter-spacing:3px;margin-bottom:1rem;}
.nutrition-subtitle{background-color:#f7b443;color:#2a2a2a;display:inline-block;
padding:.8rem 3.5rem;border-radius:50px;font-size:2.2rem;font-weight:800;}
.nutrition-bg-shape{position:absolute;top:58%;left:50%;
transform:translate(-50%,-50%);width:92vw;height:65vh;
background-color:#346c44;border-radius:70px;z-index:1;pointer-events:none;}
.nutrition-content{position:absolute;top:0;left:0;width:100%;height:100%;
pointer-events:none;z-index:2;}
.nutrition-dim-overlay{position:absolute;top:-10%;left:-10vw;width:120vw;height:120%;
background-color:rgba(18,38,23,.85);opacity:0;transition:opacity .3s ease;
z-index:15;pointer-events:none;}
.nutrition-section:has(.nutri-img:hover,.nutri-label-container:hover) .nutrition-dim-overlay{opacity:1;}

.nutri-img{position:absolute;pointer-events:auto;filter:url('#sticker-effect');
transition:transform .4s cubic-bezier(.175,.885,.32,1.275);cursor:pointer;z-index:10;}
.nutri-lemak{top:30%;left:8%;width:22vw;min-width:220px;max-width:320px;transform:rotate(-10deg);}
.nutri-protein{top:28%;right:5%;width:26vw;min-width:250px;max-width:380px;transform:rotate(15deg);}
.nutri-karbo{top:58%;left:50%;transform:translate(-50%,-50%);width:25vw;min-width:280px;max-width:450px;z-index:5;}
.nutri-mineral{bottom:-8%;left:15%;width:35vw;min-width:320px;max-width:480px;transform:rotate(15deg);}
.nutri-vitamin{bottom:-7%;right:15%;width:30vw;min-width:280px;max-width:450px;transform:rotate(-5deg);}

.nutrition-content:has(.nutri-lemak:hover,.label-lemak:hover) .nutri-lemak{transform:rotate(-5deg) scale(1.1);z-index:20;}
.nutrition-content:has(.nutri-protein:hover,.label-protein:hover) .nutri-protein{transform:rotate(10deg) scale(1.1);z-index:20;}
.nutrition-content:has(.nutri-karbo:hover,.label-karbo:hover) .nutri-karbo{transform:translate(-50%,-50%) scale(1.1);z-index:20;}
.nutrition-content:has(.nutri-mineral:hover,.label-mineral:hover) .nutri-mineral{transform:rotate(5deg) scale(1.1);z-index:20;}
.nutrition-content:has(.nutri-vitamin:hover,.label-vitamin:hover) .nutri-vitamin{transform:rotate(-10deg) scale(1.1);z-index:20;}

.nutri-label-container{position:absolute;opacity:0;z-index:30;pointer-events:none;
transition:all .4s cubic-bezier(.175,.885,.32,1.275);display:flex;align-items:center;
justify-content:center;width:28vw;min-width:250px;max-width:420px;text-align:center;
transform:translate(-50%,-50%) scale(.85);}
.brush-bg{position:absolute;width:100%;height:auto;z-index:-1;}
.nutri-label-container h3{color:#fff;font-size:2.2rem;font-weight:900;text-transform:uppercase;
letter-spacing:2px;line-height:1.1;margin:0;padding-top:5px;}
.label-lemak{top:46%;left:19%;}
.label-protein{top:47%;left:82%;}
.label-karbo{top:58%;left:50%;}
.label-mineral{top:80%;left:30%;}
.label-vitamin{top:80%;left:70%;}
.nutrition-content:has(.nutri-lemak:hover,.label-lemak:hover) .label-lemak,
.nutrition-content:has(.nutri-protein:hover,.label-protein:hover) .label-protein,
.nutrition-content:has(.nutri-karbo:hover,.label-karbo:hover) .label-karbo,
.nutrition-content:has(.nutri-mineral:hover,.label-mineral:hover) .label-mineral,
.nutrition-content:has(.nutri-vitamin:hover,.label-vitamin:hover) .label-vitamin{
    opacity:1;transform:translate(-50%,-50%) scale(1);pointer-events:auto;cursor:pointer;}

/* ── AKTIVITAS PENDUKUNG ── */
.activity-section{background:#1E3006;padding:8rem 5%;}
.activity-section .section-title{color:#FFE787;}
.activity-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem;max-width:1400px;margin:0 auto;}
.activity-card{background:rgba(255,255,255,.06);border:2px solid rgba(255,231,135,.15);
border-radius:24px;padding:2.5rem 2rem;transition:all .4s cubic-bezier(.175,.885,.32,1.275);position:relative;overflow:hidden;}
.activity-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:4px;
background:#ED7A13;transform:scaleX(0);transition:transform .3s;transform-origin:left;}
.activity-card:hover::before{transform:scaleX(1);}
.activity-card:hover{background:rgba(255,231,135,.1);border-color:rgba(255,231,135,.4);
transform:translateY(-10px);box-shadow:0 20px 50px rgba(0,0,0,.3);}
.activity-icon{font-size:3rem;margin-bottom:1.2rem;display:block;}
.activity-card h3{font-size:1.2rem;font-weight:800;color:#FFE787;margin-bottom:.8rem;}
.activity-card p{font-size:.85rem;color:rgba(255,255,255,.75);line-height:1.7;}
.activity-tags{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1rem;}
.activity-tag{background:rgba(106,128,66,.4);color:#FFE787;font-size:.7rem;font-weight:600;
padding:.25rem .7rem;border-radius:50px;}

/* ── NEWS ARTICLES ── */
.news-section{background:#FFFADD;padding:8rem 5%;}
.news-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:2rem;max-width:1400px;margin:0 auto;}
.news-card{background:#fff;border-radius:24px;overflow:hidden;transition:all .4s cubic-bezier(.175,.885,.32,1.275);
box-shadow:0 8px 30px rgba(0,0,0,.08);text-decoration:none;display:block;border:2px solid transparent;}
.news-card:hover{transform:translateY(-10px);box-shadow:0 20px 50px rgba(106,128,66,.2);border-color:#6A8042;}
.news-card-img{width:100%;height:200px;object-fit:cover;background:#f0f4e8;}
.news-card-body{padding:1.8rem;}
.news-card-date{display:inline-block;background:#FFE787;color:#1E3006;font-size:.75rem;font-weight:700;
padding:.3rem .8rem;border-radius:50px;margin-bottom:.8rem;}
.news-card h3{font-size:1.15rem;font-weight:800;color:#1E3006;line-height:1.4;margin-bottom:.6rem;
display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.news-card p{font-size:.85rem;color:#6A8042;line-height:1.6;opacity:.8;
display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
.news-card-arrow{display:inline-flex;align-items:center;gap:.3rem;color:#ED7A13;font-weight:700;
font-size:.8rem;margin-top:1rem;opacity:0;transform:translateX(-8px);transition:all .3s;}
.news-card:hover .news-card-arrow{opacity:1;transform:translateX(0);}
.news-empty{text-align:center;padding:4rem 2rem;background:#fff;border-radius:24px;
box-shadow:0 8px 30px rgba(0,0,0,.06);max-width:600px;margin:0 auto;}

/* ── EXERCISE SLIDE LINK ── */
.exercise-slide .slide-link{position:absolute;inset:0;z-index:15;display:block;}

@media(max-width:768px){
.hero h1{font-size:3rem;}.section-title{font-size:2.5rem;}
.exercise-slide{height:360px;}
.exercise-content h3{font-size:1.8rem;}
.exercise-content p{font-size:.9rem;}
.nutrition-title{font-size:3rem;}.nutrition-subtitle{font-size:1.4rem;}
.link-exercise img { width:200px !important; height:200px !important; }
.link-tracker  img { width:200px !important; height:200px !important; }
.link-quiz     img { width:280px !important; height:280px !important; }
.link-exercise{top:65%;left:68%;}.link-tracker{top:58%;left:47%;}.link-quiz{top:60%;left:85%;}
.link-nutrition img{width:180px!important;height:180px!important;}
.news-grid{grid-template-columns:1fr;}
.activity-grid{grid-template-columns:1fr;}
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section id="home" class="hero">
    <div class="hero-content">
        <h1>Transform Your <br><span class="gradient-text">Healthy Life</span></h1>
        <p>Mulai perjalanan menuju gaya hidup yang lebih sehat dengan panduan lengkap, tracking harian, dan tips nutrisi yang tepat untuk Anda.</p>
        <a href="{{ route('user.tracker') }}" class="cta-button">Mulai Sekarang</a>
    </div>
</section>

{{-- INTERACTIVE CHARACTER --}}
<section id="interactive" class="interactive-section">
    <div class="interactive-content">
        <h2>Jelajahi Dunia Sehat</h2>
        <div class="instruction-text">🖱️ Gerakkan kursor untuk memandu karakter!</div>
    </div>
    <div class="interactive-icons">
        <a href="{{ route('user.tracker') }}" class="icon-link link-tracker">
            <img src="{{ asset('images/tracker.png') }}" alt="Tracker" onerror="this.style.display='none'">
            <span class="icon-label">Tracker</span>
        </a>
        <a href="#exercise" class="icon-link link-exercise">
            <img src="{{ asset('images/exercise.png') }}" alt="Exercise" onerror="this.style.display='none'">
            <span class="icon-label">Exercise</span>
        </a>
        <a href="{{ route('user.quiz') }}" class="icon-link link-quiz">
            <img src="{{ asset('images/quiz.png') }}" alt="Quiz" onerror="this.style.display='none'">
            <span class="icon-label">Quiz</span>
        </a>
        <a href="#nutrition" class="icon-link link-nutrition">
            <img src="{{ asset('images/nutrition.png') }}" alt="Nutrition" onerror="this.style.display='none'">
            <span class="icon-label">Nutrition</span>
        </a>
    </div>
    <div class="character-container" id="charContainer">
        <div class="character facing-right" id="charEl"></div>
    </div>
</section>

{{-- ABOUT --}}
<section id="about" class="about reveal">
    <h2 class="section-title">Kenapa Pola Hidup Sehat?</h2>
    <div class="about-grid">
        @foreach([
            ['🍎','Nutrisi Optimal','Dapatkan panduan lengkap tentang pola makan seimbang dengan nutrisi yang tepat untuk tubuh Anda.'],
            ['💪','Aktivitas Teratur','Program olahraga yang disesuaikan dengan kebutuhan dan kemampuan Anda untuk hasil maksimal.'],
            ['😴','Istirahat Cukup','Pelajari pentingnya kualitas tidur dan bagaimana mengoptimalkan waktu istirahat Anda.'],
            ['🧘','Mental Balance','Kelola stres dan jaga kesehatan mental dengan teknik mindfulness dan meditasi.'],
        ] as [$icon,$title,$desc])
        <div class="about-card">
            <div class="icon">{{ $icon }}</div>
            <h3>{{ $title }}</h3>
            <p>{{ $desc }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- EXERCISE SLIDER --}}
<section id="exercise" class="exercise-section reveal">
    <h2 class="section-title">Pilihan Olahraga Terbaik</h2>
    <div class="slider-wrapper">
        <div class="exercise-slider" id="exerciseSlider">
            @foreach([
                ['https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?w=600','Running','🏃 Berlari dan Jogging','Olahraga kardio yang efektif untuk meningkatkan kesehatan jantung dan membakar kalori. Mulai dengan jogging ringan 20-30 menit, 3-4 kali seminggu untuk hasil optimal.',url('/user/education#kardio')],
                ['https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600','Yoga','🧘 Yoga dan Meditasi','Kombinasi sempurna antara latihan fisik dan mental. Meningkatkan fleksibilitas, kekuatan, dan ketenangan pikiran dalam satu aktivitas.',url('/user/education#kardio')],
                ['https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=600','Gym','💪 Latihan Kekuatan','Bangun massa otot dan tingkatkan metabolisme tubuh. Program latihan beban terstruktur untuk pemula hingga advanced.',url('/user/education#beban')],
                [asset('images/berenang.jpg'),'Swimming','🏊 Berenang','Olahraga low-impact yang melatih seluruh tubuh. Ideal untuk semua usia dan tingkat kebugaran.',url('/user/education#kardio')],
                [asset('images/bersepeda.jpg'),'Cycling','🚴 Bersepeda','Ramah lingkungan dan menyenangkan. Tingkatkan stamina dan kekuatan kaki dengan bersepeda rutin.',url('/user/education#kardio')],
            ] as [$img,$alt,$title,$desc,$link])
            <div class="exercise-slide">
                <img src="{{ $img }}" alt="{{ $alt }}" class="slide-bg" onerror="this.src='https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?w=600'">
                <div class="slide-overlay"></div>
                <a href="{{ $link }}" class="slide-link" aria-label="{{ $alt }}"></a>
                <div class="exercise-content">
                    <h3>{{ $title }}</h3>
                    <p>{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="slider-controls">
            <button class="slider-btn" onclick="changeSlide(-1)">❮</button>
            <button class="slider-btn" onclick="changeSlide(1)">❯</button>
        </div>
        <div class="slider-dots" id="sliderDots"></div>
    </div>
</section>

{{-- NUTRITION STICKER --}}
<section id="nutrition" class="nutrition-section reveal">
    <div class="nutrition-header">
        <h2 class="nutrition-title">PANDUAN NUTRISI</h2>
        <div class="nutrition-subtitle">Untuk Tubuh yang Sehat</div>
    </div>
    <div class="nutrition-bg-shape"></div>
    <div class="nutrition-content">
        <div class="nutrition-dim-overlay"></div>
        <div class="nutri-label-container label-lemak" onclick="window.location.href='{{ route('user.education') }}#makronutrien'">
            <img src="{{ asset('images/element.png') }}" alt="Brush" class="brush-bg" onerror="this.style.display='none'">
            <h3>LEMAK SEHAT</h3>
        </div>
        <div class="nutri-label-container label-protein" onclick="window.location.href='{{ route('user.education') }}#makronutrien'">
            <img src="{{ asset('images/element.png') }}" alt="Brush" class="brush-bg" onerror="this.style.display='none'">
            <h3>PROTEIN</h3>
        </div>
        <div class="nutri-label-container label-karbo" onclick="window.location.href='{{ route('user.education') }}#makronutrien'">
            <img src="{{ asset('images/element.png') }}" alt="Brush" class="brush-bg" onerror="this.style.display='none'">
            <h3>KARBOHIDRAT</h3>
        </div>
        <div class="nutri-label-container label-mineral" onclick="window.location.href='{{ route('user.education') }}#makronutrien'">
            <img src="{{ asset('images/element.png') }}" alt="Brush" class="brush-bg" onerror="this.style.display='none'">
            <h3>MINERAL DAN<br>ELEKTROLIT</h3>
        </div>
        <div class="nutri-label-container label-vitamin" onclick="window.location.href='{{ route('user.education') }}#makronutrien'">
            <img src="{{ asset('images/element.png') }}" alt="Brush" class="brush-bg" onerror="this.style.display='none'">
            <h3>VITAMIN</h3>
        </div>
        <img src="{{ asset('images/lemak.png') }}"      alt="Lemak"      class="nutri-img nutri-lemak"   onerror="this.style.display='none'">
        <img src="{{ asset('images/protein.png') }}"    alt="Protein"    class="nutri-img nutri-protein" onerror="this.style.display='none'">
        <img src="{{ asset('images/karbohidrat.png') }}" alt="Karbohidrat" class="nutri-img nutri-karbo" onerror="this.style.display='none'">
        <img src="{{ asset('images/mineral.png') }}"    alt="Mineral"    class="nutri-img nutri-mineral" onerror="this.style.display='none'">
        <img src="{{ asset('images/vitamin.png') }}"    alt="Vitamin"    class="nutri-img nutri-vitamin" onerror="this.style.display='none'">
    </div>
</section>

{{-- ══════════ AKTIVITAS PENDUKUNG POLA HIDUP SEHAT ══════════ --}}
<section class="activity-section reveal">
    <h2 class="section-title">🌱 Aktivitas Pendukung Pola Hidup Sehat</h2>
    <div class="activity-grid">
        @foreach([
            ['🧘','Manajemen Stres & Mindfulness','Meditasi ringan 10 menit setiap pagi, latihan pernapasan dalam (deep breathing), dan journaling harian dapat secara signifikan menurunkan kadar kortisol — hormon stres yang memicu berbagai penyakit kronis.',['Meditasi','Pernapasan','Journaling']],
            ['📵','Pembatasan Screen Time','Paparan blue light dari gadget sebelum tidur mengganggu produksi melatonin dan menurunkan kualitas istirahat. Terapkan aturan "no screen" minimal 1 jam sebelum tidur, serta istirahatkan mata setiap 20 menit saat bekerja.',['Digital Detox','Kesehatan Mata','Kualitas Tidur']],
            ['🧼','Kebersihan Diri & Lingkungan','Cuci tangan dengan sabun minimal 20 detik, mandi teratur, serta jaga sirkulasi udara kamar. Lingkungan bersih mengurangi risiko infeksi dan meningkatkan kenyamanan hidup secara keseluruhan.',['Higienitas','Sirkulasi Udara','Pencegahan']],
            ['🤝','Hubungan Sosial Positif','Meluangkan waktu bersama keluarga, teman, atau komunitas terbukti menurunkan tingkat kecemasan dan depresi. Interaksi sosial yang bermakna meningkatkan produksi oksitosin dan serotonin.',['Keluarga','Komunitas','Kesehatan Mental']],
        ] as [$icon,$title,$desc,$tags])
        <div class="activity-card">
            <span class="activity-icon">{{ $icon }}</span>
            <h3>{{ $title }}</h3>
            <p>{{ $desc }}</p>
            <div class="activity-tags">
                @foreach($tags as $tag)
                <span class="activity-tag">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══════════ BERITA & ARTIKEL TERUPDATE ══════════ --}}
<section id="news" class="news-section reveal">
    <h2 class="section-title">📰 Berita & Artikel Terupdate</h2>

    @if($articles->count())
        <div class="news-grid">
            @foreach($articles as $article)
            <a href="{{ url('/user/education#article-' . $article->id) }}" class="news-card">
                @if($article->image)
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="news-card-img">
                @else
                    <div class="news-card-img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;background:#f0f4e8;">📄</div>
                @endif
                <div class="news-card-body">
                    <span class="news-card-date">{{ $article->published_at?->locale('id')->isoFormat('D MMMM Y') }}</span>
                    <h3>{{ $article->title }}</h3>
                    <p>{{ Str::limit(strip_tags($article->content), 120) }}</p>
                    <div class="news-card-arrow">Baca selengkapnya →</div>
                </div>
            </a>
            @endforeach
        </div>
    @else
        <div class="news-empty">
            <div style="font-size:3rem;margin-bottom:1rem;">📰</div>
            <p style="color:#1E3006;font-weight:700;font-size:1.1rem;">Belum ada artikel</p>
            <p style="color:#6A8042;font-size:.85rem;margin-top:.5rem;">Artikel kesehatan terbaru akan tampil di sini</p>
        </div>
    @endif
</section>

@endsection

@push('scripts')
<script>
// ── Exercise Slider ──
let currentSlide = 0;
const slides = document.querySelectorAll('.exercise-slide');
const totalSlides = slides.length;

function createDots() {
    const c = document.getElementById('sliderDots');
    for (let i = 0; i < totalSlides; i++) {
        const d = document.createElement('div');
        d.className = 'dot' + (i===0 ? ' active' : '');
        d.onclick = () => goToSlide(i);
        c.appendChild(d);
    }
}
function updateDots() {
    document.querySelectorAll('.dot').forEach((d,i) => d.classList.toggle('active', i===currentSlide));
}
function changeSlide(n) {
    currentSlide = (currentSlide + n + totalSlides) % totalSlides;
    document.getElementById('exerciseSlider').style.transform = `translateX(-${currentSlide * 100}%)`;
    updateDots();
}
function goToSlide(n) { currentSlide = n; changeSlide(0); }
createDots();
setInterval(() => changeSlide(1), 5000);

// ── Character Mouse Follow ──
const section = document.querySelector('.interactive-section');
const container = document.getElementById('charContainer');
const charEl = document.getElementById('charEl');
let lastX = 0;
if (section && container) {
    section.addEventListener('mousemove', e => {
        const rect = section.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;
        let pct = Math.max(45, Math.min(95, (mouseX / rect.width) * 100));
        container.style.left = pct + '%';
        charEl.className = 'character ' + (mouseX > lastX ? 'facing-right' : 'facing-left');
        lastX = mouseX;
    });
}
</script>
@endpush
