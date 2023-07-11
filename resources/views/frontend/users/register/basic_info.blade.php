<?php
$basic = session()->get(session()->getId())['basic_info'];
?>
<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" method="post"
    class="ajax-append ajax-form">
    <div class="row form">
        <div class="col-md-12">
            <div class="" style="height:100%">
                <x-alert></x-alert>
                <div class="row me-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name" class="mb-2">Select Your Country
                                <sup class="text-danger">*</sup>
                            </label>
                            <select name="country" id="country" class="form-control py-3 rounded-3">
                                @foreach (\App\Models\Country::get() as $country)
                                    <option value="{{ $country->getKey() }}"
                                        @if (isset($basic['country']) && $basic['country'] == $country->getkey()) selected @elseif ($country->id == 13) selected @endif>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row me-5 mt-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="roles" class="mb-2">What Describes You? </label>
                            <select name="roles" id="roles" class="form-control">
                                @foreach (\App\Models\User::USER_ROLES as $role_key => $role_value)
                                    <option @if (isset($basic['roles']) && $basic['roles'] == $role_key) selected @endif
                                        value="{{ $role_key }}">{{ $role_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 me-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="date_of_birth" class="mb-2">Your Date of Birth
                                <sup class="text-danger">*</sup>
                            </label>
                            <input required type="date"
                                @if (isset($basic['date_of_birth'])) value='{{ $basic['date_of_birth'] }}' @endif
                                name="date_of_birth"
                                class="py-3 rounded-3 form-control @error('date_of_birth') border border-danger @enderror"
                                id="date_of_birth" />
                            @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4 pt-4 text-right me-5">
                    <div class="col text-start pt-3">
                        <button class="step-back btn bnt-link mt-2 pt-1 step-back-book-uploader"
                            data-url="{{ route('frontend.users.register', ['current_step' => $current_step, 'steps' => 'back']) }}"
                            data-step="1"
                            style="color:#242254;font-weight:400;text-decoration:underline;font-size:18px;line-height:25.42px;font-family:'Inter'">
                            <i class=" fas fa-arrow-left"></i>
                            Go back
                        </button>
                    </div>
                    <div class="col mt-3 text-right d-flex justify-content-end mb-5">
                        <button class="btn btn-primary py-3 px-5" data-step="1">
                            Next
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
