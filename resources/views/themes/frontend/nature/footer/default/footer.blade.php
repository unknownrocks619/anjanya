<footer id="colophon" class="site-footer footer-primary">
    <div class="top-footer">
        <div class="container">
            <div class="upper-footer">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <aside class="widget widget_text">
                            <div class="footer-logo">
                                <a href="{{\App\Classes\Helpers\SystemSetting::basic_configuration('host')}}">
                                    <img src="{{\App\Classes\Helpers\SystemSetting::logo()}}" style="max-height:50px;" alt="{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}">
                                </a>
                            </div>
                            <div class="textwidget widget-text">
                                {!! \App\Classes\Helpers\SystemSetting::basic_configuration('intro_description') !!}
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <aside class="widget widget_text">
                            <h3 class="widget-title">Contact Information</h3>
                            <p>Feel free to contact and reach us !</p>
                            <div class="textwidget widget-text">
                                <ul>
                                    <li>
                                        <i aria-hidden="true" class="icon icon-map-marker1"></i>
                                        {{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}
                                    </li>
                                    <li>
                                        <a href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}">
                                            <i aria-hidden="true" class="icon icon-phone1"></i>
                                            {!! \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}">
                                            <i aria-hidden="true" class="icon icon-envelope1"></i>
                                            <span class="__cf_email__" >{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <aside class="widget">
                            <h3 class="widget-title">Quick Link</h3>
                            <ul>
                                @foreach (\App\Classes\Helpers\Menu::parentMenu() as $parent_menu)
                                    @continue($parent_menu->children->count())
                                    <li>
                                        <a href="{{$parent_menu->$parent_menu}}">{{$parent_menu->menu_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="lower-footer">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        {!! $user_theme->widget('newsletter') !!}
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="social-links">
                            <ul>
                                @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                                    <li>
                                        <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}" target="_blank">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(\App\Classes\Helpers\SystemSetting::social_media('social_twitter'))
                                    <li>
                                        <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_twitter')}}" target="_blank">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(\App\Classes\Helpers\SystemSetting::social_media('social_youtube'))
                                    <li>
                                        <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_youtube')}}" target="_blank">
                                            <i class="fab fa-youtube" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                                    <li>
                                        <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_instagram')}}" target="_blank">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(\App\Classes\Helpers\SystemSetting::social_media('social_linkedin'))
                                    <li>
                                        <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_linkedin')}}" target="_blank">
                                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="footer-menu">
                            <ul>
                                @foreach(\App\Classes\Helpers\Menu::parentMenu()->where('menu_position','footer') as  $footer_menu)
                                <li>
                                    <a href="{{\App\Classes\Helpers\Menu::getLink($footer_menu)}}">{{$footer_menu->menu_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="copy-right text-center">Copyright &copy; {{date('Y')}} {{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}. All rights reserved.</div>
        </div>
    </div>
</footer>
<a id="backTotop" href="#" class="to-top-icon">
    <i class="fas fa-chevron-up"></i>
</a>
