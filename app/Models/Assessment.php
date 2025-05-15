<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'psychologist_id',
    ];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userAssessments()
    {
        return $this->hasMany(UserAssessment::class);
    }
} 