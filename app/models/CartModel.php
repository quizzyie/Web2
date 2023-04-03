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
    
}

?>