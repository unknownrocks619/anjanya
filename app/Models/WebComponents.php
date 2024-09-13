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
            ->orderBy('sort_by', 'asc');
    }

    public function componentConnect()
    {
        return $this->hasOne(CommonComponentConnector::class, 'web_component_id');
    }

    public function getRelationModel()
    {
        $commonComponent = $this->componentConnect;

        if (! $commonComponent) {
            return null;
        }
        $relationModel = $commonComponent->relation_model;
        $instance = new $relationModel;
        $relationID = $commonComponent->relation_id;

        return app($relationModel)::find($relationID);
    }
}
