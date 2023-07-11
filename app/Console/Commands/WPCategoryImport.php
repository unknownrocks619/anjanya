<?php

namespace App\Console\Commands;

use App\Jobs\ImportUserOldBookJob;
use App\Jobs\ImportWPCategory;
use Illuminate\Console\Command;

class WPCategoryImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wp:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Wordpress book information';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        new ImportWPCategory();
    }
}
