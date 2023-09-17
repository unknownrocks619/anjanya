@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<!-- Contact -->
<section class="contact my-4">
    <div class="container mt-5">
        <div class="row mb-90">
            <div class="col-md-6 mb-60">
                <h3>{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</h3>
                <div>
                    {!! \App\Classes\Helpers\SystemSetting::basic_configuration('short_description') !!}
                </div>
                <div class="reservations mb-30 mt-4">
                    <div class="icon"><span class="flaticon-call"></span></div>
                    <div class="text">
                        <p>Reservation</p> <a href="tel:855-100-4444">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                    </div>
                </div>
                <div class="reservations mb-30">
                    <div class="icon"><span class="flaticon-envelope"></span></div>
                    <div class="text">
                        <p>Email Info</p> <a href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</a>
                    </div>
                </div>
                <div class="reservations">
                    <div class="icon"><span class="flaticon-location-pin"></span></div>
                    <div class="text">
                        {{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address') }}
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-30 offset-md-1">
                <h3>Get in touch</h3>
                <form id="contact-form" action="{{ route('frontend.submit_contanct_us') }}"
                        class="contact-form ajax-append ajax-form" method="post">

                <input type="hidden" name="form_id" value="{{ encrypt($_loadComponentBuilder->getKey()) }}" class="form-control">
                <div class="row">
                    <div class="column col-md-6">
                        <!-- Name input -->
                        <div class="form-group">
                            <input type="text" class="" name="full_name" id="full_name"
                                   placeholder="{{ $componentValue['full_name'] }}" required="required"
                                   data-error="Name is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-6">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="text" class="" id="email" name="email"
                                   placeholder="{{ $componentValue['email'] }}" required="required" data-error="Email is required.">
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="text" class="" id="subject" name="subject"
                                   placeholder="{{ $componentValue['subject'] }}" required="required"
                                   data-error="Subject is required.">
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Message textarea -->
                        <div class="form-group">
                            <textarea name="message" id="message" class="" rows="4" placeholder="{{ $componentValue['message_box'] }}"
                                      required="required" data-error="Message is required."></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" id="submit"
                        class=" butn-dark2"><span>{{ $componentValue['button'] }}</span></button><!-- Send Button -->

                </form>
            </div>
        </div>
    </div>
</section>
