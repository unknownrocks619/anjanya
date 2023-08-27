@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<section class="main-content">
    <div class="container-xl">
        <!-- section header -->
        <div class="section-header">
            <h3 class="section-title">Contact Us</h3>
            <img src="{{asset('images/wave.svg')}}" class="wave" alt="wave" />
        </div>

        <!-- Contact Form -->
        <form id="contact-form" action="{{ route('frontend.submit_contanct_us') }}"
              class="contact-form ajax-append ajax-form" method="post">
            <input type="hidden" name="form_id" value="{{ encrypt($_loadComponentBuilder->getKey()) }}" class="form-control">
            <div class="row">
                <div class="column col-md-6">
                    <!-- Name input -->
                    <div class="form-group">
                        <input type="text" class="form-control" name="full_name" id="full_name"
                               placeholder="{{ $componentValue['full_name'] }}" required="required"
                               data-error="Name is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="column col-md-6">
                    <!-- Email input -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="{{ $componentValue['email'] }}" required="required" data-error="Email is required.">
                    </div>
                </div>

                <div class="column col-md-12">
                    <!-- Email input -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject"
                               placeholder="{{ $componentValue['subject'] }}" required="required"
                               data-error="Subject is required.">
                    </div>
                </div>

                <div class="column col-md-12">
                    <!-- Message textarea -->
                    <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="{{ $componentValue['message_box'] }}"
                                      required="required" data-error="Message is required."></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" id="submit" value="Submit"
                    class="btn btn-default">{{ $componentValue['button'] }}</button><!-- Send Button -->

        </form>
        <!-- Contact Form end -->
    </div>
</section>
