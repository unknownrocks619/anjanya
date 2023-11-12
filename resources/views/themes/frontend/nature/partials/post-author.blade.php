<aside class="widget author_widget">
    <h3 class="widget-title">ABOUT</h3>
    <div class="widget-content text-center">
        <div class="profile">
            <figure class="avatar">
                <a href="#">
                    <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}">
                </a>
            </figure>
            <div class="text-content">
                <div class="name-title">
                    <h4>
                        <a href="">{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</a>
                    </h4>
                </div>
                <div>
                    {!! \App\Classes\Helpers\SystemSetting::basic_configuration('intro_description') !!}
                </div>
            </div>
            <div class="socialgroup">
                <ul>
                    @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                        <li>
                            <a target="_blank" href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                    @endif
                    @if(\App\Classes\Helpers\SystemSetting::social_media('social_google'))
                        <li>
                            <a target="_blank" href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                    @endif
                    @if(\App\Classes\Helpers\SystemSetting::social_media('social_twitter'))
                        <li>
                            <a target="_blank" href="{{\App\Classes\Helpers\SystemSetting::social_media('social_instagram')}}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif
                    @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                        <li>
                            <a target="_blank" href="{{\App\Classes\Helpers\SystemSetting::social_media('social_instagram')}}">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</aside>
