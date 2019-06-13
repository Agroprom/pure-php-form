<?php
require_once 'models/DB.php';
require_once 'Config.php';


use app\models\DB;
use app\Config;

print_r("'Connecting DB \n");

$pdo = DB::connect(Config::DB_HOST, Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD);

print_r("Creating DB \n");

$query = "CREATE table if not exists user(
     ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
     login VARCHAR( 16 ) NOT NULL, 
     name VARCHAR( 16 ) NOT NULL,
     email VARCHAR( 32 ) NOT NULL, 
     avatar VARCHAR( 128 ) NOT NULL, 
     password VARCHAR(64 ) NOT NULL);" ;
try {
$pdo->exec($query);

} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}


print_r("Done \n");