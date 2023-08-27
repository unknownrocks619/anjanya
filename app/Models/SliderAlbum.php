<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_name',
        'status',
        'slider_type'
    ];

    public function sliders()
    {
        return $this->hasMany(SliderItem::class, 'slider_album_id');
    }
}
