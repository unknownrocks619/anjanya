<?php
$sessionInfo = session()->get(session()->getId());
$info = isset($sessionInfo['personal_information']) ? $sessionInfo['personal_information'] : [];
?>
<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" class="ajax-form" method="post">
    <div class="right-side w-100">
        <div class="main active">
            <div class="text">
                <h2>Your Personal Information</h2>
            </div>
            <div class="row">
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>First Name
                            <i class="text-danger">*</i>
                        </label>
                        <input type="text" value="@if (isset($info['first_name'])) {{ $info['first_name'] }} @endif"
                            name="first_name" id="first_name">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label><i>Middle Name(Optional)</i></label>
                        <input type="text" name="middle_name"
                            value="@if (isset($info['middle_name'])) {{ $info['middle_name'] }} @endif"
                            id="middle_name">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label>Last Name <i class="text-danger">*</i>
                        </label>
                        <input type="text" value="@if (isset($info['last_name'])) {{ $info['last_name'] }} @endif"
                            name="last_name" id="last_name">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" value="@if (isset($info['email'])) {{ $info['email'] }} @endif"
                            name="email" id="email" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label for="landline_number">Landline Number</label>
                        <input type="text" name="landline_number"
                            value="@isset($info['landline_number']){{ $info['landline_number'] }}@endif" id="landline_number" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="mobile_number" value="@isset($info['mobile_number']){{ $info['mobile_number'] }}@endif" id="mobile_number" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <div for="gender">Gender
                            <span class="text-danger">*</span>
                        </div>
                        <div class="row text-left">
                            <div class="col-md-4">
                                <div class="gender-mark mx-3 mt-2">
                                    <input @if (isset($info['gender']) && $info['gender'] == 'male') checked @endif type="checkbox" name="male" id="male" class="d-none">
                                    <button class="btn btn-sm btn-primary px-3 gender-select @if (isset($info['gender']) && $info['gender'] == 'male') btn-success text-white @endif"
                                        type="button">
                                        <i class="fa-solid fa-check @if (isset($info['gender']) && $info['gender'] == 'male') @else d-none @endif"></i>
                                        Male
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="gender-mark mx-3 mt-2">
                                    <input type="checkbox" @if (isset($info['gender']) && $info['gender'] == 'female') checked @endif name="female" id="female" class="d-none">
                                    <button class="btn btn-sm btn-primary px-3 gender-select @if (isset($info['gender']) && $info['gender'] == 'female') btn-success text-white @endif" type="button">
                                        <i class="fa-solid fa-check @if (isset($info['gender']) && $info['gender'] == 'female') @else d-none @endif"></i>

                                        Female
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="gender-mark  mx-3 mt-2">
                                    <input type="checkbox" name="other" id="other" @if (isset($info['gender']) && $info['gender'] == 'female') checked @endif class="d-none">
                                    <button class="btn btn-sm btn-primary px-3 gender-select @if (isset($info['gender']) && $info['gender'] == 'female') btn-success text-white @endif" type="button">
                                        <i class="fa-solid fa-check @if (isset($info['gender']) && $info['gender'] == 'female') @else d-none @endif"></i>

                                        Other
                                    </button>
                                </div>
                            </div>

                        </div>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label for="date_of_birth">Date of Birth (A.D)</label>
                <input type="date" value="@isset($info['date_of_birth']){{ $info['date_of_birth'] }}@endif" name="date_of_birth" id="date_of_birth" class="form-control" />
            </div>
        </div>
        <div class="row my-3 mt-2">
            <div class="col-md-12 bg-light py-2">
                <div class="form-group">
                    <h4>Permanent Address</h4>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="perma_country">Country</label>
                                <select name="perma_country" id="perma_country" class="form-control ajax-select-2"
                                    data-action="{{ route('api.countries') }}">
                                @if (isset($info['perma_country']) && isset($info['perma_country_name']))
                                    <option value="{{ $info['perma_country'] }}">
                                        {{ $info['perma_country_name'] }}
                                    </option>
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="perma_state">
                                    State / Province
                                </label>
                                <select name="perma_state" class="form-control ajax-select-2"
                                    data-base="{{ route('api.state', ['country' => '0']) }}" data-parent-id='0'>
                                    @if (isset($info['perma_state']) && isset($info['perma_state_name']))
                                    <option value="{{ $info['perma_state'] }}">
                                        {{ $info['perma_state_name'] }}
                                    </option>
                                    @else
                                    <option value="">Choose Your Country First</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="perma_street_address">Street Address</label>
                                <textarea name="perma_street_address" id="perma_street_address" class="form-control">@isset($info['perma_street_address']){{ $info['perma_street_address'] }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 bg-light py-2 mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="checkbox" @if (isset($info['temp_same_as_perma']) && $info['temp_same_as_perma'] == true) checked @endif name="temporary_address_checkbox" id="temporary_address_checkbox"
                            class="d-none">
                        <button type="button" class="btn js-address-toggle @if (isset($info['temp_same_as_perma']) && $info['temp_same_as_perma'] == true) btn-success text-white @else  btn-danger @endif">
                            <i class="fa-solid fa-check  @if (isset($info['temp_same_as_perma']) && $info['temp_same_as_perma'] == true) @else d-none @endif"></i>
                            My Temporary Address and Permanent Addresses are same.
                        </button>
                    </div>
                </div>
                <div class="temporary_address mt-3 ">
                    <h4>Temporary Address</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temp_country">Country</label>
                                <select name="temp_country" id="temp_country" class="form-control ajax-select-2"
                                    data-action="{{ route('api.countries') }}">
                                @if (isset($info['temp_country']) && isset($info['temp_country_name']) && $info['temp_country_name'])
                                    <option value="{{ $info['temp_country'] }}">
                                        {{ $info['temp_country_name'] }}
                                    </option>
                                @else
                                    <option value="">
                                        Choose Country to select state
                                    </option>
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temp_state">
                                    State / Province
                                </label>
                                <select name="temp_state" class="form-control"
                                    data-base="{{ route('api.state', ['country' => '0']) }}" data-parent-id='0'>
                                    @if (isset($info['temp_state']) && isset($info['temp_state_name']) && $info['temp_state'])
                                    <option value="{{ $info['temp_state'] }}">{{ $info['temp_state_name'] }}</option>
                                    @else
                                    <option value="">Choose Your Country First</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="temp_street_address">Street Address</label>
                            <textarea name="temp_street_address" id="temp_street_address" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-lg btn-primary">Next Step
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</form>

@if (isset($info['temp_same_as_perma']) && $info['temp_same_as_perma'] == true)
    <script>
        $(".temporary_address").addClass('d-none');
        $.each($('select'), function(dindex, element) {
            window.ajaxReinitalize(element);
        })
    </script>
@endif
