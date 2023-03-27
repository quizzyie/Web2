<?php

class Shop extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];
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