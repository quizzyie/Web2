<?php
class AuthController extends Controller{
    public $__model,$__request,$__dataForm;
    private $data = [];

    public function __construct(){
        $this->__model = $this->model("admin/AuthModel");
        $this->__request = new Request();
    }
    public function index(){
        $this->renderView('blocks/login',$this->data);
    }
    public function post_login(){
        if($this->__request->isPost()){
            $data = json_decode(file_get_contents('php://input'), true);
            $email = ($data['email']);
            $pass = trim($data['pass']);
            $userQuery = $this->__model->getFirstData("email = '$email' and status = 1");
            $return = array();
            if(!empty($userQuery)){
                $passwordHash = $userQuery['password'];
                $user_id = $userQuery['id'];
                if (password_verify($pass, $passwordHash)){
                    
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
                        Session::setSession('id_user',$user_id);
                        
                        $return = array(
                            "link"=>"index",
                        );
                    }else{
                        Session::setFlashData('msg', 'Lỗi hệ thống, bạn không thể đăng nhập vào lúc này');
                        Session::setFlashData('msg_type', 'danger');
                        $return = array(
                            "link"=>"/authcontroller",
                        );
                    }
                    
                }
            }
            else{
                $return = array('error'=>"Sai email hoac matkhau");
            }
            $return = json_encode($return);
            echo $return;
        }
        
        
    }
    
    
}


?>