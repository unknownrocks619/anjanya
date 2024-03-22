<div class="container checkout-page-style">

    <div class="row g-5 justify-content-center">
        <div class="col-lg-8 border-start border-end">
            <div class="login-form-box border-1">
                <h3 class="mb-30"><span class="text-danger">Volunteer </span> {{__('web/registration/events.registration')}} - Setup Account</h3>
                <div class="row my-3">
                    <div class="col-md-12">
                        <p class="fs-1 text-info">
                            Pleaes create a password your account.
                        </p>
                    </div>
                </div>
                <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.volunteer.registration-store')}}">
                    <input type="hidden" name="previous" value="validateAccount">
                    <input type="hidden" name="step" value="setupAccount">
                
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email
                                    <sup class="text-danger">*</sup>
                                </label>
                                    <input type="email" name="email" id="email" readonly class="form-control disabled" value="{{$email}}" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">New Password
                                    <sup class="text-danger">*</sup>
                                </label>
                                    <input type="password" name="password" id="password" class="form-control bg-white border" placeholder="Create your New Password" value="" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password
                                    <sup class="text-danger">*</sup>
                                </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-white border" placeholder="Confirm Your new password"  />
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
