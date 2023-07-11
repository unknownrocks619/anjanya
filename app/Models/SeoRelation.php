<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_id',
        'relation',
        'relation_id'
    ];

    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seo_id');
    }
}
