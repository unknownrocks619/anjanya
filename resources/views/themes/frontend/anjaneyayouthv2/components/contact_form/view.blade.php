@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<!-- ================> Contact section start here <================== -->
<div class="contact padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__header text-center">
            <h2>{{ $componentValue['heading'] ?? '' }}</h2>
            <div>
                {!! $componentValue['description'] ?? '' !!}
            </div>
        </div>
        <div class="section__wrapper">
            <div class="contact__form">
                <form class="ajax-append ajax-form" action="{{ route('frontend.submit_contanct_us') }}" id="contact-form"
                    method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control w-100"
                                    placeholder="{{ $componentValue['full_name'] }}" id="full_name" name="full_name"
                                    required="required">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control w-100"
                                    placeholder="{{ $componentValue['email'] }}" id="email" name="email" required>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="w-100 form-control" type="text"
                                    placeholder="{{ $componentValue['subject'] }}" id="subject" name="subject"
                                    required>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea placeholder="{{ $componentValue['message_box'] }}" rows="8" name="message" id="message" required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="text-center w-100">
                        <button type="submit"
                            class="default-btn move-right"><span>{{ $componentValue['button'] }}</span></button>
                    </div>
                </form>
                <p class="form-message"></p>
            </div>
        </div>
    </div>
</div>
<!-- ================> Contact section end here <================== -->
