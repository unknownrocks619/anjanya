<?php

namespace App\Plugins\TeamBuilder\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_team',
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

    const IMAGE_TYPES = [
        'profile'  => 'Profile',
        'background'    => 'Background',
        'banner'    => 'Banner'
    ];

    public function team() {
        return $this->belongsTo(TeamGroup::class,'id_team');
    }
}
