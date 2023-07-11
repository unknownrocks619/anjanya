<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLogin\AutheticateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    //
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard.dashboard');
        }
        return $this->admin_theme('guest.authetication.index');
    }
    public function autheticate(AutheticateRequest $request)
    {
        $request->autheticateUser();
        $request->session()->regenerate();

        return $this->json(true, __('admin/login.login_success'), 'redirect', ['location' => route('admin.dashboard.dashboard')]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->ajax()) {
            return $this->json(true, '', 'reload', ['location' => route('admin.login')]);
        }

        return redirect()->route('admin.login');
    }
}
