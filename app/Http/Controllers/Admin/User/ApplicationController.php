<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Jobs\MembershipRegistrationApprovedEmailJob;
use App\Jobs\MembershipRegistrationRejectedEmailJob;
use App\Models\ApplicationRejectParams;
use App\Models\MembershipApplication;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    public function index()
    {
        $applications = MembershipApplication::with(['getUser' => function ($query) {
            $query->with(['getImage' => function ($query) {
                $query->where('type', 'profile_picture')
                    ->with('image');
            }]);
        }])->get();
        return $this->admin_theme('users.applications.index', ['applications' => $applications]);
    }

    public function edit(MembershipApplication $application, $current_tab = 'general')
    {
        $user = $application->getUser;
        $guardian = $application->getUser->getUserMeta;
        $media = $user;

        $tabs = [
            'general'   => $user,
            'education' => $guardian,
            'guardian'  => $guardian,
            'media'     => $user
        ];

        if ($application->status == 'approved') {
            $paymentInfo = $application->getApplicationPayment;
            $tabs['payments']  = $paymentInfo;
        }

        return $this->admin_theme('users.applications.edit', ['tabs' => $tabs, 'user' => $user, 'application' => $application, 'current_tab' => $current_tab]);
    }

    public function rejectApplication(Request $request, MembershipApplication $application, User $user)
    {
        $rejectParams = new ApplicationRejectParams;
        $rejectParams->fill([
            'user_id'   => $user->getKey(),
            'application_id'   => $application->getKey(),
            'remarks'        => $request->post('reject_message'),
            'step_params'   => $request->post('resubmission_tab')
        ]);
        $application->status = 'rejected';
        $application->save();
        $rejectParams->save();

        MembershipRegistrationRejectedEmailJob::dispatchSync($user);
        return $this->json(true, 'Application Rejected.');
    }

    public function approveApplication(MembershipApplication $application, User $user)
    {
        $application->status = 'approved';
        $application->user_profile_approved = true;
        $application->user_identity_approved = true;
        $application->save();
        MembershipRegistrationApprovedEmailJob::dispatchSync($user);
        return $this->json(true, 'Application Approved.');
    }

    public function profile_status(Request $request, MembershipApplication $application, $status = true)
    {
        $application->user_profile_approved = $request->status == 'true' ? true : false;
        $application->save();
        return $this->json(true, 'Application Media Profile Status Updated.');
    }

    public function identity_status(Request $request, MembershipApplication $application, $status = true)
    {

        $application->user_identity_approved = $request->status == 'true' ? true : false;
        $application->save();
        return $this->json(true, 'Application Media Identity Status Updated.');
    }
}
