<?php
    class CartController extends Controller{
        public $__model,$__request,$__dataForm;
        private $data = [];
    
        public function __construct(){
            $this->__model = $this->model("CartModel");
            $this->__request = new Request();
        }
        public function index(){
            $this->renderView('blocks/cart',$this->data);
        }
        public function themVaoGio(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = json_decode(file_get_contents('php://input'), true);
                $idsp = $data['idsp'];
                $slm = $data['slm'];
                $idSize = $data['idSize'];
                
                echo $idsp." + ".$slm." + ".$idSize;
            }
        }
    }

?>