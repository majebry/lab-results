<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'has_covid',
        'has_flu_a',
        'has_flu_b',
        'has_rsv',
        'document',
        'physician'
    ];

    protected $casts = [
        'has_covid' => 'boolean',
        'has_flu_a' => 'boolean',
        'has_flu_b' => 'boolean',
        'has_rsv' => 'boolean',
    ];

    public function getFileUrlAttribute()
    {
        return Storage::url($this->document);
    }
}
