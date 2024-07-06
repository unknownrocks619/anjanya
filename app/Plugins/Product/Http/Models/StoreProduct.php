<?php

namespace App\Plugins\Product\Http\Models;

use App\Models\AdminModel;
use App\Models\Category;
use App\Models\Seo;
use App\Models\SeoRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class StoreProduct extends AdminModel
{
    use HasFactory, SoftDeletes;

    const IMAGE_TYPES = [
        'featured_image'    => 'Featured Image',
        'product_cover_image'   => 'Product Display Image',
        'banner_image'          => 'Banner Image',
        'gallery'               => 'Gallery Image',
    ];

    const STATUS = [
        'active'    => 'Active',
        'inactive'  => 'Inactive',
        'disabled'  => 'Disabled'
    ];

    const PRODUCT_PHYSICAL = 1;
    const PRODUCT_DIGITAL = 2;
    const PRODUCT_SERVICE = 3;

    const PRODUCT_TYPE = [
        1  => 'Physical',
        2   => 'Digital',
        3  => 'Service'
    ];

    public $fillable = [
        'name',
        'slug',
        'sku',
        'status',
        'product_type',
        'stock',
        'intro_description',
        'short_description',
        'full_description',
        'base_price',
        'price_range',
        'youtube_link',
        'facebook_link',
        'instagram_link',
        'twitter_link'
    ];

    protected $casts = [
        'product_files'    => 'array'
    ];

    protected $with = [
        'additionalContent',
        'productVideos',
        'getImage',
        'associatedFiles',
        'getSeo'
    ];

    public function productCategories() {
        return $this->hasManyThrough(Category::class,ProductCategory::class,'id_pro','id','id','id_cat');
    }

    public function additionalContent() {
        return $this->hasMany(StoreProductAdditional::class,'id_pro');
    }

    public function productVideos() {
        return $this->hasMany(StoreProductVideo::class,'id_pro');
    }

    public function getSeo()
    {
        return $this->hasOneThrough(Seo::class,SeoRelation::class,'relation_id','id','id','seo_id');
    }

    public static function getProductsFromCategory(array|int $categories=[], $limit = 6 ) {
        $query = StoreProduct::where('status',true);
        $query->join((new ProductCategory())->getTable() . ' as pro_cat', function($join) use($categories) {
            $join->on('pro_cat.id_pro' ,'=',(new StoreProduct())->getTable().'.id');
        });
        $query->whereIn('id_cat',$categories);
        return $query->get();
    }

}   
