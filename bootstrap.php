<?php
define("PATH_ROOT",__DIR__);

date_default_timezone_set('Asia/Ho_Chi_Minh');

$web_root = $_SERVER['HTTP_HOST'];

$temp = str_replace("\\","/",PATH_ROOT);

$temp2 = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']),"",strtolower($temp)) ;

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
    define("HOST_ROOT","https://$web_root$temp2");
}else{
    define("HOST_ROOT","http://$web_root$temp2");
}

define('_WEB_HOST_ROOT_ADMIN', HOST_ROOT.'/admin');

define('_PER_PAGE_ADMIN', 3);

const _INCODE = true; //Ngăn chặn hành vi truy cập trực tiếp vào file

define('_WEB_HOST_TEMPLATE', HOST_ROOT.'/public/assets/client');

define('_WEB_HOST_ADMIN_TEMPLATE', HOST_ROOT.'/public/assets/admin');

$config_dir = scandir('configs');

if(!empty($config_dir)){
    foreach ($config_dir as $value) {
        if($value != '.' && $value != '..' && file_exists("configs/$value")){
            require_once "configs/$value";
        }
    }
}

require_once 'core/Route.php';

require_once 'core/Session.php';

require_once 'app/App.php';

if(!empty($config['database'])){
    $db_config = array_filter($config['database']);
    
    if(!empty($db_config)){
        require_once 'core/Connection.php';
        require_once 'core/Database.php';
        require_once 'core/DB.php';
        
        $db = new Database();
    }
}

require_once 'core/Model.php';

require_once 'core/Controller.php';

require_once 'core/Request.php';

require_once 'core/Response.php';

require_once 'core/Functions.php';

if(isLogin()){
    $id = isLogin()['user_id'];
    $user_login = $db->firstRaw("select * from users where id = $id");  
    define('_NAME_USER_LOGIN', $user_login['fullname']);
}