<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'full_description',
        'category_type',
        'active',
        'sort_by'
    ];

    const IMAGE_TYPES = [
        'banner'    => 'Banner Image',
        'featured_image'    => 'Featured Image',
        'seo'       => 'SEO',
    ];

    const CATEGORY_TYPES = [
        'books' => 'Book Category',
        'genre' => 'Genre',
        'course'    => 'Course Category',
        'category'  => 'Category',
        'blog'      => 'Blog',
    ];

    const CACHE_NAME = 'FRONTEND_CATEGORY_CACHE';

    protected static function booted(): void
    {
        static::addGlobalScope(new SortableScope);
    }

    public static function getSortBy()
    {
        $max =  Category::max('sort_by');
        if (is_null($max)) {
            $max = 0;
        } else {
            $max++;
        }
        return $max;
    }

    public function getProductCategory()
    {
        return Product::where('status', 'active')->whereJsonContains('categories', $this->getKey())->get();
    }

    public static  function getPosts($categoryIds = null, $limit = 30)
    {
        $sqlQuery =  'SELECT ';
        $sqlQuery .= 'cat.id as cat_id, cat.category_name as cat_name,cat.slug as cat_slug ';
        $sqlQuery .= ',post.id as post_id, post.title, post.slug,post.short_description,post.intro_description,post.full_description';
        $sqlQuery .= ',post.type, post.status,post.slug as post_slug';
        $sqlQuery .= ',post.created_at,';
        $sqlQuery .= " post_feature_img.filepath AS post_featured_image,
                        post_intro_img.filepath AS post_intro_image,
                        cat_featured_img.filepath AS category_featured_image
                        ";
        $sqlQuery .= ' FROM ';
        $sqlQuery .= ' categories cat ';
        $sqlQuery .= ' JOIN posts post on JSON_CONTAINS(post.categories,CAST(cat.id as CHAR),"$") ';
        $sqlQuery .= ' AND post.status ="active" ';

        $sqlQuery .= ' LEFT JOIN file_relations featured ON featured.relation_id = post.id
                        AND featured.relation = "App\\\\Models\\\\Post"
                        AND featured.type = "featured_image"';

        $sqlQuery .= ' LEFT JOIN file_relations intro ON intro.relation_id = post.id
                        AND intro.relation = "App\\\\Models\\\\Post"
                        AND intro.type ="intro_image"';

        $sqlQuery .= ' LEFT JOIN file_relations category_featured_image ON category_featured_image.relation_id = cat.id
                        AND category_featured_image.relation = "App\\\\Models\\\\Category"
                        AND category_featured_image.type = "featured_image"';

        $sqlQuery .= " LEFT JOIN images post_feature_img ON post_feature_img.id = featured.image_id";
        $sqlQuery .= " LEFT JOIN images post_intro_img ON post_intro_img.id = intro.image_id";
        $sqlQuery .= " LEFT JOIN images cat_featured_img ON cat_featured_img.id = category_featured_image.image_id";


        $sqlQuery .= " WHERE ";
        $sqlQuery .= " cat.active = 1";
        if (!$categoryIds && !is_array($categoryIds)) {

            $sqlQuery .= ' AND cat.id = ' . $this->getKey();
        } elseif (is_array($categoryIds) && !empty($categoryIds)) {
            $sqlQuery .= ' AND cat.id IN (' . implode(',', $categoryIds) . ')';
        }

        $sqlQuery .= ' ORDER BY post.updated_at DESC';

        if ($limit) {
            $sqlQuery .= ' LIMIT ' . $limit;
        }

        $sql = <<<SQL
            $sqlQuery
        SQL;

        $query = DB::select($sql);
        return $query;
    }

    public function getRelated()
    {
    }
}
