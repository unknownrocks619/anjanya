<?php

namespace App\Plugins\Gallery\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbums extends AdminModel
{
    use HasFactory;

    protected  $fillable = [
        'album_name',
        'slug_name',
        'active',
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
