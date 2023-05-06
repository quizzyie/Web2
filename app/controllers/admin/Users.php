<?php
class Users extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/UsersModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('users','add')&&!isPermission('users','update')&&!isPermission('users','delete')) {
            App::$app->loadError('permission');
            return;
        }
        $data['title'] = "Danh sách người dùng";
        $data['content'] = 'admin/users/list';

        $data['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function add()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('users', 'add')) {
            App::$app->loadError('permission');
            return;
        }
        $data['title'] = "Thêm người dùng";
        $data['content'] = 'admin/users/add';

        $data['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_add()
    {
        if ($this->__request->isPost()) {
            $this->__request->rules([
                'fullname' => 'required|min:5|max:30',
                'password' => 'required|min:6|max:30',
                'repeat_password' => 'required|match:password',
                'email' => 'required|min:6|max:30|email|unique:users,email',
                'phone' => 'required|phone',
                'group_id' => 'selected',
            ]);

            $this->__request->message([
                'fullname.required' => 'Họ tên không được để trống!',
                'fullname.min' => 'Họ tên ít nhất 5 kí tự!',
                'fullname.max' => 'Họ tên không quá 30 kí tự!',
                'password.required' => 'Mật khẩu nhóm không được để trống!',
                'password.min' => 'Mật khẩu nhóm ít nhất 6 kí tự!',
                'password.max' => 'Mật khẩu nhóm không quá 30 kí tự!',
                'repeat_password.required' => 'Trường này không được để trống!',
                'repeat_password.match' => 'Mật khẩu nhập lại không trùng khớp!',
                'email.required' => 'Email không được để trống!',
                'email.min' => 'Email ít nhất 5 kí tự!',
                'email.max' => 'Email không quá 30 kí tự!',
                'email.email' => 'Email không hợp lệ!',
                'email.unique' => 'Email đã tồn tại!',
                'phone.required' => 'Số điện thoại không được để trống!',
                'phone.phone' => 'Số điện thoại không hợp lệ!',
                'group_id.selected' => 'Vui lòng chọn nhóm!',
            ]);

            $data = $this->__request->getFields();

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
                $this->__dataForm['content'] = 'admin/users/add';
                $this->__dataForm['title'] = "Thêm người dùng";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                $dataInsert = [
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'type' => $data['type'],
                    'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    'status' => $data['status'],
                    'group_id' => $data['group_id'],
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->addData($dataInsert);
                if ($status) {
                    Session::setFlashData('msg', 'Thêm người dùng thành công!');
                } else {
                    Session::setFlashData('msg', 'Thêm người dùng không thành công!');
                }
                Response::redirect('admin/users');
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Response::redirect('admin/users/');
        }
    }

    public function update($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('users', 'update')) {
            App::$app->loadError('permission');
            return;
        }
        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/users/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/users/');
            return;
        }
        if (empty($this->__model->getFirstData("id = $id"))) {
            Session::setFlashData('msg', 'Không tồn tại người dùng!');
            Response::redirect('admin/users/');
        } else {
            $data['title'] = "Cập nhập người dùng";
            $data['content'] = 'admin/users/update';
            $data['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
            $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
            $this->renderView('admin/layouts/admin_layout', $data);
            Session::setSession('user_update_id', $id);
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('user_update_id');

            if (empty($data['password']) && empty($data['repeat_password'])) {
                $this->__request->rules([
                    'fullname' => 'required|min:5|max:30',
                    'email' => 'required|min:6|max:30|email|unique:users,email,' . $data['id'],
                    'phone' => 'required|phone',
                ]);
            } else {
                $this->__request->rules([
                    'fullname' => 'required|min:5|max:30',
                    'password' => 'required|min:6|max:30',
                    'repeat_password' => 'required|match:password',
                    'email' => 'required|min:6|max:30|email|unique:users,email,' . $data['id'],
                    'phone' => 'required|phone',
                ]);
            }


            $this->__request->message([
                'fullname.required' => 'Họ tên không được để trống!',
                'fullname.min' => 'Họ tên ít nhất 5 kí tự!',
                'fullname.max' => 'Họ tên không quá 30 kí tự!',
                'password.required' => 'Mật khẩu nhóm không được để trống!',
                'password.min' => 'Mật khẩu nhóm ít nhất 6 kí tự!',
                'password.max' => 'Mật khẩu nhóm không quá 30 kí tự!',
                'repeat_password.required' => 'Trường này không được để trống!',
                'repeat_password.match' => 'Mật khẩu nhập lại không trùng khớp!',
                'email.required' => 'Email không được để trống!',
                'email.min' => 'Email ít nhất 5 kí tự!',
                'email.max' => 'Email không quá 30 kí tự!',
                'email.email' => 'Email không hợp lệ!',
                'email.unique' => 'Email đã tồn tại!',
                'phone.required' => 'Số điện thoại không được để trống!',
                'phone.phone' => 'Số điện thoại không hợp lệ!',
            ]);

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
                $this->__dataForm['content'] = 'admin/users/update';
                $this->__dataForm['title'] = "Cập nhập người dùng";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('user_update_id');
                $dataUpdate = [
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'type' => $data['type'],
                    'phone' => $data['phone'],
                    'status' => $data['status'],
                    'update_at' => date('Y-m-d H:i:s')
                ];

                if(isPermission('groups','permission')){
                    $dataUpdate['group_id'] = $data['group_id'];
                }
                if (!empty($data['password'])) {
                    $dataUpdate['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập người dùng thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập người dùng không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/users');
            }
        } else {
            Response::redirect('admin/users/');
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

        if (!isPermission('users', 'delete')) {
            App::$app->loadError('permission');
            return;
        }
        if (!empty($id)) {
            if(!is_numeric($id)){
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/users/');
                return;
            }
            if (empty($this->__model->getFirstData("id = $id"))) {
                Session::setFlashData('msg', 'Không tồn tại người dùng!');
                Session::setFlashData('msg_type', 'danger');
            } else {
                if ($this->__model->getRowsModel("select * from bill where user_id = $id") == 0) {
                    if ($this->__model->deleteData("id = $id")) {
                        Session::setFlashData('msg', 'Xóa người dùng thành công!');
                        Session::setFlashData('msg_type', 'success');
                    } else {
                        Session::setFlashData('msg', 'Xóa người dùng không thành công!');
                        Session::setFlashData('msg_type', 'danger');
                    }
                } else {
                    Session::setFlashData('msg', 'Xóa người dùng không thành công,người dùng đã tồn tại trong đơn hàng!');
                    Session::setFlashData('msg_type', 'danger');
                }
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
        Response::redirect('admin/users/');
    }

    public function change_status($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('users', 'update')) {
            App::$app->loadError('permission');
            return;
        }
        if (!empty($id)) {
            if(!is_numeric($id)){
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/users/');
                return;
            }
            $data = $this->__model->getFirstData("id = $id");
            if (empty($data)) {
                Session::setFlashData('msg', 'Không tồn tại người dùng!');
                Session::setFlashData('msg_type', 'danger');
            } else {
                $statusChange = 0;
                if ($data['status'] == 0) {
                    $statusChange = 1;
                }
                if ($this->__model->updateData(['status' => $statusChange], "id = $id")) {
                    Session::setFlashData('msg', 'Cập nhập trạng thái người dùng thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập trạng thái người dùng không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
        Response::redirect('admin/users/');
    }

    public function change_password()
    {
        if (isLoginAdmin()) {
            $data['title'] = "Thay đổi mật khẩu";
            $data['content'] = 'admin/users/change_password';
            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function post_change_password()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = isLoginAdmin()['user_id'];

            $this->__request->rules([
                'new_password' => 'required|min:6|max:30',
                'repeat_password' => 'required|match:new_password',
            ]);


            $this->__request->message([
                'new_password.required' => 'Mật khẩu nhóm không được để trống!',
                'new_password.min' => 'Mật khẩu nhóm ít nhất 6 kí tự!',
                'new_password.max' => 'Mật khẩu nhóm không quá 30 kí tự!',
                'repeat_password.required' => 'Trường này không được để trống!',
                'repeat_password.match' => 'Mật khẩu nhập lại không trùng khớp!',
            ]);

            $validate = $this->__request->validate($data);

            $password = $data['password'];
            $user = $this->__model->getFirstData("id = " . $data['id']);
            if (empty($password)) {
                $this->__request->setErr('password', 'required', "Vui lòng nhập mật khẩu hiện tại của bạn!");
                $validate = false;
            } else if (!password_verify($password, $user['password'])) {
                $this->__request->setErr('password', 'match', "Mật khẩu bạn nhập không đúng!");
                $validate = false;
            }

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                Session::setFlashData('msg', "Đã có lỗi vui lòng kiểm tra lại dữ liệu!");
                Session::setFlashData('msg_type', "danger");
                $this->__dataForm['content'] = 'admin/users/change_password';
                $this->__dataForm['title'] = "Thay đổi mật khẩu";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                $dataUpdate = [
                    'password' => password_hash($data['new_password'], PASSWORD_DEFAULT),
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . isLoginAdmin()['user_id']);
                if ($status) {
                    Session::setFlashData('msg', 'Thay đổi mật khẩu thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Thay đổi mật khẩu không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/users/change_password');
            }
        } else {
            Response::redirect('admin/users/change_password');
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
    }

    public function user_info()
    {
        if (isLoginAdmin()) {
            $data['title'] = "Thông tin cá nhân";
            $data['content'] = 'admin/users/user_info';
            $data['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
            $data['sub_data']['dataForm'] = $this->__model->getFirstRaw("select * from users where id = " . isLoginAdmin()['user_id']);
            $this->renderView('admin/layouts/admin_layout', $data);
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function post_user_info()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = isLoginAdmin()['user_id'];

            $this->__request->rules([
                'fullname' => 'required|min:5|max:30',
                'email' => 'required|min:6|max:30|email|unique:users,email,' . $data['id'],
                'phone' => 'required|phone',
            ]);


            $this->__request->message([
                'fullname.required' => 'Họ tên không được để trống!',
                'fullname.min' => 'Họ tên ít nhất 5 kí tự!',
                'fullname.max' => 'Họ tên không quá 30 kí tự!',
                'email.required' => 'Email không được để trống!',
                'email.min' => 'Email ít nhất 5 kí tự!',
                'email.max' => 'Email không quá 30 kí tự!',
                'email.email' => 'Email không hợp lệ!',
                'email.unique' => 'Email đã tồn tại!',
                'phone.required' => 'Số điện thoại không được để trống!',
                'phone.phone' => 'Số điện thoại không hợp lệ!',
            ]);

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                Session::setFlashData('msg', 'Đã có lỗi vui lòng kiểm tra lại dữ liệu!');
                Session::setFlashData('msg_type', 'danger');
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['sub_data']['group_list'] = $this->__model->getRawModel("select * from groups");
                $this->__dataForm['content'] = 'admin/users/user_info';
                $this->__dataForm['title'] = "Thông tin người dùng";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                $dataUpdate = [
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'status' => $data['status'],
                    'update_at' => date('Y-m-d H:i:s')
                ];

                if(isPermission('groups','permission')){
                    $dataUpdate['group_id'] = $data['group_id'];
                }
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Thay đổi thông tin thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Thay đổi thông tin không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/users/user_info');
            }
        } else {
            Response::redirect('admin/dashboard/');
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
    }

    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/users');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $status = $_POST['status'];
        $type = $_POST['type'];
        $group_id = $_POST['group_id'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if (!empty($keyword)) {
            $condition = "fullname like '%$keyword%'";
        }
        if (!empty($status)) {
            $status = $status == 2 ? 0 : $status;
            if (!empty($condition)) {
                $condition .= " and status = $status";
            } else {
                $condition = "status = $status";
            }
        }
        if (!empty($group_id)) {
            if (!empty($condition)) {
                $condition .= " and group_id = $group_id";
            } else {
                $condition = "group_id = $group_id";
            }
        }
        if (!empty($type)) {
            if (!empty($condition)) {
                $condition .= " and type = '$type'";
            } else {
                $condition = "type = '$type'";
            }
        }
        $users = $this->__model->getData($condition, "order by create_at desc", "limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($users as $key => $user) {
            $id = $user['id'];
            $group_id = $user['group_id'];
            $group = $this->__model->getFirstTableData("`groups`", "id = $group_id");
            $name_group = $group['name'];
            $fullname = $user['fullname'];
            $email = $user['email'];
            $phone = $user['phone'];
            $status = $user['status'];
            $type = $user['type'];
            $date_time = empty($user['update_at']) ? $user['create_at'] : $user['update_at'];
            $create_at = getDateFormat($date_time, 'd/m/Y H:i:s');
            $btnStatus = $status ? "btn-primary" : "btn-danger";
            $msgStatus = $status ? "Kích hoạt" : "Chưa kích hoạt";
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . "/users/update/$id";
            $linkDelete = _WEB_HOST_ROOT_ADMIN . "/users/delete/$id";
            $linkChangeStatus = isPermission('users', 'update') ? _WEB_HOST_ROOT_ADMIN . "/users/change_status/$id" : '#';
            $data .= "<tr>
          <td>$i</td>
            <td>$fullname</td>
            <td>$email</td>
            <td>$phone</td>
            <td>$name_group</td>
            <td>$type</td>
            <td>$create_at</td>
            <td><a href='$linkChangeStatus' class=\"btn $btnStatus btn-sm\">$msgStatus</a></td>
            
            ";

            if (isPermission('users', 'update')) {
                $data .= "<td><a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a></td>";
            }

            if (isLoginAdmin()['user_id'] != $id and isPermission('users', 'delete') and $this->__model->getRowsModel("select * from bill where user_id = $id") == 0) {
                $data .= "<td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class=\"btn btn-danger
                btn-sm\"><i class=\"fa fa-trash\"></i>
                Xóa</a></td>";
            } 
            $data .= "</tr>";
            $i++;
        }

        if (empty($data)) {
            $data = "<tr>
    <td colspan='8'>
        <div style='text-align:center;'>Chưa có người dùng nào!</div>
    </td>
</tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/users');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $status = $_POST['status'];
        $group_id = $_POST['group_id'];
        $condition = "";
        if (!empty($keyword)) {
            $condition = "fullname like '%$keyword%'";
        }
        if (!empty($status)) {
            $status = $status == 2 ? 0 : $status;
            if (!empty($condition)) {
                $condition .= " and status = $status";
            } else {
                $condition = "status = $status";
            }
        }
        if (!empty($group_id)) {
            if (!empty($condition)) {
                $condition .= " and group_id = $group_id";
            } else {
                $condition = "group_id = $group_id";
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