<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends AdminModel
{

    protected $fillable = [
        'title',
        'slug',
        'intro_text',
        'short_description',
        'full_description',
        'active'
    ];


    const IMAGE_TYPES = [
        'featured_image'   => 'Featured Image',
        'banner_image'      => 'Banner Image',
        'intro_image'       => 'Intro Image',
        'seo'               => 'SEO'
    ];

    protected static function booted(): void
    {
        // static::addGlobalScope(new SortableScope);
    }
}
