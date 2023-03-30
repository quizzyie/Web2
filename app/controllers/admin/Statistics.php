<?php
class Statistics extends Controller
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
        if (isLogin()) {
            $data['title'] = "Thống kê kinh doanh";
            $data['content'] = 'admin/statistics/index';

            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function products(){
        if (isLogin()) {
            $data['title'] = "Sản phẩm bán chạy";
            $data['content'] = 'admin/statistics/products';
            $data['sub_data']['categories'] = $this->__model->getRawModel("select * from categories");

            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function fetchData(){
        $category_id = $_POST['category_id'];
        $conditionCate = "";
        if(!empty($category_id) && $category_id != 0){
            $conditionCate = "where categories.id = $category_id";
        }
        $data = $this->__model->getRawModel("SELECT categories.id ,categories.name,SUM(quantity) AS so_luong 
        FROM categories 
        LEFT JOIN (SELECT products.id_category,product_id,quantity 
        FROM products LEFT JOIN 
        (SELECT product_id,quantity FROM bill,bill_detail
        WHERE bill.id = bill_detail.bill_id) AS temp
        ON temp.product_id = products.id
        ) AS temp2
        ON categories.id = temp2.id_category
        $conditionCate
        GROUP BY categories.id ,categories.name ");
        echo json_encode($data);
    }

    
}