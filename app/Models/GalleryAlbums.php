<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbums extends AdminModel
{
    use HasFactory;

    protected  $fillable = [
        'album_name',
        'slug',
        'active',
        'album_type',
        'description',
        'sort_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(GalleryItems::class,'gallery_albums_id');
    }

    public static function getSortOrder($parentID = null)
    {
        $sortID = 0;
        $sortID = GalleryAlbums::max('sort_by');
        return $sortID + 1;
    }

}
