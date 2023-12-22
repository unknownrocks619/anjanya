<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-7 p-5 col-sm-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">
                            First Name
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" name="first_name" id="first_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">
                            Middle Name
                        </label>
                        <input type="text" name="middle_name" id="first_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">
                            Last Name
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" name="last_name" id="first_name" class="form-control">
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
                            <option value="male">
                                {{__('web/registration/events.male')}}</option>
                            <option value="female">
                                {{__('web/registration/events.female')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12  mt-2  col-sm-12">
                    <div class="form-group">
                        <label for="phone_number">{{__('web/registration/events.mobile-number')}}
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" value="" name="phone_number" id="phone_number" class="form-control">
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
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 mt-2 ">
                    <div class="form-group">
                        <label for="state">
                            {{__('web/registration/events.state-province')}}
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" value="" name="state" id="state" class="form-control">
                    </div>
                </div>

                <div class="col-md-12 mt-2 col-lg-12">
                    <div class="form-group"><label for="address">{{__('web/registration/events.street-address')}}</label>
                        <textarea name="street_address" id="street_address" style="resize: none;" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="row my-2">
                <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                    <div class="form-group">
                        <label for="date_of_birth">
                            {{__('web/registration/events.date-of-birth')}}
                        </label>
                        <input type="date" value="" name="date_of_birth" id="date_of_birth" class="form-control" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 mt-2  col-sm-12">
                    <div class="form-group">
                        <label for="date_of_birth">
                            {{__('web/registration/events.place-of-birth')}}
                        </label>
                        <input type="text" name="place_of_birth" value="" id="place_of_birth" class="form-control" />
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
                            <option value="secondary">{{__('web/registration/events.secondary')}}</option>
                            <option value="higher_secondary">{{__('web/registration/events.higher-secondary')}}</option>
                            <option value="bachelor">{{__('web/registration/events.bachelor')}}</option>
                            <option value="master">{{__('web/registration/events.master')}}</option>
                            <option value="phd">{{__('web/registration/events.phd')}}</option>
                            <option value="none">{{__('web/registration/events.none')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="profession">{{__('web/registration/events.profession')}}
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" name="profession" value="" id="profession" class="form-control ">
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
                        <input value="" type="text" name="field_of_study" id="field_of_study" class="form-control ">
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dikshya_information"></label>
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
                        <input type="text" name="emergency_contact_person" value="" id="contact_person" class="form-control ">
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
                        <input type="text" name="emergency_phone" id="emergency_phone" value="" class="form-control ">
                    </div>
                </div>
                <div class="col-md-12 mt-1">
                    <div class="form-group">
                        <label for="emergency_contact_person_relation">
                            {{__('web/registration/events.relation-to-emergency-contact-person')}}
                            <sup class="text-danger">*</sup>
                        </label>
                        <input value="" type="text" name="emergency_contact_person_relation" id="emergency_contact_person_relation" class="form-control ">
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
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="referer_phone_number">{{__('web/registration/events.phone-number')}}</label>
                                <input type="text" name="referer_phone_number" value="{{isset(session()->get('registration_detail')['referer_relation']) ? session()->get('registration_detail')['referer_relation'] : ''}}" id="referer_phone_number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-end">
                <button type="button" onclick="window.Registration.stepBack()" class="btn btn-danger me-1">
                    <i class="fas fa-arrow-left"></i>
                    {{__('web/registration/events.back')}}
                </button>

                <button class="btn btn-primary" onclick="window.Registration.submitForm(this)">
                    <i class="fas fa-arrow-right"></i>
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    window.Registration.dikshyaInfo($('#dikshya_type'));
</script>
