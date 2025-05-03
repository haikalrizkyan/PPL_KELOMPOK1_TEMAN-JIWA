<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'saldo', // Menambahkan saldo ke dalam fillable
        'phone', // Menambahkan phone ke fillable
        'photo', // Menambahkan photo ke fillable
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'saldo' => 'float', // Mengatur saldo agar selalu di-cast sebagai float
        ];
    }

    /**
     * Cek apakah user adalah psikolog.
     */
    public function isPsikolog()
    {
        return $this->role === 'psikolog';
    }

    /**
     * Cek apakah user adalah user biasa.
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
}
