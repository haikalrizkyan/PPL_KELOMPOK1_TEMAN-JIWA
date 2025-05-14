<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->get();

        return view('article.article', compact('articles'));
    }

    public function detail($ArticleId)
    {
        $article = Article::with('user')->where('id', $ArticleId)->first();

        return view('article.detail', compact('article'));
    }
}
