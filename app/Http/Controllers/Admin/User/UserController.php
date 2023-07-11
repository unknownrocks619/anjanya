<?php

namespace App\Http\Controllers\Admin\User;

use App\Classes\Helpers\FileUpload;
use App\Classes\Import\BulkImport;
use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Jobs\BulkImportJobSync;
use App\Models\Admin\AdminUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //

    public function __construct()
    {
        app('hooks')->registerHooks('components.component-edit', new Hook('users.customers.tab', function () {
            return  [
                'name' => __('admin/users/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));
    }

    public function index()
    {
        $users = AdminUser::get();
        return $this->admin_theme('users.list', ['users' => $users]);
    }

    public function customer_index($options = null)
    {
        $queryQuery = User::where('current_step', 'complete');
        if ($options) {
            $queryQuery->where('role', $options);
        }
        $users = $queryQuery->get();

        return $this->admin_theme('users.customers.list', ['users' => $users, 'options' => $options]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'email'     => 'required|email|unique:users,email',
            'username'  => 'nullable|unique:users,username'
        ]);

        $user = new User();
        $password = ($request->has('password')) ? $request->post('password') : Str::random(8);
        $user->fill([
            'first_name'        => $request->post('firstname'),
            'middle_name'       => $request->post('middlename'),
            'last_name'         => $request->post('lastname'),
            'country'           => $request->post('country'),
            'state'             => $request->post('state'),
            'street_address'    => $request->post('street_address'),
            'date_of_birth'     => $request->post('date_of_birth'),
            'gender'            => $request->post('gender'),
            'phone_number'      => $request->post('phone_number'),
            'username'          => $request->has('username') ? $request->post('username') : Str::random(8),
            'source_record'     => ['created_by', Auth::guard('admin')->user()],
            'password'          => Hash::make($password),
            'email'             => $request->post('email'),
            'invite_token'      => strtoupper(\Illuminate\Support\Str::random(12))
        ]);

        try {
            $user->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to create user record.', '', ['error' => $th->getMessage()]);
        }

        return $this->json(true, 'New User Record Created.', 'reload');
    }

    public function edit_customer(Request $request, User $customer, $current_tab = 'general')
    {

        if ($request->post()) {
            return $this->update_customer($request, $customer);
        }
        $customer->load('getUserMeta');
        $tabs = [
            'general'   => $customer,
            'password'  => $customer,
            'documents' => $customer,
            'educations'    => $customer->getUserMeta,
            'parents'       => $customer->getUserMeta
        ];

        return $this->admin_theme('users.customers.edit', ['tabs' => $tabs, 'user' => $customer, 'current_tab' => $current_tab]);
    }

    public function edit(User $user)
    {
        return $this->admin_theme('users.edit', ['user' => $user]);
    }


    public function update_customer(Request $request, User $customer)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username'      => 'required',
            'user_role'     => 'required',
            'country'       => 'required',
            'billing_state' => 'required',
            'billing_postcode'   => 'required',
            'billing_street_address'    => 'required',
            'shipping_city'          => 'required_without:same_as_billing',
            'shipping_postcode'      => 'required_without:same_as_billing',
            'shipping_street_address'    => 'required_without:same_as_billing',
            'shipping_country'          => 'required_without:same_as_billing',
        ]);

        $customer->first_name = $request->post('first_name');
        $customer->middle_name  = $request->post('middle_name');
        $customer->last_name = $request->post('last_name');
        $customer->country  = $request->post('country');
        $customer->status = $request->has('active') ? 'active' : 'hold';
        $customer->role = $request->post('user_role');
        $customer->gender = $request->post('gender');
        $customer->date_of_birth = $request->post('date_of_birth') ? $request->post('date_of_birth') : $customer->date_of_birth;
        $customer->state = $request->post('billing_state');

        $customer->username = $request->post('username');

        if ($customer->isDirty('username') && $customer::check_username($request->post('username'), $customer)) {
            // verify customer username
            return $this->generateValidationError('username', 'Username already exists.');
        }

        $street_address = $customer->street_address;
        $address = [
            'billing_street_address'    => $request->post('billing_street_address'),
            'billing_city'              => $request->post('billing_state'),
            'billing_postcode'          => $request->post('billing_postcode'),
            'same_as_billing'           => $request->has('same_as_billing') ? true : false,
            'shipping_city'             => $request->has('same_as_billing') ?  $request->post('billing_state') : $request->post('shipping_city'),
            'shipping_postcode'         => $request->has('same_as_billing') ?  $request->post('billing_postcode') : $request->post('shipping_postcode'),
            'shipping_street_address'   => $request->has('same_as_billing') ?  $request->post('billing_street_address') : $request->post('shipping_street_address'),
            'shipping_country'          => $request->has('same_as_billing') ?   $customer->country : $request->post('shipping_country')
        ];
        $customer->street_address = $address;
        $customer->phone_number = $request->post('phone_number');

        try {
            $customer->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update user detail.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'User Detail Updated.');
    }

    public function updatePassword(Request $request, User $customer)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $customer->password = Hash::make($request->post('password'));
        $customer->save();
        return $this->json(true, 'User Password Updated.');
    }

    public function uploadFile(Request $request, $user)
    {
        $user = AdminUser::find($user);
        $uploadedFile = FileUpload::upload($request->file('file'), $user);
        $filename = $uploadedFile[0]['file']->filename;
        BulkImportJobSync::dispatch($filename);
        return $this->json(true, 'File Has been uploaded, User Import is running on background.', 'reload');
    }

    public function viewAsCustomer(User $user)
    {
        Auth::login($user, false);
        $expireTime = Carbon::now()->addMinutes(15);
        session()->put('expire_time', $expireTime);
        return redirect()->route('frontend.users.dashboard');
    }

    public function logoutAsUser(User $user)
    {
        Auth::guard('web')->logout();
        session()->forget(['expire_time', 'DEBUG_MODE']);
        return redirect()->route('admin.users.customers.index');
    }
}
