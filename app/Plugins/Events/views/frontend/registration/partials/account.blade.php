<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>Account</strong></li>
                <li id="personal"><strong>Personal</strong></li>
                <li id="payment"><strong>Family Information</strong></li>
                <li id="jap"><strong>Jap Information</strong></li>
                <li id="profile"><strong>Yagya Photo Card</strong></li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
            <div class="card border-0">
                <div class="card-body p-0">
                    <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
                        <div class="row no-gutters justify-content-center">
                        <div class="col-lg-5">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" disabled value="{{session()->get('registration-email')}}" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-5">
                                            <label for="exampleInputPassword1">
                                                Password
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
                                                Confirm Password
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
                                            back
                                        </button>
                                        <button type="button" class="edu-btn" onclick="window.Registration.submitForm(this)">
                                            Next
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
