<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_id',
        'user_id',
        'komentar',
    ];

    /**
     * Mendapatkan artikel yang dikomentari.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Mendapatkan user yang membuat komentar.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 