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
            $this->renderView('layouts/client_layout',$this->data);
            
            echo "<pre>";
            print_r($this->data['sub_data']['dsgh']);
            echo "</pre>";
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
                    $sp = $this->__model->getRawModel("select quantity from products_size where id_product = ".$idsp." and id_size = ".$idSize);
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
                $result = $this->__model->getRawModel("select products.name as tensp,sizes.name,products.sale,amount from cart inner join  products on cart.product_id = products.id INNER JOIN sizes on size_id=sizes.id where cart.user_id = ".$user_id);
                
                return $result;
            }
            
        }
    }

?>