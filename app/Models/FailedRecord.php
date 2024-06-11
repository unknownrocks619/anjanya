<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_info'
    ];

    protected  $casts = [
        'session_info' => 'array'
    ];
}
