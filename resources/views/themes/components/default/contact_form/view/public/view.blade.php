@if (
    $component->active ||
        auth()->guard('admin')->check())
    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-phone"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Phone</h3>
                            <p class="mb-0">
                                {{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') }}
                            </p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-envelope-open"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">E-Mail</h3>
                            <p class="mb-0" style="word-break:break-all">
                                {{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address') }}
                            </p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-map"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Location</h3>
                            <p class="mb-0">
                                {{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address') }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="spacer" data-height="50"></div>

            <!-- section header -->
            <div class="section-header">
                <h3 class="section-title">{{ $component->component_name }}</h3>
                <img src="images/wave.svg" class="wave" alt="wave" />
            </div>

            <!-- Contact Form -->
            <form id="contact-form" action="{{ route('frontend.submit_contanct_us') }}"
                class="contact-form ajax-append ajax-form" method="post">
                <input type="hidden" name="form_id" value="{{ encrypt($component->getKey()) }}" class="form-control">
                <div class="row">
                    <div class="column col-md-6">
                        <!-- Name input -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                placeholder="{{ $values->full_name }}" required="required"
                                data-error="Name is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-6">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="{{ $values->email }}" required="required" data-error="Email is required.">
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="{{ $values->subject }}" required="required"
                                data-error="Subject is required.">
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Message textarea -->
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="{{ $values->message_box }}"
                                required="required" data-error="Message is required."></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" id="submit" value="Submit"
                    class="btn btn-default">{{ $values->button }}</button><!-- Send Button -->

            </form>
            <!-- Contact Form end -->
        </div>
    </section>
@endif
