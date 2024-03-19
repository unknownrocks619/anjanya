<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuccessRecords extends Model
{
    use HasFactory, SoftDeletes;

    protected  $fillable = [
        'session_info',
        'source'
    ];

    protected $casts = [
        'session_info'  => 'array'
    ];
}
