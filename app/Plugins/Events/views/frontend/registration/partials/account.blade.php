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
            <div class="card border-0">
                <div class="card-body p-0">
                    <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
                        <div class="row no-gutters justify-content-center">
                        <div class="col-lg-6 col-md-10 col-sm-12">
                            <div class="row ps-5">
                                <div class="col-md-12">
                                    <h3  class="text-danger">
                                        {{__('web/registration/events.please-create-new-password')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="p-5 pt-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('web/registration/events.email-address') }}</label>
                                            <input type="email" name="email" disabled value="{{session()->get('registration-email')}}" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
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
                                    <div class="col-md-12">
                                        <div class="form-group mb-5">
                                            <label for="confirm_password">
                                                {{__('web/registration/events.confirm-password')}}
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="password" required name="password_confirmation" id="confirm_password" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <button type="button" onclick="window.Registration.stepBack()" class="edu-btn  bg-info">
                                            <i class="fas fa-arrow-left"></i>
                                            {{__('web/registration/events.back')}}
                                        </button>
                                        <button type="button" class="edu-btn" onclick="window.Registration.submitForm(this)">
                                            {{__('web/registration/events.next')}}
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
            <!-- end row -->
    </div>
    <!-- Row -->
</div>
