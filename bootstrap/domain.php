<?php
use Dotenv\Dotenv;

if ( ! defined('STDIN') ) {
    define('STDIN',fopen("php://stdin",'r'));
}

if (isset($_SERVER['HTTP_HOST']) ) {

    $domain = str_replace('www.','',$_SERVER['HTTP_HOST']);
    $domain = parse_url($domain);

    // $config = Dotenv::createMutable(realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR));
    // $config->load();

    try {
        $connection = mysqli_connect(
                            env('DB_DEFAULT_HOST','localhost'),
                            env('DB_DEFAULT_USERNAME','root'),
                            env('DB_DEFAULT_PASSWORD',''),
                            env('DB_DEFAULT_DATABASE','primary_api'));
                        
        $query = 'SELECT * FROM primary_api_dbs WHERE `domain` = ? AND active = 1 LIMIT 1';
        $stmt = $connection->prepare($query);
        $stmt->bind_param('s',$domain['path']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ( ! $result->num_rows ) {
            throw new Error('Invalid Domain.');
        }

        $domainResult = $result->fetch_assoc();

    
    } catch (\Throwable $th) {
        //throw $th;
        die("Failed to load db configuration." . $th->getMessage());
    }
    
    $_ENV['DB_DATABASE']  = $domainResult['database'];
    $_ENV['DB_USERNAME']    = $domainResult['username'];
    $_ENV['DB_PASSWORD']   = $domainResult['password'];
    $_ENV['APP_THEMES'] = $domainResult['themes'];
    $_ENV['DB_PORT']    = $domainResult['port'];
    $_ENV['APP_URL']    = $domainResult['domain'];
    $_ENV['APP_NAME']   = $domainResult['name'];

    
}

?>