<form action="{{ route('admin.users.customers.update_password', ['customer' => $user]) }}" class="ajax-form"
    method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="password">New Password
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input class="form-control" id="password" name="password" type="password"
                                    required="" placeholder="New Password" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-2">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input class="form-control" id="confirm_password" name="password_confirmation"
                                    type="password" placeholder="Confirm new Password" autocomplete="off" />
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
                Update Password
            </button>
        </div>
    </div>
</form>
