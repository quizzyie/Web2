<?php

class Shop extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("ShopModel");
        $this->__request = new Request();
    }

    public function index(){
        $data['title'] = "Cửa hàng";
        $data['content'] = 'blocks/shop';
        $this->renderView('layouts/client_layout',$data);
    }

    public function detail($id){
        $data['title'] = "Chi tiết sản phẩm";
        $data['content'] = 'blocks/product_detail';
        $this->renderView('layouts/client_layout',$data);
    }
}