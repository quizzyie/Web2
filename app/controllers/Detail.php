<?php
class Detail extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    
    public function __construct()
    {
        $this->__model = $this->model("DetailModel");
        $this->__request = new Request();
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        } 
    }
    public function index($idsp = null){
        $this->data["sub_data"]['title'] = "Chi tiet san pham";
        $this->data['content'] = 'blocks/product_detail';
        
        
        if(empty($idsp)){
            if(!empty($_GET["idsp"])){
                $idsp = $_GET['idsp'];
            }
            else{
                Response::redirect(HOST_ROOT.'/shop');
            }
        }
        
        $this->data['sub_data']['dsSizes'] = $this->__model->getRawModel("select * from sizes inner join products_size on id = id_size where id_product = ".$idsp);
        $this->data['sub_data']['sp'] = $this->showDetail($idsp);
        $this->data['sub_data']['images'] = $this->showImg($idsp);
        $idCategory = $this->data['sub_data']['sp']['id_category'];
        $idBrand = $this->data['sub_data']['sp']['id_brand'];
        $this->data["sub_data"]["loai"] = $this->__model->getCategory($idCategory);
        $this->data["sub_data"]["thuongHieu"] = $this->__model->getBrand($idBrand);
        $this->data["sub_data"]["dssplq"] = $this->sanPhamLienQuan($idsp,$idCategory,$idBrand);
        $this->data["sub_data"]["dsReview"] = $this->__model->getReviews($idsp);
        $this->data["sub_data"]["dsImage"] = $this->__model->getImages($idsp);
        $this->data["sub_data"]["soReview"] = $this->__model->soReviews($idsp)['soReview'];
        $this->data["sub_data"]["soSao"] = $this->__model->getSoSao($this->data["sub_data"]["dsReview"]);
        $this->data["sub_data"]["slg"] = $this->__model->getSoLuong($idsp)['slg'];
        // echo "<pre>";
        // print_r($this->data["sub_data"]["soSao"]);
        // echo "</pre>";

        
  
        $this->renderView('layouts/client_layout',$this->data);
        Session::setSession("user_id_detail",$idsp);
        
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
    public function getSoLuong(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            $idSize = $data["idSize"];
            $idsp = $data["idsp"];
            $slg = $this->__model->getSoLuong($idsp,$idSize)["quantity"];
            $return =["slg"=>$slg];
            $return = json_encode($return);
            echo $return;
        }
    }
}

?>