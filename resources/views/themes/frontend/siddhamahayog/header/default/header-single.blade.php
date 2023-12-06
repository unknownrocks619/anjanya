<header class="edu-header  header-sticky sticky disable-transparent">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-xl-1 col-md-2 col-6">
                <div class="logo">
                    <a href="/">
                        <img class="logo-light" src="{{\App\Classes\Helpers\SystemSetting::logo()}}" alt="{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}" style="max-height: 100px !important;">
                    </a>
                </div>
            </div>

            <div class="col-lg-10 d-none d-xl-block">
                <nav class="mainmenu-nav d-none d-lg-block">

                    <ul class="mainmenu">
                        @foreach (\App\Classes\Helpers\Menu::parentMenu()->where('menu_position','main') as $parent_menu)
                            <li @if($parent_menu->children()->count()) class="has-droupdown" @endif>
                                <a href="{{\App\Classes\Helpers\Menu::getLink($parent_menu)}}">{{$parent_menu->menu_name}}</a>

                                @if($parent_menu->children()->count())
                                    <ul class="submenu">
                                        @foreach ($parent_menu->children as $child_menu)
                                            <li>
                                                <a href="{{\App\Classes\Helpers\Menu::getLink($child_menu)}}">
                                                    {{$child_menu->menu_name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach
                    </ul>

                </nav>
            </div>

            <div class="col-lg-6 col-xl-1 col-md-1 col-6">
                <div class="header-right d-flex justify-content-end">
                    <div class="header-quote">
                        <div class="quote-icon quote-search">
                            <button class="white-box-icon search-trigger header-search"><i class="ri-search-line"></i></button>
                        </div>
                        <div class="quote-icon quote-user d-none d-md-block ml--15 ml_sm--5">
                            <a class="edu-btn btn-medium left-icon header-button" href="https://jagadguru.siddhamahayog.org/login"><i class="ri-user-line"></i></a>
                        </div>
                    </div>

                    <div class="mobile-menu-bar ml--15 ml_sm--5 d-block d-xl-none">
                        <div class="hamberger">
                            <button class="white-box-icon hamberger-button header-menu">
                                <i class="ri-menu-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
