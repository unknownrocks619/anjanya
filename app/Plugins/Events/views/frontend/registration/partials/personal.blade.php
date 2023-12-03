<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>Account</strong></li>
                <li id="personal" class="active"><strong>Personal</strong></li>
                <li id="payment"><strong>Family Information</strong></li>
                <li id="jap"><strong>Jap Information</strong></li>
                <li id="profile"><strong>Profile Picture</strong></li>
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
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" value="{{session()->get('registration_detail')['first_name']}}" class="form-control" id="first_name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="middle_name">
                                            Middle Name
                                        </label>
                                        <input type="text" name="middle_name" value="{{session()->get('registration_detail')['middle_name']}}" class="form-control" id="middle_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="last_name">
                                            Last Name
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" name="last_name" value="{{session()->get('registration_detail')['last_name']}}" required class="form-control" id="last_name">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="gender">Gender
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male" @if(session()->get('registration_detail')['gender'] == 'male' ) selected @endif>Male</option>
                                            <option value="female" @if(session()->get('registration_detail')['gender'] == 'female' ) selected @endif>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="phone_number">Mobile Number
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" value="{{session()->get('registration_detail')['phone_number']}}" name="phone_number" id="phone_number" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="country">
                                            Country
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <select name="country" id="country" class="form-control ajax-select-2" data-action="https://jagadguru.siddhamahayog.org/api/v1/countries">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="state">
                                            State
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" value="{{session()->get('registration_detail')['city']}}" name="state" id="state" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <div class="form-group"><label for="address">Street Address</label>
                                        <textarea name="street_address" id="street_address" style="resize: none;" class="form-control">{{session()->get('registration_detail')['street_address']}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="date_of_birth">
                                            Date of Birth
                                        </label>
                                        <input type="date" value="{{isset (session()->get('registration_detail')['meta']['personal']['date_of_birth']) ? session()->get('registration_detail')['meta']['personal']['date_of_birth'] : '' }}" name="date_of_birth" id="date_of_birth" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="date_of_birth">
                                            Place of Birth
                                        </label>
                                        <input type="text" name="place_of_birth" value="{{isset (session()->get('registration_detail')['meta']['personal']['place_of_birth']) ? session()->get('registration_detail')['meta']['personal']['place_of_birth'] : ''}}" id="place_of_birth" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="education">Your Highest Education
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <select name="education" id="education" class="form-control ">
                                            <option value="primary" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='primary' ) selected @endif>Primary</option>
                                            <option value="secondary" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='secondary' ) selected @endif>Secondary (1-20 Class)</option>
                                            <option value="higher_secondary" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='higher_secondary' ) selected @endif>Higher Secondary (11 - 12 Class)</option>
                                            <option value="bachelor" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education'] =='bachelor' ) selected @endif>Bachelor</option>
                                            <option value="master" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='master' ) selected @endif>Masters</option>
                                            <option value="phd" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='phd' ) selected @endif>PhD</option>
                                            <option value="none" @if(isset (session()->get('registration_detail')['meta']['education']['education'])  && session()->get('registration_detail')['meta']['education']['education']=='none' ) selected @endif>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="profession">Profession
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" name="profession" value="{{ isset (session()->get('registration_detail')['meta']['education']['profession']) ? session()->get('registration_detail')['meta']['education']['profession'] : '' }}" id="profession" class="form-control ">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-col-md-6">
                                    <div class="form-group">
                                        <label for="field_of_study">
                                            What is your education major ?
                                            <small class="text-info">
                                                Please be as specific as possible (example: computer science, engineering etc.)
                                            </small>
                                        </label>
                                        <input value="{{ isset(session()->get('registration_detail')['meta']['education']['education_major']) ? session()->get('registration_detail')['meta']['education']['education_major'] : ''}}" type="text" name="field_of_study" id="field_of_study" class="form-control ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 bg-light p-5">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h4 class="theme-text text-primary">
                                    Emergency Contact Information
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_person">Emergency Contact Person
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" name="emergency_contact_person" value="{{isset(session()->get('registration_detail')['emergency']['full_name']) ? session()->get('registration_detail')['emergency']['full_name'] : ''}}" id="contact_person" class="form-control ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_phone">Contact Mobile Number
                                        <sup class="text-danger">
                                            *
                                        </sup>
                                    </label>
                                    <input type="text" name="emergency_phone" id="emergency_phone" value="{{isset(session()->get('registration_detail')['emergency']['phone_number']) ? session()->get('registration_detail')['emergency']['phone_number'] : ''}}" class="form-control ">
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <div class="form-group">
                                    <label for="emergency_contact_person_relation">Relation to Emergency Contact Person
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input value="{{isset(session()->get('registration_detail')['emergency']['relation']) ? session()->get('registration_detail')['emergency']['relation'] : ''}}" type="text" name="emergency_contact_person_relation" id="emergency_contact_person_relation" class="form-control ">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row no-gutters my-3">
                    <div class="col-md-11 text-end">
                        <button type="button" onclick="window.Registration.stepBack()" class="edu-btn bg-info">
                            <i  class="fas fa-arrow-left"></i>
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
<script>

    if ($('select').length) {
        console.log('hello world');
        $.each($('select'), function (index, element) {
            if (!$(element).hasClass('no-select-2')) {
                window.ajaxReinitalize(element);
            }
        });
    }

</script>
