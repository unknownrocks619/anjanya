<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $connection = 'portal_connection';


    protected $table = 'images';

    protected $fillable = [
        'filename',
        'original_filename',
        'filepath',
        'sizes',
        'information',
        'access_type'
    ];

    protected $casts = [
        'information'   => 'array',
        'sizes' => 'array'
    ];
}