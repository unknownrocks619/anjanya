<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonComponentConnector extends Model
{
    use HasFactory;

    protected $fillable = [
        'relation_id',
        'relation_model',
        'web_component_id',
        'sort_by'
    ];

    public static function sortBy($model)
    {
        $max_value = 0;
        $sort = self::where('relation_model', $model::class)
            ->where('relation_id', $model->getKey())->max('sort_by');
        if (!is_null($sort)) {
            $max_value = $sort + 1;
        }
        return $max_value;
    }
}
