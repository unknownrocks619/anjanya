<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLogin\AutheticateRequest;
use App\Models\Admin\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    public function account(Request $request, AdminUser $user = null)
    {
        if (!$user) {
            $user = auth()->guard('admin')->user();
        }

        if ($request->ajax() && $request->method() === 'POST') {

            if ($request->post('type') == 'information') {
                return $this->changePassword($request, $user);
            }

            if ($request->post('type')  == 'password') {
                return $this->changePassword($request, $user);
            }
        }

        return $this->admin_theme('account.account', ['user' => $user]);
    }

    public function addNewUser(Request $request)
    {
        $request->validate([
            'firstname'    => 'required',
            'lastname'     => 'required',
            'email'         => ['required', 'email', Rule::unique('admin_users', 'email')],
            'password'      => 'required|confirmed'
        ]);
        $adminUser = new AdminUser;
        $adminUser->fill([
            'firstname' => $request->post('firstname'),
            'lastname'  => $request->post('lastname'),
            'email' => $request->post('email'),
            'password'  => Hash::make($request->post('password')),
            'role'  => 1
        ]);

        try {
            $adminUser->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to create new User.');
        }
        return $this->json(true, 'New Staff / User Created', 'reload');
    }

    public function updateDetail(Request $request, AdminUser $user)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name' => 'required',
            'email_address'     => ['required', Rule::unique('admin_users', 'email')->ignore($user->getKey(), 'id')]
        ]);

        $user->firstname = $request->post('first_name');
        $user->lastname = $request->post('last_name');
        $user->email = $request->post('email_address');

        try {
            $user->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update your information.');
        }

        return $this->json(true, 'Your information has been updated.');
    }

    public function changePassword(Request $request, AdminUser $user)
    {
        $request->validate([
            'new_password'  => 'required|confirmed'
        ]);

        $user->password = Hash::make($request->post('new_password'));

        try {
            $user->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update Password.');
        }

        return $this->json(true, 'Password Updated.');
    }
}
