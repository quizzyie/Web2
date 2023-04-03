<?php

class Contact extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct()
    {
        $this->__model = $this->model("admin/ContactsModel");
        $this->__request = new Request();
        
    }

    public function index(){
        $this->data['title'] = "Liên hệ";
        $this->data['content'] = 'blocks/contact';
        $this->renderView('layouts/client_layout',$this->data);
    }

    public function subcribe(){
        if (isPost()) {
            $email = $_POST['email'];
            $check = false;
            $msg = "";

            $dataInsert = [
                'email'=>$email,
                'status'=>1,
                'note'=>'Chưa xử lý',
                'create_at'=>date('Y-m-d H:i:s'),
            ];

            $status = $this->__model->addTableData('subcribes',$dataInsert);
            if($status){
                $msg = "Gửi email thành công!";
            }else{
                $msg = "Hệ thống lỗi vui lòng thử lại sau!";
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

    public function send(){
        if (isPost()) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $check = false;
            $msg = "";

            $dataInsert = [
                'name'=>$name,
                'email'=>$email,
                'message'=>$message,
                'status'=>1,
                'note'=>'Chưa xử lý',
                'create_at'=>date('Y-m-d H:i:s'),
            ];

            $status = $this->__model->addTableData('contacts',$dataInsert);
            if($status){
                $msg = "Gửi lời nhắn thành công";
            }else{
                $msg = "Hệ thống lỗi vui lòng thử lại";
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

    public function send_review(){
        if (isPost()) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $star = $_POST['star'];
            $check = false;
            $msg = "";

            $dataInsert = [
                'product_id'=>Session::getSession('user_id_detail'),
                'name'=>$name,
                'email'=>$email,
                'message'=>$message,
                'status'=>2,
                'note'=>'Vua gui',
                'star'=>$star,
                'create_at'=>date('Y-m-d H:i:s'),
            ];

            $status = $this->__model->addTableData('reviews',$dataInsert);
            Session::removeSession('user_id_detail');
            
            if($status){
                $msg = "Đánh giá thành công";
            }else{
                $msg = "Hệ thống lỗi vui lòng thử lại";
            }

            

            echo json_encode([
                'check' => $check,
                'msg' => $msg,
            ]);
        } else {
            Response::redirect();
            Session::setFlashData('msg',"Truy cập không hợp lệ!");
        }
    }
    
    
}