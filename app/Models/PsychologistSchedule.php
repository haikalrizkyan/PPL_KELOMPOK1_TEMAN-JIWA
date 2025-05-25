<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [
        'psychologist_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'is_available'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
        'is_available' => 'boolean'
    ];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }
} 