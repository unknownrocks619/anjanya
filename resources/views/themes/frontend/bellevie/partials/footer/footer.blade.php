<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-column footer-about">
                        <h3 class="footer-title">About Hotel</h3>
                        <div class="footer-about-text">
                            {!! \App\Classes\Helpers\SystemSetting::basic_configuration('short_description') !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="footer-column footer-explore clearfix">
                        <h3 class="footer-title">Explore</h3>
                        <ul class="footer-explore-list list-unstyled">
                            @foreach (\App\Classes\Helpers\Menu::parentMenu() as $parent_menu)
                                @if(! $parent_menu->children()->count() )
                                    <li><a href="href="{{\App\Classes\Helpers\Menu::getLink($parent_menu)}}">{{$parent_menu->menu_name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">Contact</h3>
                        <p class="footer-contact-text">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}</p>
                        <div class="footer-contact-info">
                            <p class="footer-contact-phone"><span class="flaticon-call"></span> {{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</p>
                            <p class="footer-contact-mail">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</p>
                        </div>
                        <div class="footer-about-social-list">
                            <a href="#"><i class="ti-instagram"></i></a>
                            <a href="#"><i class="ti-twitter"></i></a>
                            <a href="#"><i class="ti-youtube"></i></a>
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-inner">
                        <p class="footer-bottom-copy-right">© Copyright {{date("Y")}} by <a href="#">{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
