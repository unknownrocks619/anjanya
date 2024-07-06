<?php

namespace App\Plugins\Product\Http\Models;

use App\Models\AdminModel;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class StoreProductAdditional extends AdminModel
{
    use HasFactory, SoftDeletes;

    const IMAGE_TYPES = [
        'featured_image'    => 'Featured Image',
        'product_cover_image'   => 'Product Display Image',
        'banner_image'          => 'Banner Image',
        'gallery'               => 'Gallery Image',
    ];

    protected $table='store_product_additional';

    public $fillable = [
        'id_pro',
        'title',
        'intro_description',
        'short_description',
        'full_description',
    ];
}   
