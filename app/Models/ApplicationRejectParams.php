<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationRejectParams extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        'remarks',
        'step_params'
    ];
}
