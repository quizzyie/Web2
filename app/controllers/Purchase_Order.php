<?php  
class Purchase_Order extends Controller{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct(){
        $this->__model = $this->model("PurchaseOrderModel");
        
        $this->__request = new Request();
        $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");

        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
        if(Session::getSession("errorPOD")){
            $this->data['sub_data']['errorPOD'] = Session::getSession("errorPOD");
            Session::removeSession("errorPOD");
        }
    }
    public function index(){
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        if(isLogin()){
            $user_id = isLogin()['user_id'];
            $this->data["sub_data"]['title'] = "Xem lai hoa don";
            $this->data['content'] = 'blocks/Purchase_Order';
            $this->data["sub_data"]["dshd"] = $this->__model->xemLaiHoaDon($user_id);
            $this->renderView('layouts/client_layout',$this->data);
        }
        else{
            Session::setSession('errorDetail', 'CẦN ĐĂNG NHẬP ĐỂ XEM DANH SÁCH HÓA ĐƠN');

            Response::redirect(HOST_ROOT.'/shop');
        }
    }
    
    public function huyDonHang(){
        if(isPost()){
            $data = json_decode(file_get_contents('php://input'), true);
            $iddh = $data['iddh'];
            $user_id = isLogin()['user_id'];
            $result = $this->__model->huyDonHang($user_id,$iddh);
            $return = [];
            if($result){
                $return = ['ok'=>"Huy Don Hang thanh cong"];
                $dsdh = $this->__model->xemLaiHoaDon($user_id);
                
                $return = ['dsdh'=>$dsdh];
            }
            else{
                $return = ['error'=>"Có lỗi khi huy sản phẩm"];
            }
            
            $return = json_encode($return);
            echo $return;
        }
    }
}


?>