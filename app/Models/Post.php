<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'intro_description',
        'full_description',
        'type',
        'status',
        'categories',
        'glitter_background'
    ];
    const IMAGE_TYPES = [
        'featured_image'   => 'Featured Image',
        'banner_image'      => 'Banner Image',
        'intro_image'       => 'Intro Image',
        'seo'               => 'SEO',
        'slider'        => 'Post Slider'
    ];

    protected $with = [
        'getImage',
        'getSeo',
        'getComponents'
    ];

    const CACHE_NAME = "FRONTEND_CACHE_POST";
    protected $casts = [
        'categories'    => 'array'
    ];


    public function getCategories()
    {
        if (empty($this->categories)) {
            return [];
        }

        $categories = Category::whereIn('id', $this->categories)->get();
        return $categories;
    }

    public static function getSortBy()
    {
        $max =  self::max('sort_by');
        if (is_null($max)) {
            $max = 0;
        } else {
            $max++;
        }
        return $max;
    }

    public static function latestPost()
    {
        return Post::where('status', 'active')->orderBy('created_at', 'desc')->limit(10)->get();
    }

    public function getPostTypeIcon()
    {
        if ($this->type == 'blog') {
            return '<span class="post-format"><i class="icon-notebook"></i></span>';
        }

        if ($this->type == 'text') {
            return '<span class="post-format"><i class="icon-notebook"></i></span>';
        }

        if ($this->type == "video") {
            return '<span class="post-format"><i class="icon-camrecorder"></i></span>';
        }

        if ($this->type == 'audio') {
            return '<span class="post-format"><i class="icon-earphones"></i></span>';
        }

        return;
    }

    public static function recentPost(Post|null $currentPost = null)
    {
        return self::where('status', 'active')->with(['getImage' => function ($query) {
            $query->with('image');
        }])->orderBy('updated_at', 'desc')->limit('5')->get();
    }
}
