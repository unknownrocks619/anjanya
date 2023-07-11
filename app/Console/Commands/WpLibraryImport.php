<?php

namespace App\Console\Commands;

use App\Jobs\ImportWPLibrary;
use App\Jobs\ImportWPOrganisation;
use Illuminate\Console\Command;

class WpLibraryImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wp:library';

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
        new ImportWPLibrary();
    }
}
