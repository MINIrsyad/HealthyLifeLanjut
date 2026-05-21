<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — HealthyLife</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <meta name="description" content="Buat akun HealthyLife gratis dan mulai perjalanan hidup sehat Anda.">
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
            background-image: radial-gradient(circle, #ED7A13 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-pearl min-h-screen flex">

    {{-- Left Panel --}}
    <div class="hidden lg:flex w-1/2 bg-herb items-center justify-center relative overflow-hidden">
        <div class="dot-pattern absolute inset-0 opacity-20"></div>
        <div class="relative z-10 text-center px-12">

            {{-- LOGO --}}
            <img src="/images/logo.png" alt="HealthyLife Logo"
                 class="w-28 h-28 object-contain mx-auto mb-6 drop-shadow-lg">

            <h1 class="text-pearl font-black text-4xl leading-tight mb-4">
                Bergabung &<br>Mulai <span class="text-gleam">Hidup Sehat</span>
            </h1>
            <p class="text-pearl text-sm leading-relaxed opacity-80 max-w-xs mx-auto">
                Daftar gratis dan dapatkan akses penuh ke fitur tracker, edukasi kesehatan, dan kuesioner personal.
            </p>

            <div class="mt-10 space-y-3 max-w-xs mx-auto text-left">
                @foreach(['✅ Tracker makanan & minuman harian','✅ Log olahraga & kualitas tidur','✅ Kalkulator BMI & risiko obesitas','✅ Penilaian kesehatan mental'] as $f)
                <div class="bg-moss bg-opacity-30 border-2 border-moss border-opacity-30 rounded-xl px-4 py-2.5">
                    <span class="text-pearl text-sm font-medium">{{ $f }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="flex-1 flex items-center justify-center p-8">
        <div class="w-full max-w-md fade-up">

            <div class="mb-8">
                {{-- Mobile logo --}}
                <div class="lg:hidden flex items-center gap-2 mb-6">
                    <img src="/images/logo.png" alt="HealthyLife Logo" class="w-9 h-9 object-contain">
                    <span class="text-moss font-black text-xl">HealthyLife</span>
                </div>
                <h2 class="text-moss font-black text-3xl">Buat Akun Baru</h2>
                <p class="text-moss text-sm mt-1 font-medium">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="text-radiate font-bold underline underline-offset-2 hover:text-herb transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>

            @if($errors->any())
                <div class="bg-radiate bg-opacity-10 border-2 border-radiate rounded-xl px-4 py-3 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-radiate text-sm font-semibold">⚠️ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-moss text-sm font-semibold mb-1.5">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           required autocomplete="name"
                           class="input-field @error('name') border-radiate @enderror"
                           placeholder="Nama Anda">
                </div>

                <div>
                    <label class="block text-moss text-sm font-semibold mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="email"
                           class="input-field @error('email') border-radiate @enderror"
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label class="block text-moss text-sm font-semibold mb-1.5">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               class="input-field pr-12"
                               placeholder="Min. 8 karakter">
                        <button type="button" onclick="togglePassword('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-moss opacity-40 hover:opacity-80 text-sm">👁</button>
                    </div>
                </div>

                <div>
                    <label class="block text-moss text-sm font-semibold mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               required autocomplete="new-password"
                               class="input-field pr-12"
                               placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('password_confirmation', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-moss opacity-40 hover:opacity-80 text-sm">👁</button>
                    </div>
                </div>

                {{-- Strength indicator --}}
                <div id="strengthBar" class="h-1.5 rounded-full bg-gray-200 overflow-hidden hidden">
                    <div id="strengthFill" class="h-full rounded-full transition-all duration-300 w-0"></div>
                </div>
                <p id="strengthText" class="text-xs font-medium hidden"></p>

                <div class="bg-pearl border-2 border-herb rounded-xl px-4 py-3">
                    <p class="text-moss text-xs font-semibold">
                        🔐 Akun akan terdaftar sebagai <span class="text-herb">User</span> secara default.
                    </p>
                </div>

                <button type="submit"
                        class="w-full bg-radiate hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition-colors text-sm">
                    Daftar Sekarang →
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.style.opacity = input.type === 'text' ? '1' : '0.4';
        }

        document.getElementById('password').addEventListener('input', function() {
            const val = this.value;
            const bar = document.getElementById('strengthBar');
            const fill = document.getElementById('strengthFill');
            const text = document.getElementById('strengthText');
            if (!val) { bar.classList.add('hidden'); text.classList.add('hidden'); return; }
            bar.classList.remove('hidden'); text.classList.remove('hidden');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            const levels = [
                { pct:'25%', color:'#ED7A13', label:'Lemah' },
                { pct:'50%', color:'#FFE787', label:'Cukup' },
                { pct:'75%', color:'#6A8042', label:'Kuat' },
                { pct:'100%', color:'#1E3006', label:'Sangat Kuat' },
            ];
            const lvl = levels[score - 1] || levels[0];
            fill.style.width = lvl.pct;
            fill.style.background = lvl.color;
            text.textContent = `Kekuatan password: ${lvl.label}`;
            text.style.color = lvl.color;
        });
    </script>
</body>
</html>