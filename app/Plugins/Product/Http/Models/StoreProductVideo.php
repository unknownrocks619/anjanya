<?php

namespace App\Plugins\Product\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductVideo extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'id_pro',
        'title',
        'description',
        'video_link'
    ];

}
