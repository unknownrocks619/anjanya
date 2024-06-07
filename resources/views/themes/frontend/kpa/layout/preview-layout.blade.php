<!doctype html>
<html lang="en">
  <head>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/swiper.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/fontawesome-5.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/animate.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/plugins/unicons.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/vendor/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/kpa/assets/css/style.css')}}">
      {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> --}}

      @stack('page_setting')
      @vite(['resources/js/themes/kpa/css/app.css'])
   </head>
    <body class="home-blue home-ten">
      <div id="anywhere-home"></div>
   
      @yield('main')

      
    <!-- start loader -->
    <div class="loader-wrapper">
      <div class="loader">
      </div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End loader -->


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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