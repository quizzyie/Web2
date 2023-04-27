<?php
class Auth extends Controller{
    public $__model,$__request,$__dataForm;
    private $data = [];

    public function __construct(){
        $this->__model = $this->model("admin/AuthModel");
        $this->__request = new Request();
    }

    public function index(){
        Response::redirect('admin/auth/login');
    }

    public function login(){
        if(isLoginAdmin()){
            Response::redirect('admin/dashboard');
        }else{
            $data['content'] = 'admin/auth/login';
            $data['title'] = "Đăng nhập hệ thống";
            $this->renderView('admin/layouts/admin_layout_login',$data);
        }
    }

    public function post_login(){
        if($this->__request->isPost()){
            $this->__request->rules([
                'email'=>'required|email|min:6',
                'password'=>'required|min:6',
            ]);
            
            $this->__request->message([
                'email.required'=>'Email không được để trống!',
                'email.email'=>'Email không hợp lệ!',
                'email.min'=>'Email ít nhất 6 kí tự!',
                'password.required'=>'Mật khẩu không được để trống!',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự!',
            ]);
    
            $data = $this->__request->getFields();
            
            $validate = $this->__request->validate($data);
    
            if(!$validate){
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                Session::setFlashData('msg', 'Đã có lỗi vui lòng kiểm tra lại dữ liệu!');
                Session::setFlashData('msg_type', 'danger');
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/auth/login';
                $this->__dataForm['title'] = "Đăng nhập hệ thống";
                $this->renderView('admin/layouts/admin_layout_login',$this->__dataForm);
            }else{
                $email = ($data['email']);
                $password = trim($data['password']);
                // Truy vấn lấy thông tin user theo email
                $userQuery = $this->__model->getFirstData("email = '$email' and status = 1 and type = 'member'");

                if (!empty($userQuery)){
                    $passwordHash = $userQuery['password'];
                    $user_id = $userQuery['id'];
                    if (password_verify($password, $passwordHash)){
        
                        //Tạo token login
                        $tokenLogin = sha1(uniqid().time());
        
                        //Insert dữ liệu vào bảng login_token
                        $dataToken = [
                            'user_id' => $user_id,
                            'token' => $tokenLogin,
                            'create_at' => date('Y-m-d H:i:s')
                        ];
        
                        $this->__model->deleteTableData("login_token","user_id = $user_id");
                        $insertTokenStatus = $this->__model->addTableData('login_token', $dataToken);
                        if ($insertTokenStatus){
                            //Insert token thành công
        
                            //Lưu login_token vào session
                            Session::setSession('login_token', $tokenLogin);
                            //Chuyển hướng qua trang quản lý users
                            Response::redirect('admin/dashboard');
                        }else{
                            Session::setFlashData('msg', 'Lỗi hệ thống, bạn không thể đăng nhập vào lúc này');
                            Session::setFlashData('msg_type', 'danger');
                            Response::redirect('admin/auth/login');
                        }
                        
                    }else{
                        Session::setFlashData('msg', 'Mật khẩu không chính xác');
                        Session::setFlashData('msg_type', 'danger');
                        Response::redirect('admin/auth/login');
                    }
                }else{
                    Session::setFlashData('msg', 'Email không tồn tại trong hệ thống admin hoặc chưa được kích hoạt');
                    Session::setFlashData('msg_type', 'danger');
                    Response::redirect('admin/auth/login');
                }
            }
        }else{
            Session::setFlashData('msg','Truy cập không hợp lệ!');
            Response::redirect('admin/auth/login');
        }
    }

    public  function logout(){
        if(isLoginAdmin()){
            $token = Session::getSession('login_token');
            Session::removeSession('login_token');
            $this->__model->deleteTableData('login_token',"token = '$token'");
        }
        Response::redirect('admin/auth/login');
    }

    public function forgot(){
        if(isLoginAdmin()){
            Response::redirect('admin/dashboard');
        }else{
            $data['content'] = 'admin/auth/forgot';
            $data['title'] = "Đặt lại mật khẩu";
            $this->renderView('admin/layouts/admin_layout_login',$data);
        }
    }

