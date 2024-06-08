    @php
        /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
        $componentValue = $_loadComponentBuilder->values;

    @endphp
    <!-- conact us form fluid start -->
    <div class="rts-contact-form-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rts-contact-fluid rts-section-gap">
                        <div class="rts-title-area contact-fluid text-center mb--50">
                            <p class="pre-title">
                                Get In Touch
                            </p>
                            <h2 class="title">Needs Help? Let’s Get in Touch</h2>
                        </div>
                        <div class="form-wrapper">
                            <form id="contact-form"  class="ajax-append ajax-form"  action="{{ route('frontend.submit_contanct_us') }}" method="post">
                                <input type="hidden" name="form_id" value="{{ encrypt($_loadComponentBuilder->getKey()) }}" class="form-control">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" data-error='Name is required.' required name="full_name" placeholder="{{$componentValue['full_name']}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" required placeholder="{{$componentValue['email']}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="subject" required placeholder="{{$componentValue['subject']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <textarea minlength="15" placeholder="{{$componentValue['message_box']}}" name="message"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="rts-btn btn-primary">{{$componentValue['button']}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- conact us form fluid end -->
