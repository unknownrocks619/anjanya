<?php
$sessionInfo = session()->get(session()->getId());
$mediaInfo = isset($sessionInfo['media_information']) ? $sessionInfo['media_information'] : [];
?>
<div class="right-side w-100">
    <div class="main active">
        <div class="text">
            <h2>Identity Verification</h2>
        </div>

        <div class="row">
            <div class="col-md-5 py-2">
                <div class="form-group">
                    <h3 for="user_photo fw-400">
                        Profile Photo
                        <span class="text-danger">*</span>
                    </h3>
                    <p>
                        No hats or sunglasses. Must reflect your current appearance. This will be your
                        membership card photo.
                    </p>
                    <div class="row">
                        <div class="col-md-8">
                            <div>
                                @if (isset($mediaInfo['profileID']) && !empty($mediaInfo['profileID']))
                                    <p class="alert alert-info">
                                        You have already uploaded your profile photo.
                                    </p>
                                @endif
                            </div>
                            <form method="post"
                                action="{{ route('frontend.users.registration.upload', ['type' => 'profile']) }}"
                                data-max-file='1'>
                                <div class="dropzone dropzone-info dz-area p-2">
                                    <div class="dz-message needsclick"><i class="fa fa-cloud-upload"></i>
                                        <h4>Drop files here or click to upload.</h4>

                                        <span class="note needsclick">
                                            The photo must be in JPG, JPEG or PNG format. <span
                                                style="font-weight:bold">Maximum 1MB.</span>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <h5>Sample</h5>
                            <img src="{{ asset('frontend/sample/profile.jpg') }}" class="img-fluid" />
                        </div>
                    </div>

                </div>
            </div>
            <div class='col-md-2'></div>
            <div class="col-md-5 py-2">
                <div class="form-group">
                    <h3 for="user_photo">
                        Identity Card
                        <span class="text-danger">*</span>
                    </h3>
                    <p>
                        <span>Upload your proof of ID (e.g. driver's license,
                            nagarikta/citizenship card)</span><br /><br />
                    </p>
                    <div class="row">
                        <div class="col-md-8">
                            @if (isset($mediaInfo['verificationID']) && !empty($mediaInfo['verificationID']))
                                <p class="alert alert-info">
                                    You have already uploaded your verification card
                                </p>
                            @endif
                            <form method="post"
                                action="{{ route('frontend.users.registration.upload', ['type' => 'verification_card']) }}"
                                data-max-file='1'>
                                <div class="dropzone dropzone-info dz-area p-2">
                                    <div class="dz-message needsclick"><i class="fa fa-cloud-upload"></i>
                                        <h4>Drop files here or click to upload.</h4>
                                        <span class="note needsclick">
                                            The photo must be in JPG, JPEG or PNG format. <span
                                                style="font-weight:bold">Maximum 1MB.</span>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <h5>Sample</h5>
                            <img src="{{ asset('frontend/sample/id-card.jpg') }}" class="img-fluid" />
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" method="post"
            class="form-control ajax-append ajax-form border-none border-0">
            <div class="row">
                <div class="ajax-form-message-box"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-3">
                            <input type="hidden" name="profile"
                                value="{{ isset($mediaInfo['profileID']) && !empty($mediaInfo['profileID']) ? $mediaInfo['profileID'] : '' }}"
                                class="form-control">
                            <input type="hidden" name="verification_card"
                                value="{{ isset($mediaInfo['verificationID']) && !empty($mediaInfo['verificationID']) ? $mediaInfo['verificationID'] : '' }}"
                                class="form-control">
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-start">
                                    <button type="button" class="btn btn-secondary btn-lg mx-2 step-back"
                                        data-url="{{ route('frontend.users.register', ['current_step' => $current_step, 'steps' => 'back']) }}">
                                        <i class="fa fa-arrow-left">
                                        </i>
                                        Go Back
                                    </button>
                                    <button type="submit" class="btn btn-lg btn-primary mx-2">Next Step
                                        <i class='fa fa-arrow-right'></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
