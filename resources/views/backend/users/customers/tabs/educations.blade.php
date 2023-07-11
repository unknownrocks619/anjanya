<form action="{{ route('admin.users.customers.edit', ['customer' => $user]) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="first_name">Education Level
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                    required="" placeholder="First name" autocomplete="off"
                                    value="{{ $content->first_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="middle_name">Education Major</label>
                                <input class="form-control" id="middle_name" name="middle_name" type="text"
                                    placeholder="Middle Name" autocomplete="off" value="{{ $content->middle_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-4">
                            <div class="form-group">
                                <label for="last_name">Profession</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    required="" placeholder="Last Name" autocomplete="off"
                                    value="{{ $content->last_name }}">
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
