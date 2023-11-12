<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\directoryExists;

class PluginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:plugin {name}';

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
        //
        $pluginFolder = ['database' => ['migrations'],'Http' =>['Controllers','Models'],'routes' => ['admin.php','web.php'],'views' => ['backend','frontend']];
        $pluginDir = [$this->argument('name') => $pluginFolder];

        foreach ($pluginDir as $plugin_name => $subFolders) {

            # Plugin Directory
            if ( ! is_dir(app_path('Plugins'.DIRECTORY_SEPARATOR.$plugin_name)) ) {
                mkdir(app_path('Plugins'.DIRECTORY_SEPARATOR.$plugin_name));
            }
            touch(app_path('Plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.'config.php'));

            foreach ($subFolders as $secondFolder  => $childFolder) {

                $path = app_path('Plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$secondFolder);

                # Config Directory
                if ( ! is_dir($path) ) {
                    mkdir(app_path('Plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$secondFolder));
                }

                foreach ($childFolder as $folder) {

                    $path = app_path('Plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$secondFolder.DIRECTORY_SEPARATOR.$folder);

                    # is file, check and create
                    if (pathinfo($folder,PATHINFO_EXTENSION) ) {

                        # final folder
                        if ( file_exists($path) ) {
                            continue;
                        }
                        touch($path);
                        continue;
                    }

                    # is dir, check and create
                    if ( ! pathinfo($folder,PATHINFO_EXTENSION) ) {

                        # final folder
                        if ( is_dir($path) ) {
                            continue;
                        }

                        mkdir($path);
                    }

                }
            }
        }
    }
}
