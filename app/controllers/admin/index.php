<?php

class index extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/ProductsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }
        
        $data['title'] = "Tổng quan";
        $data['content'] = 'admin/dashboard/list';
        $data['sub_data']['categories'] = $this->__model->getRawModel("select * from categories");
        $this->renderView('admin/layouts/admin_layout', $data);
    }
}