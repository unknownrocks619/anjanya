<form action="{{ route('admin.users.customers.edit', ['customer' => $user]) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="first_name">First Name
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                    required="" placeholder="First name" autocomplete="off"
                                    value="{{ $content->gaurdian_info?->first_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="middle_name">Last Name</label>
                                <input class="form-control" id="middle_name" name="middle_name" type="text"
                                    placeholder="Middle Name" autocomplete="off"
                                    value="{{ $content->gaurdian_info?->last_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-4">
                            <div class="form-group">
                                <label for="last_name">Relation</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    required="" placeholder="Last Name" autocomplete="off"
                                    value="{{ $content->gaurdian_info?->relationship }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-4">
                            <div class="form-group">
                                <label for="last_name">Email Address</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    required="" placeholder="Last Name" autocomplete="off"
                                    value="{{ $content->gaurdian_info?->email_address }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-4">
                            <div class="form-group">
                                <label for="last_name">Phone Number</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    required="" placeholder="Last Name" autocomplete="off"
                                    value="{{ $content->gaurdian_info?->phone_number }}">
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 mt-4">
                            <div class="form-group d-flex align-items-center mt-1">
                                <div class="m-t-15 m-checkbox-inline">
                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                        <input @if ($content->gaurdian_info?->is_sadhak) checked @endif class="form-check-input"
                                            name="active" id="active" type="checkbox" data-bs-original-title=""
                                            title="Active">
                                        <label class="form-check-label" for="active">
                                            Sadhak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_full_name">Emergency Contact Full Name</label>
                                <input type="text" name="emergency_contact_full_name" id="emergency_full_name"
                                    value="{{ $content->emergency_contact?->full_name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_contact_number">Emergency Contact Number</label>
                                <input type="text" name="emergency_contact_number" id="emergency_contact_number"
                                    value="{{ $content->emergency_contact?->contact }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emergency_contact_relation">Relation with Emergency Contact</label>
                                <input type="text" name="relation_with_emergency_contact"
                                    id="relation_with_emergency_contact"
                                    value="{{ $content->emergency_contact?->relation }}" class="form-control" />
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
                Update Emergecy Contact Info
            </button>
        </div>
    </div>
</form>
