<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'remarks',
        'start_date',
        'expire_date',
        'currency',
        'bank_account',
        'application_id',
        'user_id'
    ];

    protected $with = [
        'user',
        'applicant'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function applicant()
    {
        return $this->belongsTo(MembershipApplication::class, 'application_id');
    }
}
