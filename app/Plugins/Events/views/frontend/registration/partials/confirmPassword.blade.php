<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>{{__('web/registration/events.account') }}</strong></li>
                <li id="personal"><strong>{{__('web/registration/events.personal') }}</strong></li>
                <li id="payment"><strong>{{__('web/registration/events.family-information') }}</strong></li>
                <li id="jap"><strong>{{__('web/registration/events.jaap-information') }}</strong></li>
                <li id="profile"><strong>{{ __('web/registration/events.yagya-photo-card') }}</strong></li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-md-7 p-5">
                            <h4>
                                Please Enter your password
                            </h4>
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" disabled value="{{session()->get('registration-email')}}" class="form-control disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-between">
                                        <button class="edu-btn" type="button" onclick="window.Registration.submitForm(this)">Login
                                        </button>
                                        <a class="text-danger" href="https://jagadguru.siddhamahayog.org/forgot-password">Forgot Password</a>
                                    </div>
                                </div>
                                @if(session()->has('invalid_attempt'))
                                    <div class="row mt-4">
                                        <div class="col-md-7 alert alert-danger error-reporting">
                                            {{session()->get('invalid_attempt')}}
                                            @php session()->forget('invalid_attempt') @endphp
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row no-gutters my-3">
                        <div class="col-md-11 text-end">
                            <button type="button" onclick="window.Registration.stepBack()" class="edu-btn  bg-info">
                                <i class="fas fa-arrow-left"></i>
                                back
                            </button>
                        </div>

                    </div>
                </div>
                <!-- end card-body -->
            </div>
        </form>
    </div>
    <!-- Row -->
</div>
