<?php

namespace App\Models;

use App\Models\Admin\AdminUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_user_id',
        'order_id',
        'order_line',
        'log_type',
        'log_message',
        'old_record',
        'new_record',
    ];

    protected $casts = [
        'old_record' => 'array',
        'new_record'    => 'array'
    ];

    public function getCustomer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAdmin()
    {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }
}
