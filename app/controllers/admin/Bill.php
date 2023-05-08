<?php
class Bill extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/BillModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('bill', 'update')) {
            App::$app->loadError('permission');
            return;
        }
        if (isLoginAdmin()) {
            $data['sub_data']['order_status'] = $this->__model->getRawModel("select * from order_status");
            $data['title'] = "Danh sách hóa đơn";
            $data['content'] = 'admin/bill/list';

            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function update($id="")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('bill', 'update')) {
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/bill/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/bill/');
            return;
        }
        if (empty($this->__model->getFirstData("id = $id"))) {
            Session::setFlashData('msg', 'Không tồn tại hóa đơn!');
            Response::redirect('admin/bill/');
        } else {
            $data['sub_data']['order_status'] = $this->__model->getRawModel("select * from order_status");
            $data['title'] = "Cập nhập trạng thái";
            $data['content'] = 'admin/bill/update';
            $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
            $this->renderView('admin/layouts/admin_layout', $data);
            Session::setSession('bill_update_id', $id);
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('bill_update_id');

            $this->__request->rules([
                'id_order_status' => 'selected',
                'note' => 'required',
            ]);

            $this->__request->message([
                'id_order_status.selected' => 'Vui lòng chọn trạng thái!',
                'note.required' => 'Mô tả không được để trống!',
            ]);

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['sub_data']['order_status'] = $this->__model->getRawModel("select * from order_status");
                $this->__dataForm['content'] = 'admin/bill/update';
                $this->__dataForm['title'] = "Cập nhập trạng thái";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('bill_update_id');
                $dataUpdate = [
                    'id_order_status' => $data['id_order_status'],
                    'note' => $data['note'],
                    'update_at' => date('Y-m-d H:i:s')
                ];

                $order_status = $this->__model->getFirstRaw("select * from bill where id = " . $data['id'])['id_order_status'];
                $cart = $this->__model->getRawModel("select * from bill_detail where 
                bill_id = " . $data['id']);
                if (($data['id_order_status'] == 4 and $order_status != 4)||($data['id_order_status'] != 4 and $order_status == 4)) {
                    foreach ($cart as $key => $value) {
                        if (!empty($value)) {
                            $product_id = $value['product_id'];
                            $size_id = $value['size_id'];
                            $product = $this->__model->getFirstRaw("select * from products_size where id_product = $product_id and id_size = $size_id");
                            $dataUpdateQuantity = [];
                            if (!empty($product['quantity']) && !empty($value['quantity'])) {
                                $quantityUpdate = $product['quantity'] + $value['quantity'];
                                if($data['id_order_status'] != 4 and $order_status == 4){
                                    $quantityUpdate = $product['quantity'] - $value['quantity'];
                                }
                                $dataUpdateQuantity = [
                                    'quantity' => $quantityUpdate,
                                    'update_at' => date('Y-m-d H:i:s')
                                ];
                            }

                            $this->__model->updateTableData("products_size", $dataUpdateQuantity, "id_product = $product_id and id_size = $size_id");
                        }
                    }
                }

                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);


                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập trạng thái thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập trạng thái không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/bill');
            }
        } else {
            Response::redirect('admin/bill/');
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
    }

    public function detail($id = "")
    {
        if (isLoginAdmin()) {
            if (!empty($id)) {
                if(!is_numeric($id)){
                    Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                    Session::setFlashData('msg_type', 'danger');
                    Response::redirect('admin/bill/');
                    return;
                }
                if (empty($this->__model->getFirstData("id = $id"))) {
                    Session::setFlashData('msg', 'Không tồn tại đơn hàng!');
                    Session::setFlashData('msg_type', 'danger');
                    Response::redirect('admin/bill/');
                } else {
                    $data['sub_data']['bill'] = $this->__model->getFirstRaw("select bill.*,order_status.name as status_name from bill,order_status where bill.id = $id and bill.id_order_status = order_status.id");
                    $data['sub_data']['bill_detail'] = $this->__model->getRawModel("SELECT quantity,products.img,sizes.name AS size_name,total,products.name AS product_name,products.sale FROM bill_detail,products,sizes 
                    WHERE bill_detail.bill_id = $id and bill_detail.product_id = products.id AND bill_detail.size_id = sizes.id
                    ");
                    $data['title'] = "Chi tiết hóa đơn";
                    $data['content'] = 'admin/bill/detail';

                    $this->renderView('admin/layouts/admin_layout', $data);
                }
            } else {
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/bill/');
            }
        } else {
            Response::redirect('admin/auth/login');
        }
    }


    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/bill');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if (!empty($keyword)) {
            $condition = "resipient_name like '%$keyword%'";
        }

        if (!empty($status)) {
            if (!empty($condition)) {
                $condition .= " and id_order_status = $status";
            } else {
                $condition = "id_order_status = $status";
            }
        }

        if (!empty($phone)) {
            if (!empty($condition)) {
                $condition .= " and resipient_phonenumber like '%$phone%'";
            } else {
                $condition = "resipient_phonenumber like '%$phone%'";
            }
        }

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

        $bills = $this->__model->getData($condition, "order by create_at desc", "limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($bills as $key => $bill) {
            $id = $bill['id'];
            $resipient_name = $bill['resipient_name'];
            $resipient_phonenumber = $bill['resipient_phonenumber'];
            $delivery_address = $bill['delivery_address'];
            $note = $bill['note'];
            $arr_bill = $this->__model->getRawModel("select total from bill_detail where bill_id = $id");
            $total = 0;
            foreach ($arr_bill as $key => $value) {
                $total += $value['total'];
            }
            $id_order_status = $bill['id_order_status'];
            $status = $this->__model->getFirstTableData('order_status', "id = $id_order_status")['name'];
            $create_at = $bill['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');
            $linkDetail = _WEB_HOST_ROOT_ADMIN . "/bill/detail/$id";
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . "/bill/update/$id";

            $data .= "<tr>
          <td>$i</td>
            <td>$resipient_name</td>
            <td>$resipient_phonenumber</td>
            <td>$delivery_address</td>
            <td>$note</td>
            <td>$total</td>
            <td>$status</td>
            <td>$create_at</td>
            
            <td>$fromDate</td>
            <td>$toDate</td>
            <td><a href='$linkDetail' class=\"btn btn-primary btn-sm\">Chi tiết</a></td>
            <td><a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a></td>
            </tr>
            ";



            $i++;
        }

        if (empty($data)) {
            $data = "<tr>
    <td colspan='10'>
        <div style='text-align:center;'>Không có hóa đơn nào!</div>
    </td>
</tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/bill');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $status = $_POST['status'];
        $phone = $_POST['phone'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $condition = "";
        if (!empty($keyword)) {
            $condition = "resipient_name like '%$keyword%'";
        }

        if (!empty($status)) {
            if (!empty($condition)) {
                $condition .= " and id_order_status = $status";
            } else {
                $condition = "id_order_status = $status";
            }
        }

        if (!empty($phone)) {
            if (!empty($condition)) {
                $condition .= " and resipient_phonenumber like '%$phone%'";
            } else {
                $condition = "resipient_phonenumber like '%$phone%'";
            }
        }

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