<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_filename',
        'filename',
        'filepath',
        'information',
        'sizes',
    ];

    protected $casts = [
        'information'   => 'object',
        'sizes'         => 'object'
    ];
}
