<?php

namespace App\Console\Commands;

use App\Jobs\ImportWPUsers;
use Illuminate\Console\Command;

class WpUserImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wp:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import All Users from wordpress';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        new ImportWPUsers();
    }
}
