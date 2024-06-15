<?php

namespace App\Plugins\TeamBuilder\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamGroup extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'default_group'
    ];

    const IMAGE_TYPES = [
        'featured'  => 'Featured Image',
        'banner'    => 'Banner Image'
    ];

    public function members() {
        return $this->hasMany(TeamMember::class,'id_team');
    }
}
