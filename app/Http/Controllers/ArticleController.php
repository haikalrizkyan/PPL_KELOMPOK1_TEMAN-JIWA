<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // List artikel untuk user
    public function index()
    {
        $articles = Article::with('psychologist')->latest()->get();
        return view('article.index', compact('articles'));
    }

    // Detail artikel untuk user dan psikolog
    public function show(Article $article)
    {
        // Check if the authenticated user is a psychologist
        if (Auth::guard('psychologist')->check()) {
            // If it's a psychologist, render the psychologist's detail view
            return view('psikolog.article.show', compact('article'));
        } else {
            // If it's a regular user, render the regular user's detail view
            return view('article.show', compact('article'));
        }
    }

    // List artikel milik psikolog yang login
    public function listMyArticles()
    {
        $psikolog = Auth::guard('psychologist')->user();
        $articles = Article::where('psychologist_id', $psikolog->id)->latest()->get();
        return view('psikolog.article.list', compact('articles'));
    }

    // Form tambah artikel (psikolog)
    public function create()
    {
        return view('psikolog.article.create');
    }

    // Simpan artikel baru (psikolog)
    public function store(Request $request)
    {
        $psikolog = Auth::guard('psychologist')->user();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'youtube_url' => 'nullable|url',
            'first_section_description' => 'required|string',
            'first_section_attachment' => 'nullable|file|max:4096',
            'second_section_description' => 'nullable|string',
            'second_section_attachment' => 'nullable|file|max:4096',
        ]);

        // Handle file upload
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('articles/covers', 'public');
        }
        if ($request->hasFile('first_section_attachment')) {
            $data['first_section_attachment'] = $request->file('first_section_attachment')->store('articles/attachments', 'public');
        }
        if ($request->hasFile('second_section_attachment')) {
            $data['second_section_attachment'] = $request->file('second_section_attachment')->store('articles/attachments', 'public');
        }

        // Convert YouTube URL to embed format if provided
        if ($request->filled('youtube_url')) {
            $data['youtube_url'] = $this->convertToEmbedUrl($request->youtube_url);
        }

        $data['psychologist_id'] = $psikolog->id;
        Article::create($data);
        return redirect()->route('psikolog.article.list')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Form edit artikel (psikolog)
    public function edit(Article $article)
    {
        $psikolog = Auth::guard('psychologist')->user();
        if ($article->psychologist_id !== $psikolog->id) {
            abort(403);
        }
        return view('psikolog.article.edit', compact('article'));
    }

    // Update artikel (psikolog)
    public function update(Request $request, Article $article)
    {
        $psikolog = Auth::guard('psychologist')->user();
        if ($article->psychologist_id !== $psikolog->id) {
            abort(403);
        }
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'youtube_url' => 'nullable|url',
            'first_section_description' => 'required|string',
            'first_section_attachment' => 'nullable|file|max:4096',
            'second_section_description' => 'nullable|string',
            'second_section_attachment' => 'nullable|file|max:4096',
        ]);

        // Handle file upload
        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($article->cover) {
                Storage::disk('public')->delete($article->cover);
            }
            $data['cover'] = $request->file('cover')->store('articles/covers', 'public');
        }
        if ($request->hasFile('first_section_attachment')) {
            // Delete old attachment if exists
            if ($article->first_section_attachment) {
                Storage::disk('public')->delete($article->first_section_attachment);
            }
            $data['first_section_attachment'] = $request->file('first_section_attachment')->store('articles/attachments', 'public');
        }
        if ($request->hasFile('second_section_attachment')) {
            // Delete old attachment if exists
            if ($article->second_section_attachment) {
                Storage::disk('public')->delete($article->second_section_attachment);
            }
            $data['second_section_attachment'] = $request->file('second_section_attachment')->store('articles/attachments', 'public');
        }

        // Convert YouTube URL to embed format if provided
        if ($request->filled('youtube_url')) {
            $data['youtube_url'] = $this->convertToEmbedUrl($request->youtube_url);
        }

        $article->update($data);
        return redirect()->route('psikolog.article.list')->with('success', 'Artikel berhasil diupdate!');
    }

    // Hapus artikel (psikolog)
    public function destroy(Article $article)
    {
        $psikolog = Auth::guard('psychologist')->user();
        if ($article->psychologist_id !== $psikolog->id) {
            abort(403);
        }
        $article->delete();
        return redirect()->route('psikolog.article.list')->with('success', 'Artikel berhasil dihapus!');
    }

    // Helper function to convert YouTube URL to embed format
    private function convertToEmbedUrl($url)
    {
        // If it's already an embed URL, return as is
        if (strpos($url, 'youtube.com/embed/') !== false) {
            return $url;
        }

        // Extract video ID using parse_url and parse_str
        $videoId = null;
        
        // Handle youtu.be URLs
        if (strpos($url, 'youtu.be/') !== false) {
            $path = parse_url($url, PHP_URL_PATH);
            $videoId = substr($path, 1);
        }
        // Handle youtube.com URLs
        else if (strpos($url, 'youtube.com') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
        }

        // If we found a video ID, return the embed URL
        if ($videoId) {
            return "https://www.youtube.com/embed/" . $videoId;
        }

        // If we couldn't parse the URL, return the original
        return $url;
    }
}
