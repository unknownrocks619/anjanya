@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<div class="edu-contact-us-area eduvibe-contact-us edu-section-gap bg-color-white">
    <div class="container eduvibe-animated-shape">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">Need Help?</span>

                    <h3 class="title">
                        @if(isset($model) && (($model instanceof \App\Models\Page) || ($model instanceof \App\Models\Post)))
                            Get Enrolled
                        @else
                            Send Enquiry
                        @endif
                    </h3>
                </div>
            </div>
        </div>
        <div class="row g-5 mt--20">
            <div class="col-lg-6">
                <div class="contact-info pr--70 pr_lg--0 pr_md--0 pr_sm--0">
                    <div class="row g-5">
                        <!-- Start Contact Info  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="contact-address-card-1 website">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="ri-global-line"></i>
                                    </div>
                                    <div class="content">
                                        <h6 class="title">Our Website</h6>
                                        <p><a href="{{\App\Classes\Helpers\SystemSetting::basic_configuration('host')}}" target="_blank">{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Info  -->

                        <!-- Start Contact Info  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                            <div class="contact-address-card-1 phone">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="icon-Headphone"></i>
                                    </div>
                                    <div class="content">
                                        <h6 class="title">Call Us On</h6>
                                        <p><a href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Info  -->

                        <!-- Start Contact Info  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                            <div class="contact-address-card-1 email">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="icon-mail-open-line"></i>
                                    </div>
                                    <div class="content">
                                        <h6 class="title">Email Us</h6>
                                        <p><a href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('email_official')}}" target="_blank">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('email_official')}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Info  -->

                        <!-- Start Contact Info  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12" data-sal-delay="300" data-sal="slide-up" data-sal-duration="800">
                            <div class="contact-address-card-1 location">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="icon-map-pin-line"></i>
                                    </div>
                                    <div class="content">
                                        <h6 class="title">Our Location</h6>
                                        <p>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Info  -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <form class="rnt-contact-form rwt-dynamic-form row contact-form ajax-append ajax-form"  method="post" action="{{ route('frontend.submit_contanct_us') }}">

                    <input type="hidden" name="form_id" value="{{ encrypt($_loadComponentBuilder->getKey()) }}" class="form-control">

                    @if(isset($model) && $model instanceof \App\Models\Page)
                        <input type="hidden" name="page_name" value="{{$model->title}}">
                    @endif

                    @if(isset($model) && $model instanceof  \App\Models\Post)
                        <input type="hidden" name="post_name" value="{{$model->title}}">
                    @endif

                    <div class="col-lg-12">
                        <div class="form-group">
                            <input required data-error="Name is required." name="full_name" id="contact-name" type="text" class="form-control form-control-lg" placeholder="{{ $componentValue['full_name'] }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input placeholder="{{ $componentValue['email'] }}"
                                type="email"
                               class="form-control form-control-lg"
                                   id="contact-email"
                                   required
                                   name="email"  data-error="Email is required.">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <input placeholder="Phone Number"
                                   type="text"
                                   class="form-control form-control-lg"
                                   id="phone"
                                   required
                                   name="phone"  data-error="Phone Number is required.">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject"
                                   placeholder="{{ $componentValue['subject'] }}" required="required"
                                   data-error="Subject is required.">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="{{ $componentValue['message_box'] }}"
                                      required="required" data-error="Message is required."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="rn-btn edu-btn w-100" name="submit" type="submit">
                            <span>{{ $componentValue['button'] }}</span><i class="icon-arrow-right-line-right"></i>
                        </button>
                    </div>
                    <div class="row mt-3"></div>

                </form>
            </div>
        </div>

        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            <div class="shape-image scene shape-image-1">
                        <span data-depth="-2.2">
                            <img src="{{ asset ('images/shape-bg/shape-04-01.png')}}" alt="Shape Thumb">
                        </span>
            </div>
            <div class="shape-image shape-image-2">
                <img src="{{ asset ('images/shape-bg/shape-02-08.png')}}" alt="Shape Thumb">
            </div>
            <div class="shape-image shape-image-3">
                <img src="{{ asset ('images/shape-bg/shape-15.png')}}" alt="Shape Thumb">
            </div>
        </div>
    </div>
</div>
