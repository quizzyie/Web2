<?php

class About extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct()
    {
        
        $this->__model = $this->model("admin/ContactsModel");
        $this->__request = new Request();
        
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
        $this->data['title'] = "Thông tin";
        $this->data['content'] = 'blocks/about';
        
        $this->data["sub_data"]["totalCategory"] = intval($this->__model->getTotalCategory()) ;
        $this->data["sub_data"]["generalCountry"] = $this->__model->getGeneralCountry();
        $this->data["sub_data"]["happyCustomer"] = $this->__model->getHappyCustomer();
        $this->data["sub_data"]["ourClients"] = $this->__model->getOurClients();
        $this->data["sub_data"]["ourTeam"] = $this->__model->getOurTeam();
        $this->data["sub_data"]["partner"] = $this->__model->getPartner();
        $this->renderView('layouts/client_layout',$this->data);
    }
    
}