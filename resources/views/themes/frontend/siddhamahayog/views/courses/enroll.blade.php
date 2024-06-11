
@extends($user_theme->frontend_layout($extends))
{{-- @extends('', ['bodyAttribute' => ['class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true]) --}}

@push('title')
    | {{ $course->course_name }} | Enroll
@endpush

@section('main')
    <?php
    // let's get banner image,
    $bannerImage = '';
    $courseThumbnail = '';
    $checkImage = $course->getImage;
    if ($checkImage) {
        $bannerImage = $course
            ->getImage()
            ->where('type', 'banner')
            ->latest()
            ->first();
        $bannerImage = $bannerImage?->image->filepath;

        $courseThumbnail = $course
            ->getImage()
            ->where('type', 'course_thumbnail')
            ->latest()
            ->first();
        $courseThumbnail = $courseThumbnail?->image->filepath;
    }
    ?>
    {!! $user_theme->partials('page-header',['bannerImage' => null,'title' => $course->course_name .' Enrollment' ,'glitter_background' => null]) !!}
    <div class="container mb-5 pb-5">
        <form action="{{route('frontend.courses.enroll.enroll',['course' => $course,'course_slug' => $course->slug])}}" method="post" class="ajax-form">
            <div class="row my-2">
                <div class="col-md-12 d-flex justify-content-center">
                    <h2 class="fw-bold border-bottom pb-3">हिमालयन सिद्घमहायोग - वेदान्त दर्शन</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger d-none" id="errorMessage"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                        <div class="row mt-4">
                            
                            <div class="col-md-8  p-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="theme-text">
                                            Basic Information
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name" style="font-size: 20px;">First Name
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" value="" name="first_name" id="first_name" class="mt-2 form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name"  style="font-size: 20px;">Middle Name
                                            </label>
                                            <input type="text" value="" name="middle_name" id="middle_name" class="mt-2 form-control " />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name"  style="font-size: 20px;">Last Name
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" value="{{ $user_record['last_name'] ?? '' }}" name="last_name" id="last_name" class="mt-2 form-control @error('last_name') border border-danger @enderror" />

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="gender"  style="font-size: 20px;">Gender
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="male" @if(isset($user_record['gender']) && $user_record['gender']=='male' ) selected @endif>Male</option>
                                                <option value="female" @if(isset($user_record['gender']) && $user_record['gender']=='female' ) selected @endif>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="phone_number"  style="font-size: 20px;">Mobile Number
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" value="{{ $user_record['phone_number'] ?? '' }}" name="phone_number" id="phone_number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="country"  style="font-size: 20px;">
                                                Country
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="country" id="country" class="form-control">
                                                <?php
                                                $countries = \App\Models\Country::get();
                                                ?>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->getKey() }}" @if(isset($user_record['country']) && $user_record['country']==$country->getKey()) selected @elseif($country->getKey() == 153) selected @endif>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="state"  style="font-size: 20px;">
                                                State
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" value="{{ $user_record['state'] ?? '' }}" name="state" id="state" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2"  style="font-size: 20px;">
                                        <div class="form-group"><label for="address">Street Address</label>
                                            <textarea name="street_address" id="street_address" style="resize: none;" class="form-control">{{ $user_record['street_address'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="date_of_birth"  style="font-size: 20px;">
                                                Date of Birth
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="date" value="{{ $user_record['date_of_birth'] ?? '' }}" name="date_of_birth" id="date_of_birth" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="date_of_birth"  style="font-size: 20px;">
                                                Place of Birth
                                            </label>
                                            <input type="text" name="place_of_birth" value="{{ $user_record['place_of_birth'] ?? '' }}" id="place_of_birth" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="education"  style="font-size: 20px;">Your Highest Education
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <select name="education" id="education" class="form-control ">
                                                <option value="primary" @if(isset($user_record['education']) && $user_record['education']=='primary' ) selected @endif>Primary</option>
                                                <option value="secondary" @if(isset($user_record['education']) && $user_record['education']=='secondary' ) selected @endif>Secondary (1-20 Class)</option>
                                                <option value="higher_secondary" @if(isset($user_record['higher_secondary']) && $user_record['education']=='primary' ) selected @endif>Higher Secondary (11 - 12 Class)</option>
                                                <option value="bachelor" @if(isset($user_record['education']) && $user_record['education']=='bachelor' ) selected @endif>Bachelor</option>
                                                <option value="master" @if(isset($user_record['education']) && $user_record['education']=='master' ) selected @endif>Masters</option>
                                                <option value="phd" @if(isset($user_record['education']) && $user_record['education']=='phd' ) selected @endif>PhD</option>
                                                <option value="none" @if(isset($user_record['education']) && $user_record['education']=='none' ) selected @endif>None</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="profession"  style="font-size: 20px;">Profession
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" name="profession" value="{{ $user_record['profession'] ?? '' }}" id="profession" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-col-md-6">
                                        <div class="form-group">
                                            <label for="field_of_study"  style="font-size: 20px;">
                                                What is your education major ?
                                                <small class="text-info">
                                                    Please be as specific as possible (example: computer science, engineering etc.)
                                                </small>
                                            </label>
                                            <input value="{{ $user_record['education_major'] ?? ''}}" type="text" name="field_of_study" id="field_of_study" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 p-4 bg-light">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <h4 class="theme-text">
                                            Emergency Contact Information
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="contact_person"  style="font-size: 20px;">Emergency Contact Person
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" name="emergency_contact_person" value="{{ $user_record['emmergency_contact_name'] ?? '' }}" id="contact_person" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="emergency_phone"  style="font-size: 20px;">Contact Mobile Number
                                                <sup class="text-danger">
                                                    *
                                                </sup>
                                            </label>
                                            <input type="text" value="{{ $user_record['emmergency_contact_number'] ?? '' }}" name="emergency_phone" id="emergency_phone" value="" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label for="emergency_contact_person_relation"  style="font-size: 20px;">Relation to Emergency Contact Person
                                                <sup class="text-danger">*</sup>
                                            </label>
                                            <input value="{{ $user_record['emmergency_contact_relation'] ?? '' }}" type="text" name="emergency_contact_person_relation" id="emergency_contact_person_relation" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row  ">
                                    <div class="col-md-12 mt-2">
                                        <h4 class="theme-text">
                                            Reference Detail
                                        </h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="referer_person"  style="font-size: 20px;">
                                                    Referer Person
                                                </label>
                                                <input value="{{ $user_record['referer_person'] ?? '' }}" type="text" name="referer_person" id="referer_person" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="referer_relation"  style="font-size: 20px;">
                                                    Relation
                                                </label>
                                                <input type="text" value="{{ $user_record['referer_relation'] ?? '' }}" name="referer_relation" id="referer_relation" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="referer_contact"  style="font-size: 20px;">Referer Mobile Number</label>
                                                <input type="text" value="{{ $user_record['referer_contact'] ?? '' }}" name="referer_contact" id="referer_contact" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <h4 class="teheme-text">
                                            Login Detail
                                        </h4>
                                        <p class="text-danger">
                                            <em>
                                                Remember this information !
                                                This is the login (email) and password for your portal
                                                - where class zoom link will be
                                            </em>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="email"  style="font-size: 20px;">Email Address
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="email" name="email" id="email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="email"  style="font-size: 20px;">Password
                                                    <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="password" name="password" id="password" class="form-control" />
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
        
            </div>

            <div class="col-md-12 mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-danger px-5 w-100 fs-3 edu-btn">
                    Submit
                </button>
            </div>
        </form>
    </div>

@endsection
