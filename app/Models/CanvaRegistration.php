<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvaRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'accepted_terms',
        'status',
        'remarks',
        'email'
    ];

    const STATUS = [
        'pending'   => 'Pending',
        'complete' => 'Complete',
        'reject'    => 'Reject'
    ];
    protected $casts = [
        'accepted_terms' => 'object'
    ];
}
