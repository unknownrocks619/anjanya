<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\ApplicationPayment;
use App\Models\MembershipApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApplicationPaymentController extends Controller
{
    //
    public function store(Request $request, MembershipApplication $application, User $user)
    {
        $request->validate([
            'amount'    => 'required',
            'start_date'    => 'required'
        ]);

        $paymentInfo = new ApplicationPayment();
        $expireDateCarbon = Carbon::parse($request->post('start_date'));
        $end_date = $expireDateCarbon->addYear();
        $paymentInfo->fill([
            'user_id'   => $user->getKey(),
            'application_id'    => $application->getKey(),

            'remarks'       => $request->post('remarks'),
            'amount'            => $request->post('amount'),
            'start_date'        => $request->post('start_date'),
            'expire_date'       => ($request->post('end_date')) ? $request->post('end_date') : $end_date->format("Y-m-d"),
            'currency'          => $request->post('currency')
        ]);

        $paymentInfo->save();
        return $this->json(true, 'Payment Information Saved.', 'redirect', ['location' => route('admin.users.applications.edit', ['application' => $application, 'current_tab' => 'payments'])]);
    }
}
