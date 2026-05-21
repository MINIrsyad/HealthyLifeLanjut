<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Artikel — HealthyLife Admin</title>
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
        @media(max-width:768px){.sidebar{display:none;}.main{margin-left:0;}}
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-logo">🌿 HealthyLife<br><small style="font-size:.6rem;font-weight:400;opacity:.6;">Admin Panel</small></div>

    <div class="sidebar-label">Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
    <a href="{{ route('admin.articles.index') }}" class="sidebar-link active">📰 Artikel</a>

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
    <div class="flex justify-between items-center bg-white rounded-2xl px-8 py-5 mb-8 shadow-sm">
        <div>
            <h1 class="text-2xl font-extrabold text-moss">📰 Manajemen Artikel</h1>
            <p class="text-herb text-sm mt-1">Kelola berita dan artikel kesehatan</p>
        </div>
        <a href="{{ route('admin.articles.create') }}"
           class="bg-radiate hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg text-sm">
            ＋ Tambah Artikel
        </a>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="bg-herb text-white px-6 py-3 rounded-xl mb-6 font-semibold text-sm shadow-md animate-pulse">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center">
            <span class="text-moss font-bold">Semua Artikel</span>
            <span class="bg-herb text-white px-3 py-1 rounded-full text-xs font-bold">{{ $articles->total() }} artikel</span>
        </div>

        @if($articles->isEmpty())
            <div class="px-8 py-16 text-center">
                <div class="text-5xl mb-4">📝</div>
                <p class="text-moss font-bold text-lg">Belum ada artikel</p>
                <p class="text-herb text-sm mt-1">Mulai tambahkan artikel kesehatan pertama Anda</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left font-bold text-moss text-xs uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left font-bold text-moss text-xs uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left font-bold text-moss text-xs uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left font-bold text-moss text-xs uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-center font-bold text-moss text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $i => $article)
                        <tr class="border-b border-gray-50 hover:bg-pearl transition-colors">
                            <td class="px-6 py-4 text-herb font-bold">{{ $articles->firstItem() + $i }}</td>
                            <td class="px-6 py-4">
                                @if($article->image)
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                         class="w-14 h-14 object-cover rounded-xl border-2 border-gray-100 shadow-sm">
                                @else
                                    <div class="w-14 h-14 bg-pearl rounded-xl flex items-center justify-center text-2xl border-2 border-gray-100">📄</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-moss font-bold max-w-xs truncate">{{ $article->title }}</div>
                                <div class="text-herb text-xs mt-0.5 opacity-70 max-w-xs truncate">{{ Str::limit(strip_tags($article->content), 60) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gleam text-moss px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $article->published_at?->locale('id')->isoFormat('D MMM Y') ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                       class="bg-herb hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition-colors">
                                        ✏️ Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-bold transition-colors">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
            <div class="px-8 py-5 border-t border-gray-100">
                {{ $articles->links() }}
            </div>
            @endif
        @endif
    </div>
</main>

</body>
</html>
