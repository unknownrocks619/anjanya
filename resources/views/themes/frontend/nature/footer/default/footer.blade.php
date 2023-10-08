<footer id="colophon" class="site-footer footer-primary">
    <div class="top-footer">
        <div class="container">
            <div class="upper-footer">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <aside class="widget widget_text">
                            <div class="footer-logo">
                                <a href="{{\App\Classes\Helpers\SystemSetting::basic_configuration('host')}}">
                                    <img src="{{\App\Classes\Helpers\SystemSetting::logo()}}" style="max-height:50px;" alt="{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}">
                                </a>
                            </div>
                            <div class="textwidget widget-text">
                                {!! \App\Classes\Helpers\SystemSetting::basic_configuration('intro_description') !!}
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <aside class="widget widget_text">
                            <h3 class="widget-title">Contact Information</h3>
                            <p>Feel free to contact and reach us !</p>
                            <div class="textwidget widget-text">
                                <ul>
                                    <li>
                                        <i aria-hidden="true" class="icon icon-map-marker1"></i>
                                        {{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}
                                    </li>
                                    <li>
                                        <a href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}">
                                            <i aria-hidden="true" class="icon icon-phone1"></i>
                                            {!! \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}">
                                            <i aria-hidden="true" class="icon icon-envelope1"></i>
                                            <span class="__cf_email__" >{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <aside class="widget">
                            <h3 class="widget-title">Quick Link</h3>
                            <ul>
                                <li>
                                    <a href="contact.html">Membership Registration</a>
                                </li>
                                <li>
                                    <a href="contact.html">About</a>
                                </li>
                                <li>
                                    <a href="donate.html">Contact us</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="lower-footer">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="footer-newsletter">
                            <h5>Subscribe us for more update & news !!</h5>
                            <form class="newsletter">
                                <input type="email" name="subscription" placeholder="Enter Your Email" class="subscription">
                                <button type="submit" class="button-round-primary">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="social-links">
                            <ul>
                                @if(\App\Classes\Helpers\SystemSetting::social_media('facebook'))
                                    <li>
                                        <a href="{{\App\Classes\Helpers\SystemSetting::social_media('facebook')}}" target="_blank">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="https://www.twitter.com/" target="_blank">
                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/" target="_blank">
                                        <i class="fab fa-youtube" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/" target="_blank">
                                        <i class="fab fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-menu">
                            <ul>
                                <li>
                                    <a href="policy.html">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="policy.html">Term & Condition</a>
                                </li>
                                <li>
                                    <a href="faq.html">FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="copy-right text-center">Copyright &copy; 2022 Environ. All rights reserved.</div>
        </div>
    </div>
</footer>
<a id="backTotop" href="#" class="to-top-icon">
    <i class="fas fa-chevron-up"></i>
</a>
