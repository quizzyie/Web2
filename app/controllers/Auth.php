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
            $check_admin = false;

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

                    
                    if($this->__model->getFirstRaw("select * from users where id = $user_id")['type']=='member'){
                        $check = true;
                        $check_admin = true;
                        $msg = "Không phải tài khoản người dùng! Bạn có muốn chuyển sang trang đăng nhập của Admin?";
                    }else{
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
                'check_admin' => $check_admin,
                'msg' => $msg,
            ]);
        } else {
            Response::redirect("");
            Session::setFlashData('msg',"Truy cập không hợp lệ!");
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
            Session::setFlashData('msg',"Truy cập không hợp lệ!");
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
            Session::setFlashData('msg',"Truy cập không hợp lệ!");
        }
    }

    public function post_forgot(){
        if (isPost()) {
            $email = $_POST['email'];
            $check = false;
            $msg = "";

            $userQuery = $this->__model->getFirstData("email = '$email'");

            if (!empty($userQuery)) {
                $forgotToken = sha1(uniqid() . time());
                $dataUpdate = [
                    'forgot_token'=>$forgotToken,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate,"email = '$email'");
                if ($status) {

                    $linkForgot = HOST_ROOT . '/auth/reset/' . $forgotToken;

                    // Thiết lập gửi email
                    $subject = 'Yêu cầu kích hoạt tài khoản';
                    $content = 'Chào bạn: ' . $email . '<br/>';
                    $content .= 'Chào <b>' . $userQuery['fullname'] . '</b>!<br/>Bạn gửi yêu cầu khôi phục mật khẩu, Vui lòng nhấn vào bên dưới để khôi phục  : <br/>';
                    $content .= "<a href='$linkForgot' class='btn btn-primary'>Khôi phục</a>" . '<br/>';
                    $content .= 'Trân trọng!';

                    //Tiến hành gửi email
                    $sendStatus = sendMail($email, $subject, $content);
                    if($sendStatus){
                        $check = true;
                        $msg = "Vui lòng kiểm tra email để khôi phục mật khẩu";
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
                $msg = "Email không tồn tại tồn tại trong hệ thống";
            }

            echo json_encode([
                'check' => $check,
                'msg' => $msg,
            ]);
        } else {
            Response::redirect("");
            Session::setFlashData('msg',"Truy cập không hợp lệ!");
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

    public function reset($token){
        if(!empty($token)){
            $checkToken = $this->__model->getFirstTableData('users',"forgot_token = '$token'");
        
            if(!empty($checkToken)){
                $data['content'] = 'admin/auth/reset_client';
                $data['title'] = "Đặt lại mật khẩu";
                $data['sub_data']['token'] = $token;
                $this->renderView('admin/layouts/admin_layout_login',$data);
            }else{
                Session::setFlashData('msg', 'Đường dẫn không tồn tại hoặc token đã hết hạn!');
                Response::redirect();
            }
        }else{
            Session::setFlashData('msg', 'Đường dẫn không tồn tại!');
            Response::redirect();
        }
    }

    public function post_reset(){
        if(isPost()){
            $this->__request->rules([
                'password'=>'required|min:6',
                'confirm_password'=>'required|match:password',
            ]);
            
            $this->__request->message([
                'password.required'=>'Mật khẩu không được để trống!',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự!',
                'confirm_password.required'=>'Trường này không được bỏ trống!',
                'confirm_password.match'=>'Mật khẩu nhập lại không trùng khớp!',
            ]);
    
            $data = $this->__request->getFields();
            
            $validate = $this->__request->validate($data);
    
            if(!$validate){
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['token'] = $data['token'];
                Session::setFlashData('msg',"Đã có lỗi vui lòng kiểm tra lại dữ liệu!");
                Session::setFlashData('msg_type',"danger");
                $this->__dataForm['content'] = 'admin/auth/reset_client';
                $this->__dataForm['title'] = "Đặt lại mật khẩu";
                $this->renderView('admin/layouts/admin_layout_login',$this->__dataForm);
            }else{
                $password = $data['password'];
                $token = $data['token'];

                $checkToken = $this->__model->getFirstTableData('users',"forgot_token = '$token'");
        
                if(!empty($checkToken)){
                    $dataUpdate = [
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'forgot_token'=>''
                    ];
                    $status = $this->__model->updateTableData('users',$dataUpdate,"forgot_token = '$token'");
                    if($status){
                        Session::setFlashData('msg', 'Đổi mật khẩu thành công có thể đăng nhập ngay bây giờ!');
                    }else{
                        Session::setFlashData('msg', 'Đổi mật khẩu không thành công vui lòng thử lại!');
                    }
                }else{
                    Session::setFlashData('msg', 'Đổi mật khẩu không thành công vui lòng thử lại!');
                }
                Response::redirect();
            }
        }else{
            Response::redirect();
        }
    }

    public function change_password()
    {
        if (isLogin()) {
            $data['title'] = "Thay đổi mật khẩu";
            $data['content'] = 'admin/users/change_password_client';
            $data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
            $data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");
        
            $data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
            if(isLogin()){
            $data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
            }
            $this->renderView('layouts/client_layout', $data);
        } else {
            Response::redirect();
        }
    }

    public function post_change_password()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = isLogin()['user_id'];

            $this->__request->rules([
                'new_password' => 'required|min:6|max:30',
                'repeat_password' => 'required|match:new_password',
            ]);


            $this->__request->message([
                'new_password.required' => 'Mật khẩu nhóm không được để trống!',
                'new_password.min' => 'Mật khẩu nhóm ít nhất 6 kí tự!',
                'new_password.max' => 'Mật khẩu nhóm không quá 30 kí tự!',
                'repeat_password.required' => 'Trường này không được để trống!',
                'repeat_password.match' => 'Mật khẩu nhập lại không trùng khớp!',
            ]);

            $validate = $this->__request->validate($data);

            $password = $data['password'];
            $user = $this->__model->getFirstData("id = " . $data['id']);
            if (empty($password)) {
                $this->__request->setErr('password', 'required', "Vui lòng nhập mật khẩu hiện tại của bạn!");
                $validate = false;
            } else if (!password_verify($password, $user['password'])) {
                $this->__request->setErr('password', 'match', "Mật khẩu bạn nhập không đúng!");
                $validate = false;
            }

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                Session::setFlashData('msg_form_client', "Đã có lỗi vui lòng kiểm tra lại dữ liệu!");
                Session::setFlashData('msg_type', "danger");
                $this->__dataForm['content'] = 'admin/users/change_password_client';
                $this->__dataForm['title'] = "Thay đổi mật khẩu";
                $this->renderView('layouts/client_layout', $this->__dataForm);
            } else {
                $dataUpdate = [
                    'password' => password_hash($data['new_password'], PASSWORD_DEFAULT),
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . isLogin()['user_id']);
                if ($status) {
                    Session::setFlashData('msg_form_client', 'Thay đổi mật khẩu thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg_form_client', 'Thay đổi mật khẩu không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('auth/change_password');
            }
        } else {
            Response::redirect();
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
        }
    }


    public function user_info()
    {
        if (isLogin()) {
            $data['title'] = "Thông tin cá nhân";
            $data['content'] = 'admin/users/user_info_client';
            $data['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
            $data['sub_data']['dataForm'] = $this->__model->getFirstRaw("select * from users where id = ".isLogin()['user_id']);
            
            $data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
            $data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");
        
            $data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
            if(isLogin()){
            $data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
            }
            
            $this->renderView('layouts/client_layout', $data);
        } else {
            Response::redirect();
        }
    }

    public function post_user_info()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = isLogin()['user_id'];

            $this->__request->rules([
                'fullname' => 'required|min:5|max:30',
                'email' => 'required|min:6|max:30|email|unique:users,email,' . $data['id'],
                'phone' => 'required|phone',
            ]);


            $this->__request->message([
                'fullname.required' => 'Họ tên không được để trống!',
                'fullname.min' => 'Họ tên ít nhất 5 kí tự!',
                'fullname.max' => 'Họ tên không quá 30 kí tự!',
                'email.required' => 'Email không được để trống!',
                'email.min' => 'Email ít nhất 5 kí tự!',
                'email.max' => 'Email không quá 30 kí tự!',
                'email.email' => 'Email không hợp lệ!',
                'email.unique' => 'Email đã tồn tại!',
                'phone.required' => 'Số điện thoại không được để trống!',
                'phone.phone' => 'Số điện thoại không hợp lệ!',
            ]);

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                Session::setFlashData('msg_form_client', 'Đã có lỗi vui lòng kiểm tra lại dữ liệu!');
                Session::setFlashData('msg_type', 'danger');
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
                $this->__dataForm['content'] = 'admin/users/user_info_client';
                $this->__dataForm['title'] = "Thông tin người dùng";
                $this->renderView('layouts/client_layout', $this->__dataForm);
            } else {
                $dataUpdate = [
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg_form_client', 'Thay đổi thông tin thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg_form_client', 'Thay đổi thông tin không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('auth/user_info');
            }
        } else {
            Response::redirect();
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
        }
    }
}