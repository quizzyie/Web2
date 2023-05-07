<?php

class index extends Controller
{
    public $__model, $__request, $__dataForm;
    public $data = [];

    public function __construct()
    {
        $this->__model = $this->model("HomeModel");
        $this->__request = new Request();
        $this->data['sub_data']['dsSizes'] = $this->__model->getRawModel("select * from sizes");
        $this->data["sub_data"]["dsBSeller"] = $this->__model->bestSeller();
        $this->data["sub_data"]["dsNewArrival"] = $this->__model->newArrivals();
        $this->data["sub_data"]['dsBSale'] = $this->__model->bestSales();
        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        $this->data["sub_data"]["advertises"] = $this->__model->getAdvertise();
        $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");
        $this->data["sub_data"]["facebook"] = $this->__model->getFacebook();
        $this->data["sub_data"]["twitter"] = $this->__model->getTwitter();
        $this->data["sub_data"]["instagram"] = $this->__model->getInstagram();
        $this->data["sub_data"]["youtube"] = $this->__model->getYoutube();
        
        $this->data["sub_data"]['dsSao'] = $this->__model->getDsStar();
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
        
    }

    public function index(){
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        $this->data['sub_data']['title'] = "Trang chủ";
        $this->data['content'] = 'blocks/home';
        $this->renderView('layouts/client_layout',$this->data);
    }
}