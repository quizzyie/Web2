<?php
class Options extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/OptionsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        $data['title'] = "Thiết lập chung";
        $data['content'] = 'admin/options/home';
        $data['sub_data']['dataOption'] = $this->__model->getData();

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_home()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            foreach ($data as $key => $value) {
                $this->__model->updateData(['opt_value' => $value], "opt_key = '$key'");
            }
            Session::setFlashData('msg', "Cập nhập thành công!");
            Session::setFlashData('msg_type', "success");
            Response::redirect('admin/options');
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/options');
        }
    }

    public function footer()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        $data['title'] = "Thiết lập Footer";
        $data['content'] = 'admin/options/footer';
        $dataForm = $this->__model->getFirstData("opt_key = 'general_footer'")['opt_value'];
        $data['sub_data']['dataForm'] = json_decode($dataForm,true);

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_footer(){
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $this->__model->updateData(['opt_value' => json_encode($data)], "opt_key = 'general_footer'");
            Session::setFlashData('msg', "Cập nhập thành công!");
            Session::setFlashData('msg_type', "success");
            Response::redirect('admin/options/footer');
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/options/footer');
        }
    }

    public function partner(){
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        $data['title'] = "Thiết lập đối tác";
        $data['content'] = 'admin/options/partner';
        $dataForm = $this->__model->getFirstData("opt_key = 'general_partner'")['opt_value'];
        $data['sub_data']['dataForm'] = json_decode($dataForm,true);

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_partner(){
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $this->__model->updateData(['opt_value' => json_encode($data)], "opt_key = 'general_partner'");
            Session::setFlashData('msg', "Thiết lập thành công!");
            Session::setFlashData('msg_type', "success");
            Response::redirect('admin/options/partner');
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/options/partner');
        }
    }

    public function our_team(){
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        $data['title'] = "Thiết lập thành viên";
        $data['content'] = 'admin/options/our_team';
        $dataForm = $this->__model->getFirstData("opt_key = 'general_our_team'")['opt_value'];
        $data['sub_data']['dataForm'] = json_decode($dataForm,true);

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_our_team(){
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $this->__model->updateData(['opt_value' => json_encode($data)], "opt_key = 'general_our_team'");
            Session::setFlashData('msg', "Thiết lập thành công!");
            Session::setFlashData('msg_type', "success");
            Response::redirect('admin/options/our_team');
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/options/partner');
        }
    }

    public function advertise(){
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        $data['title'] = "Thiết lập quảng cáo";
        $data['content'] = 'admin/options/advertise';
        $dataForm = $this->__model->getFirstData("opt_key = 'general_advertise'")['opt_value'];
        $data['sub_data']['dataForm'] = json_decode($dataForm,true);

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_advertise(){
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $this->__model->updateData(['opt_value' => json_encode($data)], "opt_key = 'general_advertise'");
            Session::setFlashData('msg', "Thiết lập thành công!");
            Session::setFlashData('msg_type', "success");
            Response::redirect('admin/options/advertise');
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/options/advertise');
        }
    }
}