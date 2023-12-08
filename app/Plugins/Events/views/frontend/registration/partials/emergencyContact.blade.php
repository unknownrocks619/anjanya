@php
    $jsLangFiles = [
        'full_name' =>__('web/registration/events.full-name'),
        'relation' => __('web/registration/events.relation'),
        'gender' => __('web/registration/events.gender'),
        'phone_number'  => __('web/registration/events.mobile-number')
]
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>{{__('web/registration/events.account') }}</strong></li>
                <li id="personal" class="active"><strong>{{__('web/registration/events.personal') }}</strong></li>
                <li id="payment" class="active"><strong>{{__('web/registration/events.family-information') }}</strong></li>
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
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_family_member">{{ __('web/registration/events.total-family-member-in-anustan') }}
                                            </label>
                                            <input max="12" type="number" @if(isset(session()->get('registration_detail')['family_detail']['total_member'])) value="{{session()->get('registration_detail')['family_detail']['total_member']}}" @else value='0' @endif onchange="window.Registration.populateMemberList(this)" name="total_family_member" class="form-control" value="" id="total_family_member">
                                        </div>
                                    </div>
                                </div>

                                <div class="row member-list-field" data-language-key='{{json_encode($jsLangFiles)}}'>
                                    @if(isset(session()->get('registration_detail')['family_detail']['members']))
                                        @foreach (session()->get('registration_detail')['family_detail']['members'] as $member)
                                            <div class="row border border-1 my-2">
                                                <div class="col-md-6  col-sm-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('web/registration/events.full-name')}} <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_member[]" value="{{$member['name']}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6  col-sm-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('web/registration/events.relation')}} <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_relation[]" value="{{$member['relation']}}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6  col-sm-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('web/registration/events.gender')}} <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_gender[]" value="{{$member['gender']}}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6  col-sm-12 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('web/registration/events.phone-number')}} <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_phone_number[]" value="{{$member['phone_number']}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-12 alert alert-danger">
                                        {{__('web/registration/events.family-sharing-notice')}}
                                    </div>
                                </div>
                                <div class="row no-gutters my-3">
                                    <div class="col-md-11 text-end d-flex justify-content-end">
                                        <button type="button" onclick="window.Registration.stepBack()" class="edu-btn  bg-info">
                                            <i class="fas fa-arrow-left"></i>
                                            {{__('web/registration/events.back')}}
                                        </button>
                                        &nbsp;
                                        <button class="edu-btn" type="button" onclick="window.Registration.submitForm(this)">
                                            {{__('web/registration/events.next')}}
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
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

    if ($('select').length) {

        $.each($('select'), function (index, element) {
            if (!$(element).hasClass('no-select-2')) {
                window.ajaxReinitalize(element);
            }
        });
    }

</script>
