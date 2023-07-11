<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_type',
        'status',
        'remarks',
        'resubmitted_count',
    ];

    protected $with = [
        'getUser'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getApplicationPayment()
    {
        return $this->hasMany(ApplicationPayment::class, 'application_id');
    }
}
