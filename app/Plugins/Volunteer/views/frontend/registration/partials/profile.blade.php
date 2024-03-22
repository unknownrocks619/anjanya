@php
    $profile = (new App\Plugins\Volunteer\Http\Controllers\web\WebVolunteerController())->getSession('_profile') ?? [];
    $personal = (new App\Plugins\Volunteer\Http\Controllers\web\WebVolunteerController())->getSession('_personal') ?? [];
    $personalProfile = $personal->profileImage()->where('relation_id',$personal->getKey())->latest()->first();
    $personalID = $personal->memberIDMedia()->where('relation_id',$personal->getKey())->latest()->first();
    
    if ( ! isset($profile['profile_picture']) && $personalProfile) {
        $profile['profile_picture'] = 'https://jagadguru.siddhamahayog.org/uploads/m/'.$personalProfile->filepath;
    }

    if ( ! isset($profile['id_card_picture']) && $personalID) {
        $profile['id_card_picture'] = 'https://jagadguru.siddhamahayog.org/uploads/m/'.$personalID->filepath;
    }

@endphp
@php
    $jsLangFile = [
        'dialogue_box_title' => __('web/registration/events.submit-your-information'),
        'dialogue_box_description' => __('web/registration/events.submit-your-information-description'),
        'dialouge_box_cancel_label' => __('web/registration/events.recheck'),
        'dialouge_box_approve_label' => __('web/registration/events.all-information-are-correct')
]
@endphp
<div class="container">
    <div class="row justify-content-center">
        <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
            <div class="card border-0">
                <input type="hidden" name="step" value="profile" />
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
                                            <span class="text-danger">()</span></label>
                                        <input onchange="window.VolunteerRegistration.changeProfile(this,{profileID : 'default'})" type="file"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img @if(isset($profile['profile_picture'])) src="{{$profile['profile_picture']}}" @else src="" @endif class="img-fluid w-50 display_profile_picture_default">
                                    <input type="hidden"  class="profile_picture" name="profile_picture" id="profile_picture_default" @if(isset($profile['profile_picture'])) value="{{$profile['profile_picture']}}" @endif>
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
                                            <span class="text-danger">()</span>
                                        </label>

                                        <input onchange="window.VolunteerRegistration.changeProfile(this,{profileID : 'id'})" type="file"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img  @if(isset($profile['id_card_picture']))  src="{{$profile['id_card_picture']}}" @else src="" @endif class="img-fluid w-50 display_profile_picture_id">
                                    <input type="hidden"   class="form-control profile_picture" name="id_card_picture" id="profile_picture_id" @if(isset($profile['id_card_picture'])) value="{{$profile['id_card_picture']}}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters my-3">
                        <div class="col-md-11 text-end d-flex justify-content-end">
                            <button type="button" onclick="window.VolunteerRegistration.stepBack({'back' : 'volunteerData'})" class="edu-btn btn btn-info bg-info">
                                <i class="fas fa-arrow-left"></i>
                                {{__('web/registration/events.back')}}
                            </button>
                            &nbsp;
                            <button data-language-file="{{json_encode($jsLangFile)}}" class="btn btn-warning edu-btn btn-secondary registration-progress-button" disabled type="button">
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
    window.VolunteerRegistration.checkProfilePictures();
</script>
