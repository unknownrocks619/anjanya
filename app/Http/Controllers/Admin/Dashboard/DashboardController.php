<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApplicationPayment;
use App\Models\MembershipApplication;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $applicantsTransactions = ApplicationPayment::select(['user_id', 'amount', 'currency', 'remarks', 'start_date'])->limit(20)->latest()->get();
        $totalApplicants = MembershipApplication::count();
        $pendingApplicants = MembershipApplication::where('status', 'pending')->count();
        $resubmissionApplicants = MembershipApplication::where('resubmitted_count', '>', 0)->count();
        $totalPost = Post::where('status', 'active')->count();
        $recentSubmission = MembershipApplication::where('status', 'pending')->where('resubmitted_count', 0)->limit(20)->latest()->get();
        $resubmittedApplication = MembershipApplication::where('status', 'pending')->where('resubmitted_count', '>', 0)->limit(20)->orderBy('updated_at')->get();
        return $this->admin_theme(
            'dashboard.index',
            [
                'transactions' => $applicantsTransactions,
                'total_application' => $totalApplicants,
                'pending_application'   => $pendingApplicants,
                'resubmission_application'  => $resubmissionApplicants,
                'totalPost' => $totalPost,
                'new_applications'  => $recentSubmission,
                'resubmissions' => $resubmittedApplication,
            ]
        );
    }
}
