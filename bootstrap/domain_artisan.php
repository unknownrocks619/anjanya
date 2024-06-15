<?php

use Dotenv\Dotenv;

if ( ! defined('STDIN') ) {
    define('STDIN',fopen("php://stdin",'r'));
}

// only do the bidding only it's artisan
if ( isset ($_SERVER['argv'][0]) && $_SERVER['argv'][0] == 'artisan' && $_SERVER['PHP_SELF'] == 'artisan') {

    /**
     * @info Load Env File
     */

    $config = Dotenv::createMutable(realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR));
    $config->load();

    try {

        $host = env('DB_DEFAULT_HOST','localhost');
        $username = env('DB_DEFAULT_USERNAME','root');
        $password = env('DB_DEFAULT_PASSWORD','');
        $db = env('DB_DEFAULT_DATABASE','primary_api');

        $connection = mysqli_connect(env('DB_DEFAULT_HOST','127.0.0.1'),
                                env('DB_DEFAULT_USERNAME','cnzkxzpctf'),
                                env('DB_DEFAULT_PASSWORD','AM98qfhGmk'),
                                env('DB_DEFAULT_DATABASE','cnzkxzpctf'));

    } catch (\Throwable $th) {
        die('Unable to connect to domain using db credentials');
    }

    /**
     * @info check if migration table exists in primary universe
     */
    try {
        $stmt = $connection->prepare('SELECT 1 FROM migrations');
    } catch (Exception $ex) {
        //throw $th;
        $stmt = null;
    }

    if ( ! $stmt ) {
        $migrationTable = <<<SQL
        create table migrations
        (
            id int unsigned auto_increment primary key,
            migration varchar(255) not null,
            batch int not null
        )
        collate = utf8mb4_unicode_ci;

SQL;
        try {
            $stmt = $connection->prepare($migrationTable);
            $stmt->execute();
        } catch (Exception $ex) {
            echo 'Failed to execute query';
            http_response_code(500);
        }
    }

    /**
     * @info Update default connection to current primary table. To Implement later.
     */

}
