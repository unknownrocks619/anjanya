<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;


    public static function getSlug(string $slug, Model $model = null): string
    {
        $className =  get_called_class();
        $slug = \Illuminate\Support\Str::slug($slug);

        $query = $className::where('slug', $slug);

        if ($model) {
            $query->where('id', '!=', $model->getKey());
        }

        if ($query->exists()) {
            $slug .= \Illuminate\Support\Str::slug(\Illuminate\Support\Str::random(6));
        }

        return $slug;
    }
    public function getImage()
    {
        return $this->hasMany(FileRelation::class, 'relation_id')->where('relation', get_class($this));
    }

    public function getSeo()
    {
        return $this->hasOne(SeoRelation::class, 'relation_id')->where('relation', get_class($this));
    }

    public function getComponents()
    {
        return $this->hasMany(ComponentBuilder::class, 'relation_id')
                    ->where('relation_model', get_class($this))
                    ->orderBy('component_builders.id','asc');
    }
    public function webComponents() {
        return $this->hasManyThrough(WebComponents::class,CommonComponentConnector::class,'relation_id','id','id','web_component_id')
            ->where('relation_model',get_class($this))
            ->select(['web_components.*','common_component_connectors.id as connector_id','common_component_connectors.active as connector_active'])
            ->orderBy('common_component_connectors.sort_by','asc');
    }
}
