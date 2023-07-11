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
                                    <select name="document_validate" id="document_validate" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="approve">Approve</option>
                                        <option value="reject">Reject</option>
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
                                    <select name="document_validate" id="document_validate" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="approve">Approve</option>
                                        <option value="reject">Reject</option>
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
