<?php

namespace App\Plugins\Rooms\Http\Models;

use App\Models\AdminModel;
use App\Plugins\Amenities\Http\Models\Amenities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'slug',
        'status',
        'intro_text',
        'short_description',
        'full_description',
        'price',
        'currency',
        'discount',
        'discount_percentage'
    ];
    const IMAGE_TYPES = [
        'banner'    => 'Banner Image',
        'featured'  => "Featured Image",
    ];

    protected $with = [
        'getImage'
    ];

    public function amenities() {
        return $this->belongsToMany(Amenities::class,RoomsAmenities::class,'room_id','amenities_id');
    }
    public function amenitiesRelation() {
        return $this->hasMany(RoomsAmenities::class,'room_id');
    }
}
