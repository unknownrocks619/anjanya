<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentBuilder extends AdminModel
{
    use HasFactory, SoftDeletes;

    const COMPONENT_POSITIONS = [
        'top'   => 'Top',
        'bottom'    => 'Bottom',
        'left'      => 'Left',
        'right'     => 'Right'
    ];

    const COMPONENTS_WIDGETS  = [
        'company_info' => 'Company Info Widget',
        'latest-post'   => 'Latest Post widget',
        'newsletter'    => 'News Letter Widget',
        'tag-cloud'  => 'Tag Cloud widget',
        'popular-post'  => 'Popular Post Widget',
    ];
    protected $fillable = [
        'component_name',
        'component_type',
        'relation_model',
        'relation_id',
        'sort_by',
        'active',
        'display_location',
        'values',
        'display_type'
    ];

    public $casts = [
        'display_location' => 'array',
        'values'            => 'array'
    ];
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortableScope);
    }

    public static function getSortBy($model)
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
