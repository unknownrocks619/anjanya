<form class="form-bookmark needs-validation ajax-form" method="post"
    action="{{ route('admin.organisation_student.organisation_student_store', ['organisation' => $org]) }}"
    id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Add New Staff / Student
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-6 mt-0">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" id="first_name" name="first_name" type="text" required=""
                            placeholder="First Name" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 col-md-6 mt-0">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" id="last_name" name="last_name" type="text" required=""
                            placeholder="Last Name" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="roles">User Role</label>
                        <select name="roles" id="roles" class="form-control no-select-2">
                            @foreach (App\Models\User::USER_ROLES as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Username" id="username"
                            class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control no-select-2">
                            @foreach (\App\Models\Country::get() as $country)
                                <option @if ($country->getKey() == 13) selected @endif
                                    value="{{ $country->getKey() }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" selected>Active</option>
                            <option value="hold">Hold</option>
                            <option value="reject">Reject</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-secondary mx-2" type="submit" onclick="submitContact()">Save</button>
                    <button class="btn btn-primary mx-2" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
