<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>Account</strong></li>
                <li id="personal" class="active"><strong>Personal</strong></li>
                <li id="payment" class="active"><strong>Family Information</strong></li>
                <li id="jap" class="active"><strong>Jap Information</strong></li>
                <li id="profile" class="active"><strong>Profile Picture</strong></li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-lg-7">
                            <div class="row my-2">
                                <div class="col-md-8">
                                    <div class="alert alert-danger error-reporting error-reporting_default d-none"></div>
                                    <div class="alert alert-info">
                                        Please upload YOUR individual Profile Picture (single photo). This image will be used to create your ID card for yagya.

                                    </div>
                                    <div class="form-group">
                                        <label>Upload Your Image <span class="text-danger">({{session()->get('registration_detail')['full_name']}})</span></label>
                                        <input onchange="window.Registration.changeProfile(this,{profileID : 'default'})" type="file"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="@if(isset(session()->get('registration_detail')['profile_url'])){{session()->get('registration_detail')['profile_url']}}@endif" class="img-fluid w-50 display_profile_picture_default">
                                    <input type="hidden"  class="profile_picture" name="profile_picture_default" id="profile_picture_default" value="@if(isset(session()->get('registration_detail')['profile_url'])){{session()->get('registration_detail')['profile_url']}}@endif">
                                </div>
                            </div>
                            @foreach (session()->get('registration_detail')['family_detail']['members'] as $key => $family_member)
                                <div class="row my-2">
                                    <div class="col-md-8">
                                        <div class="alert alert-danger error-reporting error-reporting_{{$key}} d-none"></div>
                                        <div class="alert alert-info">
                                            Please upload an individual Profile Picture (single photo) for each member. This image will be used to create your ID card for the Yagya.

                                        </div>
                                        <div class="form-group">
                                            <label>Upload Profile For  <span class="text-danger">({{ $family_member['name'] }})</span></label>
                                            <input onchange="window.Registration.changeProfile(this,{profileID : {{$key}}})" type="file"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="@if(isset($family_member['profile'])){{$family_member['profile']}}@endif" class="img-fluid w-50 display_profile_picture_{{$key}}">
                                        <input type="hidden" class="profile_picture" name="profile_picture_{{$key}}" id="profile_picture_{{$key}}" value="@if(isset($family_member['profile'])){{$family_member['profile']}}@endif">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row no-gutters my-3">
                        <div class="col-md-11 text-end">
                            <button type="button" onclick="window.Registration.stepBack()" class="edu-btn  bg-info">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </button>
                            &nbsp;
                            <button class="edu-btn btn-secondary registration-progress-button" disabled type="button">
                                Submit My Application
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
<script>
    window.Registration.checkProfilePictures();
</script>
