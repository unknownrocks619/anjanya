<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'project_id',
        'total_items',
        'total_amount',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'user_prefix',
        'order_status',
        'order_note',
        'billing_address',
        'delivery_address',
    ];

    const ORDER_STATUS = [
        'cart'  => 'Cart',
        'order_await'   => 'Order Waiting',
        'paid'              => 'Paid',
        'order_processing'  => 'Processing',
        'order_pending'     => 'Pending',
        'order_rejected'    => 'Rejected',
        'order_completed'   => 'Completed',
    ];

    const ADMIN_ORDER_STATUS = [
        'order_processing'  => 'Processing',
        'order_review'    => 'Under Review',
        'order_verified'    => 'Under Verified',
        'order_print_ready' => 'Order Print Ready',
        'order_print_complete'  => "Order Printed",
        'order_dispatched'  => 'Dispatched',
        'order_pending'     => 'Pending',
        'order_rejected'    => 'Rejected',
        'order_completed'   => 'Completed',
    ];

    const ORDRE_TYPE = [
        'book'  => 'Book',
        'bundle'    => 'Book Bundle'
    ];


    public $casts = [
        'delivery_address' => 'object',
        'billing_address'   => 'object',
        'order_attributes'   => 'array',
    ];

    public function getOrderLines()
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function total_donation()
    {
        $exlude = [
            '_begin',
            'cart',
            'cancelled',
            'order_await',
        ];
        $queryOrder = [];
        foreach (self::ORDER_STATUS as $key => $value) {
            if (!in_array($key, $exlude)) {
                $queryOrder[] = $key;
            }
        }

        $orderStatus = implode("','", $queryOrder);
        $sql = "SELECT SUM(t2.donation_amount) as donation_amount
                FROM orders t1
                JOIN order_lines t2 ON t1.id = t2.order_id
                WHERE t1.order_status IN ('{$orderStatus}');";
        $query = <<<SQL
            $sql
        SQL;
        return DB::select($query)[0];
    }

    public function orderLog()
    {
        return $this->hasMany(OrderLog::class, 'order_id');
    }
}
