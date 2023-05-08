<?php
class ShopModel extends Model {
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
    public function getStars($dssp){
        $dsReview = array();
        foreach($dssp as $sp){
            $sql = "SELECT ROUND(IFNULL(AVG(star), 0), 0) as sao FROM `reviews` WHERE product_id = ". $sp["id"];
            $star = intval($this->getFirstRaw($sql)["sao"]) ;
            if(empty($star)){
                $star = 0;
            }
            array_push($dsReview, $star);
        }
        return $dsReview;
    }
    public function getSlgBan($dssp){
        $dsSlgBan = array();
        foreach($dssp as $sp){
            $sql="SELECT SUM(quantity) as slgBan
            FROM `bill_detail` 
            INNER JOIN products on products.id = product_id 
            INNER JOIN bill on bill.id = bill_detail.bill_id 
            WHERE products.status = 1 and product_id =  ".$sp["id"]." and bill.id_order_status != 4";
            $slg = $this->getFirstRaw($sql)["slgBan"];
            if(empty($slg)){
                $slg = 0;
            }
            array_push($dsSlgBan,$slg);
        }
        return $dsSlgBan;
    }
}