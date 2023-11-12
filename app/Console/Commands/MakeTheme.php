<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:theme {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $themeBasePath = resource_path('views'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'frontend');
        $themename = strtolower($this->argument('name'));

        if ( !  File::isDirectory($themeBasePath.DIRECTORY_SEPARATOR.$themename) ) {
            File::makeDirectory($themeBasePath.DIRECTORY_SEPARATOR.$themename);
        }

        if ( !  File::isDirectory(app_path('Themes'.DIRECTORY_SEPARATOR.$themename)) ) {
            File::makeDirectory(app_path('Themes'.DIRECTORY_SEPARATOR.$themename));
        }

        $themeFolders = [
                    'components',
                    'footer' => ['default' => ['footer.blade.php']],
                    'header' => ['default' => ['header.blade.php']],
                    'layout' => ['master.blade.php','preview-layout.blade.php'],
                    'partials'  => [],
                    'views'  => [
                                'category' => [],
                                'home' => ['index.blade.php'],
                                'page' => ['detail.blade.php','list.blade.php'],
                                'post'  => ['single.blade.php'],
                    ],
            ];

        foreach ($themeFolders as $defaultFolder => $themeContent) {
//
            $path = $themeBasePath.DIRECTORY_SEPARATOR.$themename.DIRECTORY_SEPARATOR.$defaultFolder;
//
            if (! is_array($themeContent) ) {
//
                if ( !  File::isDirectory($themeBasePath.DIRECTORY_SEPARATOR.$themename.DIRECTORY_SEPARATOR.$themeContent) ) {
                    File::makeDirectory($themeBasePath.DIRECTORY_SEPARATOR.$themename.DIRECTORY_SEPARATOR.$themeContent);
                }
//
                continue;
            }
//
            if ( !  File::isDirectory($path) ) {
                File::makeDirectory($path);
            }

            foreach ($themeContent as $subdirectory => $directories) {

                # If folder => File Structure not available
                if ( ! is_string($subdirectory) ) {
                    # check if file or folder.
                    if ( ! File::isFile($directories,PATHINFO_EXTENSION) ) {
                        if ( !  File::exists($path.DIRECTORY_SEPARATOR.$directories) ) {
                            $majorFileContent = "<!doctype html>\n<html lang=\"en\">\n  <head>";
                            $majorFileContent .= "\n";
                            $majorFileContent .= "      <title> @yield('page_title') | | {{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</title>";
                            $majorFileContent .= "\n";
                            $majorFileContent .= "      @stack('page_setting')\n";
                            $majorFileContent .= "      @vite(['resources/js/themes/".strtolower($themename)."/css/app.css'])";
                            $majorFileContent .= "\n";
                            $majorFileContent .= "   </head>";
                            $majorFileContent .= "\n";
                            $majorFileContent .= "    <body>\n\n";
                            $majorFileContent .= '      {!! $user_theme->header() !!}';
                            $majorFileContent .= "\n";
                            $majorFileContent .= "      @yield('main')\n\n";
                            $majorFileContent .= '      {!! $user_theme->footer() !!}';
                            $majorFileContent .= "\n\n";
                            $majorFileContent .= "      @vite(['resources/js/themes/".strtolower($themename)."/js/app.js','resources/js/public_app.js'])\n\n";
                            $majorFileContent .= "    </body>\n";
                            $majorFileContent .= "</html>";
                            touch($path.DIRECTORY_SEPARATOR.$directories);
                            File::put($path.DIRECTORY_SEPARATOR.$directories,$majorFileContent);
                        }
                    } else {
                        if ( ! File::exists($path.DIRECTORY_SEPARATOR.$directories) ) {
                            File::makeDirectory($path.DIRECTORY_SEPARATOR.$directories);
                        }
                    }

                    continue;
                }

                $secondFolder = $path . DIRECTORY_SEPARATOR.$subdirectory;

                if ( !  File::exists($secondFolder) ) {
                    mkdir($secondFolder);
                }

                # if no for loop .
                if ( is_string($directories) ) {

                    # check folder or file.
                    if (pathinfo($directories,PATHINFO_EXTENSION) ) {
                        touch($path.DIRECTORY_SEPARATOR.$directories);
                    } else {
                        File::makeDirectory($path.DIRECTORY_SEPARATOR.$directories);
                    }

                    continue;
                }

                foreach ($directories as $directory) {

                    if ( ! is_string($directory ) ) {
                        continue;
                    }

                    $directoryPath  = $secondFolder. DIRECTORY_SEPARATOR . $directory;
                    if ( pathinfo($directory,PATHINFO_EXTENSION)  ) {
                        $fileContent = "";
                        $fileContent .= '@extends($user_theme->frontend_layout($extends))';
                        $fileContent .= "\n";
                        $fileContent .= '@section("page_title")';
                        $fileContent .= "\n\n";
                        $fileContent .= '@endsection';
                        $fileContent .= "\n\n";
                        $fileContent .= "@section('main')";
                        $fileContent .= "\n\n";
                        $fileContent .= "@endsection";
                        touch($directoryPath);
                        File::put($directoryPath,$fileContent);

                    } else {

                        if ( ! File::exists($path) ) {
                            File::makeDirectory($path);
                        }
                    }

                }

            }
        }

        $this->resourceJSFile($themename);
        $this->resourceCSSFile($themename);
    }

    public function resourceJSFile(string $themename) {
        mkdir(resource_path('js'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.strtolower($themename)));
        mkdir(resource_path('js'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.strtolower($themename).DIRECTORY_SEPARATOR.'js'));
        touch(resource_path('js'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.strtolower($themename).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'app.js'));
        $fileContent = "import '../../../public_app';\n";
        File::put(resource_path('js'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.strtolower($themename).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'app.js'),$fileContent);
    }

    public function resourceCSSFile(string $themename) {
        mkdir(resource_path('js'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.strtolower($themename).DIRECTORY_SEPARATOR.'css'));
        touch(resource_path("js".DIRECTORY_SEPARATOR."themes".DIRECTORY_SEPARATOR.strtolower($themename).DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."app.css"));

    }
}
