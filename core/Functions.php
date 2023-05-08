<?php
if (!defined('_INCODE')) die('Access Deined...');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// function layout($layoutName='header', $dir = "", $data = []){

//     if(!empty($dir)){
//         $dir = '/'.$dir;
//     }
//     if (file_exists(_WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php')){
//         require_once _WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php';
//     }
// }

function sendMail($to, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tienhai4888@gmail.com';                     //SMTP username
        $mail->Password   = 'ekntjrnhryqzrimn';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('tienhai@gmail.com', 'Web_2');
        $mail->addAddress($to);
        // $mail->addReplyTo($to, 'TienHai');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->CharSet = 'UTF-8';

        // ssl
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// //Kiểm tra phương thức POST
function isPost(){
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        return true;
    }

    return false;
}

//Kiểm tra phương thức GET
function isGet(){
    if ($_SERVER['REQUEST_METHOD']=='GET'){
        return true;
    }

    return false;
}

// //Lấy giá trị phương thức POST, GET
function getBody(){

    $bodyArr = [];

    if (isGet()){
        //Xử lý chuỗi trước khi hiển thị ra
        //return $_GET;
        /*
         * Đọc key của mảng $_GET
         *
         * */
        if (!empty($_GET)){
            foreach ($_GET as $key=>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

            }
        }

    }

    if (isPost()){
        if (!empty($_POST)){
            foreach ($_POST as $key=>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

            }
        }
    }

    return $bodyArr;
}

