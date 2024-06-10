<!doctype html>
<html lang="en">
  <head>
      <title> @yield('page_title')  | | {{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</title>

      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">

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
              <a class="logo-1" href="index.html"><img class="logo" src="assets/images/logo/logo-1.svg" alt="finbiz_logo"></a>
              <a class="logo-2" href="index.html"><img class="logo" src="assets/images/logo/logo-4.svg" alt="finbiz_logo"></a>
              <a class="logo-3" href="index.html"><img class="logo" src="assets/images/logo/logo-3.svg" alt="finbiz_logo"></a>
              <a class="logo-4" href="index.html"><img class="logo" src="assets/images/logo/logo-5.svg" alt="finbiz_logo"></a>
              <div class="body d-none d-xl-block">
                  <p class="disc">
                      We must explain to you how all seds this mistakens idea denouncing pleasures and praising account.
                  </p>
                  <div class="get-in-touch">
                      <!-- title -->
                      <div class="h6 title">Get In Touch</div>
                      <!-- title End -->
                      <div class="wrapper">
                          <!-- single -->
                          <div class="single">
                              <i class="fas fa-phone-alt"></i>
                              <a href="#">+8801234566789</a>
                          </div>
                          <!-- single ENd -->
                          <!-- single -->
                          <div class="single">
                              <i class="fas fa-envelope"></i>
                              <a href="#">example@gmail.com</a>
                          </div>
                          <!-- single ENd -->
                          <!-- single -->
                          <div class="single">
                              <i class="fas fa-globe"></i>
                              <a href="#">www.webexample.com</a>
                          </div>
                          <!-- single ENd -->
                          <!-- single -->
                          <div class="single">
                              <i class="fas fa-map-marker-alt"></i>
                              <a href="#">13/A, New Pro State, NYC</a>
                          </div>
                          <!-- single ENd -->
                      </div>
                      <div class="social-wrapper-two menu">
                          <a href="#"><i class="fab fa-facebook-f"></i></a>
                          <a href="#"><i class="fab fa-twitter"></i></a>
                          <a href="#"><i class="fab fa-instagram"></i></a>
                          <a href="#"><i class="fab fa-whatsapp"></i></a>
                          <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
                      </div>
                  </div>
              </div>
              <div class="body-mobile d-block d-xl-none">
                  <nav class="nav-main mainmenu-nav">
                      <ul class="mainmenu">
                          <li class="has-droupdown menu-item">
                              <a class="menu-link" href="#">Home</a>
                              <ul class="submenu">
                                  <li>
                                      <ul>
                                          <a href="#0" class="tag">Homepages</a>
                                          <li class="mobile-menu-link"><a href="index.html">Main Home</a></li>
                                          <li class="mobile-menu-link"><a href="index-two.html">Consulting Home</a></li>
                                          <li class="mobile-menu-link"><a href="index-three.html">Corporate Home</a></li>
                                          <li class="mobile-menu-link"><a href="index-four.html">Insurance Home</a></li>
                                          <li class="mobile-menu-link"><a href="index-five.html">Marketing Home</a></li>
                                          <li class="mobile-menu-link"><a href="index-six.html">Finance Home</a></li>
                                          <li class="mobile-menu-link"><a href="index-seven.html">Human Resources</a></li>
                                          <li class="mobile-menu-link"><a href="index-eight.html">IT Solutions</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-nine.html">Modern Agency</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-ten.html">Startup Agency</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-eleven.html">Branding-Agency</a></li>
                                      </ul>
                                  </li>
                                  <li>
                                      <ul>
                                          <a href="#0" class="tag">Onepages</a>
                                          <li class="mobile-menu-link"><a href="onepage-one.html">Main Home Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-two.html">Consulting Home Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-three.html">Corporate Home Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-four.html">Insurance Home Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-five.html">Marketing Home Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-six.html">Finance Home Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-seven.html">Human Resources Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-eight.html">IT Solutions Onepage</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-nine.html">Modern Agency</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-ten.html">Startup Agency</a></li>
                                          <li class="mobile-menu-link"><a href="onepage-eleven.html">Branding-Agency</a></li>
  
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li class="menu-item"><a class="menu-link" href="about-us.html">About Us</a></li>
                          <li class="has-droupdown menu-item">
                              <a class="menu-link" href="#">Services</a>
                              <ul class="submenu">
                                  <li class="has-droupdown sub-droupdown">
                                      <a href="#">Our Service</a>
                                      <ul class="submenu third-lvl mobile-menu">
                                          <li><a href="our-service.html">Service 1</a></li>
                                          <li><a href="service-2.html">Service 2</a></li>
                                          <li><a href="service-3.html">Service 3</a></li>
                                      </ul>
                                  </li>
                                  <li class="mobile-menu-link"><a href="service-details.html">Service Details</a></li>
                              </ul>
                          </li>
                          <li class="has-droupdown menu-item">
                              <a class="menu-link" href="#">Pages</a>
                              <ul class="submenu">
                                  <li class="mobile-menu-link"><a href="project.html">Project</a></li>
                                  <li class="mobile-menu-link"><a href="project-details.html">Project Details</a></li>
                                  <li class="mobile-menu-link"><a href="team.html">Team</a></li>
                                  <li class="mobile-menu-link"><a href="team-details.html">Team Details</a></li>
                                  <li class="mobile-menu-link"><a href="appoinment.html">appoinment</a></li>
                                  <li class="mobile-menu-link"><a href="price-plan.html">Price Plan</a></li>
                                  <li class="mobile-menu-link"><a href="404.html">404 Page</a></li>
                              </ul>
                          </li>
                          <li class="has-droupdown menu-item">
                              <a class="menu-link" href="#">Blog</a>
                              <ul class="submenu">
                                  <li class="mobile-menu-link"><a href="blog-list.html">Blog List</a></li>
                                  <li class="mobile-menu-link"><a href="blog-grid.html">Blog Grid</a></li>
                                  <li class="mobile-menu-link"><a href="blog-details.html">Blog Details</a></li>
                              </ul>
                          </li>
                          <li class="menu-item menu-item"><a class="menu-link" href="contactus.html">Contact</a></li>
                      </ul>
                  </nav>
                  <div class="social-wrapper-two menu mobile-menu">
                      <a href="#"><i class="fab fa-facebook-f"></i></a>
                      <a href="#"><i class="fab fa-twitter"></i></a>
                      <a href="#"><i class="fab fa-instagram"></i></a>
                      <a href="#"><i class="fab fa-whatsapp"></i></a>
                      <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
                  </div>
                  <a href="#" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu">Get Quote</a>
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
  
      @vite(['resources/js/themes/kpa/js/app.js','resources/js/public_app.js'])

    </body>
</html>