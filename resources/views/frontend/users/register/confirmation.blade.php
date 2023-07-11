<?php
$session_info = session()->get(session()->getId());
if (!$session_info && !isset($session_info['account_information']) && isset($user)) {
    $formAction = route('frontend.users.verify_email', ['user' => $user]);
} else {
    $formAction = route('frontend.users.verify_email');
}
?>
<form action="{{ $formAction }}" method="post" class="ajax-append ajax-form">
    <div class="row">
        <div class="col-md-8 ms-5 ps-5 mt-5 pt-4 ">
            <!-- Login -->
            <h2 class="mb-6 text-success" style="font-weight:bold;color:#03014C !important;font-weight:700;">
                Congratulations! Your Upschool account is created!
            </h2>
            <!-- Text -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 ms-5 ps-5 mt-4">
            <p style="color:#242254;font-size:19px; font-weight:400; font-family: 'Inter'">
                Before you can log into Upschool, please verify your email address. We have sent you an email
                with a verification link. Please remember to check your junk/spam folders.
            </p>
        </div>
    </div>
    <div class="row mb-3 mt-5">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/2.png') }}" class="img-fluid w-25" />
        </div>
    </div>
    <div class="row mx-auto text-center mt-5 pt-5">
        <div class="col-md-6 text-center mx-auto">
            <button style="background: #242254" class="btn btn-primary ms-3 py-3 w-100 reverify">Re-send
                Verification
                Email</button>
        </div>
    </div>
</form>
