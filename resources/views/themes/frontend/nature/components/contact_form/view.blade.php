@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="contact-page-section">
    <div class="contact-form-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-detail-container">
                        <div class="section-head">
                            <div class="back-title">CONTACT US!</div>
                            <h2 class="section-title">Feel Free To Contact &amp; <span class="primary-color">Reach Us!
                                    <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                       <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                                    </svg>
                                    </span>
                            </h2>
{{--                            <div class="section-disc">--}}
{{--                                <p>Praesent consequatur aptent, tincidunt habitant numquam, laoreet fringilla consequatur provident, interdum anim quas dolorum sed. Egestas debitis eleifend eniam repudiandae.</p>--}}
{{--                            </div>--}}
                        </div>
                        <div class="contact-details-list">
                            <ul>
                                <li>
                                       <span class="icon">
                                          <i class="fas fa-map-marker-alt"></i>
                                       </span>
                                    <div class="details-content">
                                        <h4>Head office address :</h4>
                                        <span>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}</span>
                                    </div>
                                </li>
                                <li>
                                       <span class="icon">
                                          <i class="fas fa-phone-volume"></i>
                                       </span>
                                    <div class="details-content">
                                        <h4>Contact Number:</h4>
                                        <span>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</span>
                                    </div>
                                </li>
                                <li>
                                       <span class="icon">
                                          <i class="fas fa-envelope-open-text"></i>
                                       </span>
                                    <div class="details-content">
                                        <h4>Email address :</h4>
                                        <span>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-from-wrap" style="background-image: url(assets/images/banner-img.jpg);">
                        <form class="contact-from ajax-append ajax-form d-block" id="contact-form" method="post" action="{{ route('frontend.submit_contanct_us') }}">
                            <input type="hidden" name="form_id" value="{{ encrypt($_loadComponentBuilder->getKey()) }}" class="form-control">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="full_name" data-error="Name is required."
                                               placeholder="{{ $componentValue['full_name'] }}*" required="required"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" name="email" data-error="Email is required."
                                               placeholder="{{ $componentValue['email'] }}*" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" data-error="Subject is required."
                                               required="required" placeholder="{{ $componentValue['subject'] }}*">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group width-full">
                                        <textarea rows="8" placeholder="{{ $componentValue['message_box'] }}*"
                                                  name="message"
                                                  data-error="Message is required."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <input type="submit" name="submit" value="{{$componentValue['button']}}">
                                </div>
                            </div>
                        </form>
                        <div class="overlay" style="background: transparent !important;border: 2px solid #ffda10 !important; border-radius: 10%"></div>
                    </div>
                    <div class="footer-social-icon">
                        @if(\App\Classes\Helpers\SystemSetting::social_media()?->count())
                            <h4>Follow us on social media..</h4>
                        <br>
                        <div class="social-icon-wrap">
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                                <div class="social-icon social-facebook">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                        <span>Facebook</span>
                                    </a>
                                </div>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_pinterest'))
                                <div class="social-icon social-pinterest">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_pinterest')}}" target="_blank">
                                        <i class="fab fa-pinterest"></i>
                                        <span>Pinterest</span>
                                    </a>
                                </div>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_whatsapp'))
                                <div class="social-icon social-whatsapp">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_whatsapp')}}" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                </div>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_linkedin'))
                                <div class="social-icon social-linkedin">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_linkedin')}}" target="_blank">
                                        <i class="fab fa-linkedin"></i>
                                        <span>Linkedin</span>
                                    </a>
                                </div>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_twitter'))
                                <div class="social-icon social-twitter">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_twitter')}}" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                </div>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_google'))
                                <div class="social-icon social-google">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_google')}}" target="_blank">
                                        <i class="fab fa-google-plus-g"></i>
                                        <span>Google</span>
                                    </a>
                                </div>
                           @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                                <div class="social-icon social-google">
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_google')}}" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                        <span>Instagram</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
