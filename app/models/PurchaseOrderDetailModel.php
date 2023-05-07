<?php  
class PurchaseOrderDetailModel extends Model{
    public $category = null;
    public $brand = null;
    protected $_table = 'bill_detail';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'bill_detail';
    }

    function fieldFill(){
        return "*";
    }
    function getCTHD($idHD){
        $sql = "SELECT  products.id as idSp,products.name as tenSP,sizes.name as tenSize,
                bill_detail.total as total,products.img as img, bill_detail.quantity as quantity FROM `bill_detail` 
                INNER JOIN products on bill_detail.product_id = products.id INNER JOIN sizes on size_id = sizes.id 
                WHERE bill_id = $idHD";
        $dsCtdh = $this->getRawModel($sql);
        return $dsCtdh;
    }
    function ktCTHD($idUser,$idHD){
        $sql = "SELECT * FROM `bill_detail` INNER JOIN bill on bill.id=bill_detail.bill_id WHERE bill.user_id = $idUser and bill.id = $idHD";
        $kt = $this->getRawModel($sql);
        if(!empty($kt)){
            return true;
        }
        else{
            return false;
        }
    }
}


?>