<!-- preloader -->
<div id="preloader">
    <div class="book" style="top:40% !important;width:20% !important;height:20% !important">
        @if (\App\Classes\Helpers\SystemSetting::preloader())
            <img src="{{ \App\Classes\Helpers\SystemSetting::preloader() }}" />
        @else
            <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" />
        @endif
        <h4 class='text-center'>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</h4>
    </div>
</div>
