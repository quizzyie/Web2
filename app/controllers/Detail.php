<?php
class Detail extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    
    public function __construct()
    {
        $this->__model = $this->model("DetailModel");
        $this->__request = new Request();
    }
    public function index(){
        $this->data['title'] = "Chi tiet san pham";
        $this->data['content'] = 'blocks/product_detail';
        
        if(!empty($_GET["idsp"])){
            $idsp = $_GET['idsp'];
        }
        else{
            $idsp = 1;
        }
        $this->data['sub_data']['dsSizes'] = $this->__model->getRawModel("select * from sizes inner join products_size on id = id_size where id_product = ".$idsp);
        $this->data['sub_data']['sp'] = $this->showDetail($idsp);
        $this->data['sub_data']['images'] = $this->showImg($idsp);
        $idCategory = $this->data['sub_data']['sp']['id_category'];
        $idBrand = $this->data['sub_data']['sp']['id_brand'];
        $this->data["sub_data"]["dssplq"] = $this->sanPhamLienQuan($idsp,$idCategory,$idBrand);
        // echo "<pre>";
        // print_r($this->data["sub_data"]["dssplq"]);
        // echo "</pre>";
        $this->renderView('layouts/client_layout',$this->data);
        
    }
    public function showDetail($idsp){
        if (!is_numeric($idsp)) {
            die('Invalid parameter');
        }
        $ctsp = $this->__model->getFirstRaw("select * from products where products.id = ".$idsp); 
        
        return $ctsp;
    }
    public function showImg($idsp){
        $dsImg = $this->__model->getRawModel("select * from images where id_product = ".$idsp); 
        
        return $dsImg;
    }
    public function sanPhamLienQuan($idsp,$idLoai,$idThuongHieu){
        $sql = "SELECT * FROM `products` WHERE ( id_category = $idLoai OR id_brand = $idThuongHieu) and id != $idsp  group BY id";
        $dssp = $this->__model->getRawModel($sql);
        return $dssp;
    }
}

?>