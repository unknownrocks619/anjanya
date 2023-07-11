<?php

namespace App\Models\WP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;
    protected $connection = 'wpmysql';
    protected $table = 'usermeta';
}
