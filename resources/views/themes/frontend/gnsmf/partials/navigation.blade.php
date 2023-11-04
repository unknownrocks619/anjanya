<!-- Navigation -->
<nav class="navbar navbar-expand-sm navbar-light" id="neubar">
    <div class="container">

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
                @foreach (\App\Classes\Helpers\Menu::parentMenu() as $menu)
                    <li class="nav-item @if($menu->children()->count()) dropdown @endif">
                        <a class=" mx-2 btn btn-gnsmf btn-primary px-5 @if(\App\Classes\Helpers\Menu::isActiveMenu($menu)) active @endif rounded-pill @if($menu->children()->count()) dropdown-toggle @endif"
                           aria-current="page"
                           @if($menu->children()->count())
                               href="#"
                           @else
                               href="{{\App\Classes\Helpers\Menu::getLink($menu)}}"
                           @endif
                           @if($menu->children()->count())
                               data-bs-toggle="dropdown"
                           aria-expanded="false"
                           role="button"
                           id="navbar{{$menu->getKey()}}DropdownMenuLink"
                            @endif
                        >{{$menu->menu_name}}</a>
                        @if($menu->children()->count())
                            <ul class="dropdown-menu" aria-labelledby="navbar{{$menu->getKey()}}DropdownMenuLink">
                                @foreach($menu->children as $child_menu)
                                    <li><a class="dropdown-item" href="{{\App\Classes\Helpers\Menu::getLink($child_menu)}}">{{$child_menu->menu_name}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
<!-- / Navigation -->
