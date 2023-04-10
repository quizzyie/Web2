<?php  
class XemLoaiHD extends Controller{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct(){
        $this->__model = $this->model("CartModel");
        $this->__request = new Request();
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
    }
    public function index(){
        if(isLogin()){
            $user_id = isLogin()['user_id'];
            $this->data["sub_data"]['title'] = "Xem lai hoa don";
            $this->data['content'] = 'blocks/Purchase_Order';
            $this->data["sub_data"]["dshd"] = $this->__model->xemLaiHoaDon($user_id);
            $this->renderView('layouts/client_layout',$this->data);
        }
        else{
            Response::redirect(HOST_ROOT.'/shop');
        }
    }
}


?>