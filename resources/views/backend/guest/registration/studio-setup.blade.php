@extends('themes.studio.studio');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Setup Your Studio</h3>
                    </div>
                    <div class="card-body">
                        <form class="f1 studio-setup-steps ajax-append" method="post"
                            action="{{ route('studio.registration.store', [$tab, $studio]) }}">
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line"
                                        data-now-value="@if ($tab == 1) 33.33 @elseif($tab == 2) 66.66 @else 100 @endif"
                                        data-number-of-steps="3"></div>
                                </div>
                                <div class="f1-step @if ($tab >= 1) active @endif">
                                    <div class="f1-step-icon"><i class="fa fa-building"></i></div>
                                    <p>Studio Information</p>
                                </div>
                                <div class="f1-step @if ($tab >= 2) active @endif">
                                    <div class="f1-step-icon"><i class="fa fa-picture-o"></i></div>
                                    <p>Logo and Branding</p>
                                </div>
                                <div class="f1-step @if ($tab >= 3) active @endif">
                                    <div class="f1-step-icon"><i class="fa fa-eye"></i></div>
                                    <p>Overview</p>
                                </div>
                            </div>
                            <div class="steps">
                                @if ($tab == 1)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="studio_name">Studio Name
                                                            <sup class="text-danger">*</sup>
                                                        </label>
                                                        <input type="text" name="studio_name" id="studio_name"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="studio_website">Studio Website</label>
                                                        <input type="url" name="studio_website" id="studio_website"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Address
                                                            <sup class="text-danger">
                                                                *
                                                            </sup>
                                                        </label>
                                                        <textarea name="address" id="address" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone_number">
                                                            Business Phone Number
                                                        </label>
                                                        <input type="text" name="business_phone_number"
                                                            id="business_phone_number" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact_person">
                                                            Contact Person
                                                            <sup class="text-danger">*</sup>
                                                        </label>
                                                        <input type="text"
                                                            value="{{ auth()->user()->first_name_usr }} {{ auth()->user()->last_name_usr }}"
                                                            name="contact_person" id="contact_person"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact_phone_number">Contact Person Phone Number
                                                            <sup class="text-danger">*</sup>
                                                        </label>
                                                        <input type="text"
                                                            value="{{ auth()->user()->mobile_number_usr }}"
                                                            name="contact_phone_number" id="contact_phone_number"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($tab == 2 && $studio)
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header pb-0">
                                                    <h3>Upload Your Studio Logo</h3>
                                                </div>
                                                @include('parts.dropzone')
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($tab == 3 && $studio)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Welcome, Mr. {{ auth()->user()->last_name_usr }}</h3>
                                            <p>
                                                Photostudio Management Software is pleased to welcome you onboard. If you
                                                have any bugs or issued.
                                                pelase write us below:
                                                <br />
                                                <strong>
                                                    Email:
                                                </strong>
                                                bugs@photonepal.com
                                                <br /><br />
                                                Best Regar,
                                                <br />
                                                Krishna Parajuli (CEO)
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-12 text-danger">
                                            Something Went Wrong ! Please Try Again.
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12  d-flex justify-content-end">
                                        <button type="submit" class="btn btn-pill btn-primary btn-air-primary w-25"
                                            @if ($tab == 2) disabled='true' @endif>
                                            @if ($tab == 3)
                                                Go To Dashboard
                                            @else
                                                Next
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
