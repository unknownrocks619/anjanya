<form action="{{ route('admin.users.customers.edit', ['customer' => $user]) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="first_name">First Name
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                    required="" placeholder="First name" autocomplete="off"
                                    value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input class="form-control" id="middle_name" name="middle_name" type="text"
                                    placeholder="Middle Name" autocomplete="off" value="{{ $user->middle_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    required="" placeholder="Last Name" autocomplete="off"
                                    value="{{ $user->last_name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type='date' name="date_of_birth" class="form-control"
                                    value="{{ $user->date_of_birth }}" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="male" @if ($user->gender == 'male') selected @endif>
                                        Male
                                    </option>
                                    <option value="female" @if ($user->gender == 'female') selected @endif>
                                        Female
                                    </option>
                                    <option value="other" @if ($user->gender == 'other') selected @endif>
                                        Other
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="form-control phone_number" value="{{ $user->phone_number }}" />
                            </div>
                        </div>
                    </div>


                    <div class="row g-2 my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ $user->username }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source">User Enrolled Source</label>
                                <input type="text" name="enrleed_source" id="enrolled_source" class="form-control"
                                    disabled value="{{ $user->source }}">
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 my-2 bg-light">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="text-dark">Email
                                    <sup class="text-danger">
                                        *
                                    </sup>
                                </label>
                                <input type="email" name="email" id="email"
                                    @if ($user->email_verified_at) disabled @endif value="{{ $user->email }}"
                                    class="form-control">
                                @if (!$user->email_verified_at)
                                    <a href="">Send Verification Link</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_role">User role</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    @foreach (\App\Models\User::USER_ROLES as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($key == $user->role) selected @endif>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group d-flex align-items-center mt-1">
                                <div class="m-t-15 m-checkbox-inline">
                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                        <input {{ $user->status == 'active' ? 'checked' : '' }}
                                            class="form-check-input" name="active" id="active" type="checkbox"
                                            data-bs-original-title="" title="Active">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    



                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update User Information
            </button>
        </div>
    </div>
</form>
