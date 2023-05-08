<?php 
class PurchaseOrderModel extends Model
{
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
    function xemLaiHoaDon($idUser){
        $sql = "SELECT bill.resipient_name as tenNN,bill.resipient_phonenumber as sdt,bill.id as idDH,bill.create_at as dateOrder
        ,bill.delivery_address as diaChi,SUM(bill_detail.total) as tongBill, bill.id_order_status as ttDH,order_status.name as tt 
        FROM `bill` 
        INNER JOIN bill_detail on bill.id = bill_detail.bill_id 
        INNER JOIN order_status ON bill.id_order_status = order_status.id 
        WHERE user_id = $idUser 
        GROUP BY bill.id 
        ORDER BY dateOrder DESC
        ";
        
        $dsHD = $this->getRawModel($sql);
        return $dsHD;
    }
    function xoaHoaDon($idUser,$idHD){
        $sql = "SELECT * FROM `bill` WHERE user_id = $idUser and id = $idHD;";
        $dh = $this->getFirstRaw($sql);
        if($dh["id_order_status"] == 6){
            echo "xoa Hoa don thanh cong";
        }
    }
    function huyDonHang($idUser,$idHD){
        $sql = "SELECT * FROM `bill` WHERE user_id = $idUser and id = $idHD;";
        $dh = $this->getFirstRaw($sql);
        if($dh["id_order_status"] == 1 ||$dh["id_order_status"] == 2){
            $sql = "UPDATE `bill` SET `id_order_status`= 4 WHERE bill.id = $idHD and bill.user_id = $idUser";
            $dataUpdate = [
                'id_order_status' => 4,
            ];
            $result = $this->updateData($dataUpdate,"bill.id = $idHD and bill.user_id = $idUser");
            if($result){
                
                $sql = "SELECT bill_detail.product_id as idSp,bill_detail.size_id as idSize, bill_detail.quantity as slg FROM `bill_detail` WHERE bill_detail.bill_id = $idHD";
                $dsdh = $this->getRawModel($sql);
                foreach($dsdh as $hd){
                    $slg  = $hd["slg"];
                    $idSp = $hd["idSp"];
                    $idSize = $hd["idSize"];
                    $sql = "UPDATE `products_size` SET `quantity`=(products_size.quantity + $slg) WHERE id_product = $idSp and id_size = $idSize ";
                    $this->getFirstRaw($sql);   
                }
                return true;
            }
            return false;
        }
    }
    function capNhatTTHD($idUser,$idHD){
        
    }
}


















?>