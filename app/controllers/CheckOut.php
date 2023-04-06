<?php  
class CheckOut extends Controller{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct(){
        $this->__model = $this->model("CheckOutModel");
        $this->__request = new Request();
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
    }
    public function index(){
        if(isLogin()){
            $user_id = isLogin()['user_id'];
            $this->data["sub_data"]['title'] = "Chi tiet san pham";
            $this->data['content'] = 'blocks/checkout';
            $this->data['sub_data']['user'] = $this->__model->getThongTin($user_id);
            $this->data['sub_data']['dsgh'] = $this->__model->getGioHang($user_id);
            $this->data['sub_data']['tongTien'] = $this->__model->tongTien($user_id);
            $this->renderView('layouts/client_layout',$this->data);
        }
        else{
            Response::redirect(HOST_ROOT.'/shop');
        }
        
    }
    public function themHoaDon(){
        if(isPost()){
            $user_id = isLogin()['user_id'];
            $fullName = $_POST["fullname"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $note = "";
            if(isset($_POST["note"])){
                $note = $_POST["note"];
            }
            $id_order_status = 1;
            $currentDateTime = date('Y-m-d H:i:s');
            $totalBill = $this->__model->tongTien($user_id);
            
            $sqlBill = "INSERT INTO `bill`( `user_id`, `resipient_name`, `resipient_phonenumber`, `delivery_address`, `note`, `total_bill`, `id_order_status`, `create_at`) 
            VALUES ($user_id,'$fullName','$phone','$address','$note',$totalBill,$id_order_status,'$currentDateTime')";
            $result = $this->__model->getFirstRaw($sqlBill);
            
            $idBill = $this->__model->getFirstRaw("SELECT LAST_INSERT_ID() as id")['id'];
            $dsgh = $this->__model->getGioHang($user_id);
            $this->__model->insertBillDetail($dsgh,$idBill);
            
            Response::redirect(HOST_ROOT.'/cartController');
        }
    }
    
}


?>