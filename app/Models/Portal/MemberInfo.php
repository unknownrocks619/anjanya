<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberInfo extends Model
{
    use HasFactory;
    protected $connection = 'portal_connection';

    protected $fillable = [
        'member_id',
        'history',
        'personal',
        'education',
        'remarks',
        'total_member_with_gurudev',
    ];

    protected $casts = [
        "history" => "object",
        "education" => "object",
        "personal" => "object",
        'remarks' => 'object'
    ];
}
