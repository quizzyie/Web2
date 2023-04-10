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
        $sql = "SELECT  products.id as idsp,products.name as tenSp, products.img as img
        ,products.sale as gia, SUM(bill_detail.quantity) as slm FROM `products` 
                INNER JOIN bill_detail on bill_detail.product_id = products.id 
                group BY products.id ORDER BY slm DESC limit 0,8";
        return $this->getRawModel($sql);
    }
    public function newArrivals(){
        $sql = "SELECT *, SUM(bill_detail.quantity) as slm,products.id as idsp 
        FROM `products` 
        INNER JOIN bill_detail on bill_detail.product_id = products.id 
        group BY products.id ORDER BY products.create_at DESC,slm DESC  limit 0,4";
        return $this->getRawModel($sql);
    }
    
    public function bestSales(){
        $sql = "SELECT *, SUM(bill_detail.quantity) as slm,products.id as idsp ,products.price-products.sale as giamGia 
        FROM `products` 
        INNER JOIN bill_detail on bill_detail.product_id = products.id 
        group BY products.id ORDER BY giamGia DESC,slm DESC  limit 0,4";
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