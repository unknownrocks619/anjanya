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
        return $this->hasMany(ComponentBuilder::class, 'relation_id')->where('relation_model', get_class($this));
    }
}
