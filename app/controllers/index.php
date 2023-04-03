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
        $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        
    }

    public function index(){
        $this->data['sub_data']['title'] = "Trang chủ";
        $this->data['content'] = 'blocks/home';
        $this->renderView('layouts/client_layout',$this->data);
    }
}