<div class="container checkout-page-style">

    <div class="row g-5 justify-content-center">
        <div class="col-lg-8">
            <div class="login-form-box border-1">
                <h3 class="mb-30"><span class="text-danger">Volunteer </span> {{__('web/registration/events.registration')}} - Account Validate</h3>
                <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.volunteer.registration-store')}}">
                    <input type="hidden" name="step" value="passwordConfirmation">
                    @csrf
                    <div class="row my-2">
                        <div class="col-md-12">
                            <div class='ajax-form-message-box'></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="email" name="email" value="{{$email}}" id="email" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password">Password
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <div class="text-end">
                                        <a href="https://jagadguru.siddhamahayog.org/forgot-password" class="text-danger">Forgot Password ?</a>
                                    </div>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <button class="rn-btn edu-btn btn btn-success my-3 w-100 mb--30" onclick="window.VolunteerRegistration.submitForm(this)" type="button">
                        <span>{{__('web/registration/events.proceed')}}</span>
                    </button>
                </form>

            </div>
            
        </div>
    </div>
</div>
