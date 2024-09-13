<ul>
    @foreach (\App\Classes\Helpers\Menu::parentMenu()->where('menu_type', '!=', 'register') as $parent_menu)
        <li @if (\App\Classes\Helpers\Menu::isActiveMenu($parent_menu)) class="active" @endif>
            <a class="nav-link"
                @if ($parent_menu->children->count()) href="#" @else href="{{ \App\Classes\Helpers\Menu::getLink($parent_menu) }}" @endif>
                {{ $parent_menu->menu_name }}
            </a>
            @if ($parent_menu->children->count())
                <ul>
                    @foreach ($parent_menu->children as $child_menu)
                        <li>
                            <a
                                @if (\App\Classes\Helpers\Menu::isActiveMenu($child_menu)) class='active' href='#' @else href="{{ \App\Classes\Helpers\Menu::getLink($child_menu) }}" @endif>
                                {{ $child_menu->menu_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
