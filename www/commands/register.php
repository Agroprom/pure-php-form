<?php
require_once '../../models/Translator.php';
require_once '../../models/DB.php';
require_once '../../models/DBHandler.php';
require_once '../../models/Helper.php';
require_once '../../Config.php';

use app\models\Translator;
use app\models\Helper;
use app\models\DB;
use app\Config;
use app\models\DBHandler;


$uploadfile = '';

if(!empty($_FILES['avatar']['tmp_name']) && getimagesize($_FILES['avatar']['tmp_name']) && $_FILES['avatar']['size'] <= Helper::MAX_IMAGE_SIZE) {    
    
$uploadfile = Helper::UPLOAD_DIR.time().'_'.basename($_FILES['avatar']['name']);
copy($_FILES['avatar']['tmp_name'], $uploadfile);

}

$pdo = DB::connect(Config::DB_HOST, Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD);
$dbHandler = new DBHandler($pdo);

try {
$dbHandler->createUser($_POST['login'], $_POST['name'], $_POST['email'], $uploadfile, $_POST['password']);
} catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
 

$currentUser = $dbHandler->getUser($_POST['login']);

?>


        <div class="col-lg-6">
            <h1><?= Translator::get('Profile')?> </h1>
            <p><?= Translator::get('Login')?>: <?= $currentUser['login']?></p>    
            <p><?= Translator::get('Name')?>: <?= $currentUser['name']?></p>    
            <p><?= Translator::get('Email')?>: <?=$currentUser['email']?></p>    
            <img class="avatar" src="<?=$currentUser['avatar']?>" alt="<?= Translator::get('No Image Available')?>">            
            <p><a class="btn btn-primary" href="/"><?= Translator::get('Exit')?></a></p>

    </div>    
   