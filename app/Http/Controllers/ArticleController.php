<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ── Admin: Daftar semua artikel ───────────────────────────────────────────
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    // ── Admin: Form tambah artikel ───────────────────────────────────────────
    public function create()
    {
        return view('admin.articles.create');
    }

    // ── Admin: Simpan artikel baru ───────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/articles'), $filename);
            $validated['image'] = $filename;
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil ditambahkan!');
    }

    // ── Admin: Form edit artikel ─────────────────────────────────────────────
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    // ── Admin: Update artikel ────────────────────────────────────────────────
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($article->image && file_exists(public_path('images/articles/' . $article->image))) {
                unlink(public_path('images/articles/' . $article->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/articles'), $filename);
            $validated['image'] = $filename;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil diperbarui!');
    }

    // ── Admin: Hapus artikel ─────────────────────────────────────────────────
    public function destroy(Article $article)
    {
        if ($article->image && file_exists(public_path('images/articles/' . $article->image))) {
            unlink(public_path('images/articles/' . $article->image));
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dihapus!');
    }
}
