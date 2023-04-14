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
    public function phanTrang($vtt = null,$idsp){
        if(empty($vtt)){
            $vtt = 0;
        }
        $sql = "select * from reviews where product_id = $idsp";
    }
    public function tongSoTrang($dsReview){
        
    }

    public function phan_trang()
    {
        $page = $_POST['page'];
        $product_id = Session::getSession('user_id_detail');
        $per_page = 3;
        $indexPage = ($page - 1) * $per_page;

        $reviews = $this->__model->getRawModel("select * from reviews where product_id = $product_id order by create_at desc limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($reviews as $key => $item) {
            $id = $item['id'];
            $name = $item['name'];
            $email = $item['email'];
            $note = $item['note'];
            $message = $item['message'];
            $star = $item['star'];
            $status = $item['status'];
            $create_at = $item['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');

            $starList = "";

            for ($j = 1; $j <= 5; $j++) { 
                if ($j <= $star) {
                    $starList .= '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
                }else{
                    $starList .= '<li><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                }
             } 

            $data .= "<div class=\"user_review_container d-flex flex-column flex-sm-row\">
                <div class=\"user\">
                    <div class=\"user_pic\">
                        <img style=\"width: 70px;  border-radius: 50%;\"
                            src=\"https://tse4.explicit.bing.net/th?id=OIP.euqcyHvusXHENYgYwF-C5wHaFh&pid=Api&P=0\"
                            alt=\"\">
                    </div>
                    <div class=\"user_rating\">
                        <ul class=\"star_rating\">
                        $starList
                        </ul>
                    </div>
                </div>
                <div class=\"review\">
                    <div class=\"review_date\">$create_at</div>
                    <div class=\"user_name\">$name</div>
                    <p>$message</p>
                </div>
            </div>";

            $i++;
        }

        if (empty($data)) {
            $data = "<div class='alert alert-danger btn-block'>Chưa có bình luận nào!</div>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        $page = $_POST['page'];
        $product_id = Session::getSession('user_id_detail');

        $users = $this->__model->getTableData("reviews","product_id = $product_id");
        $n = count($users);
        $maxpage = ceil($n / 3);
        $data = "";

        if ($n > 0) {
            $start = $page - 2;
            if ($start < 1) {
                $start = 1;
            }
            $end = $start + 4;
            if ($end > $maxpage) {
                $end = $maxpage;
            }
                                    
            $data .= "<div id='soTrang' class='product__pagination'>";
            for ($i = $start; $i <= $end; $i++) {
                $check = $page == $i ? "active" : "";
                $data .= "<li class='btn-page' style='list-style:none;margin:0 2px;'><a  class='$check'>$i</a></li>";
            }
            $data .= "</div>";
            $data .= "<input type='hidden' value='$maxpage' class='max-page'/>";
        }
        echo json_encode($data);
    }
}

?>