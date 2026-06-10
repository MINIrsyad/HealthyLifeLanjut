<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — HealthyLife</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <meta name="description" content="Masuk ke akun HealthyLife Anda untuk memantau kesehatan harian.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pearl: '#FFFADD', herb: '#6A8042',
                        radiate: '#ED7A13', moss: '#1E3006', gleam: '#FFE787'
                    },
                    fontFamily: { poppins: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .input-field {
            width: 100%; padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb; border-radius: 0.75rem;
            font-size: 0.875rem; transition: border-color 0.2s;
            background: white; color: #1E3006; outline: none;
        }
        .input-field:focus { border-color: #6A8042; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.5s ease; }
        .dot-pattern {
            background-image: radial-gradient(circle, #6A8042 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-pearl min-h-screen flex">

    {{-- Panel Kiri --}}
    <div class="hidden lg:flex w-1/2 bg-moss items-center justify-center relative overflow-hidden">
        <div class="dot-pattern absolute inset-0 opacity-20"></div>
        <div class="relative z-10 text-center px-12">

            {{-- Logo Aplikasi --}}
            <img src="/images/logo.png" alt="HealthyLife Logo"
                 class="w-28 h-28 object-contain mx-auto mb-6 drop-shadow-lg">

            <h1 class="text-gleam font-black text-4xl leading-tight mb-4">
                Selamat Datang<br>di <span class="text-radiate">HealthyLife</span>
            </h1>
            <p class="text-pearl text-sm leading-relaxed opacity-80 max-w-xs mx-auto">
                Mulai perjalanan hidup sehat Anda. Catat aktivitas, pantau nutrisi, dan evaluasi kesehatan mental setiap hari.
            </p>

            <div class="mt-10 grid grid-cols-3 gap-4 max-w-xs mx-auto">
                @foreach([['📊','Tracker Harian'],['🍎','Nutrisi'],['🧪','Kuesioner']] as [$icon,$label])
                <div class="bg-herb bg-opacity-40 border-2 border-herb rounded-2xl p-3 text-center">
                    <div class="text-2xl mb-1">{{ $icon }}</div>
                    <div class="text-pearl text-xs font-semibold">{{ $label }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Panel Kanan --}}
    <div class="flex-1 flex items-center justify-center p-8">
        <div class="w-full max-w-md fade-up">

            {{-- Bagian Header --}}
            <div class="mb-8">
                {{-- Logo untuk Tampilan Mobile --}}
                <div class="lg:hidden flex items-center gap-2 mb-6">
                    <img src="/images/logo.png" alt="HealthyLife Logo" class="w-9 h-9 object-contain">
                    <span class="text-moss font-black text-xl">HealthyLife</span>
                </div>
                <h2 class="text-moss font-black text-3xl">Masuk Akun</h2>
                <p class="text-moss text-sm mt-1 font-medium">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                       class="text-radiate font-bold underline underline-offset-2 hover:text-herb transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </div>

        
            {{-- Menampilkan Pesan Error Jika Ada --}}
            @if($errors->any())
                <div class="bg-radiate bg-opacity-10 border-2 border-radiate rounded-xl px-4 py-3 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-radiate text-sm font-semibold">⚠️ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form Login --}}
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    {{-- Input Email --}}
                    <label class="block text-moss text-sm font-semibold mb-1.5">Email</label>
                    <input id="email" type="text" name="email" value="{{ old('email') }}"
                           autocomplete="email"
                           class="input-field @error('email') border-radiate @enderror"
                           placeholder="nama@email.com">
                </div>

                <div>
                    {{-- Input Password --}}
                    <label class="block text-moss text-sm font-semibold mb-1.5">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                               autocomplete="current-password"
                               class="input-field pr-12"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-moss opacity-40 hover:opacity-80 text-sm">
                            👁
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    {{-- Checkbox Ingat Saya --}}
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember"
                               class="w-4 h-4 accent-herb rounded">
                        <span class="text-moss text-sm">Ingat saya</span>
                    </label>
                </div>
        
                {{-- Tombol Submit Login --}}
                <button type="submit"
                        class="w-full bg-radiate hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition-colors text-sm">
                    Masuk →
                </button>
            </form>

            <div class="mt-6 pt-6 border-t-2 border-pearl">
                <p class="text-center text-xs text-moss opacity-40">
                    Dengan masuk, Anda menyetujui syarat & ketentuan HealthyLife
                </p>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menyembunyikan/menampilkan teks password
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.style.opacity = input.type === 'text' ? '1' : '0.4';
        }

        // ============================================================
        // VALIDASI SISI KLIEN - Berjalan sebelum form disubmit
        // Menggunakan window.alert() untuk pesan error
        // ============================================================
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            var email    = document.getElementById('email').value.trim();
            var password = document.getElementById('password').value;

            // TC01: Both empty
            if (email === '' && password === '') {
                e.preventDefault();
                window.alert('Email dan Password wajib diisi');
                return false;
            }

            // TC02: Email empty
            if (email === '') {
                e.preventDefault();
                window.alert('Email wajib diisi');
                return false;
            }

            // TC03: Password empty
            if (password === '') {
                e.preventDefault();
                window.alert('Password wajib diisi');
                return false;
            }

            // TC04: Invalid email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                window.alert('Format email tidak valid');
                return false;
            }

            // All client-side checks passed — allow form submission to server
            return true;
        });
    </script>

    {{-- ============================================================ --}}
    {{-- ALERT SISI SERVER - Muncul setelah redirect dari controller --}}
    {{-- Menggunakan window.alert() bawaan browser --}}
    {{-- ============================================================ --}}
    @if(session('login_alert'))
    <script>
        window.alert(@json(session('login_alert')));
    </script>
    @endif
</body>
</html>