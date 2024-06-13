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
        'description'
    ];
}
