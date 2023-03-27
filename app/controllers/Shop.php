<?php

class Shop extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public $category = null;
    public $brand = null;
    public $size = null;
    public $sql = "";
    private $slgSPMT = 6;
    public function __construct()
    {
        $this->__model = $this->model("ShopModel");
        $this->__request = new Request();
        $this->data['sub_data']['dsCategories'] = $this->__model->getRawModel("select * from categories");
        $this->data['sub_data']['dsBrands'] = $this->__model->getRawModel("select * from brands");
        $this->data['sub_data']['dsSizes'] = $this->__model->getRawModel("select * from sizes");
        
    }

    public function index($vtt = 0){
        $this->data['title'] = "Cửa hàng";
        $this->data['content'] = 'blocks/shop';
        
        $this->data[''] = '';
        $this->data['sub_data']['dsProducts'] = $this->__model->getRawModel("select * from products limit $vtt,".$this->slgSPMT);
        $this->data['sub_data']['dsProductsFull'] = $this->__model->getRawModel("select * from products ");
        $this->data['sub_data']['soTrang'] = $this->tongSoTrang($this->data['sub_data']['dsProductsFull']);
        // print_r($data);
        $this->renderView('layouts/client_layout',$this->data);
    }
    public function filter(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            $this->category = $data['category'];//Lay Category
            $this->brand = $data['brand'];//Lay Thuong Hieu
            $this->size = $data['size'];//Lay Size
            
            $vtt =0;
            if(isset($data['trang'])){
                $vtt = $data['trang'];
            }
            $viTri = $vtt*$this->slgSPMT;// Cap Nhat vi tri trong sql
            $this->sql = "select * from products inner join products_size on  id = id_product where quantity > 0 ";
            if(!empty($this->category)){
                $values = implode("','", $this->category);
                $this->sql .="and id_category in ('$values')";
            }
            if(!empty($this->brand)){
                $values = implode("','", $this->brand);
                $this->sql .="and id_brand in ('$values')";
            }
            if(!empty($this->size)){
                $values = implode("','", $this->size);
                $this->sql .="and id_size in ('$values')";
            }
            $this->sql .= "group by products.id ";
            $dsspFull = $this->__model->getRawModel($this->sql);
            $ds = $this->__model->getRawModel($this->sql."limit $viTri,".$this->slgSPMT);
            $soTrang = $this->tongSoTrang($dsspFull);//Lay So Trang
            $data = array(
                'ds' => $ds,
                'soTrang' => $soTrang,
                'sql'=>$this->sql
            );
            $data = json_encode($data);
            echo $data;
        }
    }
    public function tongSoTrang($dssp){
        $soSp = count($dssp);
        //Trả về số trang nếu chia kh hết thì cộng thêm 1 vd 13/6
        return (int)($soSp%$this->slgSPMT==0?$soSp/$this->slgSPMT:($soSp/$this->slgSPMT)+1);
    }
    public function detail($id){
        $data['title'] = "Chi tiết sản phẩm";
        $data['content'] = 'blocks/product_detail';
        $this->renderView('layouts/client_layout',$data);
    }
}