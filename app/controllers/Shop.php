<?php

class Shop extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
    public $category = null;
    public $brand = null;
    public $size = null;
    public $sql = "";
    public $text = "";
    private $sort = 1;
    private $slgSPMT = 6;
    private $min = 0;
    private $max = 7000;
    private $tongSanPham = 0;
    public function __construct()
    {
        $this->__model = $this->model("ShopModel");
        $this->__request = new Request();
        $this->data['sub_data']['dsCategories'] = $this->__model->getRawModel("select * from categories");
        $this->data['sub_data']['dsBrands'] = $this->__model->getRawModel("select * from brands");
        $this->data['sub_data']['dsSizes'] = $this->__model->getRawModel("select * from sizes");
        $this->data["sub_data"]["delivery"] = $this->__model->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_delivery'");
        
        $this->data["sub_data"]["footer"] = json_decode($this->__model->getFooter()["opt_value"],true) ;
        if(isLogin()){
            $this->data['sub_data']['soSpGh'] = count($this->__model->getRawModel("select * from cart where user_id = ".isLogin()['user_id'] ." group by product_id,size_id"));
        }        
    }

    public function index($vtt = 0){
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        if(Session::getSession("errorDetail")){
            $this->data['sub_data']['error'] = Session::getSession("errorDetail");
            Session::removeSession("errorDetail");
        }
        $this->data['sub_data']['title'] = "Cửa hàng";
        $this->data['content'] = 'blocks/shop';
        
        $this->data[''] = '';
        $this->data['sub_data']['dsProducts'] = $this->__model->getRawModel("select * from products inner join products_size on  id = id_product where status = 1 and quantity > 0 and products.name like '%%' GROUP BY products.id ORDER BY sale ASC limit $vtt,".$this->slgSPMT);
        $this->data['sub_data']['dsProductsFull'] = $this->__model->getRawModel("select * from products inner join products_size on  id = id_product where status = 1 and quantity > 0 and products.name like '%%' GROUP BY products.id ");
        $this->data['sub_data']['soTrang'] = $this->tongSoTrang($this->data['sub_data']['dsProductsFull']);
        $this->data['sub_data']['dsStar'] = $this->__model->getStars($this->data['sub_data']['dsProducts']);
        $this->data['sub_data']['tongSp'] = count($this->data['sub_data']['dsProductsFull']);
        $this->data["sub_data"]["dsSlgBan"] = $this->__model->getSlgBan($this->data['sub_data']['dsProducts']);
        // echo "<pre>";
        // print_r($this->data['sub_data']['dsProductsFull']);
        // echo "</pre>";
        $this->renderView('layouts/client_layout',$this->data);
    }
    public function filter(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            $this->category = $data['category'];//Lay Category
            $this->brand = $data['brand'];//Lay Thuong Hieu
            $this->size = $data['size'];//Lay Size
            $this->text = $data['text'];//Lay tim kiem
            $this->sort = $data['sort'];//Lay Sort
            $this->min = $data['min'];//Lay Min
            $this->max = $data['max'];// Lay Max
            $vtt =0;
            if(isset($data['trang'])){
                $vtt = $data['trang'];
            }
            $viTri = $vtt*$this->slgSPMT;// Cap Nhat vi tri trong sql
            $this->sql = "select * from products
             inner join products_size on  id = id_product 
             where status = 1 and quantity > 0 and sale >= $this->min and sale <= $this->max and products.name like '%$this->text%' ";
            
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
            
            $this->sql .= " group by products.id ";
            if($this->sort==2){
                $this->sql .=" order by sale DESC ";
            }
            else{
                $this->sql .=" order by sale ASC ";
            }
            $dsspFull = $this->__model->getRawModel($this->sql);
            $ds = $this->__model->getRawModel($this->sql."limit $viTri,".$this->slgSPMT);
            $soTrang = $this->tongSoTrang($dsspFull);//Lay So Trang
            $dsStar = $this->__model->getStars($ds);
            $dsSlgBan = $this->__model->getSlgBan($ds);
            $data = array(
                'ds' => $ds,
                'soTrang' => $soTrang,
                'sql'=>$this->sql,
                'dsSize'=>$this->data['sub_data']['dsSizes'],
                'tongsp'=>count($dsspFull),
                'dsStar'=>$dsStar,
                'dsSlgBan'=>$dsSlgBan,
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
        if(isLoginAdmin()){
            Response::redirect(_WEB_HOST_ROOT_ADMIN);
        }
        $data['title'] = "Chi tiết sản phẩm";
        $data['content'] = 'blocks/product_detail';
        $this->renderView('layouts/client_layout',$data);
    }
    
}