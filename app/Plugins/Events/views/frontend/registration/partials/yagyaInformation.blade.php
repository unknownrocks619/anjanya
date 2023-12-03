<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>Account</strong></li>
                <li id="personal" class="active"><strong>Personal</strong></li>
                <li id="family" class="active"><strong>Family Information</strong></li>
                <li id="jap" class="active"><strong>Jap Information</strong></li>
                <li id="profile"><strong>Profile Image</strong></li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-lg-7">
                            <div class="p-5">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jap_start_date">Jap() Start Date</label>
                                            <input type="date" name="jap_start_date" @if(isset(session()->get('registration_detail')['jap_detail']['jap_start_date'])) value="{{session()->get('registration_detail')['jap_detail']['jap_start_date']}}" @endif class="form-control" id="jap_start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jap_count_to_date">Total Jap Count</label>
                                            <input type="number" min="1" name="total_jap_count" @isset(session()->get('registration_detail')['jap_detail']['total_jap_count']) value="{{session()->get('registration_detail')['jap_detail']['total_jap_count']}}" @endisset  class="form-control" id="jap_count_to_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label for="estimated_jap_count">
                                                Estimated Total Jap
                                            </label>
                                            <input type="number" name="estimated_jap" @isset(session()->get('registration_detail')['jap_detail']['estimated_jap']) value="{{session()->get('registration_detail')['jap_detail']['estimated_jap']}}" @endisset class="form-control" id="estimated_jap_count">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row no-gutters my-3">
                        <div class="col-md-11 text-end">
                            <button type="button" onclick="window.Registration.stepBack()" class="edu-btn bg-info">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </button>
                            &nbsp;
                            <button class="edu-btn" type="button" onclick="window.Registration.submitForm(this)">
                                Next
                                <i class="fas fa-arrow-right"></i>
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
