<?php
$sessionInfo = session()->get(session()->getId());
$dikshya_info = isset($sessionInfo['dikshya_information']) ? $sessionInfo['dikshya_information'] : [];
?>
<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" class="ajax-form" method="post">
    <div class="right-side w-100">
        <div class="main active">
            <div class="text">
                <h2>Dikshya Information</h2>
                <p>you can select more than one option, if needed
                    When did you receive Mantra Dikshya? *</p>
            </div>

            <div class="row bg-light">
                <div class="col-md-12 py-2">
                    <h4>Please Select all that apply</h4>
                    <div class="row bg-light py-2">
                        <div class="col-md-6 mt-2">
                            <div class="d-flex align-items-center parent_sadhak_info">
                                <div class="dikshay_div mx-3 mt-2">
                                    <button class="btn btn-sm btn-primary px-3 dikshya_info" type="button"
                                        data-value="none">
                                        <i class="fa-solid fa-check d-none"></i>
                                        None
                                    </button>
                                </div>
                                <div class="dikshay_div mx-3 px-2 mt-2">
                                    <input type="checkbox" @if (isset($dikshya_info['shaktipaath_dikshya']) && $dikshya_info['shaktipaath_dikshya'] == 'on') checked @endif
                                        name="shaktipaath_dikshya" class="d-none dikshya_info_checkbox">
                                    <button
                                        class="btn btn-sm btn-primary px-3 dikshya_info @if (isset($dikshya_info['shaktipaath_dikshya']) && $dikshya_info['shaktipaath_dikshya'] == 'on') btn-success text-white @endif"
                                        type="button" data-value='shaktipaath_dikshya'>
                                        <i
                                            class="fa-solid fa-check @if (isset($dikshya_info['shaktipaath_dikshya']) && $dikshya_info['shaktipaath_dikshya'] == 'on') @else d-none @endif"></i>
                                        Shaktipaat Dikshya
                                    </button>
                                </div>
                                <div class="dikshay_div mx-3 mt-2">
                                    <input type="checkbox" name="saranagati_dikshya"
                                        class="d-none dikshya_info_checkbox"
                                        @if (isset($dikshya_info['saranagati_dikshya']) && $dikshya_info['saranagati_dikshya'] == 'on') checked @endif>
                                    <button
                                        class="btn btn-sm btn-primary px-3 dikshya_info  @if (isset($dikshya_info['saranagati_dikshya']) && $dikshya_info['saranagati_dikshya'] == 'on') btn-success text-white @endif"
                                        type="button" data-value="saranagati_dikshya">
                                        <i
                                            class="fa-solid fa-check @if (isset($dikshya_info['saranagati_dikshya']) && $dikshya_info['saranagati_dikshya'] == 'on') @else d-none @endif"></i>
                                        Saranagati Dikshya
                                    </button>
                                </div>
                                <div class="dikshay_div mx-3 mt-2">
                                    <input type="checkbox" @if (isset($dikshya_info['tarak_dikshya']) && $dikshya_info['tarak_dikshya'] == 'on') checked @endif
                                        name="tarak_dikshya" class="d-none dikshya_info_checkbox">
                                    <button
                                        class="btn btn-sm btn-primary px-3 dikshya_info  @if (isset($dikshya_info['tarak_dikshya']) && $dikshya_info['tarak_dikshya'] == 'on') btn-success text-white @endif"
                                        type="button" data-value="tarak_dikshya">
                                        <i
                                            class="fa-solid fa-check @if (isset($dikshya_info['tarak_dikshya']) && $dikshya_info['tarak_dikshya'] == 'on') @else d-none @endif"></i>
                                        Tarak Dikshya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row dikshit_name mt-3"
                @if (
                    (isset($dikshya_info['shaktipaath_dikshya']) && $dikshya_info['shaktipaath_dikshya'] == 'on') ||
                        (isset($dikshya_info['mantra_dikshya']) && $dikshya_info['mantra_dikshya'] == 'on') ||
                        (isset($dikshya_info['saranagati_dikshya']) && $dikshya_info['saranagati_dikshya'] == 'on')) @else
                style="display:none" @endif>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dikshit_name">
                            What is your Dikshit Name?
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            value="@isset($dikshya_info['dikshit_name']){{ $dikshya_info['dikshit_name'] }}@else{{ 'n/a' }}@endif"
                            name="dikshit_name" id="dikshit_name" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row shaktipaath_dikshya mt-3" @if (isset($dikshya_info['shaktipaath_dikshya']) && $dikshya_info['shaktipaath_dikshya'] == 'on') @else style="display:none" @endif>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="shaktidikshya_date">
                            When did you receive Shaktipaat Dikshya?
                            <span class="text-danger">*</span>
                        </label>
                        <input type="date" value="@if (isset($dikshya_info['shaktidikshya_date'])){{ $dikshya_info['shaktidikshya_date'] }}@endif" name="shaktidikshya_date" id="shaktidikshya_date" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="shaktidikshya_level">
                            What your Sadhana Level (if given by Mahayogi Siddhababa) (e.g., 2, 4 etc.)
                        </label>
                        <input type="text" value="@if (isset($dikshya_info['shaktidikshya_level'])){{ $dikshya_info['shaktidikshya_level'] }}@else{{ 'n/a' }}@endif" name="shaktidikshya_level" id="shaktidikshya_level" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mantra_dikshya mt-3" @if (isset($dikshya_info['mantra_dikshya']) && $dikshya_info['mantra_dikshya'] == 'on') @else style="display:none" @endif>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mantradikshya_date">
                            When did you receive Mantra Dikshya?
                            <span class="text-danger">*</span>
                        </label>
                        <input type="date" value="@if (isset($dikshya_info['mantradikshya_date'])){{ $dikshya_info['mantradikshya_date'] }}@else n/a @endif"  name="mantradikshya_date" id="mantradikshya_date" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mantradikshya_level">
                            What is your Sadhana Level (e.g., 2, 4 etc.) ?
                        </label>
                        <input type="text" name="mantradikshya_level" value="value="@if (isset($dikshya_info['mantradikshya_level'])){{ $dikshya_info['mantradikshya_level'] }}@endif" id="mantradikshya_level" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row saranagati_dikshya mt-3" @if (isset($dikshya_info['saranagati_dikshya']) && $dikshya_info['saranagati_dikshya'] == 'on') @else style="display:none" @endif>
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="saranagatidikshya_date">
                                When did you receive Mantra Dikshya?
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" value="@if (isset($dikshya_info['saranagatidikshya_date'])){{ $dikshya_info['saranagatidikshya_date'] }}@endif" name="saranagatidikshya_date" id="saranagatidikshya_date"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="saranagatidikshya_level">
                                What your Sadhana Level (if given by Mahayogi Siddhababa) (e.g., 2, 4 etc.)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="saranagatidikshya_level" value="@if (isset($dikshya_info['saranagatidikshya_level'])){{ $dikshya_info['saranagatidikshya_level'] }}@endif"
                            id="saranagatidikshya_level" class="form-control">
                    </div>
                </div>
            </div>



            <div class="d-flex justify-content-start mt-3">
                <button type="button" class="btn btn-secondary btn-large mx-2 step-back"
                    data-url="{{ route('frontend.users.register', ['current_step' => $current_step, 'steps' => 'back']) }}">
                    <i class="fa fa-arrow-left">
                    </i>
                    Go Back
                </button>
                <button type="submit" class="btn btn-primary btn-lg">
                    Next Step
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</form>
