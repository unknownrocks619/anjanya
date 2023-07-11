<nav class="navbar fixed-top navbar-expand-lg py-lg-4">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">
            <img src="assets/images/logo.webp" height="35px" alt="">

        </a>
        <div class="dropdown d-md-none d-flex ms-auto">
            <a class="btn dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <iconify-icon icon="mdi:user-circle-outline"></iconify-icon>
            </a>

            <ul class="dropdown-menu">
                @if (auth()->guard('web')->check())
                    <li><a class="dropdown-item" href="{{ route('frontend.users.dashboard') }}">Dashboard</a></li>
                @else
                    <li><a class="dropdown-item" href="{{ route('frontend.users.login') }}">Sign in</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.users.register') }}">Register</a></li>
                @endif
            </ul>
        </div>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span style="font-size: 30px;">
                <iconify-icon icon="system-uicons:menu-hamburger"></iconify-icon>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-lg-5 me-auto mb-2 mb-lg-0 d-none d-md-flex">
                @foreach (\App\Classes\Helpers\Menu::parentMenu() as $menu)
                    @php
                        if ($menu->menu_position != 'main') {
                            continue;
                        }
                    @endphp
                    <li class="nav-item position-relative">
                        <a class="nav-link active d-flex align-items-center" aria-current="page"
                            href="{{ \App\Classes\Helpers\Menu::getLink($menu) }}">
                            {{ $menu->menu_name }}
                            @if ($menu->children->count())
                                <iconify-icon icon="mdi:chevron-down" class="ms-1">
                                </iconify-icon>
                            @endif
                        </a>
                        @if ($menu->children->count())
                            <div class="hover-box">
                                <ul>
                                    @foreach ($menu->children as $child_menu)
                                        <li>
                                            <a href="{{ \App\Classes\Helpers\Menu::getLink($child_menu) }}">
                                                {{ $child_menu->menu_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>




            <div class="right-aside mb-4 mb-md-0">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ic:outline-shopping-cart" style="font-size: 24px;"></iconify-icon>
                </a>
                @auth
                    <a href="{{ route('frontend.users.dashboard') }}">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('frontend.users.login') }}">
                        Sign in
                    </a>
                    <a href="{{ route('frontend.users.register') }}">
                        Register
                    </a>
                @endauth
            </div>
            <div class="d-block d-md-none">
                <div class="accordion" id="accordionExample">
                    @foreach (\App\Classes\Helpers\Menu::all() as $menu)
                        @php
                            if ($menu->menu_position != 'main') {
                                continue;
                            }
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="main_menu_title_{{ $menu->id }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#main_accordian_menu_{{ $menu->id }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    {{ $menu->menu_name }}
                                </button>

                            </h2>
                            @if ($menu->children->count())
                                <div id="main_accordian_menu_{{ $menu->id }}"
                                    class="accordion-collapse collapse show"
                                    aria-labelledby="main_menu_title_{{ $menu->id }}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($menu->children as $child_menu)
                                                <li>
                                                    <a
                                                        href="{{ \App\Classes\Helpers\Menu::getLink($child_menu) }}">{{ $child_menu->menu_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</nav>
