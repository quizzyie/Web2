<?php
class DetailModel extends Model {
    public $category = null;
    public $brand = null;
    protected $_table = 'products';
    private $soReviewMT = 3;
    
    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'products';
    }

    function fieldFill(){
        return "*";
    }
    public function getCategories(){
        
    }
    public function getImages($idsp){
        
        $sql = "select * from products inner join images on products.id = images.id_product where products.id = ".$idsp;
        $dsimg = $this->getRawModel($sql);
        return $dsimg;
    }
    public function getReviews($idsp){
        $sql = "SELECT * FROM `reviews` WHERE product_id = $idsp and status = 2 order by create_at desc";
        $dsReview = $this->getRawModel($sql);
        return $dsReview;
    }
    public function soReviews($idsp){
        $sqlSR = "SELECT COUNT(product_id) as soReview FROM `reviews` WHERE product_id = $idsp and status = 2";
        $soReiview = $this->getFirstRaw($sqlSR);
        return $soReiview;
    }
    
    public function getCategory($idLoai){
        $sql = "select * from categories where id = ".$idLoai;
        $loai = $this->getFirstRaw($sql);
        return $loai;
    }
    
    public function getBrand($idThuongHieu){
        $sql = "select * from brands where id = ".$idThuongHieu;
        $thuongHieu = $this->getFirstRaw($sql);
        return $thuongHieu;
    }
    public function getSoSao($idsp){
        $sql = "SELECT ROUND(IFNULL(AVG(star), 0), 0) as sao FROM `reviews` WHERE product_id = $idsp";
        $star = intval($this->getFirstRaw($sql)["sao"]) ;
        if(empty($star)){
            $star = 0;
        }
        return $star;
    }
    public function getSoLuong($idsp,$idSize = null){
        if(empty($idSize)){
            $sql = "SELECT Sum(quantity) as slg FROM `products_size` WHERE id_product=$idsp";
        }
        else{
            $sql ="SELECT quantity FROM `products_size` WHERE id_product=$idsp and id_size = $idSize";
        }
        return $this->getFirstRaw($sql);
    }
    public function tongSoTrang($idsp){
        $soReview = $this->getReviews($idsp);
        return (int)($soReview%$this->soReviewMT==0?$soReview/$this->soReviewMT:($soReview/$this->soReviewMT)+1);
    }
    public function phanTrangReview($vtt,$idsp){
        $sql = "select * from reviews where product_id = ".$idsp." limit ".$vtt.",".$vtt*3;
    }
}