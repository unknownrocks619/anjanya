<?php

namespace App\Plugins\TeamBuilder\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_team_name',
        'name',
        'position',
        'description',
        'email',
        'phone_number',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'website',
    ];
}
