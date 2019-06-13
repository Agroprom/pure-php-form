<?php
require_once '../../models/Translator.php';
require_once '../../models/DB.php';
require_once '../../models/DBHandler.php';
require_once '../../models/Helper.php';
require_once '../../Config.php';

use app\models\Translator;
use app\models\DB;
use app\Config;
use app\models\DBHandler;


$pdo = DB::connect(Config::DB_HOST, Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD);
$dbHandler = new DBHandler($pdo);


if($dbHandler->login($_POST['login'], $_POST['password'])==false) {
    echo Translator::get('Wrong login or password!');
    die();
}

$currentUser = $dbHandler->getUser($_POST['login']);

?>


        <div class="col-lg-6">           
            <h1><?= Translator::get('Profile')?> </h1>
            <p><?= Translator::get('Login')?>: <?= $currentUser['login']?></p>    
            <p><?= Translator::get('Name')?>: <?= $currentUser['name']?></p>    
            <p><?= Translator::get('Email')?>: <?=$currentUser['email']?></p>    
            <img class="avatar" src="<?=$currentUser['avatar']?>" alt="no image available">
            <p><a class="btn btn-primary" href="/"><?= Translator::get('Exit')?></a></p>
    </div>    