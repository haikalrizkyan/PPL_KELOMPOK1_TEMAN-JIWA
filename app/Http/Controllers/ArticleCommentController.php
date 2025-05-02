<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menyimpan komentar baru.
     */
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        $article = Article::findOrFail($articleId);

        $comment = new ArticleComment([
            'komentar' => $request->komentar,
            'user_id' => Auth::id(),
        ]);

        $article->komentar()->save($comment);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Menghapus komentar.
     */
    public function destroy($articleId, $commentId)
    {
        $comment = ArticleComment::findOrFail($commentId);
        
        // Hanya pemilik komentar yang bisa menghapus
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
} 