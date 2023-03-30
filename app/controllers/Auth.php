<?php

class Auth extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("Admin/AuthModel");
        $this->__request = new Request();
    }
    
    public function login(){
        // $data['title'] = "Đăng kí | Đăng nhập";
        // $data['content'] = 'blocks/form';
        // $this->renderView('layouts/client_layout',$data);
    }
}