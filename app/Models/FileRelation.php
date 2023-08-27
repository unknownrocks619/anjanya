<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'relation',
        'relation_id',
        'type'
    ];

    protected $with = [
        'image'
    ];

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
