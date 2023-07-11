@php
    $accountInformation = session()->get(session()->getId())['account_information'];
    $user = [
        'first_name' => isset($accountInformation['first_name']) ? $accountInformation['first_name'] : '',
        'last_name' => isset($accountInformation['last_name']) ? $accountInformation['last_name'] : '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
    ];
    if (isset($accountInformation['_user'])) {
        $dbUser = \App\Models\User::find(decrypt($accountInformation['_user']));
        $user['email'] = $dbUser->email;
        unset($dbUser);
    }
    
@endphp
<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" method="post"
    class="ajax-append ajax-form">
    <div class="row form">
        <div class="col-md-12">
            <div class="" style="height:100%">
                <x-alert></x-alert>
                <div class="row me-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="mb-2">First Name
                                <sup class="text-danger">*</sup>
                            </label>
                            <input value="{{ $user['first_name'] }}" type="text" name="first_name"
                                class="py-3 form-control rounded-3 @error('first_name') border border-danger @enderror"
                                id="first_name" placeholder="Your First Name" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name" class="mb-2">Last Name </label>
                            <input type="text" value="{{ $user['last_name'] }}" name="last_name"
                                class="py-3 rounded-3 form-control @error('last_name') border border-danger @enderror"
                                id="last_name" placeholder="Your Last Name" />
                        </div>
                    </div>
                </div>
                <div class="row mt-4 me-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email" class="mb-2">Email address
                                <sup class="text-danger">*</sup>
                            </label>
                            <input required type="email" value="{{ $user['email'] }}" name="email"
                                placeholder="name@example.com"
                                class="py-3 rounded-3 form-control @error('email') border border-danger @enderror"
                                id="email" />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-4 me-5">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="password" class="mb-2">
                                Password
                                <sup class="text-danger">*</sup>
                            </label>
                            <input
                                @if (empty($user['email'])) required placeholder="Password" @else placeholder="********" @endif
                                value="{{ old('password') }}" placeholder="Password" type="password" name="password"
                                id="password"
                                class="py-3 rounded-3 form-control @error('password') border border-danger @enderror" />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="confirm_password" class="mb-2">
                                Confirm Password
                                <sup class="text-danger">*</sup>
                            </label>
                            <input
                                @if (empty($user['email'])) required placeholder="Confirm Password" @else placeholder="********" @endif
                                type="password" value="{{ old('password_confirmation') }}" name="password_confirmation"
                                class="py-3 rounded-3 form-control @error('password_confirmation') border border-danger @enderror"
                                id="confirm_password" />
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-2 mt-4 text-right me-5">
                    <div class="col-md-12 text-right d-flex justify-content-end">
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