//Kiểm tra email
function isEmail($email){
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

// //Kiểm tra số nguyên
// function isNumberInt($number, $range=[]){
//     /*
//      * $range = ['min_range'=>1, 'max_range'=>20];
//      *
//      * */
//     if (!empty($range)){
//         $options = ['options'=>$range];
//         $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
//     }else{
//         $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
//     }

//     return $checkNumber;

// }

// //Kiểm tra số thực
// function isNumberFloat($number, $range=[]){
//     /*
//      * $range = ['min_range'=>1, 'max_range'=>20];
//      *
//      * */
//     if (!empty($range)){
//         $options = ['options'=>$range];
//         $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
//     }else{
//         $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
//     }

//     return $checkNumber;

// }



//Hàm tạo thông báo
function getMsg($msg, $type='danger'){
    if(empty($type)){
        $type = 'danger';
    }
    if (!empty($msg)){
    echo '<div class="alert alert-'.$type.'">';
    echo $msg;
    echo '</div>';
    }
}

function getValueInput($data, $field)
{
    if (!empty($data) && !empty(trim($data["$field"]))) {
        echo $data["$field"];
    }
}


function getMsgErr($errs, $field)
{
    if (!empty($errs) && !empty($errs[$field])) {
        $msg = reset($errs[$field]);
        echo "<span style='color:red;'>$msg</span><br/>";
    }
}

function getErrForm($msg = ""){
    if(!empty($msg)){
        echo "<span style='color:red;'>$msg</span><br/>";
    }
}


//Hàm chuyển hướng
// function redirect($path='index.php'){
//     header("Location: $path");
//     exit;
// }

// //Hàm thông báo lỗi
// function form_error($fieldName, $errors, $beforeHtml='', $afterHtml=''){
//     return (!empty($errors[$fieldName]))?$beforeHtml.reset($errors[$fieldName]).$afterHtml:null;
// }

// //Hàm hiển thị dữ liệu cũ
// function old($fieldName, $oldData, $default=null){
//     return (!empty($oldData[$fieldName]))?$oldData[$fieldName]:$default;
// }

//Kiểm tra trạng thái đăng nhập
function isLogin(){
    $checkLogin = false;
    if (Session::getSession('login_token')){
        $tokenLogin = Session::getSession('login_token');

        $db = new Database();
        $queryToken = $db->firstRaw("SELECT user_id FROM login_token WHERE token='$tokenLogin'");

        if (!empty($queryToken)){
            //$checkLogin = true;
            $checkLogin = $queryToken;
        }else{
            Session::removeSession('login_token');
        }
    }

    return $checkLogin;
}

function isLoginAdmin(){
    $checkLogin = false;
    if (Session::getSession('login_token')){
        $tokenLogin = Session::getSession('login_token');

        $db = new Database();
        $queryToken = $db->firstRaw("SELECT user_id FROM login_token,users WHERE
        users.id = login_token.user_id and users.type = 'member' and login_token.token='$tokenLogin'");

        if (!empty($queryToken)){
            //$checkLogin = true;
            $checkLogin = $queryToken;
        }
    }

    return $checkLogin;
}

function getNameLogin(){
    if(isLogin()){
        $db = new Database();
        return $db->firstRaw("select * from users where id = ".isLogin()['user_id'])['fullname'];
    }
    return '';
}

function getUserLogin(){
    if(isLogin()){
        $db = new Database();
        return $db->firstRaw("select * from users where id = ".isLogin()['user_id']);
    }
    return [];
}

function isPermission($module,$action){
    if(isLogin()){
        $id = isLogin()['user_id'];
        $db = new Database();
        $permission = json_decode($db->firstRaw("select groups.permission from users,groups where users.id = $id and users.group_id = groups.id")['permission'],true);
        return !empty($permission) && !empty($permission[$module]) && in_array($action,$permission[$module]);
    }
    return false;
}

// Tự động xoá token login đếu đăng xuất
function autoRemoveTokenLogin(){
    $db = new Database();
    $allUsers = $db->getRaw("SELECT * FROM users WHERE status=1");

    if (!empty($allUsers)){
        foreach ($allUsers as $user){
            $now = date('Y-m-d H:i:s');

            $before = $user['last_activity'];

            $diff = strtotime($now)-strtotime($before);
            $diff = floor($diff/60);

            if ($diff>=1){
                $db->delete('login_token', "user_id=".$user['id']);
            }
        }
    }
}

// //Lưu lại thời gian cuối cùng hoạt động
// function saveActivity(){
//     $user_id = isLogin()['user_id'];
//     update('users', ['last_activity'=>date('Y-m-d H:i:s')], "id=$user_id");
// }

// //Lấy thông tin user
function getUserInfo($user_id){
    $db = new Database();
    $info = $db->firstRaw("SELECT * FROM users WHERE id=$user_id");
    return $info;
}

function getActiveSidebar($module){
    return !empty(Session::getSession('action')) && Session::getSession('action')==$module;
}


function getLinkAdmin($path){
    $url = _WEB_HOST_ROOT_ADMIN."/$path";

    return $url;
}


function getDateFormat($strDate,$format){
    $dateObject = date_create($strDate);
    if(!empty($dateObject)){
        return date_format($dateObject,$format);
    }
    return false;
}

// function checkIcon($str){
//     $str = html_entity_decode($str);
//     return strpos($str,"</i>") ;
// }

// function getLink($key = '',$value = ''){
//     $body = getBody();
//     $body[$key] = $value;
//     $str = "";
//     foreach ($body as $item=>$value) {
//         $str .= $item.'='.$value.'&';
//     }
//     $str = trim($str,'&');
//     return $str;
// }

// function showExceptionError($exception) {
//     require_once _WEB_PATH_ROOT.'/modules/errors/exception.php';
//     die();
// }

// function showErrorHandler($errno, $errstr, $errfile, $errline) {
//     throw new ErrorException($errstr,0,$errno,$errfile,$errline);
// }


// function getValueOptions($key,$field = "opt_value"){
//     $data = firstRaw("select * from options where opt_key = '$key'");
//     if(!empty($data)){
//         if(!empty($data[$field])){
//             return $data[$field];
//         }
//         return "";
//     }
//     return "";
// }

// function loadErr($err='404'){
//     $pathErr = _WEB_PATH_ROOT.'/modules/errors/'.$err.'.php';
//     require_once $pathErr;
//     die();
// }


// function getYoutubeId($url){
//     $result = [];
//     $urlStr = parse_url($url,PHP_URL_QUERY);
//     parse_str($urlStr,$result);
//     if(!empty($result['v'])){
//         return $result['v'];
//     }
//     return false;
// }




// function countCommnent($arrId = [],$result=0){
//     if(!empty($arrId)){
//         foreach ($arrId as $key => $value) {
//             $id = $value['id'];
//             $arrTemp = getRaw("select id from comments where parent_id = $id and status = 1");
//             if(!empty($arrTemp)){
//                 $result += count($arrTemp);
//                 return countCommnent($arrTemp,$result);
//             }
//         }
//     }
//     return $result;
// }

// function deleteComment($arrId){
//     if(!empty($arrId)){
//         $arrTemp = [];
//         foreach ($arrId as $key => $value) {
//           $arrTemp[] = $value['id'];
//         }
//         $strSql = implode(",",$arrTemp);
//         delete("comments","id in ($strSql)");
//         foreach ($arrTemp as $key => $value) {
//             $arrId = getRaw("select id from comments where parent_id = $value");
//             deleteComment($arrId);
//         }
//     }

  
// }