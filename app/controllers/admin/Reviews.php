<?php
class Reviews extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/ReviewsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('reviews','update')&&!isPermission('reviews','delete')){
            App::$app->loadError('permission');
            return;
        }
        if (isLoginAdmin()) {
            $data['sub_data']['products'] = $this->__model->getRawModel("select * from products order by name asc");
            $data['title'] = "Danh sách đánh giá";
            $data['content'] = 'admin/reviews/list';

            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function update($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('reviews','update')){
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/reviews/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/reviews/');
            return;
        }
        if (isLoginAdmin()) {
            if (empty($this->__model->getFirstData("id = $id"))) {
                Session::setFlashData('msg', 'Không tồn tại đánh giá!');
                Response::redirect('admin/reviews/');
            } else {
                $data['title'] = "Cập nhập đánh giá";
                $data['content'] = 'admin/reviews/update';
                $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
                $this->renderView('admin/layouts/admin_layout', $data);
                Session::setSession('review_update_id', $id);
            }
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('review_update_id');

            $this->__request->rules([
                'status' => 'selected',
                'note' => 'required',
            ]);

            $this->__request->message([
                'status.selected' => 'Vui lòng chọn trạng thái!',
                'note.required' => 'Mô tả không được để trống!',
            ]);

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/reviews/update';
                $this->__dataForm['title'] = "Cập nhập đánh giá";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('review_update_id');
                $dataUpdate = [
                    'status' => $data['status'],
                    'note' => $data['note'],
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập đánh giá thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập đánh giá không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/reviews');
            }
        } else {
            Response::redirect('admin/reviews/');
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
    }

    public function delete($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('reviews','delete')){
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/reviews/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/reviews/');
            return;
        }
        if (isLoginAdmin()) {
            if (!empty($id)) {
                if (empty($this->__model->getFirstData("id = $id"))) {
                    Session::setFlashData('msg', 'Không tồn tại đánh giá!');
                    Session::setFlashData('msg_type', 'danger');
                } else {
                    if ($this->__model->deleteData("id = $id")) {
                        Session::setFlashData('msg', 'Xóa đánh giá thành công!');
                        Session::setFlashData('msg_type', 'success');
                    } else {
                        Session::setFlashData('msg', 'Xóa đánh giá không thành công!');
                        Session::setFlashData('msg_type', 'danger');
                    }
                }
            } else {
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
            }
            Response::redirect('admin/reviews/');
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function change_status($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('reviews','update')){
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/reviews/');
            return;
        }

        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/reviews/');
            return;
        }
        
        $review = $this->__model->getFirstData("id = $id");
        if (empty($review)) {
            Session::setFlashData('msg', 'Không tồn tại đánh giá!');
            Session::setFlashData('msg_type', 'danger');
        } else {
            $dataUpdate = [
                'status' => $review['status'] == 1 ? 2 : 1,
            ];
            $status = $this->__model->updateData($dataUpdate, "id = " . $id);
            if ($status) {
                Session::setFlashData('msg', 'Cập nhập đánh giá thành công!');
                Session::setFlashData('msg_type', 'success');
            } else {
                Session::setFlashData('msg', 'Cập nhập đánh giá không thành công!');
                Session::setFlashData('msg_type', 'danger');
            }
        }
        Response::redirect('admin/reviews/');
    }

    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/reviews');
            return;
        }
        $page = $_POST['page'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $star = $_POST['star'];
        $product_id = $_POST['product_id'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if(!empty($star)){
            if(!empty($condition)){
                $condition .= " and star = $star";
            }else{
                $condition = "star = $star";
            }
        }

        if(!empty($product_id)){
            if(!empty($condition)){
                $condition .= " and product_id = $product_id";
            }else{
                $condition = "product_id = $product_id";
            }
        }

        if(!empty($status)){
            if(!empty($condition)){
                $condition .= " and status = $status";
            }else{
                $condition = "status = $status";
            }
        }

        if(!empty($email)){
            if(!empty($condition)){
                $condition .= " and email like '%$email%'";
            }else{
                $condition = "email like '%$email%'";
            }
        }

        $reviews = $this->__model->getData($condition, "order by create_at desc", "limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($reviews as $key => $item) {
            $id = $item['id'];
            $name = $item['name'];
            $email = $item['email'];
            $note = $item['note'];
            $message = $item['message'];
            $star = $item['star'];
            $status = $item['status'];
            $create_at = $item['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . "/reviews/update/$id";
            $linkDelete = _WEB_HOST_ROOT_ADMIN . "/reviews/delete/$id";
            
            $product_id = $item['product_id'];
            $productName = $this->__model->getFirstTableData('products',"id = $product_id")['name'];

            $linkChangeStatus = "#";
            if(isPermission('reviews','update')){
                $linkChangeStatus = _WEB_HOST_ROOT_ADMIN.'/reviews/change_status/'.$id;
            }
            $btnStatus = $status == 1 ? "<a href='$linkChangeStatus' class='btn btn-danger btn-sm'>Ẩn</a>" : "<a href='$linkChangeStatus' class='btn btn-primary btn-sm'>Hiển thị</a>";
            $data .= "<tr>
          <td>$i</td>
            <td>$name</td>
            <td>$email</td>
            <td>$productName</td>
            <td>$star</td>
            <td>$message</td>
            <td>$btnStatus</td>
            <td>$note</td>
            <td>$create_at</td>
            ";

            if(isPermission('reviews','update')){
                $data .= "<td><a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a></td>";
            }

            if(isPermission('reviews','delete')){
                $data .= "<td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class=\"btn btn-danger
                btn-sm\"><i class=\"fa fa-trash\"></i>
                Xóa</a></td>";
            }

            $data .= "</tr>";

            $i++;
        }

        if (empty($data)) {
            $data = "<tr>
    <td colspan='9'>
        <div style='text-align:center;'>Không có đánh giá nào!</div>
    </td>
</tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/reviews');
            return;
        }
        $page = $_POST['page'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $star = $_POST['star'];
        $product_id = $_POST['product_id'];
        $condition = "";
        if(!empty($star)){
            if(!empty($condition)){
                $condition .= " and star = $star";
            }else{
                $condition = "star = $star";
            }
        }

        if(!empty($product_id)){
            if(!empty($condition)){
                $condition .= " and product_id = $product_id";
            }else{
                $condition = "product_id = $product_id";
            }
        }

        if(!empty($status)){
            if(!empty($condition)){
                $condition .= " and status = $status";
            }else{
                $condition = "status = $status";
            }
        }

        if(!empty($email)){
            if(!empty($condition)){
                $condition .= " and email like '%$email%'";
            }else{
                $condition = "email like '%$email%'";
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

    public function get_options(){
        $sizes = $this->__model->getData();
        $data = "<option value='0'>Vui lòng chọn kích thước</option>";
        if(!empty($sizes)){
            foreach ($sizes as $key => $size) {
                $id = $size['id'];
                $name = $size['name'];
                $data .= "<option value='$id'>$name</option>";
            }
        }
        echo json_encode($data);
    }

    public function get_quantity(){
        if(isPost()){
            $product_id = Session::getSession('user_id_detail');
            $quantity = $this->__model->getRowsModel("select * from reviews where status = 2 and product_id = ".$product_id);
            echo json_encode(['quantity'=>$quantity]);
        }else{
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');           
            Response::redirect('admin/reviews/');
        }
    }
}