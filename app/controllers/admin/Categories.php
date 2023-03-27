<?php 
class Categories extends Controller {
    public $__model,$__request,$__dataForm;
    private $data = [];

    public function __construct(){
        $this->__model = $this->model("admin/CategoriesModel");
        $this->__request = new Request();
    }

    public function index(){
        if(isLogin()){
            $data['title'] = "Danh sách danh mục sản phẩm";
            $data['content'] = 'admin/categories/list';
    
            $this->renderView('admin/layouts/admin_layout',$data);
        }else{
            Response::redirect('admin/auth/login');
        }        
    }

    public function add(){
        if(isLogin()){
            $data['title'] = "Thêm danh mục sản phẩm";
            $data['content'] = 'admin/categories/add';
                
            $this->renderView('admin/layouts/admin_layout',$data);
        }else{
            Response::redirect('admin/auth/login');
        }   
    }
    
    public function post_add(){
        if($this->__request->isPost()){
            $this->__request->rules([
                'name'=>'required|max:30',
                'image'=>'required',
            ]);
            
            $this->__request->message([
                'name.required'=>'Tên danh mục sản phẩm không được để trống!',
                'name.max'=>'Tên danh mục sản phẩm không quá 30 kí tự!',
                'image.required'=>'Hình ảnh không được để trống!',
            ]);
    
            $data = $this->__request->getFields();
            
            $validate = $this->__request->validate($data);
    
            if(!$validate){
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/categories/add';
                $this->__dataForm['title'] = "Thêm danh mục sản phẩm";
                $this->renderView('admin/layouts/admin_layout',$this->__dataForm);
            }else{
                $dataInsert = [
                    'name'=>$data['name'],
                    'image'=>$data['image'],
                    'create_at'=>date('Y-m-d H:i:s')
                ];
                $status = $this->__model->addData($dataInsert);
                if($status){
                    Session::setFlashData('msg','Thêm danh mục sản phẩm thành công!');
                    Session::setFlashData('msg_type','success');
                }else{
                    Session::setFlashData('msg','Thêm danh mục sản phẩm không thành công!');
                }
                Response::redirect('admin/categories');
            }
        }else{
            Session::setFlashData('msg','Truy cập không hợp lệ!');
            Response::redirect('admin/categories/');
        }
    }

    public function update($id){
        if(isLogin()){
            if(empty($this->__model->getFirstData("id = $id"))){
                Session::setFlashData('msg','Không tồn tại danh mục sản phẩm!');
                Response::redirect('admin/categories/');
            }else{
                $data['title'] = "Cập nhập danh mục sản phẩm";   
                $data['content'] = 'admin/categories/update';
                $data['sub_data']['dataForm'] = $this->__model->getFirstData("id = $id");
                $this->renderView('admin/layouts/admin_layout',$data);
                Session::setSession('catetgory_update_id',$id);
            } 
        }else{
            Response::redirect('admin/auth/login');
        }
    }

    public function post_update(){
        if($this->__request->isPost()){
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('catetgory_update_id');

            $this->__request->rules([
                'name'=>'required|max:30',
                'image'=>'required',
            ]);
            
            $this->__request->message([
                'name.required'=>'Tên danh mục sản phẩm không được để trống!',
                'name.max'=>'Tên danh mục sản phẩm không quá 30 kí tự!',
                'image.required'=>'Hình ảnh không được để trống!',
            ]);
    
            $validate = $this->__request->validate($data);
    
            if(!$validate){
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/categories/update';
                $this->__dataForm['title'] = "Cập nhập danh mục sản phẩm";
                $this->renderView('admin/layouts/admin_layout',$this->__dataForm);
            }else{
                Session::removeSession('catetgory_update_id');
                $dataUpdate = [
                    'name'=>$data['name'],
                    'image'=>$data['image'],
                    'update_at'=>date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate,"id = ".$data['id']);
                if($status){
                    Session::setFlashData('msg','Cập nhập danh mục sản phẩm thành công!');
                    Session::setFlashData('msg_type','success');
                }else{
                    Session::setFlashData('msg','Cập nhập danh mục sản phẩm không thành công!');
                    Session::setFlashData('msg_type','danger');
                }
                Response::redirect('admin/categories');
            }
        }else{
            Response::redirect('admin/categories/');
            Session::setFlashData('msg','Truy cập không hợp lệ!');
            Session::setFlashData('msg_type','danger');
        }
    }

