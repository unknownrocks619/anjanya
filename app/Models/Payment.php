<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends AdminModel
{
    use HasFactory;

    const PAYMENT_TYPES = [
        'stripe'    => 'STRIPE',
    ];

    protected $fillable = [
        'payment_type',
        'order_id',
        'status',
        'transaction_key',
        'amount',
        'tax',
        'donation',
        'payment_response_object',
        'remarks',
    ];

    protected $casts = [
        'payment_response_object' => 'object',
    ];

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
