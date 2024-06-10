<?php

namespace App\Console\Commands;

use App\Models\PrimaryApiDb;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:db';

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
        /**
         * Get Default Connection
         */
        if (!  Schema::connection('defaultConnection')->hasTable('primary_api_dbs') ){
            Schema::connection('defaultConnection')->create('primary_api_dbs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('domain');
                $table->string('database');
                $table->string('username');
                $table->string('password');
                $table->string('themes')->default('default');
                $table->integer('port')->default(3306);
                $table->boolean('active')->default(true);

            });
        }

        foreach (PrimaryApiDb::get() as $domain) {


            echo 'Running Migration For: '. $domain->domain . PHP_EOL;
            $connection = config('database.connections.mysql');
            $connection = array_merge($connection,[
                            'port' => $domain->port,
                            'database' => $domain->database,
                            'username' => $domain->username,
                            'password' => $domain->password,
                        ]);
            config(['database.connections.dbMigrate_'.$domain->getKey() => $connection,['database.default' => 'dbMigrate_'.$domain->getKey()]]);
            DB::setDefaultConnection('dbMigrate_'.$domain->getKey());


            Artisan::call('migrate --force --database=dbMigrate_'.$domain->getKey());
        }
    }
}
