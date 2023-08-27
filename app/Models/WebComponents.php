<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebComponents extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'component_name',
        'active'
    ];

    public function getComponents()
    {
        return $this->hasMany(ComponentBuilder::class, 'relation_id')
            ->where('relation_model', get_class($this))
            ->orderBy('sort_by','asc');
    }

}
