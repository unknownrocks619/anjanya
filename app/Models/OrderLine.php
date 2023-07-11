<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'project_id',
        'item_price',
        'quantity',
        'tip_amount',
        'processing_charge',
        'final_amount',
        'donation_amount',
    ];

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getProject()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
