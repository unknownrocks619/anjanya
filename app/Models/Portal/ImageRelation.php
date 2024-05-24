<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageRelation extends Model
{
    use HasFactory,SoftDeletes;

    protected $connection = 'portal_connection';

    protected  $fillable = [
        'image_id',
        'relation_id',
        'relation',
        'type',
        'title',
        'description'
    ];

    protected $with = [
        'image'
    ];

    public function image() {
        return $this->hasOne(Images::class,'id','image_id');
    }

    public function storeRelation(Model $uploadFrom , Images $image) {
        $fileRelation = new self();
        $fileRelation->fill([
            'image_id' => $image->getKey(),
            'relation' => $uploadFrom::class,
            'relation_id' => $uploadFrom->getKey()
        ]);

        $fileRelation->save();

        return $fileRelation;
    }
}