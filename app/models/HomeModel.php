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
    
    public function bestSeller(){
        $sql = "SELECT *, SUM(bill_detail.quantity) as slm FROM `products` 
                INNER JOIN bill_detail on bill_detail.product_id = products.id 
                INNER JOIN reviews on products.id = reviews.product_id 
                group BY products.id limit 0,8";
        return $this->getRawModel($sql);
    }
    
}