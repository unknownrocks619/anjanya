<!-- header -->
<header class="header-default">
    <nav class="navbar navbar-expand-lg">
        <div class="container-xl">
            <!-- site logo -->
            <a class="navbar-brand" href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}">
                <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" alt="logo"
                     style="width:80px;height:80px;" />
            </a>

            <div class="collapse navbar-collapse">
                <!-- menus -->
                <ul class="navbar-nav mr-auto">
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

            <!-- header right section -->
            <div class="header-right">
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
                <!-- header buttons -->
                <div class="header-buttons">
                    {{-- <button class="search icon-button">
                        <i class="icon-magnifier"></i>
                    </button> --}}
                    <button class="burger-menu icon-button">
                        <span class="burger-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>


