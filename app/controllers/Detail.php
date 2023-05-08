<?php
class Detail extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    
    public function __construct()
    {
        $this->__model = $this->model("DetailModel");
        $this->__request = new Request();
        $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");

        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        } 
    }
    public function index($idsp = null){
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        $this->data["sub_data"]['title'] = "Chi tiet san pham";
        $this->data['content'] = 'blocks/product_detail';
        
        
        if(empty($idsp)){
            if(!empty($_GET["idsp"])){
                $idsp = $_GET['idsp'];
            }
            else{
                Session::setSession('errorDetail', 'ID San Pham KHONG TON TAI!');
                Response::redirect(HOST_ROOT.'/shop');
            }
        }
        if (!is_numeric($idsp)) {
            Session::setSession('errorDetail', 'ID SẢN PHẨM KHÔNG THỂ LÀ CHUỖI');
            Response::redirect(HOST_ROOT.'/shop');
        }
        
        $sql = "SELECT sizes.name as name,sizes.id as id,products_size.quantity as quantity  FROM `products`
        INNER JOIN products_size on products_size.id_product = products.id
        INNER JOIN sizes on sizes.id = products_size.id_size
        where products.id = $idsp and status = 1";
        if(!empty($this->__model->getRawModel($sql))){
            $this->data['sub_data']['dsSizes'] = $this->__model->getRawModel($sql);
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
            $this->data["sub_data"]["soSao"] = $this->__model->getSoSao($idsp);
            $this->data["sub_data"]["slg"] = $this->__model->getSoLuong($idsp)['slg'];
            $this->renderView('layouts/client_layout',$this->data);
            Session::setSession("user_id_detail",$idsp);
        }
        else{
            Session::setSession('errorDetail', 'ID San Pham KHONG TON TAI!');
            Response::redirect(HOST_ROOT.'/shop');
        }
        
        
        
    }
    public function showDetail($idsp){
        if (!is_numeric($idsp)) {
            die('Invalid parameter');
        }
        else{
            $ctsp = $this->__model->getFirstRaw("select * from products where products.id = $idsp and status = 1"); 
        }
        
        
        return $ctsp;
    }
    public function showImg($idsp){
        $dsImg = $this->__model->getRawModel("select * from images where id_product = ".$idsp); 
        
        return $dsImg;
    }
    public function sanPhamLienQuan($idsp,$idLoai,$idThuongHieu){
        $sql = "SELECT products.*, ROUND(IFNULL(SUM(reviews.star)/COUNT(reviews.product_id), 0), 0) as sao
        FROM `products`
        LEFT JOIN reviews ON reviews.product_id = products.id
        WHERE (products.id_category = $idLoai OR products.id_brand = $idThuongHieu) 
        AND products.id != $idsp
        AND products.status = 1  
        GROUP BY products.id 
        ORDER BY products.create_at DESC
        LIMIT 0,4";
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

        $reviews = $this->__model->getRawModel("select * from reviews where status = 2 and product_id = $product_id order by create_at desc limit $indexPage,$per_page");

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
                    <div class=\"review_date\" >$create_at</div>
                    <div class=\"user_name\" style='margin-bottom: 0;'><b>$name</b></div>
                    <div class=\"user_name\">$email</div>
                    <p>$message</p>
                </div>
            </div>";

            $i++;
        }

        if (empty($data)) {
            $linkImg = HOST_ROOT.'/uploads/khongcodanhgia.png';
            $data = "<div class='product-ratings-comments-view__no-data'><div class='product-ratings-comments-view__no-data__icon'><img style='border:0' src='$linkImg' alt='empty-icon'></div><div class='product-ratings-comments-view__no-data__text'>Chưa có đánh giá</div></div>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        $page = $_POST['page'];
        $product_id = Session::getSession('user_id_detail');

        $users = $this->__model->getTableData("reviews","status = 2 and product_id = $product_id");
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