<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'psychologist_id',
        'tanggal',
        'jam',
        'catatan',
        'status',
    ];

    public function psychologist()
    {
        return $this->belongsTo(\App\Models\Psychologist::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
