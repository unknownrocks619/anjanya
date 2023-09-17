<?php

namespace App\Plugins\Amenities\Http\Models;

use App\Plugins\Rooms\Http\Models\Rooms;
use App\Plugins\Rooms\Http\Models\RoomsAmenities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;

    protected  $fillable= [
        'amenities',
        'slug',
        'amenities_type',
        'icon_name',
        'image',
        'active',
    ];

    public function amenitiesLink() {
        return $this->hasMany(RoomsAmenities::class,'amenities_id');
    }

    public function rooms() {
        return $this->hasManyThrough(Rooms::class,RoomsAmenities::class,'room_id','amenities_id');
    }
}
