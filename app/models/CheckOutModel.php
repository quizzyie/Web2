<?php
class CheckOutModel extends Model {
    public $category = null;
    public $brand = null;
    protected $_table = 'bill';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'bill';
    }

    function fieldFill(){
        return "*";
    }
    public function getCategories(){
        
    }
    public function getThongTin($idUser){
        $sql = "select * from users where id = ".$idUser;
        return $this->getFirstRaw($sql);
    }
    public function getGioHang($idUser){
        $sql = "SELECT products.name as tenSp,(SUM(amount)*products.sale) as totalSp,cart.amount as slgSp 
        ,products.id as idsp,sizes.name as tenSize, sizes.id as idSize  
        FROM `cart` INNER JOIN products on cart.product_id = products.id INNER JOIN sizes on cart.size_id = sizes.id 
        WHERE cart.user_id = $idUser 
        GROUP by cart.product_id,cart.size_id";
        return $this->getRawModel($sql);
    }
    
    public function tongTien($idUser){
        $sql = "SELECT SUM(amount*products.sale) as tongTien FROM `cart` 
        INNER JOIN products on cart.product_id = products.id 
        WHERE cart.user_id = $idUser ";
        return $this->getFirstRaw($sql)['tongTien'];
    }
    public function insertBillDetail($dsgh,$idBill){
        foreach($dsgh as $sp){
            $idsp = $sp["idsp"];
            $idSize = $sp["idSize"];
            $total = $sp["totalSp"];
            $slm = $sp["slgSp"];
            $sqlDetailBill = "INSERT INTO `bill_detail`(`bill_id`, `product_id`, `size_id`, `total`, `quantity`) 
            VALUES ($idBill,$idsp,$idSize,$total,$slm)"; 
            $result = $this->getFirstRaw($sqlDetailBill);
        }
    }
    public function giamSlg($idsp,$idSize,$slm){
        // update trong bang product_size
    }
    public function xoaKhoiGio($idsp){
        // remove trong bang cart
    }
    
}