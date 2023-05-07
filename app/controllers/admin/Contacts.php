<?php
class Contacts extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/ContactsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('contacts','update')&&!isPermission('contacts','delete')){
            App::$app->loadError('permission');
            return;
        }
        if (isLoginAdmin()) {
            $data['title'] = "Danh sách liên hệ";
            $data['content'] = 'admin/contacts/list';

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

        if(!isPermission('contacts','update')){
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/contacts/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/contacts/');
            return;
        }
        if (isLoginAdmin()) {
            if (empty($this->__model->getFirstData("id = $id"))) {
                Session::setFlashData('msg', 'Không tồn tại liên hệ!');
                Response::redirect('admin/contacts/');
            } else {
                $data['title'] = "Cập nhập liên hệ";
                $data['content'] = 'admin/contacts/update';
                $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
                $this->renderView('admin/layouts/admin_layout', $data);
                Session::setSession('contact_update_id', $id);
            }
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('contact_update_id');

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
                $this->__dataForm['content'] = 'admin/contacts/update';
                $this->__dataForm['title'] = "Cập nhập liên hệ";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('contact_update_id');
                $dataUpdate = [
                    'status' => $data['status'],
                    'note' => $data['note'],
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập liên hệ thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập liên hệ không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/contacts');
            }
        } else {
            Response::redirect('admin/contacts/');
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

        if(!isPermission('contacts','delete')){
            App::$app->loadError('permission');
            return;
        }
        if (isLoginAdmin()) {
            if (!empty($id)) {
                if(!is_numeric($id)){
                    Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                    Session::setFlashData('msg_type', 'danger');
                    Response::redirect('admin/contacts/');
                    return;
                }
                if (empty($this->__model->getFirstData("id = $id"))) {
                    Session::setFlashData('msg', 'Không tồn tại liên hệ!');
                    Session::setFlashData('msg_type', 'danger');
                } else {
                    if ($this->__model->deleteData("id = $id")) {
                        Session::setFlashData('msg', 'Xóa liên hệ thành công!');
                        Session::setFlashData('msg_type', 'success');
                    } else {
                        Session::setFlashData('msg', 'Xóa liên hệ không thành công!');
                        Session::setFlashData('msg_type', 'danger');
                    }
                }
            } else {
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
            }
            Response::redirect('admin/contacts/');
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/contacts');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
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

        $contacts = $this->__model->getData($condition, "order by create_at desc", "limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($contacts as $key => $item) {
            $id = $item['id'];
            $name = $item['name'];
            $email = $item['email'];
            $status = $item['status'];
            $note = $item['note'];
            $message = $item['message'];
            $create_at = $item['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . "/contacts/update/$id";
            $linkDelete = _WEB_HOST_ROOT_ADMIN . "/contacts/delete/$id";
            

            $btnStatus = "";
            if($status==1){
                $btnStatus = "<a href='' class='btn btn-danger btn-sm'>Chưa xử lý</a>";
            }else if($status ==2){
                $btnStatus = "<a href='' class='btn btn-warning btn-sm'>Đang xử lý</a>";
            }else if($status == 3){
                $btnStatus = "<a href='' class='btn btn-primary btn-sm'>Đã xử lý</a>";
            }
            $data .= "<tr>
          <td>$i</td>
            <td>$name</td>
            <td>$email</td>
            <td>$message</td>
            <td>$btnStatus</td>
            <td>$note</td>
            <td>$create_at</td>
            
            
            ";
            $i++;

            if(isPermission('contacts','update')){
                $data .= "<td><a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a></td>";
            }

            if(isPermission('contacts','delete')){
                $data .= "<td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class=\"btn btn-danger
                btn-sm\"><i class=\"fa fa-trash\"></i>
                Xóa</a></td>";
            }

            $data .= "</tr>";
        }



        if (empty($data)) {
            $data = "<tr>
    <td colspan='9'>
        <div style='text-align:center;'>Không có liên hệ nào!</div>
    </td>
</tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/contacts');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
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
}