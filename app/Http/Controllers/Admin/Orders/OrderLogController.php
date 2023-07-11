<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
use Illuminate\Http\Request;

class OrderLogController extends Controller
{
    //
    const log_type = [
        'order_update'   => 'Order Status <span class="text-danger">__FROM__</span> has been changed to <span class="text-success">__TO__</span>',
        'order_note'    => 'Order Delivery note is changed. <div class="bg-light p-2 d-block"><h5>Old Value</h5>__FROM__</div><div class="bg-light d-block p-2"><h5>New Value</h5>__TO__</div>'
    ];
    public static function storeLog(Request $request, Order $order)
    {

        $orderLog = new OrderLog();

        $log_message = '';

        if ($request->type == 'order_note') {
            $log_message =  str_replace(['__FROM__', '__TO__'], [$order->order_note, $request->order_note], self::log_type[$request->type]);
        }

        if ($request->type == 'order_update') {
            $currentOrder = (isset($order::ORDER_STATUS[$order->order_status])) ? $order::ORDER_STATUS[$order->order_status] : $order::ADMIN_ORDER_STATUS[$order->order_status];
            $newOrder = (isset($order::ORDER_STATUS[$request->status])) ? $order::ORDER_STATUS[$request->status] : $order::ADMIN_ORDER_STATUS[$request->status];
            $log_message = str_replace(['__FROM__', '__TO__'], [$currentOrder, $newOrder], self::log_type[$request->type]);
        }

        $orderLog->fill([
            'user_id'   => $order->user_id,
            'admin_user_id' => auth()->guard('admin')->check() ? auth()->guard('admin')->id() : null,
            'order_id'  => $order->getKey(),
            'log_type'  => $request->type,
            'log_message' => $log_message,
            'old_record'    => $order->toArray(),
            'new_record'    => []
        ]);
        $orderLog->save();
    }

    public function getLog(Order $order)
    {
        $allOrders = [];
        $orderLog = OrderLog::where('order_id', $order->getKey())
            ->with(['getCustomer', 'getAdmin'])
            ->orderBy('id', 'desc')
            ->get();

        foreach ($orderLog as $log) {
            $allOrders[] = [
                'date' => $log->created_at->format('Y-m-d H:i:s'),
                'admin_user_id'   => $log->getAdmin->getFullName(),
                'type' => $log->log_type,
                'message'   => $log->log_message
            ];
        }
        return response($allOrders);
    }
}
