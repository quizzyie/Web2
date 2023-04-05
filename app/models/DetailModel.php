<?php
class DetailModel extends Model {
    public $category = null;
    public $brand = null;
    protected $_table = 'products';

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
    public function getSoSao($dsReview){
        $tong = 0;
        if(empty($dsReview)){
            return 5;
        }
        else{
            for($i=0;$i<count($dsReview);$i++){
                $tong += $dsReview[$i]["star"];
            }
            return intval($tong/count($dsReview)) ;
        }
        
    }
    
}