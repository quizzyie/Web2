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
        $sql = "SELECT opt_value FROM `options` WHERE opt_key = 'general_advertise'";
        return json_decode($this->getFirstRaw($sql)['opt_value'],1) ;
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
        $sql = "SELECT products.*, 
        SUM(bill_detail.quantity) AS slm, 
        ROUND(IFNULL(SUM(reviews.star)/COUNT(reviews.product_id), 0), 0) as sao
      FROM `bill_detail`
      INNER JOIN products ON products.id = bill_detail.product_id
      LEFT JOIN reviews ON reviews.product_id = products.id
      WHERE products.status = 1
      GROUP BY bill_detail.product_id
      ORDER BY slm DESC
      LIMIT 0, 8";
        return $this->getRawModel($sql);
    }
    public function newArrivals(){
        $sql = "SELECT products.*,SUM(bill_detail.quantity) as slm, Round(SUM(star)/COUNT(reviews.product_id),0) as sao
        FROM `bill_detail` 
        INNER JOIN products on products.id = bill_detail.product_id 
        LEFT JOIN reviews on reviews.product_id = products.id
        WHERE products.status = 1 
        GROUP BY bill_detail.product_id 
        ORDER BY products.create_at DESC,slm DESC 
        limit 0,4";
        return $this->getRawModel($sql);
    }
    
    public function bestSales(){
        $sql = "SELECT products.*,SUM(bill_detail.quantity) as slm,(products.price - products.sale) as gg, Round(SUM(star)/COUNT(reviews.product_id),0) as sao
        FROM `bill_detail` 
        INNER JOIN products on products.id = bill_detail.product_id 
        LEFT JOIN reviews on reviews.product_id = products.id
        WHERE products.status = 1 
        GROUP BY bill_detail.product_id 
        ORDER BY gg DESC,slm DESC 
        limit 0,4";
        return $this->getRawModel($sql);
    }
    
    public function getStart($idsp){
        $sql = "SELECT Round(SUM(star)/COUNT(product_id),0) as sao FROM `reviews` WHERE product_id = $idsp";
        return $this->getFirstRaw($sql)['sao'];
    }
    
    public function getDsStar(){
        $ds = $this->bestSeller();
        $dsSao = array(); // khởi tạo danh sách sao
        foreach ($ds as $sp) {
            $sao = $this->getStart($sp['id']);
            $dsSao[] = $sao; // thêm sao vào danh sách sao
        }
        return $dsSao; // trả về danh sách sao
    }
    
    
    
}