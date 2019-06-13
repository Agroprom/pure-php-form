<!DOCTYPE html>
<?php
require_once '../models/Translator.php';
require_once '../models/DB.php';
require_once '../models/DBHandler.php';
require_once '../models/Helper.php';
require_once '../Config.php';
use app\models\Translator;
use app\models\Helper;
Translator::setLang(Translator::RU);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple registration form</title>
            <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" >
            <link rel="stylesheet" type="text/css" href="/css/style.css" >            
            <script src="/js/jQuery_min.js"></script>
            <script src="/js/jquery.cookie.js"></script>   
            <script src="/js/site.js"></script>

    </head>
    <body>
        <div id="container"> 
            
            <div class="row">
                
                <button class="btn btn-primary" id="change_language"><?= Translator::get('Change Language')?></button>
                
            </div>
            <div class="row">                 
            <div class="col-lg-5">
            <h2><?= Translator::get('Simple Registration Form')?></h2>
           
                
            <form id="reg_form" method="post"  enctype=multipart/form-data>
            
            <input class="required" id="login" type="text" placeholder="<?= Translator::get('Enter Login')?>" name="login" required minlength="<?=Helper::LOGIN_MIN_LENGTH?>"  maxlength="<?=Helper::LOGIN_MAX_LENGTH?>">
            <input class="required" id="name" type="text" placeholder="<?= Translator::get('Enter Name')?>" name="name" required minlength="<?=Helper::NAME_MIN_LENGTH?>" maxlength="<?=Helper::NAME_MAX_LENGTH?>">
            <input class="required" id="email" type="email" placeholder="<?= Translator::get('Enter Email')?>" name="email" required maxlength="<?=Helper::EMAIL_MAX_LENGTH?>">
            <input class="required" id="file" type="file" name="avatar" accept="image/jpeg,image/png,image/gif">
            <input class="required" id="password" type="password" placeholder="<?= Translator::get('Enter Password')?>" name="password" required minlength="<?=Helper::PASSWORD_MIN_LENGTH?>" maxlength="<?=Helper::PASSWORD_MAX_LENGTH?>"> 
            
            <button class="btn btn-primary" type="submit"><?= Translator::get('Submit')?></button>
                            
            </form>
            
            </div>
                
            <div class="col-lg-5">
    
            <h2><?= Translator::get('Login Form')?></h2>
            <form method="post" id="login_form" action="commands/login.php">
            
            <input class="required" type="text" placeholder="<?= Translator::get('Enter Login')?>" name="login" required minlength="<?=Helper::LOGIN_MIN_LENGTH?>"  maxlength="<?=Helper::LOGIN_MAX_LENGTH?>">            
            <input class="required" type="password" placeholder="<?= Translator::get('Enter Password')?>" name="password" required minlength="<?=Helper::PASSWORD_MIN_LENGTH?>" maxlength="<?=Helper::PASSWORD_MAX_LENGTH?>"> 
            
            <button class="btn btn-primary" type="submit"><?= Translator::get('Submit')?></button>
                            
        </form>      
        </div>
        
       </div> 
            
        <div id="profile" class="row" ></div>
            
    </div>   
        
            <script>
        $("#change_language").click(function (e) {
                
        if ($.cookie('<?= Translator::COOKIE_NAME?>') === '<?= Translator::EN?>') {           
        $.cookie('<?= Translator::COOKIE_NAME?>', '<?= Translator::RU?>', { expires: 7 });        
        
        } else if ($.cookie('<?= Translator::COOKIE_NAME?>') === '<?= Translator::RU?>') {
        $.cookie('<?= Translator::COOKIE_NAME?>', '<?= Translator::EN?>', { expires: 7 });        
        }
         
        location.reload();
    });
         
    $('#file').change(function () {
        if(!validateSize(this,1)){
            alert("<?= Translator::get('Size of file exceeds 1 mbyte')?>");
            $(this).val('');
        }
    });         
         
    function validateSize(fileInput, size) {
        var fileObj, oSize;
        fileObj = fileInput.files[0];    
        oSize = fileObj.size;
        if(oSize > size * 1024 * 1024){
            return false;
        }
        return true;
    }         
            </script>        
        
    </body>
</html>