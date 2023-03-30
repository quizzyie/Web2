<?php
class Dashboard extends Controller{
    public $__model,$__request,$__dataForm;
    private $data = [];

    public function __construct(){
        $this->__model = $this->model("admin/AuthModel");
        $this->__request = new Request();
    }

    public function index(){
        Response::redirect('admin/');
    }
    
}