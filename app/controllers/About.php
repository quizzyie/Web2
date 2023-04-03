<?php

class About extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public function __construct()
    {
        $this->__model = $this->model("admin/ContactsModel");
        $this->__request = new Request();
        
    }

    public function index(){
        $this->data['title'] = "Thông tin";
        $this->data['content'] = 'blocks/about';
        $this->renderView('layouts/client_layout',$this->data);
    }
    
}