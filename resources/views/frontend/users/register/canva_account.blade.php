<form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" method="post"
    class="ajax-append ajax-form">
    <div class="row step-two-row">
        <div class="col-md-12">
            <div class="bg-white pt-3" style="height:100%">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-0"
                            style="color: #03014C !important;font-weight:700;line-height:42px;font-size:34px;">
                            Your Canva Account </h4>
                    </div>
                    <div class="col-md-10">
                        <p style="font-size:19px;color:#242254" class="mt-4 pt-4">
                            Thanks to a collaboration between Upschool and Canva, registered Upschool users can receive
                            a
                            FREE Canva for Education account! This means you can create incredible graphic designs,
                            images,
                            books, and a range of other creative products using Canva's premium design package at no
                            cost.
                        </p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <h3 class=""
                            style="color: #242254 !important;font-weight:700;line-height:22.99px;font-size:19px;">
                            Canva is an essential tool used in many of Upschool’s courses, and we highly recommend you
                            register.
                        </h3>
                    </div>
                </div>
                <div class="row me-5 mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="canva" class="mb-2">Would you like to register for a FREE Canva for
                                Education
                                account?
                                <sup class="text-danger">*</sup>
                            </label>
                            <select name="canva_terms_options" id="canva" autocomplete="off"
                                class="py-3 rounded-3 form-control form-select @error('canva') border bordered-danger @enderror">
                                <option value="yes" @if (old('canva') != 'no') selected @endif>Yes</option>
                                <option value="no" @if (old('canva') == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 me-5">

                    <div class="col-md-12 mt-3 canva-term">
                        <div class="form-group">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-1">
                                    <input type="checkbox" @if (old('canva') == 'yes' && old('personal_detail')) checked @endif required
                                        value="1" name="personal_detail" id="personal_detail"
                                        style="width:30px; height:30px;" />
                                    <span></span>

                                </div>
                                <div class="col-md-10">
                                    <label for="personal_detail" class="mb-2 ms-2">I acknowledge and accept that my name
                                        and
                                        email address may be visible to Upschool users registered with Canva.
                                        <sup class="text-danger">*</sup>
                                    </label>

                                </div>
                            </div>
                            @error('personal_detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12 mt-3 canva-term">
                        <div class="form-group">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-1">
                                    <input @if (old('canva') == 'yes' && old('canva_free')) checked @endif type="checkbox" required
                                        value="1" name="canva_free" id="canva_free"
                                        style="width:30px; height:30px;" />
                                    <span></span>

                                </div>
                                <div class="col-md-10">
                                    <label for="canva_free" class="mb-2">I acknowledge that should I not wish to have
                                        my
                                        details visible to other users, I can instead sign up for free Canva basic <a
                                            href="https://canva.com" style="color:#242254;font-family:'Inter'"
                                            target="_blank">here</a>.
                                        <sup class="text-danger">*</sup>
                                    </label>

                                </div>
                            </div>
                            @error('canva_free')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-1">
                                    <input type="checkbox" @if (old('terms')) checked @endif required
                                        value="1" name="terms" id="terms" style="width:30px; height:30px;" />
                                    <span></span>

                                </div>
                                <div class="col-md-10">
                                    <label for="terms">I agree to Upschool’s <a
                                            href="https://upschool.co/terms-and-conditions/"
                                            style="color:#242254;font-family:'Inter'">Terms and Conditions</a> and <a
                                            href="https://upschool.co/privacy-policy/"
                                            style="color:#242254;font-family:'Inter'">Privacy Policy</a>.
                                        <sup class="text-danger">*</sup>
                                    </label>

                                </div>
                            </div>
                            @error('terms')
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
                        <button type="submit" class="btn btn-primary next py-3 px-5" data-step="2">
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
