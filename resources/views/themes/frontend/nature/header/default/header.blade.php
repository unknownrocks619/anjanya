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
                            @foreach (\App\Classes\Helpers\Menu::parentMenu() as $parent_menu)
                                <li
                                    class="@if ($parent_menu->children->count()) menu-item-has-children @endif @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) current-menu-item @endif">
                                    <a
                                       href="{{($parent_menu->children->count()) ? '#' : \App\Classes\Helpers\Menu::getLink($parent_menu) }}">{{ $parent_menu->menu_name }}</a>
                                    @if ($parent_menu->children->count())
                                        <ul>
                                            @foreach ($parent_menu->children as $child_menu)
                                                <li><a
                                                       href="{{ ($child_menu->children()->count()) ? '#' : \App\Classes\Helpers\Menu::getLink($child_menu) }}">
                                                        {{ $child_menu->menu_name }}
                                                    </a>
                                                    @if($child_menu->children()->count())
                                                        <ul>
                                                            @foreach ($child_menu->children as $children_menu)
                                                                <li>
                                                                    <a href="{{\App\Classes\Helpers\Menu::getLink($child_menu)}}">{{$child_menu->menu_name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>

                            @endforeach
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
