<header class="header-three header--sticky">
    <div class="container">
        <div class="row header-top-three">
            <div class="col-lg-6">
                <p class="top-left">Are you ready to grow up your business? <a href="contactus.html">Contact Us <i
                        class="far fa-arrow-right"></i></a></p>
            </div>
            <div class="col-lg-6 right-h-three">
                <div class="header-top-right">
                    <div class="single-right email">
                        <i class="fas fa-envelope"></i>
                        <a href="#">info@example.com</a>
                    </div>
                    <div class="single-right call">
                        <i class="far fa-phone-volume"></i>
                        <span>Hotline:</span>
                        <a href="#">+210-9856988</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row main-header main-header-three">
            <div class="col-lg-2 col-md-3 col-sm-5 col-5">
                <a class="thumbnail-logo" href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}">
                    @if(\App\Classes\Helpers\SystemSetting::logo())
                        <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="logo-img" alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}" style="width: 190px;height:150px;">
                    @else
                        <h2>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</h2>
                    @endif
                </a>
            </div>
            <div class="col-lg-7 d-none d-xl-block">
                <div class="text-center d-flex justify-content-center">
                    <nav class="nav-main mainmenu-nav d-none d-xl-block">
                        <ul class="mainmenu">
                            @foreach (\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','!=' ,'register') as $parent_menu)
                                <li class=" @if($parent_menu->children->count())has-droupdown @endif">
                                    <a class="nav-link"
                                            @if($parent_menu->children->count())  href="#" @else href="{{\App\Classes\Helpers\Menu::getLink($parent_menu)}}" @endif>
                                        {{$parent_menu->menu_name}}
                                    </a>
                                    @if($parent_menu->children->count())
                                        <ul class="submenu menu-link3">
                                            @foreach ($parent_menu->children as $child_menu)
                                                <li @if($child_menu->children->count()) class="sub-droupdown" @endif>
                                                    <a  class='sub-menu-link' @if($child_menu->children->count()) href='#' @else href="{{\App\Classes\Helpers\Menu::getLink($child_menu)}}" @endif>
                                                        {{$child_menu->menu_name}}
                                                    </a>

                                                    @if($child_menu->children->count())
                                                        <ul class="submenu third-lvl">
                                                            @foreach ($child_menu->children as $subChild)
                                                                <li>
                                                                    <a href="{{\App\Classes\Helpers\Menu::getLink($subChild)}}">{{$subChild->menu_name}}</a>
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
                </div>
            </div>
            <div class="col-xl-3 col-lg-9 col-md-8 col-sm-7 col-7">
                <div class="right justify-content-end">
                    @if(\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first())
                        <a href="{{\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first()}}" class="rts-btn btn-primary-3">
                            {{\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first()->menu_name}}
                        </a>
                    @endif
                    <button id="menu-btn" class="menu rts-btn btn-primary-3-menu ml--20">
                        <img class="menu-dark" src="{{asset('frontend/kpa/assets/images/icon/menu.png')}}" alt="Menu-icon">
                        <img class="menu-light" src="{{asset('frontend/kpa/assets/images/icon/menu-light.png')}}" alt="Menu-icon">
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
