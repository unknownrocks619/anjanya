<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryItems extends AdminModel
{
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT =  'updated_at';

    protected  $fillable = [
        'gallery_albums_id',
        'heading_one',
        'subtitle',
        'heading_two',
        'description',
        'sort_by',
        'featured_background',
        'featured_button'
    ];

    /**
     * get sort index
     * @return int
     */
    public function getSortOrder(): int
    {
        $sortID = 0;
        if ($this->gallery_album_id) {
            $sortID = SliderItem::where('slider_album_id', $this->gallery_album_id)->max('sort_by');
        } else {
            $sortID = SliderItem::max('sort_by');
        }

        return $sortID + 1;
    }
}
