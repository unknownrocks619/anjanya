<?php

namespace App\Models\WP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $connection = 'wpmysql';
    // protected $table = ""
}
