<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** Landing Page — port dari WEB.html */
    public function index()
    {
        $articles = Article::published()
                        ->orderBy('published_at', 'desc')
                        ->take(6)
                        ->get();

        return view('user.home', compact('articles'));
    }

    /** Halaman Edukasi Kesehatan Detail */
    public function education()
    {
        $articles = Article::published()
                        ->orderBy('published_at', 'desc')
                        ->get();

        return view('user.education', compact('articles'));
    }
}

