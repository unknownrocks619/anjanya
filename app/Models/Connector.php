<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    use HasFactory;

    protected $fillable = [
        'connectors_class',
        'connector_id',
        'connected_class',
        'connected_id'
    ];


    public function eloquentClass()
    {
        $class = new $this->connected_class();
        return $this->belongsTo($class::class, 'connected_id', 'id');
    }
}
