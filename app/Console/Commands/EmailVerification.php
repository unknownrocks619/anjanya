<?php

namespace App\Console\Commands;

use App\Jobs\sendVerificationEmailJob;
use Illuminate\Console\Command;

class EmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:verification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //

    }
}
