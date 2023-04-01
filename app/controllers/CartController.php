<?php
    class CartController extends Controller{
        public $__model,$__request,$__dataForm;
        private $data = [];
    
        public function __construct(){
            $this->__model = $this->model("CartModel");
            $this->__request = new Request();
        }
        public function index(){
            $this->data['title'] = "Gio Hang";
            $this->data['content'] = 'blocks/cart';
            $this->data['sub_data']['dsgh'] = $this->xemGioHang();
            $this->data['sub_data']['tongTien'] = $this->tongTien();
            $this->renderView('layouts/client_layout',$this->data);
        }
        public function themVaoGio(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $return =[];
                if(Session::getSession('login_token')){
                    $data = json_decode(file_get_contents('php://input'), true);
                    $idsp = $data['idsp'];
                    $slm = $data['slm'];
                    $user_id = Session::getSession('id_user');
                    if(isset($data['idSize'])){
                        $idSize = $data['idSize'];
                    }
                    else{
                        $idSize = 1;
                    }
                    $sp = $this->__model->getRawModel("select * from products_size where id_product = ".$idsp." and id_size = ".$idSize);
                    if(!empty($sp)){
                        //Lay  So Luong
                        $quantities = array_column($sp, 'quantity');
                        if($quantities[0]>0){
                            $result = $this->__model->getRawModel("INSERT INTO cart (user_id, product_id, amount, size_id) VALUES ('$user_id', '$idsp', '$slm', '$idSize')");
                            if($result){
                                $return = ['error'=>"Có lỗi khi thêm sản phẩm"];
                            }
                        }
                        else{
                            echo "San pham nay da het hang";
                        }
                    }
                    else{
                        echo "khong ton tai idsp hoac idSize";
                    }
                    
                }
                else{
                    $return = ['error'=>"Cần đăng nhập mới được thêm giỏ hàng"];
                }
                
                $return = json_encode($return);
                echo $return;
            }
        }
        
        public function xemGioHang(){
            if(Session::getSession('login_token')){
                $user_id = Session::getSession('id_user');
                $result = $this->__model->getRawModel("select products.name as tensp,sizes.name,products.sale,amount,sum(amount) as tsl,cart.product_id from cart inner join  products on cart.product_id = products.id INNER JOIN sizes on size_id=sizes.id where cart.user_id = ".$user_id." group by cart.product_id,size_id ");
                
                return $result;
            }
            
            
        }
        public function tongTien(){
            $tt =0;
            if(Session::getSession('login_token')){
                $user_id = Session::getSession('id_user');
                $tt = $this->__model->getFirstRaw("select sum(products.sale) as tongTien from cart inner join  products on cart.product_id = products.id INNER JOIN sizes on size_id=sizes.id where cart.user_id = ".$user_id."");
            }
            
            
            return $tt["tongTien"];
        }
        public function xoaSanPham(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $this->__model->getRawModel("DELETE FROM `cart` WHERE product_id = ".$data['idsp']);
                if ($result === false) {
                    $error = $this->__model->getError();
                    $return = [$error];
                    // handle the error
                } else {
                    $user_id = Session::getSession('id_user');
                    $dssp = $this->__model->getRawModel("select products.name as tensp,sizes.name,products.sale,amount,sum(amount) as tsl,cart.product_id from cart inner join  products on cart.product_id = products.id INNER JOIN sizes on size_id=sizes.id where cart.user_id = ".$user_id." group by cart.product_id,size_id ");
                    $tt = $this->tongTien();
                    $return = ["dsgh"=>$dssp,"tt"=>$tt];
                    
                }
                $return = json_encode($return);
                echo $return;
            }
            
        }
        public function capNhatSanPham(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents('php://input'), true);
                $dsIDsp = $data["dsidsp"];
                $dsTSL = $data["dstsl"];
                
                for($i=0;$i<count($dsIDsp);$i++){
                    $idsp = $dsIDsp[$i];
                    $tsl = $dsTSL[$i];
                    $result = $this->__model->getRawModel("UPDATE `cart` SET `amount`= ".$tsl." where product_id = ".$idsp);
                    if ($result === false) {
                        $error = $this->__model->getError();
                        $return = [$error];
                        // handle the error
                    } else {
                        $return = ["ok"];
                        
                    }
                    
                }
                $return = json_encode($return);
                echo $return;
            }
        }
    }

?>