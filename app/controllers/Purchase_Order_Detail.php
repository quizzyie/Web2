<?php  
class Purchase_Order_Detail extends Controller{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct(){
        $this->__model = $this->model("PurchaseOrderDetailModel");
        $this->__request = new Request();
        $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");

        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
    }
    public function index($idHD = null){
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        if(isLogin()){
            if(empty($idHD)){
                if(!empty($_GET["idhd"])){
                    $idHD = $_GET['idhd'];
                }
                else{
                    Session::setSession('errorPOD', 'ID HÓA ĐƠN KHÔNG THỂ RỖNG');

                    Response::redirect(HOST_ROOT.'/purchase_order');
                }
            }
            
            if(!is_numeric($idHD)){
                Session::setSession('errorPOD', 'ID HD KHÔNG THỂ LÀ CHUỖI');

                Response::redirect(HOST_ROOT.'/purchase_order');
            }
            
            $user_id = isLogin()['user_id'];
            if($this->__model->ktCTHD($user_id,$idHD)){
                $this->data["sub_data"]['title'] = "Xem lai Chi tiet hoa don";
                $this->data['content'] = 'blocks/Purchase_Order_Detail';
                $this->data["sub_data"]["dsCthd"] = $this->__model->getCTHD($idHD);
                $this->renderView('layouts/client_layout',$this->data);
            }
            else{
                Session::setSession('errorPOD', 'ID HD NÀY KHÔNG PHẢI CỦA BẠN');
                Response::redirect(HOST_ROOT.'/purchase_order');
            }
            
        }
        else{
            Session::setSession('errorDetail', 'CẦN ĐĂNG NHẬP ĐỂ XEM CHI TIẾT HÓA ĐƠN');

            Response::redirect(HOST_ROOT.'/shop');
        }
    }
}


?>