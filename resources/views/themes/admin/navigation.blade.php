<!-- Page Sidebar Start-->
<div class="sidebar-wrapper h-100">
    <div>
        <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo.png"
                    alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo-dark.png"
                    alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-left"> </i>
            </div>
        </div>
        <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid for-light"
                    src="../assets/images/logo/logo-icon.png" alt=""><img class="img-fluid for-dark"
                    src="../assets/images/logo/logo-icon-dark.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div>
                @php

//                    if (!\Illuminate\Support\Facades\Cache::has('ADMIN_NAVIGATION')) {
                        $navigation = [];
                        if (config('navigation.admin')) {
                            $navigation[] = config('navigation.admin');
                        }

                        // \Illuminate\Support\Facades\Cache::add('ADMIN_NAVIGATION', $navigation);
//                    } else {
////                         $navigation = \Illuminate\Support\Facades\Cache::get('NAVIATION');
//                    }
                @endphp
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid for-light"
                                src="../assets/images/logo/logo-icon.png" alt=""><img class="img-fluid for-dark"
                                src="../assets/images/logo/logo-icon-dark.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    @foreach ($navigation as $nav_loop)
                        @foreach ($nav_loop as $nav_category => $parent_nav)
                            <li class="sidebar-main-title">
                                <div>
                                    <h4 class="lan-1">{{ $nav_category }}</h4>
                                </div>
                            </li>
                            @foreach ($parent_nav as $nav_items)
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title"
                                        @if (isset($nav_items['route']) && !empty($nav_items['route'] && $nav_items['route'] != '') && count($nav_items['children']) == 0 ) href="{{ route($nav_items['route']) }}" @else href="#" @endif">
                                        @if (isset($nav_items['icon']) && !empty($nav_items['icon']))
                                            <i class='{{ $nav_items['icon'] }}'></i>
                                        @endif
                                        <span class="lan-3">{{ $nav_items['name'] }}</span>
                                        @if (count($nav_items['children']))
                                            <span class="badge badge-primary">{{ count($nav_items['children']) }}</span>
                                        @endif

                                    </a>

                                    @if (count($nav_items['children']))
                                        <ul class="sidebar-submenu">
                                            @foreach ($nav_items['children'] as $child_nav)
                                                @php
                                                    $params = [];
                                                    if (isset($child_nav['params'])) {
                                                        $params = $child_nav['params'];
                                                    }
                                                @endphp
                                                <li>
                                                    <a class="lan-4"
                                                        href="@if ($child_nav['route']) {{ route($child_nav['route'], $params) }} @endif">
                                                        {{ $child_nav['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->
