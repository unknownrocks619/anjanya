<!-- Start Footer Area  -->
<footer class="eduvibe-footer-one edu-footer footer-style-default">
    <div class="footer-top">
        <div class="container eduvibe-animated-shape">
            <div class="row g-5">
                <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                    <div class="edu-footer-widget">
                        <div class="logo">
                            <a href="/">
                                <img class="logo-light" src="{{\App\Classes\Helpers\SystemSetting::logo()}}" alt="Site Logo" style="max-width: 125px">
                            </a>
                        </div>
                        <div class="description">
                            {!! \App\Classes\Helpers\SystemSetting::basic_configuration('intro_description') !!}
                        </div>

                        <ul class="social-share">
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                                <li><a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}"><i class="icon-Fb"></i></a></li>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                                <li><a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_instagram')}}"><i class="icon-linkedin"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="edu-footer-widget quick-link-widget">
                        <h5 class="widget-title">Useful Links</h5>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                <li><a href="contact-us.html"><i class="icon-Double-arrow"></i>Contact Us</a></li>
                                <li><a href="pricing.html"><i class="icon-Double-arrow"></i>Pricing Plan</a></li>
                                <li><a href="instructor-profile.html"><i class="icon-Double-arrow"></i>Instructor Profile</a></li>
                                <li><a href="faq.html"><i class="icon-Double-arrow"></i>FAQ</a></li>
                                <li><a href="course-style-3.html"><i class="icon-Double-arrow"></i>Popular Courses</a></li>
                                <li><a href="purchase-guide.html"><i class="icon-Double-arrow"></i>Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="edu-footer-widget">
                        <h5 class="widget-title">Contact Info</h5>
                        <div class="inner">
                            <div class="widget-information">
                                <ul class="information-list">
                                    <li><i class="icon-map-pin-line"></i>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}</li>
                                    <li><i class="icon-phone-fill"></i><a href="tel:+1(237)382-2839">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}</a></li>
                                    <li><i class="icon-mail-line-2"></i><a target="_blank" href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @if(\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_map'))
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="edu-footer-widget quick-link-widget">
                            {!! \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_map') !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="shape-dot-wrapper shape-wrapper d-md-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="{{asset('images/shape-bg/shape-21-01.png')}}" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="{{asset('images/shape-bg/shape-35.png')}}" alt="Shape Thumb" />
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area copyright-default">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <p>Copyright {{date("Y")}} <a href="#" class="p-1" style="color: #e90400;border:2px solid #fd9a02;box-shadow:2px 2px #ea1b01">{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</a>  All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area  -->
