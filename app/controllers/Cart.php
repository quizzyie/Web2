<?php
    class Cart extends Controller{
        public $__model,$__request,$__dataForm;
        private $data = [];
    
        public function __construct(){
            $this->__model = $this->model("CartModel");
            $this->__request = new Request();
            $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");

        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
            if(isLogin()){
                $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
            }        
        }
        public function index(){
            if(isLoginAdmin()){
                Response::redirect(_WEB_HOST_ROOT_ADMIN);
            }
            $this->data['title'] = "Gio Hang";
            $this->data['content'] = 'blocks/cart';
            if(isLogin()){
                $idUser = isLogin()['user_id'];
                $this->data['sub_data']['dsgh'] = $this->__model->xemGioHang($idUser);
                $this->data['sub_data']['tongTien'] = $this->__model->tongTien($idUser);
                $this->data['sub_data']['dscb'] = $this->__model->canhBaoSp($this->data['sub_data']['dsgh'] );
                // echo "<pre>";
                // print_r( $this->data['sub_data']['dscb']);
                // echo "</pre>";
                $this->renderView('layouts/client_layout',$this->data);
            }
            else{
                Session::setSession('errorDetail', 'CẦN ĐĂNG NHẬP ĐỂ XEM TRANG GIỎ HÀNG');
                Response::redirect(HOST_ROOT.'/shop');
            }
            
        }
        public function themVaoGio(){
            if (isPost()) {
                $return =[];
                if(isLogin()){
                    $data = json_decode(file_get_contents('php://input'), true);
                    $idsp = $data['idsp'];
                    $slm = $data['slm'];
                    $user_id = isLogin()['user_id'];
                    if(isset($data['idSize'])){
                        $idSize = $data['idSize'];
                    }
                    else{
                        $idSize = 1;
                    }
                    if($this->__model->ktSoLuong($idsp,$idSize,$slm,$user_id)){
                        $sp = $this->__model->getRawModel("select * from products_size where id_product = ".$idsp." and id_size = ".$idSize);
                        if(!empty($sp)){
                            //Lay  So Luong
                            $quantities = array_column($sp, 'quantity');
                            if($quantities[0]>0){
                                //Kiem tra san pham da ton tai trong gio hang
                                if($this->__model->ktSanPhamTrgGH($idsp,$user_id,$idSize)){
                                    $slgSPTrgGh = $this->__model->getSoLuongTrgGH($idsp,$idSize,$user_id);
                                    $amount = $slgSPTrgGh+$slm;
                                    $dataUpdate = [
                                        'amount' => $amount,
                                    ];
                                    $sql = "UPDATE `cart` SET `amount`= $amount WHERE `user_id`=$user_id and `product_id`=$idsp and`size_id`=$idSize";
                                    // $result = $this->__model->getFirstRaw($sql);
                                    $result = $this->__model->updateTableData("cart",$dataUpdate,"user_id=$user_id and product_id=$idsp and size_id=$idSize") ;
                                }
                                else{
                                    // $result = $this->__model->getRawModel("INSERT INTO cart (user_id, product_id, amount, size_id) VALUES ('$user_id', '$idsp', '$slm', '$idSize')");
                                    $dataInsert = [
                                        'user_id' => $user_id,
                                        'product_id' => $idsp,
                                        'amount' => $slm,
                                        'size_id'=> $idSize,
                                        'created_at' => date('Y-m-d H:i:s')
                                    ];
                                    $result = $this->__model->addData($dataInsert);
                                }
                                if(!$result){
                                    $return = ['error'=>"Có lỗi khi thêm sản phẩm"];
                                }
                                else{
                                    $return = ['soSpTGh'=>count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"))];
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
                        $return = ['error'=>"Vượt quá số lượng sản phẩm"];
                    }
                }
                else{
                    $return = ['login'=>"Cần đăng nhập mới được thêm giỏ hàng"];
                }
                
                $return = json_encode($return);
                echo $return;
            }else {
                Response::redirect(HOST_ROOT.'/shop');
            }
        }
        
        public function xemGioHang(){
            if(Session::getSession('login_token')){
                $user_id = isLogin()['user_id'];
                $result = $this->__model->getRawModel("select products.name as tensp,sizes.name,products.sale,amount,sum(amount) as tsl,cart.product_id,sizes.id as idSize from cart inner join  products on cart.product_id = products.id INNER JOIN sizes on size_id=sizes.id where cart.user_id = ".$user_id." group by cart.product_id,size_id ");
                $result = $this->__model->xoaSanPhamQuaSLG($result);
                return $result;
            }
            else {
                Response::redirect(HOST_ROOT.'/shop');
            }
        }
        public function tongTien(){
            $tt =0;
            if(Session::getSession('login_token')){
                $user_id = isLogin()['user_id'];
                $tt = $this->__model->getFirstRaw("select sum(products.sale) as tongTien from cart inner join  products on cart.product_id = products.id INNER JOIN sizes on size_id=sizes.id where cart.user_id = ".$user_id."");
            }
            return $tt["tongTien"];
        }
        public function xoaSanPham(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_id = isLogin()['user_id'];
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $this->__model->getRawModel("DELETE FROM `cart` WHERE product_id = ".$data['idsp']." AND size_id = ".$data["idSize"]." AND user_id = $user_id");
                if ($result === false) {
                    $error = $this->__model->getError();
                    $return = [$error];
                    // handle the error
                } else {
                    $dssp = $this->__model->xemGioHang($user_id);
                    $tt = $this->__model->tongTien($user_id);
                    $soSpTGh=count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));

                    $return = ["dsgh"=>$dssp,"tt"=>$tt,"soSpTGh"=>$soSpTGh];
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
                $dsSize = $data["dssize"];
                $user_id = isLogin()['user_id'];
                $return = array();
                for($i=0;$i<count($dsIDsp);$i++){
                    $idsp = $dsIDsp[$i];
                    $tsl = $dsTSL[$i];
                    $size = $dsSize[$i];
                    $this->__model->getRawModel("DELETE FROM cart where product_id = ".$idsp." AND size_id = ".$size);
                    $result = $this->__model->getRawModel("INSERT INTO cart (user_id, product_id, amount, size_id) VALUES ('$user_id', '$idsp', '$tsl', '$size')");
                    if ($result === false) {
                        $error = $this->__model->getError();
                        $return = [$error];
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