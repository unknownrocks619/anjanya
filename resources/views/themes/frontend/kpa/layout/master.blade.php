<!doctype html>
<html lang="en">
  <head>
      <title> @yield('page_title')  | | {{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</title>

      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
        @php
            $defined = get_defined_vars();
            if (isset($defined['seo'])) {
                echo $defined['seo'];
            }
        @endphp
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/x-icon" href="{{\App\Classes\Helpers\SystemSetting::basic_configuration('logo')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/swiper.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/fontawesome-5.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/animate.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/unicons.css')}}">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      {{-- <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/vendor/bootstrap.min.css')}}"> --}}
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/style.css')}}">
  

      @stack('page_setting')
      @vite(['resources/js/themes/kpa/css/app.css'])
   </head>
    <body class="home-blue home-ten">

      {!! $user_theme->header() !!}
      <div id="anywhere-home"></div>
      <div id="side-bar" class="side-bar">
          <button class="close-icon-menu"><i class="far fa-times"></i></button>
          <!-- inner menu area desktop start -->
          <div class="rts-sidebar-menu-desktop">
                @if(\App\Classes\Helpers\SystemSetting::logo())
                    <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="logo-img" alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}" style="width: 150px;height:140px;">
                @else
                    <h2>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</h2>
                @endif
              <div class="body d-none d-xl-block">
                  <div class="disc">
                      {!! \App\Classes\Helpers\SystemSetting::basic_configuration('short_description') !!}
                  </div>
                  <div class="get-in-touch">
                      <!-- title -->
                      <div class="h6 title">Get In Touch</div>
                      <!-- title End -->
                      <div class="wrapper">
                          <!-- single -->
                          @if(\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number'))

                            <div class="single">
                                <i class="fas fa-phone-alt"></i>
                                <a href="#">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                            </div>
                          @endif
                          <!-- single ENd -->
                          <!-- single -->
                          @if(\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address'))
                            <div class="single">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address')}}</a>
                            </div>
                          @endif
                          <!-- single ENd -->
                          <!-- single -->
                          <div class="single">
                              <i class="fas fa-globe"></i>
                              <a href="{{\App\Classes\Helpers\SystemSetting::basic_configuration('host')}}">{{\App\Classes\Helpers\SystemSetting::basic_configuration('host')}}</a>
                          </div>
                          <!-- single ENd -->
                          <!-- single -->
                          @if(\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address'))
                          <div class="single">
                              <i class="fas fa-map-marker-alt"></i>
                              <a href="#">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address')}}</a>
                          </div>
                          @endif
                          <!-- single ENd -->
                      </div>
                      <div class="social-wrapper-two menu">
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                            <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            @endif

                          <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
                      </div>
                  </div>
              </div>
              <div class="body-mobile d-block d-xl-none">
                  <nav class="nav-main mainmenu-nav">
                      <ul class="mainmenu">
                        @foreach (\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','!=' ,'register') as $parent_menu)
                                <li class=" @if($parent_menu->children->count())has-droupdown @endif">
                                    <a class="nav-link"
                                            @if($parent_menu->children->count())  href="#" @else href="{{\App\Classes\Helpers\Menu::getLink($parent_menu)}}" @endif>
                                        {{$parent_menu->menu_name}}
                                    </a>
                                    @if($parent_menu->children->count())
                                        <ul class="submenu menu-link3">
                                            @foreach ($parent_menu->children as $child_menu)
                                                <li class="menu-item">
                                                    <a @if($child_menu->children->count()) class='sub-menu-link' href='#' @else href="{{\App\Classes\Helpers\Menu::getLink($child_menu)}}"  @endif>
                                                        {{$child_menu->menu_name}}
                                                    </a>

                                                    @if($child_menu->children->count())
                                                        <ul class="submenu third-lvl mobile-menu">
                                                            @foreach ($child_menu->children as $subChild)
                                                                <li>
                                                                    <a href="{{\App\Classes\Helpers\Menu::getLink($subChild)}}">{{$subChild->menu_name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                      </ul>
                  </nav>
                  <div class="social-wrapper-two menu mobile-menu">
                    @if(\App\Classes\Helpers\SystemSetting::social_media('social_facebook'))
                    <a href="{{\App\Classes\Helpers\SystemSetting::social_media('social_facebook')}}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(\App\Classes\Helpers\SystemSetting::social_media('social_instagram'))
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    @endif


                      <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
                  </div>
                  @if(\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first())
                    <a href="/register" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu">{{\App\Classes\Helpers\Menu::parentMenu()->where('menu_type','register')->first()->menu_name}}</a>
                  @endif
              </div>
          </div>
          <!-- inner menu area desktop End -->
      </div>
  

   
      @yield('main')

      {!! $user_theme->footer() !!}

      
    <!-- start loader -->
    <div class="loader-wrapper">
      <div class="loader">
      </div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End loader -->

      <!-- progress Back to top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- progress Back to top End -->


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <script src="{{ asset('frontend/kpa/assets/js/vendor/jqueryui.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/vendor/waypoint.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/plugins/swiper.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/plugins/counterup.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/plugins/sal.min.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/vendor/bootstrap.min.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/vendor/waw.js')}}"></script>
      <script src="{{ asset('frontend/kpa/assets/js/plugins/contact.form.js')}}"></script>
      <script src="{{ asset('backend/js/notify/bootstrap-notify.min.js') }}"></script>

      @vite(['resources/js/themes/kpa/js/app.js','resources/js/public_app.js'])

      @stack('page_script')
    </body>
</html>