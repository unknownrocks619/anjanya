<nav class="navbar navbar-expand-lg navbar-light py-4">
    <div class="container-xl">
        @if (\App\Classes\Helpers\SystemSetting::logo())
            <a class="navbar-brand" href="/">
                <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                     alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }} logo"
                     style="max-width:120px; max-height:120px;" />
            </a>
        @endif
        <div class="collapse navbar-collapse" id="nav_lc">
            <ul class="d-none d-lg-flex navbar-nav mx-auto my-3 my-lg-0 position-absolute top-50 start-50 translate-middle">
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
            <div class="ms-lg-auto">
                <a class="btn btn-default" href="/register">Registration</a>
                <button class="burger-menu icon-button ms-2 float-end float-md-none">
                    <span class="burger-icon"></span>
                </button>
            </div>
    </div>
</nav>
