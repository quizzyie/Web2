<?php
class Order_Status extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/OrderStatusModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('bill','update')){
            App::$app->loadError('permission');
            return;
        }
        if (isLoginAdmin()) {
            $data['title'] = "Danh sách trạng thái đơn hàng";
            $data['content'] = 'admin/order_status/list';

            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function add()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('bill','update')){
            App::$app->loadError('permission');
            return;
        }
        if (isLoginAdmin()) {
            $data['title'] = "Thêm trạng thái";
            $data['content'] = 'admin/order_status/add';

            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function post_add()
    {
        if ($this->__request->isPost()) {
            $this->__request->rules([
                'name' => 'required|max:30',
                'description' => 'required',
            ]);

            $this->__request->message([
                'name.required' => 'Tên trạng thái không được để trống!',
                'name.max' => 'Tên size không quá 30 kí tự!',
                'description.required' => 'Mô tả không được để trống!',
            ]);

            $data = $this->__request->getFields();

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/order_status/add';
                $this->__dataForm['title'] = "Thêm trạng thái";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                $dataInsert = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->addData($dataInsert);
                if ($status) {
                    Session::setFlashData('msg', 'Thêm trạng thái thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Thêm trạng thái không thành công!');
                }
                Response::redirect('admin/order_status');
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Response::redirect('admin/order_status/');
        }
    }

    public function update($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('bill','update')){
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/order_status/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/order_status/');
            return;
        }
        if (isLoginAdmin()) {
            if (empty($this->__model->getFirstData("id = $id"))) {
                Session::setFlashData('msg', 'Không tồn tại trạng thái!');
                Response::redirect('admin/order_status/');
            } else {
                $data['title'] = "Cập nhập trạng thái";
                $data['content'] = 'admin/order_status/update';
                $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
                $this->renderView('admin/layouts/admin_layout', $data);
                Session::setSession('order_status_update_id', $id);
            }
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('order_status_update_id');

            $this->__request->rules([
                'name' => 'required|max:30',
                'description' => 'required',
            ]);

            $this->__request->message([
                'name.required' => 'Tên trạng thái không được để trống!',
                'name.max' => 'Tên trạng thái không quá 30 kí tự!',
                'description.required' => 'Mô tả không được để trống!',
            ]);

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/order_status/update';
                $this->__dataForm['title'] = "Cập nhập trạng thái";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('order_status_update_id');
                $dataUpdate = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập trạng thái thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập trạng thái không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/order_status');
            }
        } else {
            Response::redirect('admin/order_status/');
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
    }

    // public function delete($id = "")
    // {
    //     if (isLoginAdmin()) {
    //         if (!empty($id)) {
        // if(!is_numeric($id)){
        //     Session::setFlashData('msg', 'Truy cập không hợp lệ!');
        //     Session::setFlashData('msg_type', 'danger');
        //     Response::redirect('admin/order_status/');
        //     return;
        // }
    //             if (empty($this->__model->getFirstData("id = $id"))) {
    //                 Session::setFlashData('msg', 'Không tồn tại trạng thái!');
    //                 Session::setFlashData('msg_type', 'danger');
    //             } else {
    //                 if ($this->__model->deleteData("id = $id")) {
    //                     Session::setFlashData('msg', 'Xóa trạng thái thành công!');
    //                     Session::setFlashData('msg_type', 'success');
    //                 } else {
    //                     Session::setFlashData('msg', 'Xóa trạng thái không thành công!');
    //                     Session::setFlashData('msg_type', 'danger');
    //                 }
    //             }
    //         } else {
    //             Session::setFlashData('msg', 'Truy cập không hợp lệ!');
    //             Session::setFlashData('msg_type', 'danger');
    //         }
    //         Response::redirect('admin/order_status/');
    //     } else {
    //         Response::redirect('admin/auth/login');
    //     }
    // }

    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/order_status');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
        }
        $order_status = $this->__model->getData($condition, "order by create_at desc", "limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($order_status as $key => $item) {
            $id = $item['id'];
            $name = $item['name'];
            $description = $item['description'];
            $create_at = $item['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . "/order_status/update/$id";
            $linkDelete = _WEB_HOST_ROOT_ADMIN . "/order_status/delete/$id";
            $data .= "<tr>
          <td>$i</td>
            <td>$name</td>
            <td>$description</td>
            <td>$create_at</td>
            <td><a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a></td>
            </tr>
            ";
            $i++;
            // <td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class=\"btn btn-danger
            //     btn-sm\"><i class=\"fa fa-trash\"></i>
            //     Xóa</a></td>
        }

        if (empty($data)) {
            $data = "<tr>
    <td colspan='6'>
        <div style='text-align:center;'>Không có trạng thái nào nào!</div>
    </td>
</tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/order_status');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
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