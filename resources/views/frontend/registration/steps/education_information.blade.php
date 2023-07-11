<?php
$sessionInfo = session()->get(session()->getId());
$info = isset($sessionInfo['education_information']) ? $sessionInfo['education_information'] : [];
?>

<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" class="ajax-form" method="post">
    <div class="right-side w-100">
        <div class="main active">
            <div class="text">
                <h2>Your Education Information</h2>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label>What is your level of education
                            <i class="text-danger">*</i>
                        </label>
                        <select name="education" id="education_level" class="form-control">
                            @foreach (\App\Models\UserMeta::USER_EDUCATIONS as $education_key => $education)
                                <option value="{{ $education_key }}" @if (isset($info['education']) && $info['education'] == $education_key) selected @endif>
                                    {{ $education }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group" style="display:none">
                        <label>Education Major</label>
                        <input type="text"
                            value="@isset($info['education_major']){{ $info['education_major'] }}@endif" name="education_major" id="education_major" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="email">Citizenship Country(e.g., Nepali, Canadian, American etc.) <span
                                class="text-danger">*</span>
                        </label>
                        <select name="citizenship_country" class="form-control ajax-select-2"
                            data-action="{{ route('api.countries') }}">
                            @if (isset($info['citizenship_country']) && isset($info['citizenship_country_name']))
                                <option value="{{ $info['citizenship_country'] }}" selected>
                                    {{ $info['citizenship_country_name'] }}
                                </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="email">What is your Profession/Occupation? <span class="text-danger">*</span>
                        </label>
                        <input type="text" value="@isset($info['profession']){{ $info['profession'] }}@endif"
                            name="profession" id="profession" class="form-control" />
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
                <button type="submit" class="btn btn-primary btn-lg">Next Step
                    <i class="fa fa-arrow-right">
                    </i>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    $.each($('select'), function(dindex, element) {
        window.ajaxReinitalize(element);
    })
</script>
