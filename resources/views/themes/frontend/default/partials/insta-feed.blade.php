<!-- instagram feed -->
@if (\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
    <div class="instagram">
        <div class="container-xl">
            <!-- button -->
            <a href="#"
                class="btn btn-default btn-instagram">{{ \App\Classes\Helpers\SystemSetting::social_media('social_instagram') }}
                on Instagram</a>
            <!-- images -->
            @if (\App\Classes\Helpers\SystemSetting::footerConfiguration())
                <div class="instagram-feed d-flex flex-wrap">
                    @foreach (\App\Classes\Helpers\SystemSetting::footerConfiguration() as $footerImages)
                        <div class="insta-item col-sm-2 col-6 col-md-2">
                            <a href="#">
                                <img src="{{ $footerImages }}"
                                    alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}" />
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endif
