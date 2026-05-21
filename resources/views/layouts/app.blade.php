<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>@yield('title', 'HealthyLife') — Pola Hidup Sehat Modern</title>
    <meta name="description" content="@yield('meta_description', 'HealthyLife — Mulai perjalanan hidup sehat dengan tracker harian, panduan nutrisi, dan kuesioner kesehatan.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pearl:  '#FFFADD',
                        herb:   '#6A8042',
                        radiate:'#ED7A13',
                        moss:   '#1E3006',
                        gleam:  '#FFE787',
                    },
                    fontFamily: { poppins: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --herb: #6A8042; --gleam: #FFE787; --pearl: #FFFADD;
            --radiate: #ED7A13; --moss: #1E3006; --white: #ffffff;
        }
        html, body { width: 100%; max-width: 100%; overflow-x: hidden; }
        body { font-family: 'Poppins', sans-serif; background: var(--pearl); color: var(--moss); }
        html { scroll-behavior: smooth; }

        /* ── NAVBAR ── */
        #hl-nav {
            position: fixed; top: 0; width: 100%;
            padding: 1.2rem 5%; z-index: 1000;
            transition: all 0.3s ease; background: transparent;
        }
        #hl-nav.scrolled {
            background: rgba(30, 48, 6, 0.96);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 30px rgba(0,0,0,.3);
        }
        .nav-inner {
            max-width: 1400px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
            position: relative;
        }
        .nav-logo {
            font-size: 1.6rem; font-weight: 800;
            color: var(--gleam); cursor: pointer; text-decoration: none;
        }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; align-items: center; }
        @media (min-width: 1024px) {
            .nav-links { position: absolute; left: 50%; transform: translateX(-50%); }
        }
        .nav-links a {
            color: var(--moss); text-decoration: none; font-weight: 600;
            position: relative; transition: color .3s;
        }
        #hl-nav.scrolled .nav-links a { color: var(--gleam); }
        .nav-links a::after {
            content: ''; position: absolute; bottom: -5px; left: 0;
            width: 0; height: 2px; background: var(--radiate); transition: width .3s;
        }
        .nav-links a:hover::after { width: 100%; }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-user {
            background: var(--gleam); color: var(--moss);
            padding: .4rem 1rem; border-radius: 50px;
            font-weight: 700; font-size: .85rem;
        }
        .nav-logout {
            background: var(--radiate); color: white;
            padding: .4rem 1.2rem; border-radius: 50px;
            font-weight: 700; font-size: .85rem;
            border: none; cursor: pointer; text-decoration: none;
            transition: transform .2s;
        }
        .nav-logout:hover { transform: translateY(-2px); }

        /* ── REVEAL ANIMATION ── */
        .reveal { opacity: 0; transform: translateY(50px); transition: all .8s cubic-bezier(.175,.885,.32,1.275); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* ── FLASH MESSAGES ── */
        .flash-msg {
            position: fixed; top: 80px; right: 1.5rem; z-index: 9999;
            padding: .875rem 1.5rem; border-radius: 16px; font-weight: 600;
            font-size: .875rem; animation: slideInRight .4s ease;
            box-shadow: 0 8px 24px rgba(0,0,0,.15);
        }
        .flash-success { background: var(--herb); color: white; }
        .flash-error   { background: var(--radiate); color: white; }
        @keyframes slideInRight { from { opacity:0; transform:translateX(60px); } to { opacity:1; transform:none; } }

        /* ── FOOTER ── */
        footer { background: var(--moss); color: var(--gleam); text-align: center; padding: 2.5rem; font-size: .9rem; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--pearl); }
        ::-webkit-scrollbar-thumb { background: var(--herb); border-radius: 3px; }

        @yield('page_css')
    </style>

    @stack('styles')

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    {{-- ── SVG STICKER FILTER (persis dari WEB.html) ── --}}
    <svg style="position:absolute;width:0;height:0;left:0;top:0;pointer-events:none;" aria-hidden="true" focusable="false">
        <filter id="sticker-effect" x="-50%" y="-50%" width="200%" height="200%">
            <feMorphology in="SourceAlpha" operator="dilate" radius="10" result="THICKENED"/>
            <feColorMatrix in="THICKENED" type="matrix"
                values="0 0 0 0 1
                        0 0 0 0 1
                        0 0 0 0 1
                        0 0 0 1 0" result="WHITE_OUTLINE"/>
            <feDropShadow in="WHITE_OUTLINE" dx="0" dy="15" stdDeviation="8" flood-color="#000000" flood-opacity="0.25" result="SHADOW"/>
            <feMerge>
                <feMergeNode in="SHADOW"/>
                <feMergeNode in="WHITE_OUTLINE"/>
                <feMergeNode in="SourceGraphic"/>
            </feMerge>
        </filter>
    </svg>

    {{-- ── NAVBAR ── --}}
    <nav id="hl-nav">
        <div class="nav-inner">
            <a class="nav-logo" href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;">
                <img src="{{ asset('images/logo.png') }}" alt="HealthyLife Logo" style="width:32px;height:32px;object-fit:contain;">
                HealthyLife
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ url('/user/education') }}#kardio">Exercise</a></li>
                <li><a href="{{ route('user.tracker') }}">Tracker</a></li>
                <li><a href="{{ url('/user/education') }}#makronutrien">Nutrition</a></li>
                <li><a href="{{ route('user.quiz') }}">Quiz</a></li>
                <li><a href="{{ route('user.education') }}">Edukasi</a></li>
            </ul>
            <div class="nav-right">
                <span class="nav-user">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="nav-logout">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ── FLASH MESSAGES ── --}}
    @if(session('success'))
        <div class="flash-msg flash-success" id="flash-msg">✅ {{ session('success') }}</div>
    @elseif(session('error'))
        <div class="flash-msg flash-error" id="flash-msg">⚠️ {{ session('error') }}</div>
    @endif

    {{-- ── MAIN CONTENT ── --}}
    @yield('content')

    {{-- ── FRUIT MODAL ── --}}
    <div id="fruitModal" style="display:none;position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,.9);backdrop-filter:blur(10px);z-index:2000;animation:fadeIn .3s;">
        <div style="position:relative;background:#fff;margin:5% auto;padding:3rem;max-width:700px;border-radius:30px;color:var(--moss);animation:slideUp .4s cubic-bezier(.175,.885,.32,1.275);box-shadow:0 30px 80px rgba(0,0,0,.3);">
            <span onclick="closeModal()" style="position:absolute;right:2rem;top:2rem;font-size:2rem;cursor:pointer;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:var(--pearl);transition:all .3s;color:var(--moss);" onmouseover="this.style.background='var(--radiate)';this.style.color='white'" onmouseout="this.style.background='var(--pearl)';this.style.color='var(--moss)'">×</span>
            <div id="fruitContent"></div>
        </div>
    </div>

    {{-- ── FOOTER ── --}}
    <footer>
        <p>© 2026 HealthyLife — Transform Your Life, One Step at a Time 💚</p>
    </footer>


    <script>
        // ── Navbar Scroll Effect ──
        const nav = document.getElementById('hl-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 100);
        });

        // ── Anchor Hash Scroll (setelah redirect antar-halaman) ──
        (function handleAnchorNav() {
            const hash = window.location.hash;
            if (!hash) return;
            const target = document.querySelector(hash);
            if (target) {
                setTimeout(() => {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 350); // delay agar halaman fully rendered
            }
        })();

        // ── Scroll Reveal ──
        const reveals = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => revealObserver.observe(el));

        // ── Flash Auto-hide ──
        const flash = document.getElementById('flash-msg');
        if (flash) setTimeout(() => { flash.style.opacity='0'; flash.style.transform='translateX(60px)'; flash.style.transition='all .4s'; }, 3500);

        // ── Fruit Modal ──
        const fruits = {
            apple:       { name:'Apple 🍎', emoji:'🍎', benefits:['Serat tinggi untuk pencernaan','Vitamin C untuk imunitas','Antioksidan pelindung sel','Menurunkan kolesterol','Mengatur gula darah'] },
            banana:      { name:'Pisang 🍌', emoji:'🍌', benefits:['Energi cepat dari karbohidrat','Kaya kalium untuk jantung','Regulasi tekanan darah','Meningkatkan mood dengan triptofan','Baik untuk pencernaan'] },
            orange:      { name:'Jeruk 🍊', emoji:'🍊', benefits:['Sangat tinggi vitamin C','Boost sistem imun','Antioksidan kuat','Membantu penyerapan zat besi','Menjaga kesehatan kulit'] },
            strawberry:  { name:'Stroberi 🍓', emoji:'🍓', benefits:['Tinggi antioksidan','Melindungi kesehatan jantung','Regulasi gula darah','Kaya vitamin C & mangan','Anti-inflamasi alami'] },
            watermelon:  { name:'Semangka 🍉', emoji:'🍉', benefits:['Hidrasi optimal (92% air)','Lycopene untuk jantung','Vitamin A untuk mata','Rendah kalori','Mengurangi nyeri otot'] },
            avocado:     { name:'Alpukat 🥑', emoji:'🥑', benefits:['Lemak tak jenuh sehat','Vitamin E untuk kulit','Lebih banyak kalium dari pisang','Membantu penyerapan nutrisi','Baik untuk kesehatan jantung'] },
        };

        function showFruit(key) {
            const f = fruits[key];
            if (!f) return;
            document.getElementById('fruitContent').innerHTML = `
                <h2 style="color:var(--herb);margin-bottom:1.5rem;font-size:1.8rem;">${f.emoji} ${f.name}</h2>
                <h3 style="color:var(--moss);margin-bottom:1rem;">Manfaat Kesehatan:</h3>
                <ul style="line-height:2.2;color:#333;">
                    ${f.benefits.map(b => `<li>✅ ${b}</li>`).join('')}
                </ul>`;
            document.getElementById('fruitModal').style.display = 'block';
        }

        function closeModal() { document.getElementById('fruitModal').style.display = 'none'; }
        window.onclick = e => { if (e.target === document.getElementById('fruitModal')) closeModal(); };

        @stack('inline_js')
    </script>

    @stack('scripts')
</body>
</html>