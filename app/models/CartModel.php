<?php
class CartModel extends Model{
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
    function soSanPham(){
        $sql = "select * from cart group by product_id,size_id";
        $soSp = count($this->getRawModel("select * from cart group by product_id,size_id"));
        return $soSp;
    }
    function xemGioHang($idUser){
        
        $sql = "SELECT products_size.quantity as slgSp,sum(amount) as slm, products.name as tenSp, products.sale as giaSp,
                 sizes.name as tenSize,cart.product_id as idsp,cart.size_id as idSize,products.img as image
                  FROM `cart` INNER join products on cart.product_id=products.id INNER JOIN products_size on  
                 products_size.id_size = cart.size_id INNER JOIN sizes on sizes.id=cart.size_id 
                 WHERE user_id = $idUser  and cart.product_id=products_size.id_product and products_size.id_size = sizes.id
                 GROUP BY product_id,size_id;";
        $dssp = $this->getRawModel($sql);
        return $dssp;
    }
    public function tongTien($idUser){
        $tt =0;
        
        $sql = "SELECT SUM(products.sale*cart.amount) as tongTien
                    FROM `cart` INNER join products on cart.product_id=products.id INNER JOIN products_size on  
                products_size.id_size = cart.size_id INNER JOIN sizes on sizes.id=cart.size_id 
                WHERE user_id = 3  and cart.product_id=products_size.id_product and products_size.id_size = sizes.id
                ;";
        $tt = $this->getFirstRaw($sql);
        
        return $tt["tongTien"];
    }
    public function xemLaiHoaDon($idUser){
        $sql = "select * from bill where user_id = ".$idUser;
        return $this->getRawModel($sql);
    }
    public function xemLaiChiTietHoaDon($idBill){
        $sql = "select * from bill_detail where bill_id = ".$idBill;
    }
}

?>