<?php

namespace App\Http\Controllers\Admin\Organisation;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\OrganisationStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrganisationStudentController extends Controller
{
    //

    public function store(Request $request, Organisation $organisation)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email'     => 'required',
            'roles'     => 'required',
            'country'   => 'required'
        ]);

        $userStudent = new User;

        $userStudent->fill([
            'first_name'    => $request->post('first_name'),
            'last_name'     => $request->post('last_name'),
            'country'       => $request->post('country'),
            'date_of_birth' => $request->post('date_of_birth'),
            'gender'        => $request->post('gender'),
            'source'        => 'admin_entry',
            'phone_number'  => $request->post('phone_number'),
            'status'        => $request->post('status'),
            'role'        => $request->post('roles'),
            'current_step'  => 'complete',
            'terms'         => true,
            'email'         => $request->post('email'),
            'password'      => $request->post('password') ? Hash::make($request->post('password')) : Hash::make(\Illuminate\Support\Str::random(8)),
            'username'      => $request->post('username'),
            'invite_token'  => strtoupper(\Illuminate\Support\Str::random(12))
        ]);

        $organisationStudent = new OrganisationStudent();
        $organisationStudent->fill([
            'org_id'    => $organisation->getKey(),
            'active'    => ($request->post('status') == 'active') ? true : false,
            'role'      => $request->post('roles')
        ]);

        try {
            DB::transaction(function () use ($organisationStudent, $userStudent) {
                $userStudent->save();
                $organisationStudent->user_id = $userStudent->getKey();
                $organisationStudent->save();
            });
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to insert new record.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'New record recorded.', 'reload');
    }
}
