<!doctype html>
<html lang="en">
  <head>
      <title> @yield('page_title') | | {{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</title>
      @stack('page_setting')
      @vite(['resources/js/themes/siddhamahayog/css/app.css'])
   </head>
    <body>

      {!! $user_theme->header() !!}
      @yield('main')

      {!! $user_theme->footer() !!}

      @vite(['resources/js/themes/siddhamahayog/js/app.js','resources/js/public_app.js'])

    </body>
</html>