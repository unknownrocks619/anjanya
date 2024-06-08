@php
    $contactMenu = \App\Classes\Helpers\Menu::parentMenu()->where('menu_type','=' ,'contact')->last();
@endphp

@if($contactMenu)
<div class="rts-single-wized contact">
    <div class="wized-header">
        <a href="/">
            <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}" style="max-height:110px;"></a>
    </div>
    <div class="wized-body">
        <h5 class="title">Need Help? We Are Here
            To Help You</h5>

        <a class="rts-btn btn-primary" href="{{\App\Classes\Helpers\Menu::getLink($contactMenu)}}">{{$contactMenu->menu_name}}</a>
    </div>
</div>
@endif