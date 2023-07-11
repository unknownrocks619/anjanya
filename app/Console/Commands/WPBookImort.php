<?php

namespace App\Console\Commands;

use App\Jobs\ImportUserOldBookJob;
use Illuminate\Console\Command;

class WPBookImort extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wp:books';

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
        new ImportUserOldBookJob();
    }
}
