<?php

namespace App\Models\WP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $connection = 'wpmysql';

    protected $table = 'users';

    protected $with = ['meta'];

    protected $primaryKey = 'ID';

    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id')->where(function ($query) {
            return $query->where('meta_key', 'wp_capabilities')
                ->orWhere('meta_key', 'billing_country')
                ->orWhere('meta_key', 'shipping_country')
                ->orWhere('meta_key', 'first_name')
                ->orWhere('meta_key', 'last_name');
        });
    }
}
