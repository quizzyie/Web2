<?php
class HomeModel extends Model {
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
    
    public function getAdvertise(){
        $sql = "SELECT * FROM `advertise` WHERE 1";
        return $this->getRawModel($sql);
    }
    
    public function getGeneralDelivery(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");
    }
    
    public function getFacebook(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_facebook'");
    }
    
    public function getTwitter(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_twitter'");
    }
    
    public function getYoutube(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_youtube'");
    }
    
    public function getInstagram(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_instagram'");
    }
    
    public function bestSeller(){
        $sql = "SELECT products.*,SUM(bill_detail.quantity) as slm 
        FROM `bill_detail` 
        INNER JOIN products on products.id = bill_detail.product_id 
        GROUP BY product_id 
        ORDER BY slm DESC 
        limit 0,8";
        return $this->getRawModel($sql);
    }
    public function newArrivals(){
        $sql = "SELECT products.*,SUM(bill_detail.quantity) as slm 
        FROM `bill_detail` 
        INNER JOIN products on products.id = bill_detail.product_id 
        GROUP BY product_id 
        ORDER BY products.create_at DESC,slm DESC 
        limit 0,4";
        return $this->getRawModel($sql);
    }
    
    public function bestSales(){
        $sql = "SELECT products.*,SUM(bill_detail.quantity) as slm,(products.price - products.sale) as gg 
        FROM `bill_detail` 
        INNER JOIN products on products.id = bill_detail.product_id 
        GROUP BY product_id 
        ORDER BY gg DESC,slm DESC 
        limit 0,4";
        return $this->getRawModel($sql);
    }
    
    public function getStart($dssp){
        foreach($dssp as $sp){
            $sql = "SELECT  SUM(reviews.star)/COUNT(products.id)  FROM `products` 
            JOIN reviews on products.id = reviews.product_id 
            where products.id = ".$sp["idsp"] ."
            GROUP BY products.id limit 0,8";
        }
    }
    
    
    
}