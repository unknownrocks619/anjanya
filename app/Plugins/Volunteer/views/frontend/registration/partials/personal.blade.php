@php
    $member = (new App\Plugins\Volunteer\Http\Controllers\web\WebVolunteerController())->getSession('_personal');
@endphp
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-30"><span class="text-danger">Volunteer </span> {{__('web/registration/events.registration')}} - Basic Information</h3>

        </div>
    </div>
    <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.volunteer.registration-store')}}">

        <div class="row d-none">
            <input type="hidden" name="step" value="personal" />
            <input type="hidden" name="previous" value="{{$previous}}">
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <div class='ajax-form-message-box'></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 col-lg-7 p-5 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name">
                                First Name
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="first_name" value="{{$member?->full_name}}" id="first_name" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="middle_name">
                                Middle Name
                            </label>
                            <input type="text" name="middle_name" value="{{$member?->middle_name}}" id="middle_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">
                                Last Name
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="last_name" value="{{$member?->last_name}}" id="last_name" class="form-control">
                        </div>
                    </div>
                    
                </div>
                <div class="row my-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="gotra">
                                Gotra
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="gotra" value="{{$member?->gotra}}" id="gotra" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mt-2 my-2">
                    <div class="col-lg-6 col-md-12  col-sm-12">
                        <div class="form-group">
                            <label class="d-block" for="gender">{{__('web/registration/events.gender')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male" @if($member?->gender == 'male') selected @endif>
                                    {{__('web/registration/events.male')}}</option>
                                <option value="female"  @if($member?->gender == 'female') selected @endif>
                                    {{__('web/registration/events.female')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12  mt-2  col-sm-12">
                        <div class="form-group">
                            <label for="phone_number">{{__('web/registration/events.mobile-number')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" value="{{$member?->phone_number}}" name="phone_number" id="phone_number" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-12 col-lg-6 ">

                        <div class="form-group">
                            
                            <label class="d-block" for="country">
                                {{__('web/registration/events.country')}}
                                <sup class="text-danger">*</sup>
                            </label>

                            <select name="country" id="country" class="form-control ajax-select-2" data-action="https://jagadguru.siddhamahayog.org/api/v1/countries">
                                @if($member?->portalCountry)
                                    <option value="{{$member?->portalCountry->getKey()}}" selected>{{$member?->portalCountry->name}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 mt-2 ">
                        <div class="form-group">
                            <label for="state">
                                {{__('web/registration/events.state-province')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" value="{{$member?->city}}" name="state" id="state" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12 mt-2 col-lg-12">
                        <div class="form-group"><label for="address">{{__('web/registration/events.street-address')}}</label>
                            <textarea name="street_address" id="street_address" style="resize: none;" class="form-control">{{$member?->address?->street_address}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                        <div class="form-group">
                            <label for="date_of_birth">
                                {{__('web/registration/events.date-of-birth')}}
                            </label>
                            <input type="date" value="{{$member?->date_of_birth}}" name="date_of_birth" id="date_of_birth" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                        <div class="form-group">
                            <label for="date_of_birth">
                                {{__('web/registration/events.place-of-birth')}}
                            </label>
                            <input type="text" name="place_of_birth" value="{{$member?->meta?->personal?->place_of_birth}}" id="place_of_birth" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                        <div class="form-group">
                            <label for="education">
                                {{__('web/registration/events.highest-education')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <select name="education" id="education" class="form-control ">
                                <option value="primary">
                                    {{__('web/registration/events.primary')}}</option>
                                <option value="secondary" @if($member?->meta?->education?->education == 'secondary') selected @endif>{{__('web/registration/events.secondary')}}</option>
                                <option value="higher_secondary" @if($member?->meta?->education?->education == 'higher_secondary') selected @endif>{{__('web/registration/events.higher-secondary')}}</option>
                                <option value="bachelor" @if($member?->meta?->education?->education == 'bachelor') selected @endif>{{__('web/registration/events.bachelor')}}</option>
                                <option value="master" @if($member?->meta?->education?->education == 'master') selected @endif>{{__('web/registration/events.master')}}</option>
                                <option value="phd" @if($member?->meta?->education?->education == 'phd') selected @endif>{{__('web/registration/events.phd')}}</option>
                                <option value="none" @if($member?->meta?->education?->education == 'none') selected @endif>{{__('web/registration/events.none')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-2">
                        <div class="form-group">
                            <label for="profession">{{__('web/registration/events.profession')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="profession"  value="{{$member?->meta?->education?->profession}}" id="profession" class="form-control ">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="field_of_study">
                                {{__('web/registration/events.education-major')}} ?
                                <small class="text-info">
                                    {{__('web/registration/events.highest-education-support-text')}}
                                </small>
                            </label>
                            <input type="text" value="{{$member?->meta?->education?->education_major}}" name="field_of_study" id="field_of_study" class="form-control ">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-5 bg-light p-5 col-sm-12">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h4 class="theme-text text-primary">
                            {{__('web/registration/events.emergency-contact-information')}}
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person">
                                {{__('web/registration/events.emergency-contact-person')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="emergency_contact_person" value="{{$member?->emergency?->contact_person}}" id="contact_person" class="form-control ">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emergency_phone">
                                {{ __('web/registration/events.contact-mobile-number') }}
                                <sup class="text-danger">
                                    *
                                </sup>
                            </label>
                            <input type="text" name="emergency_phone" id="emergency_phone" value="{{$member?->emergency?->phone_number}}" class="form-control ">
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <div class="form-group">
                            <label for="emergency_contact_person_relation">
                                {{__('web/registration/events.relation-to-emergency-contact-person')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <input value="{{$member?->emergency?->relation}}" type="text" name="emergency_contact_person_relation"  id="emergency_contact_person_relation" class="form-control ">
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-12">
                        <h4 class="theme-text text-primary">
                            {{__('web/registration/events.dikshya_information')}}
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dikshya_type">
                                {{__('web/registration/events.diskshya_type')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <select onchange="window.VolunteerRegistration.dikshyaInfo(this)" name="dikshya_type" id="dikshya_type" class="form-control">
                                <option @if( ! $member?->diskshya) selected @endif value="non-dikshit">
                                    {{__('web/registration/events.non-dikshit')}}</option>
                                <option @if( ! $member?->diskshya) seleted @endif value="dikshit">
                                    {{__('web/registration/events.dikshit')}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 dikshya_type dikshit">
                        <div class="form-group">
                            <label for="dikshya_category">
                                {{__('web/registration/events.dikshya_category')}}
                                <sup class="text-danger">*</sup>
                            </label>
                            <select name="dikshya_category" id="dikshya_category"
                                    class="form-control">
                                <option @if($member?->dikshya?->dikshya_type == 'sadhana') selected @endif value="sadhana" >{{__('web/registration/events.sadhana')}}</option>
                                <option  @if($member?->dikshya?->dikshya_type == 'saranagati') selected @endif value="saranagati" >{{__('web/registration/events.saranagati')}}</option>
                                <option @if($member?->dikshya?->dikshya_type == 'tarak') selected @endif  value="tarak" >{{__('web/registration/events.tarak')}}</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 text-end">

                <button type="button" class="edu-btn btn btn-primary" onclick="window.VolunteerRegistration.submitForm(this)" style="background:#488925 !important">
                    <i class="fas fa-arrow-right"></i>
                    Next
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $.each($('select'),function(index,element) {

        if (!$(element).hasClass('no-select-2')) {
            window.ajaxReinitalize(element);
        }
    })

    window.VolunteerRegistration.dikshyaInfo($('#dikshya_type'));
</script>
