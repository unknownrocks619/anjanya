<div class="canvas-menu d-flex align-items-end flex-column">
    <!-- close button -->
    <button type="button" class="btn-close" aria-label="Close"></button>

    <!-- logo -->
    <div class="logo text-center">
        <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
            alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }} logo"
            class="img-fluid w-50" />
    </div>

    <!-- menu -->
    <nav>
        <ul class="vertical-menu">
            @foreach (\App\Classes\Helpers\Menu::parentMenu() as $parent_menu)
                <li
                    class="nav-item @if ($parent_menu->children->count()) dropdown @endif @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) active @endif">
                    <a class="nav-link @if ($parent_menu->children->count()) dropdown-toggle @endif @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) active @endif"
                        href="{{ \App\Classes\Helpers\Menu::getLink($parent_menu) }}">{{ $parent_menu->menu_name }}</a>
                    @if ($parent_menu->children->count())
                        <ul class="dropdown-menu">
                            @foreach ($parent_menu->children as $child_menu)
                                <li><a class="dropdown-item"
                                        href="{{ \App\Classes\Helpers\Menu::getLink($child_menu) }}">Magazine</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- social icons -->
    <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
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
