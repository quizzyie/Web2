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
        $sql = "SELECT * FROM `bill_detail` WHERE bill_id = $idHD";
        $dsCtdh = $this->getRawModel($sql);
        return $dsCtdh;
    }
}


?>