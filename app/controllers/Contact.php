<?php

class Contact extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct()
    {
        
        $this->__model = $this->model("admin/ContactsModel");
        
        $this->__request = new Request();
        $this->data["sub_data"]["hotline"] = $this->__model->getHotline();
        $this->data["sub_data"]["address"] = $this->__model->getAddress();
        $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");

        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
    }

    public function index(){
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        $this->data['title'] = "Liên hệ";
        $this->data['content'] = 'blocks/contact';
        $this->renderView('layouts/client_layout',$this->data);
    }

    public function subcribe(){
        if (isPost()) {
            $email = $_POST['email'];
            $check = false;
            $msg = "";
            $type = "";

            $dataInsert = [
                'email'=>$email,
                'status'=>1,
                'note'=>'Chưa xử lý',
                'create_at'=>date('Y-m-d H:i:s'),
            ];

            $status = $this->__model->addTableData('subcribes',$dataInsert);
            if($status){
                $msg = "Gửi email thành công!";
                $type = "success";
            }else{
                $msg = "Hệ thống lỗi vui lòng thử lại sau!";
                $type = "error";
            }

            echo json_encode([
                'check' => $check,
                'msg' => $msg,
                'type' => $type,
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
                $check = true;
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
            $type = "";

            $product_id = Session::getSession('user_id_detail');

            $checkReview = $this->__model->getRawModel("SELECT * FROM users,bill,bill_detail
            WHERE users.id = bill.user_id AND users.email = '$email'
            AND bill_detail.bill_id = bill.id AND bill_detail.product_id = $product_id");

            $review_product = $this->__model->getRawModel("select * from reviews where email = '$email' and product_id = $product_id");
            if(empty($checkReview)){
                $msg = "Bạn chưa mua sản phẩm hoặc chưa hoàn tất nhận hàng!";
                $type = "warning";
            }else if(!empty($review_product)){
                $msg = "Bạn đã đánh giá sản phẩm!";
                $type = "warning";
            }else{
                
                $check = true;
                $dataInsert = [
                    'product_id'=>$product_id,
                    'name'=>$name,
                    'email'=>$email,
                    'message'=>$message,
                    'status'=>2,
                    'note'=>'Chưa xử lý',
                    'star'=>$star,
                    'create_at'=>date('Y-m-d H:i:s'),
                ];
    
                $status = $this->__model->addTableData('reviews',$dataInsert);
                
                if($status){
                    $msg = "Đánh giá thành công";
                    $type = "success";
                }else{
                    $msg = "Hệ thống lỗi vui lòng thử lại";
                    $type = "error";
                }
            }

            echo json_encode([
                'check' => $check,
                'msg' => $msg,
                'type' => $type,
            ]);
        } else {
            Response::redirect();
            Session::setFlashData('msg',"Truy cập không hợp lệ!");
        }
    }
    
    
}