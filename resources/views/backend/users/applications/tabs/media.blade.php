<form action="{{ route('admin.users.customers.edit', ['customer' => $user]) }}" class="ajax-form" method="post">
    @php
        $userProfile = \App\Models\FileRelation::where('relation', $user::class)
            ->where('relation_id', $user->getKey())
            ->where('type', 'profile_picture')
            ->latest()
            ->first();
        $userVerificationCard = \App\Models\FileRelation::where('relation', $user::class)
            ->where('relation_id', $user->getKey())
            ->where('type', 'verification_card')
            ->latest()
            ->first();
    @endphp
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Document Type
                                </th>
                                <th>

                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Profile Photo
                                </td>
                                <td>
                                    <a
                                        href="{{ \App\Classes\Helpers\Image::getImageAsSize($userProfile->image->filepath, 'cus') }}">
                                        <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($userProfile->image->filepath, 'm') }}"
                                            class="img-fluid w-25" />
                                    </a>
                                </td>
                                <td>
                                    <select name="profile_validate update_application_media" id="profile_validate"
                                        data-method="post"
                                        data-action="{{ route('admin.users.applications.profile_status', ['application' => $application]) }}"
                                        class="form-control update_application_media">
                                        <option value="">Select Option</option>
                                        <option value="true" @if ($application->user_profile_approved === true) selected @endif>
                                            Approve</option>
                                        <option value="false" @if ($application->user_profile_approved === false) selected @endif>Reject
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Verification ID
                                </td>
                                <td>
                                    <a
                                        href="{{ \App\Classes\Helpers\Image::getImageAsSize($userVerificationCard->image->filepath, 'cus') }}">
                                        <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($userVerificationCard->image->filepath, 'm') }}"
                                            class="img-fluid w-25" />
                                    </a>
                                </td>
                                <td>
                                    <select name="document_validate update_application_media" id="document_validate"
                                        class="form-control update_application_media" data-method="post"
                                        data-action="{{ route('admin.users.applications.identity_status', ['application' => $application]) }}">
                                        <option value="">Select Option</option>
                                        <option value="true" @if ($application->user_identity_approved === true) selected @endif>
                                            Approve</option>
                                        <option value="false" @if ($application->user_identity_approved === false) selected @endif>Reject
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</form>
