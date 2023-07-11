<?php
$sessionInfo = session()->get(session()->getId());
$info = isset($sessionInfo['guardian_and_emergency_contact']) ? $sessionInfo['guardian_and_emergency_contact'] : [];
$personalInfo = $sessionInfo['personal_information'];
$parseBirth = \Carbon\Carbon::parse($personalInfo['date_of_birth']);
?>

<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" class="ajax-form" method="post">
    <div class="right-side w-100">
        <div class="main active">
            <small><i class="fa fa-smile-o"></i></small>
            <div class="text">
                <h2>Emergency Contact Information</h2>
            </div>

            <div class="row bg-light @if ($parseBirth->diffInYears() >= 18) d-none @endif">
                <div class="col-md-12 py-2">
                    <h4>Parent of Guardian Information</h4>
                    <div class="row bg-light">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label>First name of Parent (or Legal Guardian)
                                    <i class="text-danger">*</i>
                                </label>
                                <input type="text"
                                    value="@isset($info['first_name_of_parent']){{ $info['first_name_of_parent'] }}@endif" name="first_name_of_parent" id="first_name">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label>Last name of Parent (or Legal Guardian)
                                    <i class="text-danger">*</i>
                                </label>
                                <input type="text" value="@isset($info['last_name_of_parent']){{ $info['last_name_of_parent'] }}@endif" name="last_name_of_parent" id="first_name">
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="email">Child's Relationship with Parent / Legal Guardian <span
                                        class="text-danger">*</span>
                                </label>
                                <input type="text" name="parent_relationship" value="@isset($info['parent_relationship']){{ $info['parent_relationship'] }}@endif" id="parent_" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="parent_email_address">Email Address of Parent (or Legal Guardian)</label>
                                <input type="text" name="parent_email_address" value="@isset($info['parent_email_address']){{ $info['parent_email_address'] }}@endif"
                                    id="parent_email_address" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="parent_phone_number">
                                    Phone Number of Parent (or Legal Guardian)
                                </label>
                                <input type="text" name="phone_number_of_parent" value="@isset($info['phone_number_of_parent']){{ $info['phone_number_of_parent'] }}@endif" id="phone_number_of_parent"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="parent_phone_number">
                                    Are you, the parent or legal guardian, a meditator of Himalayan Siddha Mahayog?
                                </label>
                                <div class="d-flex align-items-center parent_sadhak_info">
                                    <input @if (isset($info['parent_is_sadhak']) && $info['parent_is_sadhak'] == 'on') checked @endif type="checkbox" name="parent_is_sadhak" id="parent_is_sadhak" class="d-none">
                                    <div class=" mx-3 px-2 mt-2">
                                        <button class="btn btn-sm btn-primary px-3 sadhak_info @if (isset($info['parent_is_sadhak']) && $info['parent_is_sadhak'] == 'on') btn-success text-white @endif" type="button"
                                            data-value='true'>
                                            <i class="fa-solid fa-check @if (isset($info['parent_is_sadhak']) && $info['parent_is_sadhak'] == 'on') @else d-none @endif"></i>
                                            Yes
                                        </button>
                                    </div>
                                    <div class=" mx-3 mt-2">
                                        <button class="btn btn-sm btn-primary px-3 sadhak_info @if (isset($info['parent_is_sadhak']) && $info['parent_is_sadhak'] == 'on') @else btn-succes text-white  @endif"
                                    type="button" data-value="false">
                                    <i class="fa-solid fa-check @if ((isset($info['parent_is_sadhak']) && $info['parent_is_sadhak'] == 'on') || !isset($info['parent_is_sadhak'])) d-none @endif"></i>
                                No
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row my-3 mt-2">
        <div class="col-md-12 py-2">
            <div class="form-group">
                <h4>Emergency Contact Info</h4>
                <div class="row bg-light">
                    <div class="col-md-2">
                        @if ($parseBirth->diffInYears() < 18)
                            <button class="btn btn-primary copy_guardian_info">
                                Copy Information from Parent / Guardian
                            </button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="emergency_contact_full_name">
                                Full Name of Emergency Contact Person
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" value="@isset($info['emergency_contact_full_name']){{ $info['emergency_contact_full_name'] }}@endif" name="emergency_contact_full_name" id="emergency_contact_full_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="emergency_contact_number">
                                Emergency Contact Number
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="emergency_contact_number" value="@isset($info['emergency_contact_number']){{ $info['emergency_contact_number'] }}@endif" id="emergency_contact_number"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="relation_to_emergency_contact">
                                Your Relation to Emergency Contact
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="relation_to_emergency_contact"
                                id="relation_to_emergency_contact" value="@isset($info['relation_to_emergency_contact']) {{ $info['relation_to_emergency_contact'] }} @endif"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-start">
            <button type="button" class="btn btn-secondary btn-large mx-2 step-back"
                data-url="{{ route('frontend.users.register', ['current_step' => $current_step, 'steps' => 'back']) }}">
                <i class="fa fa-arrow-left">
                </i>
                Go Back
            </button>
            <button class="btn btn-lg btn-primary">
                Next Step
                <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>
    </div>
</form>
