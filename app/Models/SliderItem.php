<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'slider_album_id',
        'slider_type',
        'active',
        'heading_one',
        'heading_two',
        'subtitle',
        'description',
        'sort_by',
    ];

    protected $with = [
        'getImage'
    ];
    protected $casts = [
        'active' => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    public function sliderAlbum()
    {
        return $this->belongsTo(SliderAlbum::class, 'slider_album_id');
    }

    public function getSortOrder()
    {
        $sortID = 0;
        if ($this->slider_album_id) {
            $sortID = SliderItem::where('slider_album_id', $this->slider_album_id)->max('sort_by');
        } else {
            $sortID = SliderItem::max('sort_by');
        }

        return $sortID + 1;
    }
}
