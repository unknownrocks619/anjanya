<div class="container checkout-page-style">

    <div class="row g-5 justify-content-center">
        <div class="col-lg-8">
            <div class="login-form-box border-1">
                <h3 class="mb-30"><span class="text-danger">Volunteer </span> {{__('web/registration/events.registration')}}</h3>
                <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.volunteer.registration-store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-box mb--30">
                                    <input type="text" name="email" placeholder="{{__('web/registration/events.email-address')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="rn-btn edu-btn btn btn-success my-3 w-100 mb--30" onclick="window.Registration.submitForm(this)" type="button">
                        <span>{{__('web/registration/events.proceed')}}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
