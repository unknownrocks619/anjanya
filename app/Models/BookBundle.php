<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookBundle extends AdminModel
{
    use HasFactory, SoftDeletes;


    const IMAGE_TYPES = [
        'banner'    => 'Banner Image',
        'seo'       => "SEO",
        'featured'  => 'Featured Image',
        'gallery'   => "Gallery Image",
        'cover_image'     => 'Cover Image'
    ];

    protected $fillable = [
        'bundle_title',
        'slug',
        'products',
        'categories',
        'sort_by',
        'active'
    ];

    protected $casts = [
        'categories' => 'array',
        'products'  => 'array',
        'active'    => 'boolean'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new SortableScope);
    }

    public function getBundleProducts()
    {
        return Product::whereIn('id', $this->products)->get();
    }
    public function getBundleCategories()
    {
        return Category::whereIn('id', $this->categories)->get();
    }
}
