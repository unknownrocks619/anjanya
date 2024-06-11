<div class="popup-mobile-menu">
    <div class="inner">
        <div class="header-top">
            <div class="logo">
                <a href="/">
                    <img src="{{\App\Classes\Helpers\SystemSetting::logo()}}" alt="{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}">
                </a>
                {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}
            </div>
            <div class="close-menu">
                <button class="close-button">
                    <i class="ri-close-line"></i>
                </button>
            </div>
        </div>
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
    </div>
</div>
