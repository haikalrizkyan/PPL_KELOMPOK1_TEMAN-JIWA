<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'user_id',
        'status',
        'kategori',
        'tanggal_terbit',
    ];

    /**
     * Atribut yang harus di-cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_terbit' => 'datetime',
    ];

    /**
     * Mendapatkan penulis artikel.
     */
    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendapatkan komentar artikel.
     */
    public function komentar()
    {
        return $this->hasMany(ArticleComment::class);
    }

    /**
     * Scope query untuk hanya mengambil artikel yang sudah diterbitkan.
     */
    public function scopeDiterbitkan($query)
    {
        return $query->where('status', 'diterbitkan')
                    ->whereNotNull('tanggal_terbit')
                    ->where('tanggal_terbit', '<=', now());
    }

    /**
     * Scope query untuk mengambil artikel berdasarkan kategori.
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
} 