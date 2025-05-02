<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $articles = Article::with('penulis')
            ->where('status', 'diterbitkan')
            ->latest('tanggal_terbit')
            ->paginate(6);

        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::with('penulis')
            ->where('status', 'diterbitkan')
            ->findOrFail($id);

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'kategori' => 'required|in:kesehatan_mental,perawatan_diri,hubungan,manajemen_stres,kecemasan,depresi',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = new Article($request->except('gambar'));
        $article->user_id = Auth::id();
        $article->status = 'draft';

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('articles', 'public');
            $article->gambar = $path;
        }

        $article->save();

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);

        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'kategori' => 'required|in:kesehatan_mental,perawatan_diri,hubungan,manajemen_stres,kecemasan,depresi',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article->fill($request->except('gambar'));

        if ($request->hasFile('gambar')) {
            if ($article->gambar) {
                Storage::disk('public')->delete($article->gambar);
            }
            $path = $request->file('gambar')->store('articles', 'public');
            $article->gambar = $path;
        }

        $article->save();

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);

        if ($article->gambar) {
            Storage::disk('public')->delete($article->gambar);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    public function publish($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);

        $article->status = 'diterbitkan';
        $article->tanggal_terbit = now();
        $article->save();

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Artikel berhasil diterbitkan!');
    }
}
