<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>{{__('web/registration/events.account') }}</strong></li>
                <li id="personal" class="active"><strong>{{__('web/registration/events.personal') }}</strong></li>
{{--                <li id="payment"><strong>{{__('web/registration/events.family-information') }}</strong></li>--}}
{{--                <li id="jap"><strong>{{__('web/registration/events.jaap-information') }}</strong></li>--}}
{{--                <li id="profile"><strong>{{ __('web/registration/events.yagya-photo-card') }}</strong></li>--}}
            </ul>
        </div>
    </div>

            <div class="row justify-content-center">
                <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
                    <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="row no-gutters justify-content-center">
                            <div class="col-lg-7 col-md-12">
                                <div class="ps-5">
                                    <div class="row my-2">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="first_name">
                                                    {{__('web/registration/events.first-name')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="text" name="first_name" value="{{session()->get('registration_detail')['first_name']}}" class="form-control" id="first_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="gotra">{{__('web/registration/events.gotra')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="text" name="gotra" value="@isset(session()->get('registration_detail')['gotra']){{session()->get('registration_detail')['gotra']}}@endisset" class="form-control" id="gotra">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-md-12 col-lg-6 col-sm-12">
                                            <div class="form-group 5mb-5">
                                                <label for="middle_name">
                                                    {{__('web/registration/events.middle-name')}}
                                                </label>
                                                <input type="text" name="middle_name" value="{{session()->get('registration_detail')['middle_name']}}" class="form-control" id="middle_name">
                                            </div>
                                        </div>

                                        <div class="col-md-12  col-lg-6 col-sm-12">
                                            <div class="form-group mb-5">
                                                <label for="last_name">
                                                    {{__('web/registration/events.last-name')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="text" name="last_name" value="{{session()->get('registration_detail')['last_name']}}" required class="form-control" id="last_name">
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
                                                    <option value="male" @if(session()->get('registration_detail')['gender'] == 'male' ) selected @endif>
                                                        {{__('web/registration/events.male')}}</option>
                                                    <option value="female" @if(session()->get('registration_detail')['gender'] == 'female' ) selected @endif>
                                                        {{__('web/registration/events.female')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12  mt-2  col-sm-12">
                                            <div class="form-group">
                                                <label for="phone_number">{{__('web/registration/events.mobile-number')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="text" value="{{session()->get('registration_detail')['phone_number']}}" name="phone_number" id="phone_number" class="form-control">
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
                                                    @if(isset(session()->get('registration_detail')['country_label']))
                                                        <option value="{{session()->get('registration_detail')['country']}}" selected>{{session()->get('registration_detail')['country_label']}}</option>
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
                                                <input type="text" value="{{session()->get('registration_detail')['city']}}" name="state" id="state" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2 col-lg-12">
                                            <div class="form-group"><label for="address">{{__('web/registration/events.street-address')}}</label>
                                                <textarea name="street_address" id="street_address" style="resize: none;" class="form-control">{{session()->get('registration_detail')['street_address']}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                                            <div class="form-group">
                                                <label for="date_of_birth">
                                                    {{__('web/registration/events.date-of-birth')}}
                                                </label>
                                                <input type="date" value="{{isset (session()->get('registration_detail')['meta']['personal']['date_of_birth']) ? session()->get('registration_detail')['meta']['personal']['date_of_birth'] : '' }}" name="date_of_birth" id="date_of_birth" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                                            <div class="form-group">
                                                <label for="date_of_birth">
                                                    {{__('web/registration/events.place-of-birth')}}
                                                </label>
                                                <input type="text" name="place_of_birth" value="{{isset (session()->get('registration_detail')['meta']['personal']['place_of_birth']) ? session()->get('registration_detail')['meta']['personal']['place_of_birth'] : ''}}" id="place_of_birth" class="form-control" />
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
                                                    <option value="primary" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='primary' ) selected @endif>
                                                        {{__('web/registration/events.primary')}}</option>
                                                    <option value="secondary" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='secondary' ) selected @endif>{{__('web/registration/events.secondary')}}</option>
                                                    <option value="higher_secondary" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='higher_secondary' ) selected @endif>{{__('web/registration/events.higher-secondary')}}</option>
                                                    <option value="bachelor" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education'] =='bachelor' ) selected @endif>{{__('web/registration/events.bachelor')}}</option>
                                                    <option value="master" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='master' ) selected @endif>{{__('web/registration/events.master')}}</option>
                                                    <option value="phd" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='phd' ) selected @endif>{{__('web/registration/events.phd')}}</option>
                                                    <option value="none" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='none' ) selected @endif>{{__('web/registration/events.none')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="profession">{{__('web/registration/events.profession')}}
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="text" name="profession" value="{{ isset (session()->get('registration_detail')['meta']['education']['profession']) ? session()->get('registration_detail')['meta']['education']['profession'] : '' }}" id="profession" class="form-control ">
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
                                                <input value="{{ isset(session()->get('registration_detail')['meta']['education']['education_major']) ? session()->get('registration_detail')['meta']['education']['education_major'] : ''}}" type="text" name="field_of_study" id="field_of_study" class="form-control ">
                                            </div>
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
                                            <input type="text" name="emergency_contact_person" value="{{isset(session()->get('registration_detail')['emergency']['full_name']) ? session()->get('registration_detail')['emergency']['full_name'] : ''}}" id="contact_person" class="form-control ">
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
                                            <input type="text" name="emergency_phone" id="emergency_phone" value="{{isset(session()->get('registration_detail')['emergency']['phone_number']) ? session()->get('registration_detail')['emergency']['phone_number'] : ''}}" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label for="emergency_contact_person_relation">
                                                {{__('web/registration/events.relation-to-emergency-contact-person')}}
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input value="{{isset(session()->get('registration_detail')['emergency']['relation']) ? session()->get('registration_detail')['emergency']['relation'] : ''}}" type="text" name="emergency_contact_person_relation" id="emergency_contact_person_relation" class="form-control ">
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
                                            <select onchange="window.Registration.dikshyaInfo(this)" name="dikshya_type" id="dikshya_type" class="form-control">
                                                <option {{(isset(session()->get('registration_detail')['dikshit']['type']) && session()->get('registration_detail')['dikshit']['type'] == 'non-dikshit') ? 'selected' : '' }} value="non-dikshit">
                                                    {{__('web/registration/events.non-dikshit')}}</option>
                                                <option {{(isset(session()->get('registration_detail')['dikshit']['type']) && session()->get('registration_detail')['dikshit']['type'] == 'dikshit') ? 'selected' : '' }} value="dikshit">
                                                    {{__('web/registration/events.dikshit')}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                        <div class="col-md-12 dikshya_type dikshit">
                                        <div class="form-group">
                                            <label for="dikshya_category" class="d-block">
                                                {{__('web/registration/events.dikshya_category')}}
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="dikshya_category" id="dikshya_category"
                                                    class="form-control w-100">
                                                <option value="sadhana" {{(isset(session()->get('registration_detail')['dikshit']['category']) && session()->get('registration_detail')['dikshit']['category'] == 'sadhana') ? 'selected' : '' }}>{{__('web/registration/events.sadhana')}}</option>
                                                <option value="saranagati" {{(isset(session()->get('registration_detail')['dikshit']['category']) && session()->get('registration_detail')['dikshit']['category'] == 'saranagati') ? 'selected' : '' }}>{{__('web/registration/events.saranagati')}}</option>
                                                <option value="tarak"  {{(isset(session()->get('registration_detail')['dikshit']['category']) && session()->get('registration_detail')['dikshit']['category'] == 'tarak') ? 'selected' : '' }}>{{__('web/registration/events.tarak')}}</option>
                                                <option value="sadhana&saranagati"  {{(isset(session()->get('registration_detail')['dikshit']['category']) && session()->get('registration_detail')['dikshit']['category'] == 'sadhana&saranagati') ? 'selected' : '' }}>{{__('web/registration/events.two')}}</option>
                                                <option value="sadhana&saranagati&tarak"  {{(isset(session()->get('registration_detail')['dikshit']['category']) && session()->get('registration_detail')['dikshit']['category'] == 'sadhana&saranagati&tarak') ? 'selected' : '' }}>{{__('web/registration/events.three')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reference_source">
                                                {{__('web/registration/events.how-did-you-hear-about-us')}}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select onchange="window.Registration.referenceSource(this)" name="reference_source" id="reference_source" class="form-control">
                                                <option value="" disabled selected></option>
                                                <option value="portal" @if(isset(session()->get('registration_detail')['reference_source']) && session()->get('registration_detail')['reference_source'] == 'portal') selected @endif>From Portal</option>
                                                <option value="social-media" @if(isset(session()->get('registration_detail')['reference_source']) && session()->get('registration_detail')['reference_source'] == 'social-media') selected @endif>Social Media</option>
                                                <option value="friend" @if(isset(session()->get('registration_detail')['reference_source']) && session()->get('registration_detail')['reference_source'] == 'friend') selected @endif>Friends / Family</option>
                                                <option value="other" @if(isset(session()->get('registration_detail')['reference_source']) &&session()->get('registration_detail')['reference_source'] == 'other') selected @endif>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2 reference other  @if( ! isset(session()->get('registration_detail')['reference_source']) || session()->get('registration_detail')['reference_source'] != 'other') d-none @endif">
                                        <div class="form-group">
                                            <label for="other-source">
                                                {{__('web/registration/events.please-specify-source')}}
                                            </label>
                                            <textarea name="reference_source_detail" id="reference_source"
                                                      class="form-control">{{isset(session()->get('registration_detail')['reference_source_detail']) ? session()->get('registration_detail')['reference_source_detail'] : ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2 reference friend @if(! isset(session()->get('registration_detail')['reference_source']) || session()->get('registration_detail')['reference_source'] != 'friend') d-none @endif">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="friend_detail">
                                                        {{__('web/registration/events.referer-name')}}

                                                    </label>
                                                    <input type="text" name="referer_name" value="{{ isset(session()->get('registration_detail')['referer_name']) ?  session()->get('registration_detail')['referer_name'] : ''}}" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="referer_relation">{{__('web/registration/events.relation')}}</label>
                                                    <input type="text" name="referer_relation" value="{{isset(session()->get('registration_detail')['referer_relation']) ? session()->get('registration_detail')['referer_relation'] : ''}}" id="referer_relation" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row no-gutters my-3">
                            <div class="col-md-11 text-end d-flex justify-content-end">
                                <button type="button" onclick="window.Registration.stepBack()" class="edu-btn bg-info">
                                    <i  class="fas fa-arrow-left"></i>
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
                    <!-- end card-body -->
                </div>
            </form>
    </div>
    <!-- Row -->
</div>
<script>

    if ($('select').length) {
        console.log('hello world');
        $.each($('select'), function (index, element) {
            if (!$(element).hasClass('no-select-2')) {
                window.ajaxReinitalize(element);
            }
        });
    }
    window.Registration.dikshyaInfo($('#dikshya_type'));
</script>
