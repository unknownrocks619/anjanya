<?php

namespace App\Http\Controllers\Web\Profile;

use App\Classes\Helpers\FileUpload;
use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Jobs\BulkImportJobSync;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    //
    public function settings(Request $request, $current_tab = 'profile')
    {
        $user = auth()->guard('web')->user();


        /**
         * Profile Image
         */
        if ($request->file('profile')) {
            $userProfile = Image::uploadImage($request->file('profile'), $user);
            $image = $userProfile[0]['image'];
            return $this->json(true, 'Upload Sucess.', 'profileImage', ['image_path' => Image::getImageAsSize($image->filepath, 's')]);
        }

        if ($request->post()) {

            /**
             * Billing & Shipping Address
             */

            if ($request->has('billing_country')) {

                $request->validate([
                    'billing_street_address' => 'required',
                    'billing_state'          => 'required',
                    'billing_postcode'      => 'required',
                    'shipping_city'          => 'required_without:same_as_billing',
                    'shipping_postcode'      => 'required_without:same_as_billing',
                    'shipping_street_address'    => 'required_without:same_as_billing'
                ], [
                    'shipping_city.required_if' => 'City field is required',
                    'shipping_postcode' => 'Post Code is required.',
                    'shipping_street_address'   => 'Unit , Street Number, Street Name is required.'
                ]);

                $address = [
                    'billing_street_address'    => $request->post('billing_street_address'),
                    'billing_city'              => $request->post('billing_state'),
                    'billing_postcode'          => $request->post('billing_postcode'),
                    'same_as_billing'           => $request->has('same_as_billing') ? true : false,
                    'shipping_city'             => $request->has('same_as_billing') ?  $request->post('billing_city') : $request->post('shipping_city'),
                    'shipping_postcode'         => $request->has('same_as_billing') ?  $request->post('billing_postcode') : $request->post('shipping_postcode'),
                    'shipping_street_address'   => $request->has('same_as_billing') ?  $request->post('billing_street_address') : $request->post('shipping_street_address'),
                    'shipping_country'          => $request->has('same_as_billing') ? $user->country : $request->post('shipping_country')
                ];

                $user->street_address = $address;
                $user->save();

                return $this->json(true, 'Billing & Shipping address updated.');
            }


            /**
             * Basic profile
             */
            if (!$request->has('billing_country') && !$request->file('profile') && !$request->has('password')) {
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'country'   => 'required',
                ]);
                $user->first_name = $request->post('first_name');
                $user->last_name = $request->post('last_name');
                $user->country = $request->post('country');
                $user->date_of_birth = $request->post('date_of_birth');
                $user->save();
                return $this->json(true, 'Personal Detail updated.');
            }

            /**
             * password
             */
            if ($request->has('password')) {
                $request->validate([
                    'password' => ['required', 'confirmed', Password::min(6)->mixedCase()->numbers()]
                ], [
                    'password.confirmed' => 'Password does not match',
                ]);

                $user->password = Hash::make($request->post('password'));
                $user->save();
                return $this->json(true, 'Password Updated.');
            }
        }



        $tabs = [
            'profile'   => $user,
        ];

        if ($user->role == 'teacher') {

            $tabs['students'] = [];
            $teacherOrganisation = $user->getOrganisation;

            if ($teacherOrganisation) {

                $userId = \App\Models\OrganisationStudent::where('org_id', $teacherOrganisation->org_id)
                    ->where('id', '!=', $teacherOrganisation->getKey())
                    ->where('shared_through', $user->invite_token)
                    ->get()
                    ->groupBy('user_id')
                    ->toArray();

                $userId  = array_keys($userId);
                $users = User::with(['getImage' => function ($query) {
                    $query->with(['image']);
                }, 'getLatestCourse' => function ($query) {
                    $query->with(['getCourse' => function ($query) {
                        $query->with(['lessions']);
                    }, 'getHistory']);
                }])->whereIn('id', $userId)->get();

                $tabs['students'] = $users;
            }
        }

        $current_tab = !in_array($current_tab, array_keys($tabs)) ? 'profile' : $current_tab;
        return $this->user_theme('profile.settings', ['tabs' => $tabs, 'current_tab' => $current_tab, 'user' => $user]);
    }

    public function remove_profile_picture()
    {

        $user = auth()->guard('web')->user();
        $user->getImage()->delete();

        return $this->json(true, '', 'reload');
    }

    public function uploadImport(Request $request)
    {
        $user = auth()->guard('web')->user();
        $uploadedFile = FileUpload::upload($request->file('file'), $user);
        $filename = $uploadedFile[0]['file']->filename;
        $imageRelation = $uploadedFile[0]['relation'];

        $imageRelation->type = 'bulk_import_excel';
        $imageRelation->save();

        BulkImportJobSync::dispatchSync($filename, $user);
        return $this->json(true, 'File Has been uploaded, User Import is running on background.', 'reload');
    }
}
