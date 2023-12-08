@php
    $jsLangFile = [
        'dialogue_box_title' => __('web/registration/events.submit-your-information'),
        'dialogue_box_description' => __('web/registration/events.submit-your-information-description'),
        'dialouge_box_cancel_label' => __('web/registration/events.recheck'),
        'dialouge_box_approve_label' => __('web/registration/events.all-information-are-correct')
]
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>{{__('web/registration/events.account') }}</strong></li>
                <li class="active" id="personal" ><strong>{{__('web/registration/events.personal') }}</strong></li>
                <li class="active" id="payment"><strong>{{__('web/registration/events.family-information') }}</strong></li>
                <li class="active" id="jap"><strong>{{__('web/registration/events.jaap-information') }}</strong></li>
                <li class="active" id="profile"><strong>{{ __('web/registration/events.yagya-photo-card') }}</strong></li>

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
                                <div class="col-md-12">
                                    <div class="alert alert-danger error-reporting error-reporting_default d-none"></div>
                                    <div class="alert alert-info">
                                        {{__('web/registration/events.upload-your-individual-image-notice')}}
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            {{__('web/registration/events.upload-your-photo')}}
                                            <span class="text-danger">({{session()->get('registration_detail')['full_name']}})</span></label>
                                        <input onchange="window.Registration.changeProfile(this,{profileID : 'default'})" type="file"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="@if(isset(session()->get('registration_detail')['profile_url'])){{session()->get('registration_detail')['profile_url']}}@endif" class="img-fluid w-50 display_profile_picture_default">
                                    <input type="hidden"  class="profile_picture" name="profile_picture_default" id="profile_picture_default" value="@if(isset(session()->get('registration_detail')['profile_url'])){{session()->get('registration_detail')['profile_url']}}@endif">
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-12">
                                    <div class="alert alert-danger error-reporting error-reporting_default d-none"></div>
                                    <div class="alert alert-info">
                                        {{__('web/registration/events.upload-your-individual-image-id-notice')}}
                                    </div>
                                    <div class="form-group">

                                        <label>
                                            {{__('web/registration/events.upload-your-photo-id')}}
                                            <span class="text-danger">({{session()->get('registration_detail')['full_name']}})</span>
                                        </label>

                                        <input onchange="window.Registration.changeProfile(this,{profileID : 'id'})" type="file"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="@if(isset(session()->get('registration_detail')['profile_url'])){{session()->get('registration_detail')['profile_id']}}@endif" class="img-fluid w-50 display_profile_picture_id">
                                    <input type="hidden"  class="profile_picture" name="profile_picture_id" id="profile_picture_id" value="@if(isset(session()->get('registration_detail')['profile_id'])){{session()->get('registration_detail')['profile_id']}}@endif">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters my-3">
                        <div class="col-md-11 text-end d-flex justify-content-end">
                            <button type="button" onclick="window.Registration.stepBack()" class="edu-btn  bg-info">
                                <i class="fas fa-arrow-left"></i>
                                {{__('web/registration/events.back')}}
                            </button>
                            &nbsp;
                            <button data-language-file="{{json_encode($jsLangFile)}}" class="edu-btn btn-secondary registration-progress-button" disabled type="button">
                                {{__('web/registration/events.submit-my-application')}}
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
