<?php

class index extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/BrandsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (isLogin()) {
            $data['title'] = "Tổng quan";
            $data['content'] = 'admin/dashboard/list';
            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }
}