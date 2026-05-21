<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>@yield('title', 'Admin') — HealthyLife Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pearl:   '#FFFADD',
                        herb:    '#6A8042',
                        radiate: '#ED7A13',
                        moss:    '#1E3006',
                        gleam:   '#FFE787',
                    },
                    fontFamily: { poppins: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #1E3006; }
        ::-webkit-scrollbar-thumb { background: #6A8042; border-radius: 3px; }
    </style>
    @stack('styles')
</head>
<body class="bg-moss min-h-screen text-pearl">

    {{-- Sidebar --}}
    <div class="flex min-h-screen">
        <aside class="w-64 bg-moss border-r-2 border-herb flex-shrink-0 fixed h-full z-10">
            <div class="p-6 border-b-2 border-herb">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="HealthyLife Logo" style="width:32px;height:32px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div class="text-gleam font-black text-lg leading-tight">HealthyLife</div>
                        <div class="text-herb text-xs font-medium">Admin Panel</div>
                    </div>
                </a>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                          {{ request()->routeIs('admin.dashboard') ? 'bg-herb text-pearl' : 'text-pearl hover:bg-herb hover:bg-opacity-40' }}
                          transition-colors">
                    <span>📊</span> Dashboard
                </a>
            </nav>

            {{-- Admin Profile --}}
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t-2 border-herb">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-herb rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-pearl leading-tight">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gleam">Administrator</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-radiate hover:bg-orange-600 text-white text-xs font-bold py-2 rounded-xl transition-colors">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div class="ml-64 flex-1 flex flex-col">
            {{-- Top bar --}}
            <header class="bg-moss border-b-2 border-herb px-8 py-4 flex items-center justify-between sticky top-0 z-10">
                <h1 class="text-gleam font-bold text-lg">@yield('page_title', 'Dashboard')</h1>
                <div class="text-xs text-herb font-medium">
                    🕐 {{ now()->format('d M Y, H:i') }} WIB
                </div>
            </header>

            <main class="flex-1 p-8">
                @if(session('success'))
                    <div class="bg-herb text-white px-4 py-3 rounded-xl mb-6 flex items-center justify-between border-2 border-gleam">
                        <span class="text-sm font-semibold">✅ {{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-white text-lg">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="border-t-2 border-herb py-4 text-center">
                <p class="text-herb text-xs flex items-center gap-1">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width:16px;height:16px;object-fit:contain;">
                    HealthyLife Admin &copy; {{ date('Y') }}
                </p>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>