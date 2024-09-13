<!-- ================> header section start here <================== -->
<header class="header">
    <!-- Logo -->
    <div class="navbar-expand-xl">
        <div class="collapse navbar-collapse" id="menubar2">
            <div class="header__top w-100">
                <div class="container">
                    <div class="header__top-area">
                        <div class="header__top-left">
                            <ul>
                                @if (\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number'))
                                    <li class="d-flex flex-wrap">
                                        <i class="fas fa-phone-alt"></i>
                                        <a
                                            href="tel:{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') }}">
                                            <h6 class="call">
                                                {{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') }}
                                            </h6>
                                        </a>
                                    </li>
                                @endif
                                @if (\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address'))
                                    <li class="d-flex flex-wrap">
                                        <i class="fas fa-envelope"></i>
                                        <a
                                            href="mailto:{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address') }}">
                                            <h6>
                                                {{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address') }}
                                            </h6>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="header__top-center">
                            <div class="header__top-logo d-none d-md-block">
                                <a href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}">
                                    @if (\App\Classes\Helpers\SystemSetting::logo())
                                        <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="logo-img"
                                            alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}"
                                            style="width: 190px;height:150px;">
                                    @else
                                        <h2>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}
                                        </h2>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="header__top-right">
                            <div class="header__top-socialsearch">
                                <div class="header__top-social">
                                    <ul>
                                        @if (\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        @endif
                                        @if (\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        {{-- <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li> --}}
                                    </ul>
                                </div>
                                <div class="header__top-search">
                                    <ul>
                                        <li class="search__icon"><i class="fas fa-search"></i></li>
                                        <li class="cart__icon"><i class="fas fa-shopping-bag"></i><span>04</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Logo-->

    <!--  Navigation -->
    <div class="header__bottom">
        <div class="container">
            <div class="header__mainmenu navbar navbar-expand-xl navbar-light">
                <div class="header__logo">
                    <a href="index.html" class="d-none d-xl-block"><img src="assets/images/logo/02.png"
                            alt="logo"></a>
                    <a href="index.html" class="d-xl-none"><img src="assets/images/logo/01.png" alt="logo"></a>
                </div>
                <div class="header__bar">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar"
                        aria-controls="menubar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <button class="navbar-toggler header__bar-info" type="button" data-bs-toggle="collapse"
                        data-bs-target="#menubar2" aria-controls="menubar2" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="fas fa-info"></span>
                    </button>
                </div>
                <div class="header__menu navbar-expand-xl">
                    <div class="collapse navbar-collapse" id="menubar">

                        {!! $user_theme->header('navigation') !!}

                        @if (\App\Classes\Helpers\Menu::parentMenu()->where('menu_type', 'register')->first())
                            <a href="{{ \App\Classes\Helpers\Menu::parentMenu()->where('menu_type', 'register')->first() }}"
                                class="default-btn">
                                <span>
                                    {{ \App\Classes\Helpers\Menu::parentMenu()->where('menu_type', 'register')->first()->menu_name }}
                                    <i class="fas fa-heart"></i>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Navigation -->
</header>
<!-- ================> header section end here <================== -->
