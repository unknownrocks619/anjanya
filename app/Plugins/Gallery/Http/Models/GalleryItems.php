<?php

namespace App\Plugins\Gallery\Http\Models;

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
        'description'
    ];
}
