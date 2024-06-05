<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryApiDb extends Model
{
    use HasFactory;
    protected $connection = 'defaultConnection';
    protected $table = 'primary_api_dbs';
}
