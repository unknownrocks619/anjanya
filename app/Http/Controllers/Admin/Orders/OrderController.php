<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function index()
    {
        $orders = Order::with(['getOrderLines'])
            ->where('order_status', '!=', '_begin')
            ->where('order_status', '!=', 'cart')
            ->get();
        return $this->admin_theme('orders.index', ['orders' => $orders]);
    }

    public function edit(Order $order, $current_tab = 'general')
    {
        $order->load(['getOrderLines', 'orderLog' => function ($query) {
            $query->with('getAdmin')
                ->orderBy('id', 'desc');
        }]);
        $tabs = [
            'general' => $order,
            'log'       => $order->orderLog()->latest()->get()
        ];

        return $this->admin_theme('orders.edit', ['order' => $order, 'current_tab' => $current_tab, 'tabs' => $tabs]);
    }
    public function update_status(Request $request, Order $order, $type = "status")
    {

        $callback = null;
        if ($type == 'status') {
            $orderStatus = $request->post('order_status');
            $orderAttribute = $order->order_attributes == null ? [] : $order->order_attributes;
            if (!isset($orderAttribute[$orderStatus])) {
                $orderAttribute[$orderStatus] =  [];
            }

            if ($orderStatus == 'order_print_ready') {

                $orderAttribute[$orderStatus] = [
                    'print_date'    => $request->post('print_date'),
                    'exp_compelete_date'    => $request->post('exp_compelete_date')
                ];
            }

            if ($orderStatus == 'order_print_complete') {
                $orderAttribute[$orderStatus] = [
                    'print_completed_date' => $request->post('print_completed_date')
                ];
            }

            if ($orderStatus == 'order_dispatched') {
                $orderAttribute[$orderStatus] = [
                    'dispatched_date' => $request->post('dispatched_date'),
                    'shipping_company_partner'  => $request->post('shipping_company_partner'),
                    'tracking_code' => $request->post('tracking_code')
                ];
            }
            $request->merge(['status' => $orderStatus, 'type' => 'order_update']);
            OrderLogController::storeLog($request, $order);
            $order->order_attributes = $orderAttribute;
            $order->order_status = $orderStatus;
            $callback = 'orderLogAPI';
        }

        if ($type == 'note') {
            $request->merge(['type' => 'order_note']);
            OrderLogController::storeLog($request, $order);
            $order->order_note = $request->post('order_note');
            $callback = 'orderLogAPI';
        }

        if ($type == 'address') {
        }

        $order->save();
        return $this->json(true, 'Order information updated.', $callback);
    }
}
