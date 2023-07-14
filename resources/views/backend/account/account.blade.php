@extends('themes.admin.master')

@push('page_title')
    - Account Setting
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Account Settings</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-4">
                <form action="{{ route('admin.admin-account.settings', ['user' => $user]) }}" class="ajax-form ajax-append"
                    method="post">
                    <input type="hidden" name="type" value="information">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class='text-white'>Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" value="{{ $user->firstname }}" name="first_name"
                                            id="first_name" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">
                                            Last Name
                                        </label>
                                        <input type="text" value="{{ $user->lastname }}" name="last_name" id="last_name"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="text" value="{{ $user->email }}" name="email_address"
                                            id="email_address" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Update Information
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Zero Configuration  Ends-->
            <div class="col-sm-4">
                <form action="{{ route('admin.admin-account.settings', ['user' => $user]) }}" class="ajax-form ajax-append"
                    method="post">
                    <input type="hidden" name="type" value="password" />
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">
                                Password
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="new_password_confirmation">Confirm Password</label>
                                        <input type="password" name="new_password_confirmation"
                                            id="new_password_confirmation" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>
@endsection
