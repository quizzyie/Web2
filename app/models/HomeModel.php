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
        ROUND(IFNULL(sao_tb, 0), 0) AS sao
        FROM `bill_detail`
        INNER JOIN products ON products.id = bill_detail.product_id 
        INNER JOIN bill on bill_detail.bill_id = bill.id 
        LEFT JOIN (
        SELECT product_id, AVG(star) AS sao_tb 
        FROM reviews 
        GROUP BY product_id
        ) AS rv ON rv.product_id = products.id 
        
        WHERE products.status = 1 AND bill.id_order_status != 4
        GROUP BY bill_detail.product_id
        ORDER BY slm DESC
        LIMIT 0, 8
        ";
        return $this->getRawModel($sql);
    }
    public function newArrivals(){
        $sql = "SELECT products.*, SUM(bill_detail.quantity) AS slm, ROUND(IFNULL(sao_tb, 0), 0) AS sao
        FROM `bill_detail`
        INNER JOIN products ON products.id = bill_detail.product_id
        INNER JOIN bill on bill.id = bill_detail.bill_id
        LEFT JOIN (
          SELECT product_id, AVG(star) AS sao_tb 
          FROM reviews 
          GROUP BY product_id
        ) AS rv ON rv.product_id = products.id
        WHERE products.status = 1 and bill.id_order_status != 4
        GROUP BY bill_detail.product_id 
        ORDER BY products.create_at DESC, slm DESC
        LIMIT 0, 4
        ";
        return $this->getRawModel($sql);
    }
    
    public function bestSales(){
        $sql = "SELECT products.*, SUM(bill_detail.quantity) AS slm, (products.price - products.sale) AS gg, ROUND(IFNULL(sao_tb, 0), 0) AS sao
        FROM `bill_detail`
        INNER JOIN products ON products.id = bill_detail.product_id
        INNER JOIN bill ON bill.id = bill_detail.bill_id
        LEFT JOIN (
          SELECT product_id, AVG(star) AS sao_tb 
          FROM reviews 
          GROUP BY product_id
        ) AS rv ON rv.product_id = products.id
        WHERE products.status = 1 and bill.id_order_status != 4
        GROUP BY bill_detail.product_id 
        ORDER BY gg DESC, slm DESC
        LIMIT 0, 4
        ";
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