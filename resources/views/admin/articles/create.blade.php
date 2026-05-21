<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel — HealthyLife Admin</title>
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
        .sidebar-logo{color:#FFE787;font-size:1.3rem;font-weight:800;margin-bottom:2.5rem;}
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
        .form-input{width:100%;padding:.8rem 1rem;border:2px solid #e5e7eb;border-radius:12px;
        font-family:'Poppins',sans-serif;font-size:.9rem;transition:border-color .2s;outline:none;
        background:#fff;color:#1E3006;}
        .form-input:focus{border-color:#6A8042;box-shadow:0 0 0 3px rgba(106,128,66,.15);}
        .form-input::placeholder{color:#aaa;}
        textarea.form-input{min-height:200px;resize:vertical;}
        .img-preview{width:200px;height:140px;object-fit:cover;border-radius:16px;border:3px solid #e5e7eb;display:none;}
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
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit" class="logout-btn">🚪 Keluar</button>
        </form>
    </div>
</aside>

<main class="main">
    {{-- TOPBAR --}}
    <div class="flex justify-between items-center bg-white rounded-2xl px-8 py-5 mb-8 shadow-sm">
        <div>
            <h1 class="text-2xl font-extrabold text-moss">✏️ Tambah Artikel Baru</h1>
            <p class="text-herb text-sm mt-1">Buat konten edukasi kesehatan baru</p>
        </div>
        <a href="{{ route('admin.articles.index') }}"
           class="bg-moss hover:bg-green-900 text-gleam font-bold px-5 py-3 rounded-xl transition-all text-sm">
            ← Kembali
        </a>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="bg-red-50 border-2 border-red-200 text-red-700 px-6 py-4 rounded-xl mb-6 text-sm">
            <p class="font-bold mb-1">⚠️ Terdapat kesalahan:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="bg-white rounded-2xl shadow-sm p-8">
        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="mb-6">
                <label class="block text-moss font-bold text-sm mb-2">📌 Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan judul artikel..."
                       class="form-input" required>
            </div>

            {{-- Konten --}}
            <div class="mb-6">
                <label class="block text-moss font-bold text-sm mb-2">📝 Isi Artikel</label>
                <textarea name="content" placeholder="Tulis isi artikel kesehatan di sini..."
                          class="form-input" required>{{ old('content') }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-6">
                <label class="block text-moss font-bold text-sm mb-2">🖼️ Gambar Artikel</label>
                <input type="file" name="image" accept="image/*" id="imageInput"
                       class="form-input" onchange="previewImage(event)">
                <p class="text-herb text-xs mt-2 opacity-60">Format: JPG, PNG, WebP — Maks 2MB</p>
                <img id="imagePreview" class="img-preview mt-3" alt="Preview">
            </div>

            {{-- Tanggal --}}
            <div class="mb-8">
                <label class="block text-moss font-bold text-sm mb-2">📅 Tanggal Publikasi</label>
                <input type="date" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}"
                       class="form-input" required>
            </div>

            {{-- Submit --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="bg-radiate hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg text-sm">
                    💾 Simpan Artikel
                </button>
                <a href="{{ route('admin.articles.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-moss font-bold px-8 py-3 rounded-xl transition-all text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</main>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}
</script>
</body>
</html>
