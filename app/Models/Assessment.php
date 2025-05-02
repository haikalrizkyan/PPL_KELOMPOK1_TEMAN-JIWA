<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'answers'];

    protected $casts = [
        'answers' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getScoreAttribute()
    {
        $score = 0;
        foreach ($this->answers as $answer) {
            switch ($answer) {
                case 'Jarang': $score += 1; break;
                case 'Kadang-kadang': $score += 2; break;
                case 'Sering': $score += 3; break;
                case 'Sangat Sering': $score += 4; break;
                default: $score += 0;
            }
        }
        return $score;
    }

    public function getResultAttribute()
    {
        $score = $this->score;
        if ($score <= 20) {
            return 'Tidak ada indikasi gangguan mental';
        } elseif ($score <= 40) {
            return 'Indikasi gangguan ringan';
        } elseif ($score <= 60) {
            return 'Indikasi gangguan sedang';
        } else {
            return 'Indikasi gangguan berat';
        }
    }
}