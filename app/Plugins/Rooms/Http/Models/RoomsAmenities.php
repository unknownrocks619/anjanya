<?php

namespace App\Plugins\Rooms\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsAmenities extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'amenities',
        'slug',
        'amenities_type',
        'icon_name',
        'image',
        'active'
    ];
}
