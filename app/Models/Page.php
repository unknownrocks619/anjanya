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

    public function webComponents() {
        return $this->hasManyThrough(WebComponents::class,CommonComponentConnector::class,'relation_id','id','id','web_component_id')
                    ->where('relation_model',self::class)
                    ->select(['web_components.*','common_component_connectors.id as connector_id','common_component_connectors.active as connector_active'])
                    ->orderBy('common_component_connectors.sort_by','asc');
    }
}
