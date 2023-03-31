<?php

class Auth extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("Admin/AuthModel");
        $this->__request = new Request();
    }

    public function post_login()
    {
        if (isPost()) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $check = false;
            $msg = "";

            $userQuery = $this->__model->getFirstData("email = '$email' and status = 1");

            if (!empty($userQuery)) {
                $passwordHash = $userQuery['password'];
                $user_id = $userQuery['id'];
                if (password_verify($password, $passwordHash)) {

                    //Tạo token login
                    $tokenLogin = sha1(uniqid() . time());

                    //Insert dữ liệu vào bảng login_token
                    $dataToken = [
                        'user_id' => $user_id,
                        'token' => $tokenLogin,
                        'create_at' => date('Y-m-d H:i:s')
                    ];

                    $this->__model->deleteTableData("login_token", "user_id = $user_id");
                    $insertTokenStatus = $this->__model->addTableData('login_token', $dataToken);
                    if ($insertTokenStatus) {
                        //Insert token thành công

                        //Lưu login_token vào session
                        Session::setSession('login_token', $tokenLogin);
                        $check = true;
                        $msg = "Đăng nhập thành công";
                    } else {
                        $check = false;
                        $msg = "Lỗi hệ thống, bạn không thể đăng nhập vào lúc này";
                    }
                } else {
                    $check = false;
                    $msg = "Mật khẩu không chính xác";
                }
            } else {
                $check = false;
                $msg = "Email không tồn tại trong hệ thống hoặc tài khoản chưa được kích hoạt";
            }

            echo json_encode([
                'check' => $check,
                'msg' => $msg,
            ]);
        } else {
            Response::redirect("");
        }
    }



    public  function logout()
    {
        if (isPost()) {
            if (isLogin()) {
                $token = Session::getSession('login_token');
                Session::removeSession('login_token');
                $this->__model->deleteTableData('login_token', "token = '$token'");
            } else {
                Response::redirect();
            }
        } else {
            Response::redirect();
        }
    }

    public function post_register()
    {
        if (isPost()) {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $check = false;
            $msg = "";

            $userQuery = $this->__model->getFirstData("email = '$email'");

            if (empty($userQuery)) {
                $activeToken = sha1(uniqid() . time());
                $dataInsert = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'active_token' => $activeToken,
                    'status' => 0,
                    'type' => 'user',
                    'group_id' => 2,
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->addData($dataInsert);
                if ($status) {

                    $linkActive = HOST_ROOT . '/auth/active/' . $activeToken;
                    // $linkActive = HOST_ROOT . '/auth/active/' . $activeToken;

                    // Thiết lập gửi email
                    $subject = 'Yêu cầu kích hoạt tài khoản';
                    $content = 'Chào bạn: ' . $email . '<br/>';
                    $content .= 'Chào <b>' . $fullname . '</b>!<br/>Bạn vừa tạo tài khoản thành công bạn vui lòng kích hoạt tài khoản để sử dụng : <br/>';
                    $content .= "<a href='$linkActive' class='btn btn-primary'>Kích hoạt</a>" . '<br/>';
                    $content .= 'Trân trọng!';

                    //Tiến hành gửi email
                    $sendStatus = sendMail($email, $subject, $content);
                    if($sendStatus){
                        $check = true;
                        $msg = "Vui lòng kiểm tra email để kích hoạt tài khoản";
                    }else{
                        $check = false;
                        $msg = "Hệ thống bị lỗi vui lòng thử lại sau";
                    }
                } else {
                    $check = false;
                    $msg = "Hệ thống bị lỗi vui lòng thử lại sau";
                }
            } else {
                $check = false;
                $msg = "Email đã tồn tại trong hệ thống";
            }

            echo json_encode([
                'check' => $check,
                'msg' => $msg,
            ]);
        } else {
            Response::redirect("");
        }
    }

    public function active($token){
        $msg = "";
        if(!empty($token)){
            $checkToken = $this->__model->getFirstTableData('users',"active_token = '$token'");
        
            if(!empty($checkToken)){
                $dataUpdate = [
                    'status' => 1,
                    'active_token' => '',
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $this->__model->updateData($dataUpdate,"active_token = '$token'");
                $msg = "Bạn có thể đăng nhập ngay bây giờ!";
                
            }else{
                $msg = "Đường dẫn không tồn tại hoặc token đã hết hạn!";
                
            }
        }else{
            $msg = "Đường dẫn không tồn tại!";
            
        }
        Session::setFlashData("msg",$msg);
        Response::redirect();
        
    }
}