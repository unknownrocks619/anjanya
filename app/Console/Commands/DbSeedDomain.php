<?php

namespace App\Console\Commands;

use App\Models\PrimaryApiDb;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DbSeedDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Db::seed to all available universe';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        foreach (PrimaryApiDb::where('active',true)->get() as $domain) {
            
            echo 'Seeding Database For: '. $domain->domain . PHP_EOL;
            $connection = config('database.connections.mysql');
            $connection = array_merge($connection,[
                            'port' => $domain->port,
                            'database' => $domain->database,
                            'username' => $domain->username,
                            'password' => $domain->password,
                        ]);
            config(['database.connections.dbMigrate_'.$domain->getKey() => $connection,['database.default' => 'dbMigrate_'.$domain->getKey()]]);
            DB::setDefaultConnection('dbMigrate_'.$domain->getKey());
            Artisan::call('db:seed');

        }
    }
}
