<nav class="navbar navbar-expand-lg px-4" style="background: ">
    <div class="container-fluid">
        <!-- Logo -->
        <div class="logo-wrapper">
            <a class="logo" href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}">
                @if (\App\Classes\Helpers\SystemSetting::logo())
                    <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="logo-img"
                        alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}">
                @else
                    <h2>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</h2>
                @endif
            </a>
        </div>
        <!-- Button -->
        <button class="navbar-toggler" type="button" aria-controls="navbar" aria-expanded="false"
            aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                @foreach (\App\Classes\Helpers\Menu::parentMenu() as $parent_menu)
                    <li class="nav-item  @if ($parent_menu->children->count()) dropdown @endif">
                        <a class="nav-link @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) active @endif dropdown-toggle"
                            @if ($parent_menu->children->count()) role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"  href="#" @else href="{{ \App\Classes\Helpers\Menu::getLink($parent_menu) }}" @endif>
                            {{ $parent_menu->menu_name }}
                        </a>
                        @if ($parent_menu->children->count())
                            <i class="ti-angle-down"></i>
                            <ul class="dropdown-menu">
                                @foreach ($parent_menu->children as $child_menu)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ \App\Classes\Helpers\Menu::getLink($child_menu) }}">
                                            <span>
                                                {{ $child_menu->menu_name }}
                                            </span>
                                        </a>
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
