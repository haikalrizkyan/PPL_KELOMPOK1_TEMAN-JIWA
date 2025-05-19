<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'psychologist_id',
        'title',
        'cover',
        'first_section_description',
        'first_section_attachment',
        'second_section_description',
        'second_section_attachment',
    ];

    public function psychologist()
    {
        return $this->belongsTo(\App\Models\Psychologist::class);
    }
}
