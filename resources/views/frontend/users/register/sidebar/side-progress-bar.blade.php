<div class="col-md-4 d-none d-md-block mx-auto sidebar" style="background-color: #242254 !important;align-items:center;">
    <div class="row mx-auto">
        <div class="col-md-12 text-center mt-5 pt-1">

        </div>
    </div>
    <div class=" px-0 ps-5  ms-2">
        <div class="row first mt-4">
            <div class="col-md-8">
                <div class="information-circle-disabled active-circle" data-step='1'
                    style="display:flex;justify-content:center;align-items:center">
                    <img src="{{ asset('images/1.png') }}" class="current-image d-none"
                        style="width:25px; height: 25px;" />
                </div>
                <div class="information-disabled active-text">
                    Account Information
                </div>
                <div class="information-line-disabled active-line">
                </div>
            </div>
        </div>
        <div class="row second">
            <div class="col-md-8 ">
                <div class="information-circle-disabled" data-step='1'
                    style="display:flex;justify-content:center;align-items:center">
                    <img src="{{ asset('images/1.png') }}" class="current-image d-none"
                        style="width:25px; height: 25px;" />
                </div>
                <div class="information-disabled">
                    About You
                </div>
                <div class="information-line-disabled">
                </div>
            </div>
        </div>
        <div class="row third">
            <div class="col-md-8 ">
                <div class="information-circle-disabled" data-step='1'
                    style="display:flex;justify-content:center;align-items:center">
                    <img src="{{ asset('images/1.png') }}" class="current-image d-none"
                        style="width:25px; height: 25px;" />
                </div>
                <div class="information-disabled">
                    Your Canva Account
                </div>
            </div>
        </div>
        <div class="row signup-progress-bar ps-3 mb-5 pb-5">
            <div class="col-md-12 steps p-0 m-0 mt-5">
                <p class="p-0 m-0 text-left"><span class="step-count">1</span> of 3 Steps</p>
            </div>
            <div class="progress-title col-md-12">
                <h5><span class="percent-complete">100%</span> to Complete</h5>
            </div>
            <div class="col-md-12 bar mt-2 ps-0">
                <div class="progress w-75" style="background-color: #fff;">
                    <div class="progress-bar" style="width: 5%;" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-md-12 already-exists ps-0 mb-5" style="color: #fff;margin-top: 10px;font-weight:400">
                <p>Already have an account ? <a href="{{ route('frontend.users.login') }}" class="text-white"
                        style="text-decoration: none; font-weight:700;font-family:'Inter' !important">Login here</a></p>
            </div>
        </div>
    </div>
</div>