    public function post_forgot(){
        if(isPost()){
            $this->__request->rules([
                'email'=>'required|email|min:6',
            ]);
            
            $this->__request->message([
                'email.required'=>'Email không được để trống!',
                'email.email'=>'Email không hợp lệ!',
                'email.min'=>'Email ít nhất 6 kí tự!',
            ]);
    
            $data = $this->__request->getFields();
            
            $validate = $this->__request->validate($data);
    
            if(!$validate){
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                Session::setFlashData('msg',"Đã có lỗi vui lòng kiểm tra lại dữ liệu!");
                Session::setFlashData('msg_type',"danger");
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/auth/forgot';
                $this->__dataForm['title'] = "Đặt lại mật khẩu";
                $this->renderView('admin/layouts/admin_layout_login',$this->__dataForm);
            }else {
                $email = trim($data['email']);
                $queryUser = $this->__model->getFirstTableData('users',"email = '$email' and type='member'");
                if (!empty($queryUser)) {
                    $userId = $queryUser['id'];
        
                    //Tạo forgot_token
                    $forgot_token = sha1(uniqid() . time());
                    $data_update = [
                        'forgot_token' => $forgot_token
                    ];
        
                    $updateStatus = $this->__model->updateTableData('users', $data_update, "id=$userId");
                    if ($updateStatus) {
        
                        //Tạo link khôi phục
                        $linkReset = _WEB_HOST_ROOT_ADMIN . '/auth/reset/' . $forgot_token;
        
                        //Thiết lập gửi email
                        $subject = 'Yêu cầu khôi phục mật khẩu';
                        $content = 'Chào bạn: ' . $email . '<br/>';
                        $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để khôi phục: <br/>';
                        $content .= $linkReset . '<br/>';
                        $content .= 'Trân trọng!';
        
                        //Tiến hành gửi email
                        $sendStatus = sendMail($email, $subject, $content);
                        if ($sendStatus) {
                            Session::setFlashData('msg', 'Vui lòng kiểm tra email để xem hướng dẫn đặt lại mật khẩu');
                            Session::setFlashData('msg_type', 'success');
                        } else {
                            Session::setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                            Session::setFlashData('msg_type', 'danger');
                        }
                    } else {
                        Session::setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                        Session::setFlashData('msg_type', 'danger');
                    }
                } else {
                    Session::setFlashData('msg', 'Địa chỉ email không tồn tại trong hệ thống admin');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/auth/forgot');
            }
        }else{
            Response::redirect('admin/auth/forgot');
        }
    }

    public function reset($token){
        if(!empty($token)){
            $checkToken = $this->__model->getFirstTableData('users',"forgot_token = '$token' and type='member'");
        
            if(!empty($checkToken)){
                $data['content'] = 'admin/auth/reset';
                $data['title'] = "Đặt lại mật khẩu";
                $data['sub_data']['token'] = $token;
                $this->renderView('admin/layouts/admin_layout_login',$data);
            }else{
                Session::setFlashData('msg', 'Đường dẫn không tồn tại hoặc token đã hết hạn!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/auth/forgot');
            }
        }else{
            Session::setFlashData('msg', 'Đường dẫn không tồn tại!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/auth/forgot');
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
                $this->__dataForm['content'] = 'admin/auth/reset';
                $this->__dataForm['title'] = "Đặt lại mật khẩu";
                $this->renderView('admin/layouts/admin_layout_login',$this->__dataForm);
            }else{
                $password = $data['password'];
                $token = $data['token'];

                $checkToken = $this->__model->getFirstTableData('users',"forgot_token = '$token' and type='member'");
        
                if(!empty($checkToken)){
                    $dataInsert = [
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'forgot_token'=>''
                    ];
                    $status = $this->__model->updateTableData('users',$dataInsert,"forgot_token = '$token'");
                    if($status){
                        Session::setFlashData('msg', 'Đổi mật khẩu thành công có thể đăng nhập ngay bây giờ!');
                        Session::setFlashData('msg_type', 'success');
                    }else{
                        Session::setFlashData('msg', 'Đổi mật khẩu không thành công vui lòng thử lại!');
                        Session::setFlashData('msg_type', 'danger');
                    }
                }else{
                    Session::setFlashData('msg', 'Đổi mật khẩu không thành công vui lòng thử lại!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/auth/login');
            }
        }else{
            Response::redirect('admin/auth');
        }
    }
}