<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDikshya extends Model
{
    use HasFactory;
    protected $connection = 'portal_connection';

    protected $fillable = [
        'member_id',
        'rashi_name',
        'dikshya_type',
        'ceromony_location',
    ];

}
