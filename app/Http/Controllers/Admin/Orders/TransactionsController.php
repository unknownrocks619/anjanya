<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    //

    public function index()
    {
        $transactions = Payment::with(['getOrder' => function ($query) {
            $query->with(['getOrderLines']);
        }])->get();

        return $this->admin_theme('transactions.index', ['transactions' => $transactions]);
    }
}
