<?php

class About extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct()
    {
        
        $this->__model = $this->model("admin/ContactsModel");
        $this->__request = new Request();
        
        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }
    }

    public function index(){
        $this->data['title'] = "Thông tin";
        $this->data['content'] = 'blocks/about';
        $this->renderView('layouts/client_layout',$this->data);
    }
    
}