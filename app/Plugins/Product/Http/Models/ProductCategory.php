<?php

namespace App\Plugins\Product\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProductCategory extends AdminModel
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'id_cat',
        'id_pro',
    ];

    protected $casts = [
        'product_files'    => 'array'
    ];


    public function product() {
        return $this->belongsTo(StoreProduct::class,'id_pro');
    }

}
