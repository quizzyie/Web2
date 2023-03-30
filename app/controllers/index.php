<?php

class index extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("HomeModel");
        $this->__request = new Request();
    }

    public function index(){
        $data['title'] = "Trang chủ";
        $data['content'] = 'blocks/home';
        $this->renderView('layouts/client_layout',$data);
    }
<<<<<<< HEAD
    public function add(){
        echo "123";
    }
    
=======
>>>>>>> 83cce04ea6fac81c334da1a88db50941f20958ee
}