    public function delete($id){
        if(isLogin()){
            if(!empty($id)){
                if(empty($this->__model->getFirstData("id = $id"))){
                    Session::setFlashData('msg','Không tồn tại danh mục sản phẩm!');
                    Session::setFlashData('msg_type','danger');
                }else {
                    if($this->__model->deleteData("id = $id")){
                        Session::setFlashData('msg','Xóa danh mục sản phẩm thành công!');
                        Session::setFlashData('msg_type','success');
                    }else{
                        Session::setFlashData('msg','Xóa danh mục sản phẩm không thành công!');
                        Session::setFlashData('msg_type','danger');
                    }
                }
            }else{
                Session::setFlashData('msg','Truy cập không hợp lệ!');
                Session::setFlashData('msg_type','danger');
            }
            Response::redirect('admin/categories/');
        }else{
            Response::redirect('admin/auth/login');
        }
    }

    public function phan_trang(){        
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if(!empty($keyword)){
            $condition = "name like '%$keyword%'";
        }
        $catigories = $this->__model->getData($condition,"order by create_at desc","limit $indexPage,$per_page");
        
        $data = "";
        $i = 1;
        foreach ($catigories as $key => $category) {
            $id = $category['id'];
            $name = $category['name'];
            $image = $category['image'];
            $create_at = $category['create_at'];
            $create_at = getDateFormat($create_at, 'd/m/Y H:i:s');
            $linkUpdate = _WEB_HOST_ROOT_ADMIN."/categories/update/$id";
            $linkDelete = _WEB_HOST_ROOT_ADMIN."/categories/delete/$id";
            $linkImage = HOST_ROOT . "/uploads/$image";
          $data .= "<tr>
          <td>$i</td>
            <td>$name</td>
            <td><img src='$linkImage' width='80' /></td>
            <td>$create_at</td>
            <td><a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a></td>
            <td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class=\"btn btn-danger
                btn-sm\"><i class=\"fa fa-trash\"></i>
                Xóa</a></td></tr>
            ";
        $i++;
        }

if(empty($data)){
$data = "<tr>
    <td colspan='8'>
        <div style='text-align:center;'>Chưa có danh mục sản phẩm nào!</div>
    </td>
</tr>";
}

echo json_encode($data);
}

public function pagination(){
    $page = $_POST['page'];
    $keyword = $_POST['keyword'];
    $condition = "";
    if(!empty($keyword)){
        $condition = "name like '%$keyword%'";
    }
    
        $users = $this->__model->getData($condition);
        $n = count($users);
        $maxpage = ceil($n / _PER_PAGE_ADMIN);
        $data = "";

        if($n > 0){
        $page = empty($page) ? 1 : $page;
        $start = $page - 2;
        if ($start < 1) { 
            $start=1; 
        } 
        $end=$start + 4; 
        if ($end> $maxpage) {
            $end = $maxpage;
            $start = $end - 4;
            if ($start < 1) { $start=1; } } 
            $data .="<nav aria-label='Page navigation example' class='d-flex justify-content-end'><ul class='pagination pagination-sm'>
                    <li class='page-item btn-pre'><a class='page-link' href=''>Previous</a>
                    </li>" ; for ($i=$start ; $i <=$end; $i++) { $check=$page==$i ? "active" : "" ; $data
                .="<li class='page-item btn-page $check'><a class='page-link' href=''>$i</a></li>" ;} $data .="<li class='page-item btn-next'><a class='page-link ' href=''>Next</a></li>
                    </ul>
                    </nav>" ; $data .="<input type='hidden' value='$maxpage' class='max-page'/>" ; 
        } 
        echo json_encode($data); 
    }
        
}