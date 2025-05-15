<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'pertanyaan',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
} 