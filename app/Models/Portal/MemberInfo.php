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
        'remarks'
    ];

    protected $casts = [
        "history" => "object",
        "education" => "object",
        "personal" => "object",
        'remarks' => 'object'
    ];
}
