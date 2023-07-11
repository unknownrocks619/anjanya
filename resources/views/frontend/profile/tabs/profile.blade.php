    <div class="settings mt-lg-5 mt-3">
        <!-- personal info  -->
        <div class="info-card">
            <div class="info-header">
                <h2>Personal Information</h2>
            </div>
            <div class="info-form">
                <div class="row">
                    <div class="col-md-4 col-lg-3 mb-3">
                        <label for="">Profile Photo</label>
                    </div>
                    <div class="col-md-7 col-lg-8 mb-3">
                        <div class="file-uploader">
                            <div class="up-img">
                                <?php
                                $userImage = auth()
                                    ->guard('web')
                                    ->user()
                                    ->getImage()
                                    ->whereNull('type')
                                    ->latest()
                                    ->first();

                                if ($userImage) {
                                    echo "<img src='" .
                                        App\Classes\Helpers\Image::getImageAsSize($userImage->image->filepath, 's') .
                                        "'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class='img-fluid rounded-5' />";
                                } else {
                                    echo strtoupper(substr($user->first_name, 0, 1)) . strtoupper(substr($user->last_name, 0, 1));
                                }
                                ?>
                            </div>
                            <div class="up-content">
                                <form action="{{ route('frontend.users.profile.settings') }}" method="post">
                                    <input type="file" name="profile" id="profile-picture"
                                        class="form-control d-none">
                                </form>
                                <p>It can be PNG,JPG or GIF file. The size should not exceed 2MB
                                </p>
                                <div class="up-btns">
                                    <a href="javascript:void(0)" class="left-btn upload-picture-icon"><span
                                            class="iconify" data-icon="ic:round-cloud-upload"></span></a>
                                    <a data-action="{{ route('frontend.profile.remove_profile_picture') }}"
                                        data-method="post" href="javascript:void(0)"
                                        class="right-btn ajax-button-confirm"><span class="iconify"
                                            data-icon="ic:baseline-delete"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('frontend.profile.settings') }}" method="post" class="ajax-form ajax-append">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">First Name</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group"><input type="text" name="first_name"
                                    value="{{ $user->first_name }}" placeholder="Gavin"></div>
                        </div>

                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Last Name</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group">
                                <input type="text" name='last_name' value="{{ $user->last_name }}"
                                    placeholder="McCormack">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Email Address</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group">
                                <input type="email" value="{{ $user->email }}" readonly
                                    placeholder="aretheseyourglasses@gmail.com">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Country</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group">
                                <select name="country" class="form-select ajax-select" id="country">
                                    @foreach (\App\Models\Country::get() as $country)
                                        <option value="{{ $country->getKey() }}"
                                            @if ($country->getKey() == $user->country) selected @endif>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Date of Birth</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group">
                                <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}"
                                    placeholder="22/10/1987" class="form-select">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="text-end">
                                <button type="submit" class="save-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Billing details  -->

        <div class="info-card">
            <form class="ajax-append ajax-form" action="{{ route('frontend.profile.settings') }}" method="post">
                <div class="info-header">
                    <h2>Billing & Shipping Details</h2>
                </div>
                <div class="info-form user_address">
                    <div class="row align-items-center billing_address">
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="" class="fs-17 mb-3 ">Billing Details</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                        </div>
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Address</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="billing_street_address"
                                            placeholder="Unit, Street Number, Street Name"
                                            value="{{ $user->street_address?->billing_street_address }}">
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="billing_city"
                                            value="{{ $user->street_address?->billing_city }}" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3 px-md-0">
                                    <div class="form-group">
                                        <input name="billing_postcode" type="text" placeholder="Post Code"
                                            value="{{ $user->street_address?->billing_postcode }}">
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <div class="form-group">
                                        <input type="text" readonly name="billing_country"
                                            value="{{ $user->getCountry->name }}" placeholder="Country">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Organisation</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <input type="text" placeholder="Company/Organisation">
                        </div> --}}
                    </div>
                    <div
                        class="row align-items-center @if ($user->street_address?->same_as_billing) d-none @endif shipping_address mt-2 border-top">
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="" class="fs-17 mb-3 ">Shipping Details</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                        </div>
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Address</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="shipping_street_address"
                                            value="{{ $user->street_address?->shipping_street_address }}"
                                            placeholder="Unit, Street Number, Street Name">
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <div class="form-group">
                                        <input type="text" value="{{ $user->street_address?->shipping_city }}"
                                            name="shipping_city" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3 px-md-0">
                                    <div class="form-group">
                                        <input name="shipping_postcode"
                                            value="{{ $user->street_address?->shipping_postcode }}" type="text"
                                            placeholder="Post Code">
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <div class="form-group">
                                        <select name="shipping_country" class="form-select  ajax-select">
                                            @foreach (\App\Models\Country::get() as $country)
                                                <option value="{{ $country->getKey() }}"
                                                    @if ($user->street_address?->shipping_country == $country->getKey()) selected
                                                    @elseif ($country->getKey() == $user->country) selected @endif>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-form">
                    <div class="row align-items-center">
                        <div class="col-md-11 col-lg-11 mb-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <input class="billing_address_check" id="checkbox" name="same_as_billing"
                                        @if ($user->street_address?->same_as_billing == true) checked @endif
                                        style="width: 20px;accent-color: #242254;" type="checkbox" value="1">
                                    <label for="checkbox">Shipping Details same as
                                        Billing Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="text-end">
                                <button type="submit" class="save-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Change password  -->

        <div class="info-card">
            <div class="info-header">
                <h2>Change Password</h2>
            </div>
            <div class="info-form">
                <form action="{{ route('frontend.users.profile.settings') }}" method="post"
                    class="ajax-form ajax-append">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">New Passworde</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group"><input type="password" name="password"
                                    placeholder="*******************"></div>
                            <p class="msg">at least 6 characters, including letters (a-z, A-Z), 1
                                uppercase and 1 numeric character</p>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-3">
                            <label for="">Confirmation</label>
                        </div>
                        <div class="col-md-7 col-lg-8 mb-3">
                            <div class="form-group"><input type="password" name="password_confirmation"
                                    placeholder="Repeat new password"></div>
                        </div>
                        <div class="col-md-11">
                            <div class="text-end">
                                <button type="submit" class="save-btn">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
