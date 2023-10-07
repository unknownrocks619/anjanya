<header class="header-personal">
    <div class="container-xl header-top">
        <div class="row align-items-center">
            <div class="col-4 d-none d-md-block d-lg-block">
                <!-- social icons -->
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

            <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                <!-- site logo -->
                @if (\App\Classes\Helpers\SystemSetting::logo())
                    <a class="navbar-brand" href="/">
                        <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                             alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }} logo"
                             style="max-width:80px; max-height:80px;" />
                    </a>
                @endif
                @if (\App\Classes\Helpers\SystemSetting::basic_configuration('site_name'))
                    <a href="/"
                       class="d-block text-logo">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                @endif
                @if (\App\Classes\Helpers\SystemSetting::basic_configuration('tagline'))
                    <span
                        class="slogan d-block">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('tagline') }}</span>
                @endif
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <!-- header buttons -->
                <div class="header-buttons float-md-end mt-4 mt-md-0">
                    {{-- <button class="search icon-button">
                        <i class="icon-magnifier"></i>
                    </button> --}}
                    <button class="burger-menu icon-button ms-2 float-end float-md-none">
                        <span class="burger-icon"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <nav class="navbar navbar-expand-lg">
        <div class="container-xl">

            <div class="collapse navbar-collapse justify-content-center centered-nav">
                <!-- menus -->
                <ul class="navbar-nav">
                    @foreach (\App\Classes\Helpers\Menu::parentMenu() as $parent_menu)
                        <li
                            class="nav-item @if ($parent_menu->children->count()) dropdown @endif @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) active @endif">
                            <a class="nav-link @if ($parent_menu->children->count()) dropdown-toggle @endif @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) active @endif"
                               href="{{ \App\Classes\Helpers\Menu::getLink($parent_menu) }}">{{ $parent_menu->menu_name }}</a>
                            @if ($parent_menu->children->count())
                                <ul class="dropdown-menu">
                                    @foreach ($parent_menu->children as $child_menu)
                                        <li><a class="dropdown-item"
                                               href="{{ \App\Classes\Helpers\Menu::getLink($child_menu) }}">{{ $child_menu->menu_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </nav>
</header>
