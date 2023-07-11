<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends AdminModel
{
    use HasFactory, SoftDeletes;

    const IMAGE_TYPES = [
        'featured_image'    => 'Featured Image',
        'product_cover_image'   => 'Product Display Image',
        'banner_image'          => 'Banner Image',
        'gallery'               => 'Gallery Image'
    ];

    const STATUS = [
        'active'    => 'Active',
        'inactive'  => 'Inactive',
        'disabled'  => 'Disabled'
    ];

    const PRODUCT_TYPE = [
        'physical'  => 'Physical',
        'digital'   => 'Digital',
        'physical_digital'  => 'Both (Physical & Digital)'
    ];

    const PRODUCT_LISTING_TYPE = [
        'single'    => 'Individual',
    ];

    public $fillable = [
        'product_name',
        'slug',
        'sku',
        'author_id',
        'book_id',
        'option_project_id',
        'intro_text',
        'short_description',
        'full_description',
        'status',
        'categories',
        'stock',
        'product_type',
        'product_listing',
        'item_price',
        'tax',
        'total_pricing',
        'is_shipping_available',
        'sort_by'
    ];

    protected $casts = [
        'categories'    => 'array'
    ];

    public static function getSortBy()
    {
        $max =  Product::max('sort_by');
        if (is_null($max)) {
            $max = 0;
        } else {
            $max++;
        }
        return $max;
    }

    public function getCategories(): mixed
    {
        $result = [];
        $categories = Category::whereIn('id', $this->categories)->get();

        if ($categories) {
            $result = $categories;
        }

        return $result;
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function getRecommendedProject()
    {
        return $this->hasOne(Project::class, 'id', 'option_project_id');
    }

    public function recommendeProduct()
    {
        $cat = '["' . implode('","', $this->categories) . '"]';
        $sqlQuery = <<<SQL
            SELECT
            products.id AS product_id,
            products.product_name,
            products.slug,
            products.author_id,
            products.book_id,
            products.categories,
            products.option_project_id,
            products.intro_text,
            products.short_description,
            products.full_description,
            products.status,
            products.product_type,
            users.first_name,
            users.last_name,
            users.country,
            users.id AS user_id,
            country.name,
            country.code

            FROM products

            LEFT JOIN users ON
            users.id = products.author_id

            LEFT JOIN countries country on
            country.id = users.country

            WHERE JSON_CONTAINS(categories->'$', '{$cat}');

        SQL;
        return DB::select($sqlQuery);
    }
}
