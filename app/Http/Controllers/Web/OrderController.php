<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\UserController;
use App\Http\Requests\Web\User\AutheticateRequest;
use App\Jobs\EmailUserWithBookAttached;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class OrderController extends Controller
{
    //
    public function createOrder(Request $request)
    {
        $request->validate([
            'project',
            'product',
        ]);

        $sessionID = session()->getId();

        $order = Order::where('session_id', $sessionID)->first();

        if ($order && $order->order_status == 'paid') {
            session()->regenerate();
            $sessionID = session()->getId();
            $order = null;
        }

        $user = auth()->guard('web')->check() ? auth()->guard('web')->user() : null;

        if (!$order) {
            $order = new Order;
        }
        $order->first_name =  (!$order->first_name)  ? $user?->first_name : $order->first_name;
        $order->last_name =  (!$order->last_name)  ? $user?->last_name : $order->last_name;
        $order->email =  (!$order->email)  ? $user?->email : $order->email;
        $order->phone_number =  (!$order->phone_number)  ? $user?->phone_number : $order->phone_number;
        $order->user_id = (!$order->user_id) ? $user?->user_id : $order->user_id;
        $order->session_id = $sessionID;
        $order->save();

        $orderLine = OrderLine::where('order_id', $order->getKey())
            ->where('product_id', $request->post('product'))
            ->first();

        $product = Product::find($request->post('product'));
        $project = Project::find($request->post('project'));

        if (!$orderLine) {
            $orderLine = new OrderLine;

            $orderLine->fill([
                'order_id' => $order->getKey(),
                'project_id'    => $request->post('project'),
                'product_id'    => $request->post('product'),
                'item_price'    => $request->post('amount'),
                'quantity'      => $request->post('quantity'),
                'tip_amount'    => 0,
                'processing_charge' => 0,
                'final_amount'  => $request->post('amount'),
                'donation_amount'  => $request->has('donation') ? $request->post('donation') : 0
            ]);
        }

        $processing_amount = (($request->post('amount') * 2.9) / 100) + 0.30;

        $orderLine->tip_amount  = $request->post('tip') ? $request->post('tip') : 0;
        $orderLine->final_amount = ($request->post('quantity') * $request->post('amount')) + $orderLine->tip_amount;
        $orderLine->quantity = $request->post('quantity');
        $orderLine->processing_charge = $processing_amount;
        $orderLine->project_id =  $request->post('project') ? $request->post('project') : $orderLine->project_id;
        $orderLine->save();

        $order->total_items = $order->getOrderLines->count();
        $order->total_amount = ($order->getOrderLines->sum('final_amount'));
        $order->save();

        $view = $this->user_theme('books.modal.confirm-payment', ['orderLine' => $orderLine, 'order' => $order, 'product' => $product, 'project' => $project])->render();
        return response($view);
    }

    public function update(Request $request, OrderLine $orderLine)
    {
        $order = $orderLine->getOrder;

        $orderLine->tip_amount = $request->post('tip');
        $orderLine->donation_amount = $request->post('donation');
        $orderLine->quantity = $request->post('quantity');
        $orderLine->processing_charge = (($orderLine->item_price * $orderLine->quantity * 2.9) / 100) + 0.30;
        $orderLine->final_amount = ($orderLine->item_price * $orderLine->quantity) + $orderLine->tip_amount + $orderLine->donation_amount;
        $orderLine->save();

        $order->total_items = $order->getOrderLines->count();
        $order->total_amount = ($order->getOrderLines->sum('final_amount'));
        $order->save();
    }


    public function checkout(Request $request)
    {

        if ($request->post()) {
            dd($request->all());
        }

        $sessionID = session()->getId();
        $order = Order::where('session_id', $sessionID)->first();
        $orderLines = $order?->getOrderLines()->get();
        if (auth()->guard('web')->check()) {
            $user = auth()->guard('web')->user();
        }
        $intent = null;
        if ($order) :
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $intent = PaymentIntent::create([
                'amount' => ($order->total_amount + $order->processing_chrage) * 1000,
                'currency' => 'aud',
                'automatic_payment_methods' => [
                    'enabled' => true
                ]
            ]);
        endif;

        return $this->user_theme('order.checkout', ['order' => $order, 'orderLines' => $orderLines, 'intent' => $intent]);
    }

    public function preCheckout(Request $request, Order $order)
    {
        if (auth()->guard('web')->check()) {
            $user = auth()->guard('web')->user();
        }

        try {
            //code...
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($request->post('payment_method'));
            $user->charge(199 * 100, $request->post('payment_method'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Unable to complete your payment. If your amount is deducted from the account please create support ticket with your transaction statement detail Or you can try again.');
            return back()->withInput();
        }
    }

    public function postCheckOut()
    {
        session()->regenerate();
        return $this->user_theme('order.invalid-payment-response', ['title' => 'Thank-you', 'message' => "                                    We recieved your payment. You should shortly received yoru payment confirmation email."]);
    }

    public function order($sessionID = null)
    {

        //
        $sessionID = ($sessionID) ? $sessionID :  session()->getId();
        $order = Order::where('session_id', $sessionID)->first();

        if ($order) {
            return $order;
        }

        return;
    }
    public function stripe_payment_response(Request $request)
    {
        $intentID = $request->get('payment_intent');
        $sessionID = session()->getId();
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = PaymentIntent::retrieve($intentID);
        $basketOrder = Order::where('session_id', $sessionID)->first();

        if (!$basketOrder) {
            return $this->user_theme('order.invalid-payment-response', ['message' => 'There was an issue handling your payment. Please try again.']);
        }

        $basketOrder->order_status = 'order_processing';
        $basketOrder->save();

        if (!$paymentIntent) {
            return $this->user_theme('order.invalid-payment-response', ['message' => 'Your payment failed to reach us, please try again.']);
        }

        $basketOrder->order_status = 'paid';
        $basketOrder->save();

        $payment = new Payment;

        $payment->fill([
            'payment_type'  => 'stripe',
            'order_id'      => $basketOrder->getKey(),
            'status'        => $request->get('redirect_status'),
            'transaction_key'   => $intentID,
            'amount'        => $basketOrder->total_amount,
            'tax'           => 0,
            'donation'      => 0,
            'payment_response_object'   => $request->all(),
            'remarks'       => ''
        ]);

        if ($payment->save()) {
            // also email zipped pdf to user.
            new EmailUserWithBookAttached($basketOrder->email, $basketOrder);
            return redirect()->route('frontend.orders.complete-checkout');
        }
        dd('unable to update payment information. Please contact support to ammend your prices.');
    }

    public function updateUserInfo(Request $request, Order $order)
    {
        $request->validate(
            [
                'user_first_name' => 'required',
                'user_last_name'    => 'required',
                'user_email'    => 'required|email'
            ],
            [
                'user_first_name' => 'First Name is required',
                'user_last_name'    => 'Last Name is required',
                'user_email'    => 'Email Address is required.'
            ]
        );

        $order->first_name = $request->post('user_first_name');
        $order->last_name = $request->post('user_last_name');
        $order->email = $request->post('user_email');

        $order->save();

        return $this->json(true, 'Information Validated', 'redirect', ['location' => route('frontend.orders.checkout')]);
    }
}
