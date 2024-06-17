    <!-- copyright-area start -->
    <div class="rts-copy-right ptb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-h-2-wrapper">
                        <p class="disc">
                            
                            {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }} - Copyright {{date('Y')}}. All rights reserved.
                        </p>
                        <div class="right">
                            <ul>
                                <li><a href="/">Home</a></li>
                                @if(\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first())
                                    <li><a href="/register">{{\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first()->menu_name}}</a></li>
                                @endif
                                @php
                                    $contactMenu = \App\Classes\Helpers\Menu::parentMenu()->where('menu_type','contact')->first();
                                @endphp
                                @if($contactMenu)
                                <li><a href="{{\App\Classes\Helpers\Menu::getLink($contactMenu)}}">{{$contactMenu->menu_name}}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright-area end -->
