<?php
class Statistics extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/ProductsModel");
        $this->__request = new Request();
    }


    public function fetchData(){
        if(!isPost()){
            Response::redirect('admin/');
            return;
        }
        $category_id = $_POST['category_id'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        
        $conditionCate = "";
        if(!empty($category_id) && $category_id != 0){
            $conditionCate = "where categories.id = $category_id";
        }

        $condition = "";
        if (!empty($fromDate)) {
            $fromDate = getDateFormat($fromDate, 'Y-m-d H:i:s');
            if (!empty($condition)) {
                $condition .= " and create_at >= '$fromDate'";
            } else {
                $condition = "create_at >= '$fromDate'";
            }
        }

        if (!empty($toDate)) {
            $toDate = getDateFormat($toDate, 'Y-m-d H:i:s');
            if (!empty($condition)) {
                $condition .= " and create_at <= '$toDate'";
            } else {
                $condition = "create_at <= '$toDate'";
            }
        }

        if(!empty($condition)){
            $condition = " and $condition";
        }

        $data = $this->__model->getRawModel("SELECT categories.id ,categories.name,SUM(quantity) AS so_luong 
        FROM categories 
        LEFT JOIN (SELECT products.id_category,product_id,quantity 
        FROM products LEFT JOIN 
        (SELECT product_id,quantity FROM bill,bill_detail
        WHERE bill.id = bill_detail.bill_id $condition
        and bill.id_order_status <> 4)
        AS temp
        ON temp.product_id = products.id
        ) AS temp2
        ON categories.id = temp2.id_category
        $conditionCate
        GROUP BY categories.id ,categories.name ");
        echo json_encode($data);
    }

    public function getQuantityProductSale($month,$year,$category_id = ''){
        $condition = "";
        if(!empty($category_id)){
            $condition = " and products.id_category = $category_id";
        }
        $data = $this->__model->getFirstRaw("SELECT SUM(quantity) AS so_luong FROM bill,
        (SELECT bill_detail.bill_id,bill_detail.quantity FROM products,bill_detail,bill
        WHERE products.id = bill_detail.product_id and bill.id = bill_detail.bill_id and 
        bill.id_order_status <> 4
        $condition ) AS temp
        WHERE bill.id = temp.bill_id 
        AND  MONTH(create_at) = $month 
        AND year(create_at) = $year");
        return !empty($data['so_luong']) ? $data['so_luong'] : 0;
    }

    public function fetchDataChartBar(){
        if(!isPost()){
            Response::redirect('admin/');
            return;
        }
        $category_id = $_POST['category_id'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];

        $conditionCate = "";
        if(!empty($category_id) && $category_id != 0){
            $conditionCate = "where categories.id = $category_id";
        }

        $condition = "";
        $fromDate = null;
        $toDate = null;
        if (!empty($fromDate)) {
            
            $fromDate = getDateFormat($fromDate, 'Y-m-d H:i:s');
            if (!empty($condition)) {
                $condition .= " and create_at >= '$fromDate'";
            } else {
                $condition = "create_at >= '$fromDate'";
            }
        }

        if (!empty($toDate)) {
            $toDate = getDateFormat($toDate, 'Y-m-d H:i:s');
            if (!empty($condition)) {
                $condition .= " and create_at <= '$toDate'";
            } else {
                $condition = "create_at <= '$toDate'";
            }
        }

        $value1 = [];
        $value2 = [];
        if(!empty($_POST['fromDate'])&&empty($_POST['toDate'])){
            $fromDate = getDateFormat($_POST['fromDate'], 'Y-m-d H:i:s');
            $value1 = [
                // 'day'=>idate('d',strtotime($fromDate)),
                'month'=>idate('m',strtotime($fromDate)),
                'year'=> idate('Y',strtotime($fromDate)),
            ];
            $value2 = [
                // 'day'=>idate('d',strtotime(date("Y-m-d H:i:s"))),
                'month'=>idate('m',strtotime(date("Y-m-d H:i:s"))),
                'year'=> idate('Y',strtotime(date("Y-m-d H:i:s"))),
            ];
            $data['check'] = 1;
        }else if(!empty($_POST['fromDate'])&&!empty($_POST['toDate'])){
            $data['check'] = 2;
            $fromDate = getDateFormat($_POST['fromDate'], 'Y-m-d H:i:s');
            $toDate = getDateFormat($_POST['toDate'], 'Y-m-d H:i:s');
            // $value1['day'] = idate('d',strtotime($fromDate));
            $value1['month'] = idate('m',strtotime($fromDate));
            $value1['year'] = idate('Y',strtotime($fromDate));
            // $value2['day'] = idate('d',strtotime($toDate));
            $value2['month'] = idate('m',strtotime($toDate));
            $value2['year'] = idate('Y',strtotime($toDate));
        }

        

        $arr_month = [];
        // $arr_month[] = $value1;
        // $arr_month[] = $value2;
        if(!empty($value1)&&!empty($value2)){
            if($value1['year']==$value2['year']){
                if($value1['month']<=$value2['month']){
                    for ($i = $value1['month'];$i<=$value2['month'];$i++) {
                        $arr_month[] = [
                            'col'=>"T$i/".$value1['year'],
                            'value'=>$this->getQuantityProductSale($i,$value1['year'],$category_id),
                        ];
                    }
                }
            }
            else if($value1['year']< $value2['year']){
                for($i = $value1['year'];$i<=$value2['year'];$i++){
                    $j = 1;
                    $max = 12;
                    if($i==$value1['year']){
                        $j = $value1['month'];
                    }else if($i==$value2['year']){
                        $max = $value2['month'];
                    }
                    for ($j;$j<=$max;$j++) {
                        $arr_month[] = [
                            'col'=>"T$j/".$i,
                            'value'=>$this->getQuantityProductSale($j,$i,$category_id),
                        ];
                    }
                }
            }
        }

        if(empty($arr_month)){
            $m = date('m');
            $y = date('Y');
            for($i = 1;$i<= $m;$i++){
                $arr_month[] = [
                    'col'=>"T$i/".$y,
                    'value'=>$this->getQuantityProductSale($i,$y,$category_id),
                ];
            }
        }

        
        

        if(!empty($condition)){
            $condition = " and $condition";
        }

        // $data['total_revenue'] = $this->__model->getFirstRaw("SELECT SUM(bill_detail.total) AS total FROM bill,bill_detail
        //     WHERE bill.id_order_status = 6 AND bill.id = bill_detail.bill_id $condition")['total'];

        
        

        $data['arr_month'] = $arr_month;
        echo json_encode($data);
        
    }

    public function fetchSmallBoxs(){
        if(!isPost()){
            Response::redirect('admin/');
            return;
        }
        $category_id = $_POST['category_id'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $conditionDate = "";
        $conditionDateTotal = "";
        $conditionCate = "";
        $data['from'] = $fromDate;
        $data['to'] = $toDate;
        if (!empty($fromDate)) {
            $fromDate = getDateFormat($fromDate, 'Y-m-d H:i:s');
            if (!empty($conditionDate)) {
                $conditionDate .= " and create_at >= '$fromDate'";
                $conditionDateTotal .= " and bill.create_at >= '$fromDate'";
            } else {
                $conditionDate = "create_at >= '$fromDate'";
                $conditionDateTotal = "bill.create_at >= '$fromDate'";
            }
        }
        
        if (!empty($toDate)) {
            $toDate = getDateFormat($toDate, 'Y-m-d H:i:s');
            if (!empty($conditionDate)) {
                $conditionDate .= " and create_at <= '$toDate'";
                $conditionDateTotal .= " and bill.create_at <= '$toDate'";
            } else {
                $conditionDate = "create_at <= '$toDate'";
                $conditionDateTotal = "bill.create_at <= '$toDate'";
            }
        }

        if(!empty($category_id)){
            $conditionCate = " and products.id_category = $category_id ";
        }

        $data['conditon']= $conditionDate;

        if(!empty($conditionDate)){
            $data['new_users'] = $this->__model->getRowsModel("select * from users where group_id = 2 and $conditionDate");
            $data['bill_quantity_cancel'] = $this->__model->getRowsModel("select * from bill where id_order_status = 4 and $conditionDate");
            $data['bill_quantity'] = $this->__model->getRowsModel("select * from bill where  $conditionDate");
            $data['total_revenue'] = $this->__model->getFirstRaw("SELECT SUM(bill_detail.total) AS total FROM bill,bill_detail,products
            WHERE bill.id_order_status <> 4 AND bill.id = bill_detail.bill_id 
            AND bill_detail.product_id = products.id $conditionCate and $conditionDateTotal")['total'];
        }else{
            $data['new_users'] = $this->__model->getRowsModel("select * from users where group_id = 2");
            $data['bill_quantity_cancel'] = $this->__model->getRowsModel("select * from bill where id_order_status = 4");
            $data['bill_quantity'] = $this->__model->getRowsModel("select * from bill ");
            $data['total_revenue'] = $this->__model->getFirstRaw("SELECT SUM(bill_detail.total) AS total FROM bill,bill_detail,products
            WHERE bill.id_order_status <> 4 AND bill.id = bill_detail.bill_id 
            AND bill_detail.product_id = products.id $conditionCate ")['total'];
        }

        

        echo json_encode($data);
    }


    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/');
            return;
        }
        $page = $_POST['page'];
        $category_id = $_POST['category_id'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        

        if (!empty($category_id)) {
            if (!empty($condition)) {
                $condition .= " and id_category = $category_id";
            } else {
                $condition = "id_category = $category_id";
            }
        }

        

        $conditionBill = "";
        if (!empty($fromDate)) {
            $fromDate = getDateFormat($fromDate, 'Y-m-d H:i:s');
            if (!empty($conditionBill)) {
                $conditionBill .= " and create_at >= '$fromDate'";
            } else {
                $conditionBill = "create_at >= '$fromDate'";
            }
        }

        if (!empty($toDate)) {
            $toDate = getDateFormat($toDate, 'Y-m-d H:i:s');
            if (!empty($conditionBill)) {
                $conditionBill .= " and create_at <= '$toDate'";
            } else {
                $conditionBill = "create_at <= '$toDate'";
            }
        }

        if(!empty($conditionBill)){
            $conditionBill = " and $conditionBill";
        }

        $sortBy = "";

        $sortBy = "temp2.da_ban desc,";
        

        if (!empty($condition)) {
            $condition = " having $condition";
        }

        $products = $this->__model->getRawModel("SELECT * FROM products LEFT JOIN (SELECT id_product,SUM(quantity) AS con_hang FROM products_size GROUP BY id_product) AS temp 
        ON products.id = temp.id_product LEFT JOIN (SELECT product_id,SUM(quantity) AS da_ban FROM bill_detail,bill where bill.id = bill_detail.bill_id $conditionBill and bill.id_order_status <> 4  GROUP BY product_id) AS temp2
        ON products.id = temp2.product_id $condition order by $sortBy create_at desc  limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($products as $key => $product) {
            $id = $product['id'];
            $name = $product['name'];
            $img = $product['img'];
            $price = $product['price'];
            $sale = $product['sale'];
            $status = $product['status'] == 1 ? "<span class='btn btn-primary'>Mở bán</span>" : "<span class='btn btn-warning'>Ẩn</span>";
            $type = $product['type'];
            $so_luong = !empty($product['con_hang']) ? $product['con_hang'] : 0;
            $da_ban = !empty($product['da_ban']) ? $product['da_ban'] : 0;
            $id_category = $product['id_category'];
            $category = $this->__model->getFirstTableData("`categories`", "id = $id_category")['name'];
            $id_brand = $product['id_brand'];
            $brand = $this->__model->getFirstTableData("`brands`", "id = $id_brand")['name'];
            $create_at = $product['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');
            $linkDetail = _WEB_HOST_ROOT_ADMIN . "/products/detail/$id";
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . "/products/update/$id";
            $linkDelete = _WEB_HOST_ROOT_ADMIN . "/products/delete/$id";
            $linkImage = HOST_ROOT . "/uploads/$img";

            $total = $da_ban * $sale;
            $data .= "<tr>
          <td>$i</td>
            <td>$name</td>
            <td><img src='$linkImage' width='50' /></td>
            <td>$sale</td>
            <td>$category</td>
            <td>$da_ban</td>
            <td>$so_luong</td>
            <td>$total</td>
            </tr>
            ";
            $i++;
        }

        if (empty($data)) {
            $data = "<tr>
    <td colspan='13'>
        <div style='text-align:center;'>Chưa có sản phẩm nào!</div>
    </td>
</tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $status = $_POST['status'];
        $type = $_POST['type'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];

        $condition = "";
        

        if (!empty($category_id)) {
            if (!empty($condition)) {
                $condition .= " and id_category = $category_id";
            } else {
                $condition = "id_category = $category_id";
            }
        }

        

        $users = $this->__model->getData($condition);
        $n = count($users);
        $maxpage = ceil($n / _PER_PAGE_ADMIN);
        $data = "";

        if ($n > 0) {
            $page = empty($page) ? 1 : $page;
            $start = $page - 2;
            if ($start < 1) {
                $start = 1;
            }
            $end = $start + 4;
            if ($end > $maxpage) {
                $end = $maxpage;
                $start = $end - 4;
                if ($start < 1) {
                    $start = 1;
                }
            }
            $data .= "<nav aria-label='Page navigation example' class='d-flex justify-content-end'><ul class='pagination pagination-sm'>
                    <li class='page-item btn-pre'><a class='page-link' href=''>Previous</a>
                    </li>";
            for ($i = $start; $i <= $end; $i++) {
                $check = $page == $i ? "active" : "";
                $data
                    .= "<li class='page-item btn-page $check'><a class='page-link' href=''>$i</a></li>";
            }
            $data .= "<li class='page-item btn-next'><a class='page-link ' href=''>Next</a></li>
                    </ul>
                    </nav>";
            $data .= "<input type='hidden' value='$maxpage' class='max-page'/>";
        }
        echo json_encode($data);
    }
    
}