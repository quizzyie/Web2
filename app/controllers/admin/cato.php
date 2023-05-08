<?php 
class cato extends Controller {
    public $__model, $__request, $__dataForm;
    private $data = [];   
    
    public function __construct(){
        $this->__model = $this->model("admin/CategoriesModel");
        $this->__request = new Request();
    }

    public function index(){
        $data['title'] = "Danh sách the loai";
        $data['content'] = 'admin/cato/cato';
        $data['sub_data']['list_category'] = $this->__model->getRawModel("select * from categories");
        // $data['content'] = 'admin/products/list';
        $this->renderView('admin/layouts/admin_layout',$data);    
    }

}