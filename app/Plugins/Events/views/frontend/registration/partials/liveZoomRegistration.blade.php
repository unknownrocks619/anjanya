<div class="container-fluid">
    <div class="row justify-content-center">
        <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
            <div class="card border-0">
                <div class="card-body p-3">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="ps-5">
                                @if( ! session()->has('registration_detail') && ! isset(session()->get('registration_detail')['first_name']))
                                    <div class="row my-3">
                                        <div class="col-md-12">
                                            <h4>Create New Account</h4>
                                        </div>
                                    </div>
                                @endif
                                <div class="row my-2">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="email_email">
                                                {{__('web/registration/events.email-address')}}
                                            </label>
                                            <input type="text" name="email" id="email" readonly class="form-control" value="{{session()->get('registration-email')}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="first_name">{{__('web/registration/events.first-name')}}
                                            <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" name="first_name" value="" class="form-control" id="first_name">
                                        </div>
                                    </div>

                                    <div class="col-md-12  col-lg-6 col-sm-12">
                                        <div class="form-group mb-5">
                                            <label for="last_name">
                                                {{__('web/registration/events.last-name')}}
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" name="last_name" value="" required class="form-control" id="last_name">
                                        </div>
                                    </div>
                                </div>

                                @if( ! session()->has('registration_detail') && ! isset(session()->get('registration_detail')['first_name']))
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-5">
                                                <label for="exampleInputPassword1">
                                                    {{__('web/registration/events.password')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-5">
                                                <label for="confirm_password">
                                                    {{__('web/registration/events.confirm-password')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="password" required name="password_confirmation" id="confirm_password" value="" />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters my-3">
                        <div class="col-md-11 text-end d-flex justify-content-end">
                            <button type="button" onclick="window.Registration.stepBack()" class="edu-btn bg-info">
                                <i  class="fas fa-arrow-left"></i>
                                {{__('web/registration/events.back')}}
                            </button>
                            &nbsp;
                            <button class="edu-btn" type="button" onclick="window.Registration.submitForm(this)">
                                {{__('web/registration/events.next')}}
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Row -->
</div>
