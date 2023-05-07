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
            $sql = "SELECT SUM(star)/COUNT(id) as sao FROM `reviews` WHERE product_id = ". $sp["id"];
            $star = intval($this->getFirstRaw($sql)["sao"]) ;
            if(empty($star)){
                $star = 0;
            }
            array_push($dsReview, $star);
        }
        return $dsReview;
    }
}