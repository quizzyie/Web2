<?php
class CartModel extends Model{
    public $category = null;
    public $brand = null;
    protected $_table = 'cart';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'cart';
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
        // $result = $this->xoaSanPhamQuaSLG($dssp);
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
    
    public function ktSoLuong($idsp,$idSize,$slm,$idUser){
        $sql = "SELECT quantity FROM `products_size` WHERE id_product = $idsp and id_size = $idSize";
        $slSpMax = intval($this->getFirstRaw($sql)["quantity"]) ;
        $sql = "SELECT SUM(amount) as slg FROM `cart` WHERE user_id = $idUser and product_id = $idsp and size_id = $idSize";
        $slgTrgGH = intval( $this->getFirstRaw($sql)["slg"]);
        if($slgTrgGH+$slm > $slSpMax){
            return false;
        }
        return true;
    }
    
    public function getSoLuongTrgGH($idsp,$idSize,$idUser){
        $sql = "SELECT SUM(amount) as slg FROM `cart` WHERE user_id = $idUser and product_id = $idsp and size_id = $idSize";
        $slgTrgGH = intval( $this->getFirstRaw($sql)["slg"]);
        return $slgTrgGH;
    }
    
    public function ktSanPhamTrgGH($idsp,$idUser,$idSize){
        $sql ="SELECT * FROM `cart` WHERE user_id = $idUser and product_id = $idsp and size_id = $idSize";
        $dssp = $this->getFirstRaw($sql);
        if(empty($dssp)){
            return false;//true laf insert
        }
        return true;//false laf update
    }
    
    public function xoaSanPhamQuaSLG($dsSp){
        foreach ($dsSp as $key => $sp) {
            $sql = "SELECT quantity FROM `products_size` WHERE id_product = ".$sp['idsp']." and id_size = ".$sp['idSize'];
            $slg = $this->getFirstRaw($sql)['quantity'];
            if($slg < 1){
                unset($dsSp[$key]);
            }
        }
        return $dsSp;
    }
    
    public function canhBaoSp($dsSp){
        $dscb = array();
        foreach ($dsSp as $key => $sp) {
            if($sp['slm'] > $sp['slgSp']){
                $dscb[] = $sp;
            }
        }
        return $dscb;
    }
    
    // public function xoaSanPham(){
    //     $result = $this->__model->getRawModel("DELETE FROM `cart` WHERE product_id = ".$data['idsp']." AND size_id = ".$data["idSize"]." AND user_id = $user_id");
    //             if ($result === false) {
    //                 $error = $this->__model->getError();
    //                 $return = [$error];
    //                 // handle the error
    //             } else {
    //                 $dssp = $this->__model->xemGioHang($user_id);
    //                 $tt = $this->__model->tongTien($user_id);
    //                 $soSpTGh=count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));

    //                 $return = ["dsgh"=>$dssp,"tt"=>$tt,"soSpTGh"=>$soSpTGh];
    //             }
    // }
    
}

?>