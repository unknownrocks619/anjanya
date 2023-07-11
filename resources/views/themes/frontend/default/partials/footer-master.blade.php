<!-- footer -->
<footer>
    <div class="container-xl">
        <div class="footer-inner">
            <div class="row d-flex align-items-center gy-4">
                <!-- copyright text -->
                <div class="col-md-4">
                    <span class="copyright">© {{ date('Y') }}
                        {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</span>
                </div>

                <!-- social icons -->
                <div class="col-md-4 text-center">
                    <ul class="social-icons list-unstyled list-inline mb-0">
                        @if (\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                            <li class="list-inline-item"><a
                                    href="{{ \App\Classes\Helpers\SystemSetting::social_media('social_facebook') }}"><i
                                        class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if (\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                            <li class="list-inline-item"><a
                                    href="{{ \App\Classes\Helpers\SystemSetting::social_media('social_instagram') }}"><i
                                        class="fab fa-twitter"></i></a></li>
                        @endif
                    </ul>
                </div>

                <!-- go to top button -->
                <div class="col-md-4">
                    <a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back to
                        Top</a>
                </div>
            </div>
        </div>
    </div>
</footer>
