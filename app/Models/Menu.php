<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class Menu extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'menu_name',
        'slug',
        'parent_id',
        'description',
        'menu_type',
        'menu_position',
        'sort_by',
        'active',
        'glitter_background'
    ];


    const MENU_TYPES = [
        'homepage'  => 'Home',
        'login'     => 'Login Page',
        'register'     => 'Registration Page',
        'page'      => 'Page',
        'category'  => 'Category',
        'post'      => 'Post',
        'courses'  => 'Courses',
        'contact'   => 'Contact Us',
        'book_upload'   => 'Book Upload Form',
        'book_bundle'   => 'Book Bundle',
        'seo'           => 'SEO',
        'rooms'         => 'Room List',
        'events'        => 'Event List',
        'gallery'       => 'Gallery'
    ];

    const MENU_POSITIONS = [
        'top'       => 'Top',
        'main'      => 'Main',
        'footer'    => 'Footer'
    ];

    const IMAGE_TYPES = [
        'banner_image'  => 'Banner Image',
        'background'    => 'Background',
    ];

    public function pages()
    {
        return $this->hasMany(Connector::class, 'connector_id')->where('connectors_class', Menu::class);
    }

    public function categories()
    {
        return $this->hasMany(Connector::class, 'connector_id')->where('connected_class', Category::class);
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('sort_by', 'asc');
    }

    public function getImage()
    {
        return $this->hasMany(FileRelation::class, 'relation_id')->where('relation', Menu::class);
    }

    public function getSeo()
    {
        return $this->hasOne(SeoRelation::class, 'relation_id')->where('relation', Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id')->orderBy('sort_by', 'asc');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new SortableScope);
    }

    public static function getSortOrder($parentID = null)
    {
        $sortID = 0;
        if ($parentID) {
            $sortID = Menu::where('parent_id', $parentID)->max('sort_by');
        } else {
            $sortID = Menu::max('sort_by');
        }

        return $sortID + 1;
    }

}
