<?php


class Groups extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/GroupsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('groups','add')&&!isPermission('groups','update')&&!isPermission('groups','delete')&&!isPermission('groups','permission')){
            App::$app->loadError('permission');
            return;
        }

        $data['title'] = "Danh sách nhóm";
        $data['content'] = 'admin/groups/list';

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function add()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('groups','add')){
            App::$app->loadError('permission');
            return;
        }
        $data['title'] = "Thêm nhóm";
        $data['content'] = 'admin/groups/add';
        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_add()
    {
        if ($this->__request->isPost()) {
            $this->__request->rules([
                'name' => 'required|min:3|max:30',
            ]);

            $this->__request->message([
                'name.required' => 'Tên nhóm không được để trống!',
                'name.min' => 'Tên nhóm ít nhất 3 kí tự!',
                'name.max' => 'Tên nhóm không quá 30 kí tự!',
            ]);

            $data = $this->__request->getFields();

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/groups/add';
                $this->__dataForm['title'] = "Thêm nhóm";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                $dataInsert = [
                    'name' => $data['name'],
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->addData($dataInsert);
                if ($status) {
                    Session::setFlashData('msg', 'Thêm nhóm thành công!');
                } else {
                    Session::setFlashData('msg', 'Thêm nhóm không thành công!');
                }
                Response::redirect('admin/groups');
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Response::redirect('admin/groups/');
        }
    }

    public function update($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('groups','update')){
            App::$app->loadError('permission');
            return;
        }

        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/groups/');
            return;
        }

        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/groups/');
            return;
        }
        if (empty($this->__model->getFirstData("id = $id"))) {
            Session::setFlashData('msg', 'Không tồn tại nhóm!');
            Response::redirect('admin/groups/');
        } else {
            $data['title'] = "Cập nhập nhóm";
            $data['content'] = 'admin/groups/update';
            $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
            $this->renderView('admin/layouts/admin_layout', $data);
            Session::setSession('group_update_id', $id);
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $this->__request->rules([
                'name' => 'required|min:3|max:30',
            ]);

            $this->__request->message([
                'name.required' => 'Tên nhóm không được để trống!',
                'name.min' => 'Tên nhóm ít nhất 3 kí tự!',
                'name.max' => 'Tên nhóm không quá 30 kí tự!',
            ]);

            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('group_update_id');

            $validate = $this->__request->validate($data);

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/groups/update';
                $this->__dataForm['title'] = "Cập nhập nhóm";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('group_update_id');
                $dataUpdate = [
                    'name' => $data['name'],
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập nhóm thành công!');
                } else {
                    Session::setFlashData('msg', 'Cập nhập nhóm không thành công!');
                }
                Response::redirect('admin/groups');
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Response::redirect('admin/groups/');
        }
    }

    public function delete($id = '')
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('groups','delete')){
            App::$app->loadError('permission');
            return;
        }
        if (!empty($id)) {
            if(!is_numeric($id)){
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/groups/');
                return;
            }
            if (empty($this->__model->getFirstData("id = $id"))) {
                Session::setFlashData('msg', 'Không tồn tại nhóm!');
            } else {
                if($this->__model->getRowsModel("select * from users where group_id = $id")>0){
                    Session::setFlashData('msg', 'Vui lòng thử lại nhóm đã tồn tại thành viên!');
                }else{
                    if ($this->__model->deleteData("id = $id")) {
                        Session::setFlashData('msg', 'Xóa nhóm thành công!');
                    } else {
                        Session::setFlashData('msg', 'Xóa nhóm không thành công!');
                    }
                }
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
        }
        Response::redirect('admin/groups/');
    }

    public function permission($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if(!isPermission('groups','permission')){
            App::$app->loadError('permission');
            return;
        }
        if (!empty($id)) {
            if(!is_numeric($id)){
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/groups/');
                return;
            }
            if (empty($this->__model->getFirstData("id = $id"))) {
                Session::setFlashData('msg', 'Không tồn tại nhóm!');
            } else {
                $data['title'] = "Phân quyền";
                $data['content'] = 'admin/groups/permission';
                $modules = $this->__model->getRawModel("select * from modules");
                $data['sub_data']['modules'] = $modules;
                $data['sub_data']['permission'] = json_decode($this->__model->getFirstRaw("select * from groups where id = $id")['permission'],true);
                $this->renderView('admin/layouts/admin_layout', $data);
                Session::setSession('permission_update_id', $id);
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
        }
    }

    public function post_permission()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('permission_update_id');

            Session::removeSession('permission_update_id');
            $dataUpdate = [
                'permission' => json_encode($data['permission']),
                'update_at' => date('Y-m-d H:i:s')
            ];
            $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
            if ($status) {
                Session::setFlashData('msg', 'Phân quyền nhóm thành công!');
            } else {
                Session::setFlashData('msg', 'Phân quyền nhóm không thành công!');
            }
            Response::redirect('admin/groups/permission/'.$data['id']);
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Response::redirect('admin/groups/');
        }
    }

    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/groups');
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
        $groups = $this->__model->getData($condition, "order by create_at desc", "limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($groups as $key => $group) {
            $id = $group['id'];
            $name = $group['name'];
            $create_at = getDateFormat($group['create_at'], 'd/m/Y H:i:s');
            $linkUpdate = _WEB_HOST_ROOT_ADMIN . '/groups/update/' . $id;
            $linkDelete = _WEB_HOST_ROOT_ADMIN . '/groups/delete/' . $id;
            $linkPermission = _WEB_HOST_ROOT_ADMIN . '/groups/permission/' . $id;
            $data .= "
            <tr>
            <td>$i</td>
            <td><a href=''>$name</a></td>
            <td>$create_at</td>
            
            
            ";
            
            if(isPermission('groups','permission')){
                $data .= "<td><a href='$linkPermission' class='btn btn-primary btn-sm'>Phân quyền</a></td>";
            }
            if(isPermission('groups','update')){
                $data .= "<td><a href='$linkUpdate' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i> Sửa</a></td>";
            }
            if(isPermission('groups','delete')&&$this->__model->getRowsModel("select * from users where group_id = $id")==0){
                $data .= "<td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class='btn btn-danger btn-sm'><i
                class='fa fa-trash'></i>
            Xóa</a></td>";
            }
            
            $data .= "</tr>";
            $i++;
        }

        if (empty($data)) {
            $data = "<tr>
            <td colspan='6'><div style='text-align:center;'>Chưa có nhóm nào!</div></td></tr>";
        }

        echo json_encode($data);
    }

    public function pagination()
    {
        if(!isPost()){
            Response::redirect('admin/groups');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
        }
        $groups = $this->__model->getData($condition);
        $n = count($groups);
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
                $data .= "<li class='page-item btn-page $check'><a class='page-link' href=''>$i</a></li>";
            }

            $data .= "<li class='page-item btn-next'><a class='page-link ' href=''>Next</a></li>
            </ul>
            </nav>";
            $data .= "<input type='hidden' value='$maxpage' class='max-page'/>";
        }

        echo json_encode($data);
    }
}