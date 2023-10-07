<header id="masthead" class="site-header site-header-transparent">
    <!-- header html start -->
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="header-contact-info">
                        <ul>
                            <li>
                                <a href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}"><i class="fas fa-phone-alt"></i> {{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                            </li>
                            <li>
                                <a href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}"><i class="fas fa-envelope"></i>
                                    <span class="" >{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</span></a>
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i> {{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">
                    <div class="header-social social-links">
                        <ul>
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                            <li>
                                <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}" target="_blank">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                </a>
                            </li>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_twitter'))
                            <li>
                                <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_twitter')}}" target="_blank">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_youtube'))
                            <li>
                                <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_youtube')}}" target="_blank">
                                    <i class="fab fa-youtube" aria-hidden="true"></i>
                                </a>
                            </li>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                                <li>
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_instagram')}}" target="_blank">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_linkedin'))
                                <li>
                                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_linkedin')}}" target="_blank">
                                        <i class="fab fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="header-search-icon">
                        <button class="search-icon">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-header">
        <div class="container">
            <div class="hgroup-wrap d-flex justify-content-between align-items-center">
                <div class="site-identity">
                    <h1 class="site-title">
                        <a href="{{\App\Classes\Helpers\SystemSetting::basic_configuration('host')}}">
                            <img src="{{\App\Classes\Helpers\SystemSetting::logo()}}" alt="logo" style="max-height:70px;">
                        </a>
                    </h1>
                </div>
                <div class="main-navigation">
                    <nav id="navigation" class="navigation d-none d-lg-inline-block">
                        <ul>
                            <li class="current-menu-item">
                                <a href="index-2.html">Home</a>
                            </li>
                            <li>
                                <a href="about.html">Abouts</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul>
                                    <li>
                                        <a href="event-archive.html">Event List</a>
                                    </li>
                                    <li>
                                        <a href="event-single.html">Event Details</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">charity</a>
                                        <ul>
                                            <li>
                                                <a href="charity-archive.html">charity List</a>
                                            </li>
                                            <li>
                                                <a href="charity-single.html">charity Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Career</a>
                                        <ul>
                                            <li><a href="career.html">Career</a></li>
                                            <li><a href="career-detail.html">Career Single</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="single-page.html">Single Page</a></li>
                                    <li><a href="volunteer.html">Volunteer</a></li>
                                    <li><a href="donate.html">Donate</a></li>
                                    <li><a href="gallery.html">Gallery Page</a></li>
                                    <li><a href="testimonial-page.html">Testimonial Page</a></li>
                                    <li><a href="faq.html">FAQ Page</a></li>
                                    <li><a href="search-page.html">Search Page</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="comming-soon.html">Comming Soon</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-archive.html">Blog</a>
                                <ul>
                                    <li><a href="blog-archive.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Shop</a>
                                <ul>
                                    <li>
                                        <a href="product-right.html">Shop Archive</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">Shop Single</a>
                                    </li>
                                    <li>
                                        <a href="product-cart.html">Shop Cart</a>
                                    </li>
                                    <li>
                                        <a href="product-checkout.html">Shop Checkout</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="header-btn d-inline-block">
                        <a href="/register" class="button-round-primary">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-container"></div>
</header>
