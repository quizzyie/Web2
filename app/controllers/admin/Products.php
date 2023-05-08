<?php
class Products extends Controller
{
    public $__model, $__request, $__dataForm;
    private $data = [];

    public function __construct()
    {
        $this->__model = $this->model("admin/ProductsModel");
        $this->__request = new Request();
    }

    public function index()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('products', 'add') && !isPermission('products', 'update') && !isPermission('products', 'delete')) {
            App::$app->loadError('permission');
            return;
        }
        $data['sub_data']['list_brand'] = $this->__model->getRawModel("select * from brands");
        $data['sub_data']['list_category'] = $this->__model->getRawModel("select * from categories");
        $data['title'] = "Danh sách sản phẩm";
        $data['content'] = 'admin/products/list';

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function add()
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('products', 'add')) {
            App::$app->loadError('permission');
            return;
        }
        $data['title'] = "Thêm sản phẩm";
        $data['sub_data']['list_brand'] = $this->__model->getRawModel("select * from brands");
        $data['sub_data']['list_category'] = $this->__model->getRawModel("select * from categories");
        $data['content'] = 'admin/products/add';

        $this->renderView('admin/layouts/admin_layout', $data);
    }

    public function post_add()
    {
        if ($this->__request->isPost()) {
            $this->__request->rules([
                'name' => 'required|min:5',
                'img' => 'required',
                'id_category' => 'selected',
                'id_brand' => 'selected',
                'description' => 'required',
            ]);

            $this->__request->message([
                'name.required' => 'Tên sản phẩm không được để trống!',
                'name.min' => 'Tên sản phẩm ít nhất 5 kí tự!',
                'img.required' => 'Hình ảnh không được để trống!',
                'id_category.selected' => 'Vui lòng chọn danh mục sản phẩm!',
                'id_brand.selected' => 'Vui lòng chọn thương hiệu!',
                'description.required' => 'Vui lòng nhập mô tả sản phẩm!',
            ]);

            $data = $this->__request->getFields();

            $validate = $this->__request->validate($data);
            $price = $data['price'];
            $sale = $data['sale'];

            if (empty($price)) {
                $validate = false;
                $this->__request->setErr('price', 'required', "Vui lòng nhập giá!");
            } else if (!is_numeric($price) || intval($price) < 0) {
                $validate = false;
                $this->__request->setErr('price', 'required', "Dữ liệu không hợp lệ!");
            }

            if (empty($sale)) {
                $validate = false;
                $this->__request->setErr('sale', 'required', "Vui lòng nhập giá!");
            } else if (!is_numeric($sale) || intval($sale) < 0) {
                $validate = false;
                $this->__request->setErr('sale', 'required', "Dữ liệu không hợp lệ!");
            }

            $errors_form = [];
            if (!empty($data['image'])) {
                foreach ($data['image'] as $key => $image) {
                    if (empty($image)) {
                        $errors_form['image'][$key] = "Vui lòng chọn hình ảnh!";
                        $validate = false;
                    }
                }
            }
            if (!empty($data['size'])) {
                $countedArray = array_count_values($data['size']);
                foreach ($data['size'] as $key => $size) {
                    if ($size == 0) {
                        $errors_form['size'][$key] = "Vui lòng chọn size!";
                        $validate = false;
                    } else if ($countedArray[$size] > 1) {
                        $errors_form['size'][$key] = "Vui lòng chọn size khác nhau!";
                        $validate = false;
                    }
                }
            }
            if (!empty($data['quantity'])) {
                foreach ($data['quantity'] as $key => $quantity) {
                    if (empty($quantity)) {
                        $errors_form['quantity'][$key] = "Vui lòng nhập số lượng!";
                        $validate = false;
                    } else if (!is_numeric($quantity) || intval($quantity) < 0) {
                        $validate = false;
                        $errors_form['quantity'][$key] = "Dữ liệu không hợp lệ!";
                    }
                }
            }


            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['errors_form'] = $errors_form;
                $this->__dataForm['sub_data']['list_brand'] = $this->__model->getRawModel("select * from brands");
                $this->__dataForm['sub_data']['list_category'] = $this->__model->getRawModel("select * from categories");
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['sub_data']['group_size'] = $this->__model->getRawModel("select * from sizes");
                $this->__dataForm['content'] = 'admin/products/add';
                $this->__dataForm['title'] = "Thêm sản phẩm";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                $dataInsert = [
                    'name' => $data['name'],
                    'img' => $data['img'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'sale' => $data['sale'],
                    'id_category' => $data['id_category'],
                    'id_brand' => $data['id_brand'],
                    'status' => $data['status'],
                    'type' => $data['type'],
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->addData($dataInsert);
                if ($status) {
                    Session::setFlashData('msg', 'Thêm sản phẩm thành công!');
                    Session::setFlashData('msg_type', 'success');
                    $product_id = $this->__model->insertIdModel();
                    if (!empty($data['image'])) {
                        foreach ($data['image'] as $key => $image) {
                            $dataInsert = [
                                'id_product' => $product_id,
                                'image' => $image,
                                'create_at' => date('Y-m-d H:i:s')
                            ];
                            $this->__model->addTableData("images", $dataInsert);
                        }
                    }
                    if (!empty($data['size'])) {
                        foreach ($data['size'] as $key => $size) {
                            $dataInsert = [
                                'id_product' => $product_id,
                                'id_size' => $size,
                                'quantity' => $data['quantity'][$key],
                                'create_at' => date('Y-m-d H:i:s')
                            ];
                            $this->__model->addTableData("products_size", $dataInsert);
                        }
                    }
                } else {
                    Session::setFlashData('msg', 'Thêm sản phẩm không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/products');
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Response::redirect('admin/products/');
        }
    }

    public function update($id = '')
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('products', 'update')) {
            App::$app->loadError('permission');
            return;
        }
        if(empty($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/products/');
            return;
        }
        if(!is_numeric($id)){
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
            Response::redirect('admin/products/');
            return;
        }
        if (empty($this->__model->getFirstData("id = $id"))) {
            Session::setFlashData('msg', 'Không tồn tại sản phẩm!');
            Response::redirect('admin/products/');
        } else {
            $data['title'] = "Cập nhập sản phẩm";
            $data['sub_data']['group_size'] = $this->__model->getRawModel("select * from sizes");
            $data['sub_data']['list_brand'] = $this->__model->getRawModel("select * from brands");
            $data['sub_data']['list_category'] = $this->__model->getRawModel("select * from categories");
            $dataProduct = $this->__model->getFirstData("id = $id");
            $dataImage = $this->__model->getRawModel("select image from images where id_product = $id");
            if (!empty($dataImage)) {
                foreach ($dataImage as $key => $image) {
                    $dataImage[$key] = $image['image'];
                }
                $dataProduct['image'] = $dataImage;
            }
            $dataSize = [];
            $dataQuantity = [];
            $products_size = $this->__model->getRawModel("select quantity,id_size from 
        products_size where id_product = $id");
            if (!empty($products_size)) {
                foreach ($products_size as $key => $item) {
                    $dataSize[$key] = $item['id_size'];
                    $dataQuantity[$key] = $item['quantity'];
                }
                $dataProduct['size'] = $dataSize;
                $dataProduct['quantity'] = $dataQuantity;
            }
            $data['content'] = 'admin/products/update';
            $data['sub_data']['dataForm'] = $dataProduct;
            $this->renderView('admin/layouts/admin_layout', $data);
            Session::setSession('product_update_id', $id);
        }
    }

    public function post_update()
    {
        if ($this->__request->isPost()) {
            $data = $this->__request->getFields();
            $data['id'] = Session::getSession('product_update_id');

            $this->__request->rules([
                'name' => 'required|min:5',
                'img' => 'required',
                'id_category' => 'selected',
                'id_brand' => 'selected',
                'description' => 'required',
            ]);

            $this->__request->message([
                'name.required' => 'Tên sản phẩm không được để trống!',
                'name.min' => 'Tên sản phẩm ít nhất 5 kí tự!',
                'img.required' => 'Hình ảnh không được để trống!',
                'id_category.selected' => 'Vui lòng chọn danh mục sản phẩm!',
                'id_brand.selected' => 'Vui lòng chọn thương hiệu!',
                'description.required' => 'Vui lòng nhập mô tả sản phẩm!',
            ]);


            $validate = $this->__request->validate($data);
            $price = $data['price'];
            $sale = $data['sale'];

            if (empty($price)) {
                $validate = false;
                $this->__request->setErr('price', 'required', "Vui lòng nhập giá!");
            } else if (!is_numeric($price) || intval($price) < 0) {
                $validate = false;
                $this->__request->setErr('price', 'required', "Dữ liệu không hợp lệ!");
            }

            if (empty($sale)) {
                $validate = false;
                $this->__request->setErr('sale', 'required', "Vui lòng nhập giá!");
            } else if (!is_numeric($sale) || intval($sale) < 0) {
                $validate = false;
                $this->__request->setErr('sale', 'required', "Dữ liệu không hợp lệ!");
            }

            $errors_form = [];
            if (!empty($data['image'])) {
                foreach ($data['image'] as $key => $image) {
                    if (empty($image)) {
                        $errors_form['image'][$key] = "Vui lòng chọn hình ảnh!";
                        $validate = false;
                    }
                }
            }
            if (!empty($data['size'])) {
                $countedArray = array_count_values($data['size']);
                foreach ($data['size'] as $key => $size) {
                    if ($size == 0) {
                        $errors_form['size'][$key] = "Vui lòng chọn size!";
                        $validate = false;
                    } else if ($countedArray[$size] > 1) {
                        $errors_form['size'][$key] = "Vui lòng chọn size khác nhau!";
                        $validate = false;
                    }
                }
            }
            if (!empty($data['quantity'])) {
                foreach ($data['quantity'] as $key => $quantity) {
                    if (empty($quantity)) {
                        $errors_form['quantity'][$key] = "Vui lòng nhập số lượng!";
                        $validate = false;
                    } else if (!is_numeric($quantity) || intval($quantity) < 0) {
                        $validate = false;
                        $errors_form['quantity'][$key] = "Dữ liệu không hợp lệ!";
                    }
                }
            }

            if (!$validate) {
                $this->__dataForm['sub_data']['errors'] = $this->__request->error();
                $this->__dataForm['sub_data']['errors_form'] = $errors_form;
                $this->__dataForm['sub_data']['group_size'] = $this->__model->getRawModel("select * from sizes");
                $this->__dataForm['sub_data']['list_brand'] = $this->__model->getRawModel("select * from brands");
                $this->__dataForm['sub_data']['list_category'] = $this->__model->getRawModel("select * from categories");
                $this->__dataForm['sub_data']['msg'] = "Đã có lỗi vui lòng kiểm tra lại dữ liệu!";
                $this->__dataForm['sub_data']['dataForm'] = $data;
                $this->__dataForm['content'] = 'admin/products/update';
                $this->__dataForm['title'] = "Cập nhập sản phẩm";
                $this->renderView('admin/layouts/admin_layout', $this->__dataForm);
            } else {
                Session::removeSession('product_update_id');
                $dataUpdate = [
                    'name' => $data['name'],
                    'img' => $data['img'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'sale' => $data['sale'],
                    'id_category' => $data['id_category'],
                    'id_brand' => $data['id_brand'],
                    'status' => $data['status'],
                    'type' => $data['type'],
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $data['id']);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập sản phẩm thành công!');
                    Session::setFlashData('msg_type', 'success');
                    $product_id = $data['id'];
                    $this->__model->deleteTableData('images', "id_product = $product_id");
                    if (!empty($data['image'])) {
                        foreach ($data['image'] as $key => $image) {
                            $dataInsert = [
                                'id_product' => $product_id,
                                'image' => $image,
                                'create_at' => date('Y-m-d H:i:s')
                            ];
                            $this->__model->addTableData("images", $dataInsert);
                        }
                    }
                    $this->__model->deleteTableData('products_size', "id_product = $product_id");
                    if (!empty($data['size'])) {
                        foreach ($data['size'] as $key => $size) {
                            $dataInsert = [
                                'id_product' => $product_id,
                                'id_size' => $size,
                                'quantity' => $data['quantity'][$key],
                                'create_at' => date('Y-m-d H:i:s')
                            ];
                            $this->__model->addTableData("products_size", $dataInsert);
                        }
                    }
                } else {
                    Session::setFlashData('msg', 'Cập nhập sản phẩm không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
                Response::redirect('admin/products');
            }
        } else {
            Response::redirect('admin/products/');
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
    //                 Session::setFlashData('msg', 'Không tồn tại sản phẩm!');
    //                 Session::setFlashData('msg_type', 'danger');
    //             } else {
    //                 if ($this->__model->deleteData("id = $id")) {
    //                     $this->__model->deleteTableData('images', "id_product = $id");
    //                     $this->__model->deleteTableData('products_size', "id_product = $id");
    //                     Session::setFlashData('msg', 'Xóa sản phẩm thành công!');
    //                     Session::setFlashData('msg_type', 'success');
    //                 } else {
    //                     Session::setFlashData('msg', 'Xóa sản phẩm không thành công!');
    //                     Session::setFlashData('msg_type', 'danger');
    //                 }
    //             }
    //         } else {
    //             Session::setFlashData('msg', 'Truy cập không hợp lệ!');
    //             Session::setFlashData('msg_type', 'danger');
    //         }
    //         Response::redirect('admin/products/');
    //     } else {
    //         Response::redirect('admin/auth/login');
    //     }
    // }

    public function detail($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('products', 'add') && !isPermission('products', 'update')&& !isPermission('products', 'delete')) {
            App::$app->loadError('permission');
            return;
        }


        if (isLoginAdmin()) {
            if (!empty($id)) {
                if(!is_numeric($id)){
                    Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                    Session::setFlashData('msg_type', 'danger');
                    Response::redirect('admin/products/');
                    return;
                }
                if (empty($this->__model->getFirstData("id = $id"))) {
                    Session::setFlashData('msg', 'Không tồn tại sản phẩm!');
                    Session::setFlashData('msg_type', 'danger');
                    Response::redirect('admin/bill/');
                } else {

                    $data['title'] = "Chi tiết sản phẩm";
                    $data['content'] = 'admin/products/detail';
                    $data["sub_data"]['product_detail'] = $this->__model->getFirstRaw("SELECT products.*,da_ban,con_hang,categories.name AS cate_name,brands.name AS brand_name
                    FROM products LEFT JOIN (SELECT id_product,SUM(quantity) 
                    AS con_hang FROM products_size GROUP BY id_product) AS temp 
                    ON products.id = temp.id_product 
                    LEFT JOIN (SELECT product_id,SUM(quantity) AS da_ban 
                    FROM bill_detail,bill where bill.id = bill_detail.bill_id  
                    and bill.id_order_status <> 4
                    GROUP BY product_id) AS temp2
                    ON products.id = temp2.product_id
                    JOIN categories ON products.id_category = categories.id 
                    JOIN brands ON products.id_brand = brands.id 
                    where products.id = $id");
                    $data["sub_data"]['list_img'] =  $this->__model->getRawModel("select * from images where id_product = $id");

                    $this->renderView('admin/layouts/admin_layout', $data);
                }
            } else {
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/products/');
            }
        } else {
            Response::redirect('admin/auth/login');
        }
    }

    public function updateTotalBillDetail()
    {
        $detail = $this->__model->getRawModel("select * from bill_detail");
        foreach ($detail as $key => $value) {
            $id = $value['id'];
            $product_id = $value['product_id'];
            $quantity = $value['quantity'];
            $price = $this->__model->getFirstRaw("select * from products where id = $product_id")['sale'];
            $total =  $quantity * $price;
            $this->__model->updateTableData('bill_detail', ['total' => $total], "id = $id");
        }
    }

    public function change_status($id = "")
    {
        if (!isLoginAdmin()) {
            Response::redirect('admin/auth/login');
            return;
        }

        if (!isPermission('products', 'update')) {
            App::$app->loadError('permission');
            return;
        }

        
        

        if (!empty($id)) {
            if(!is_numeric($id)){
                Session::setFlashData('msg', 'Truy cập không hợp lệ!');
                Session::setFlashData('msg_type', 'danger');
                Response::redirect('admin/products/');
                return;
            }
            $product = $this->__model->getFirstRaw("select * from products where id = " . $id);
            if (empty($product)) {
                Session::setFlashData('msg', 'Không tồn tại sản phẩm!');
                Session::setFlashData('msg_type', 'danger');
            } else {
                $dataUpdate = [
                    'status' => $product['status'] == 1 ? 2 : 1,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->__model->updateData($dataUpdate, "id = " . $id);
                if ($status) {
                    Session::setFlashData('msg', 'Cập nhập sản phẩm thành công!');
                    Session::setFlashData('msg_type', 'success');
                } else {
                    Session::setFlashData('msg', 'Cập nhập sản phẩm không thành công!');
                    Session::setFlashData('msg_type', 'danger');
                }
            }
        } else {
            Session::setFlashData('msg', 'Truy cập không hợp lệ!');
            Session::setFlashData('msg_type', 'danger');
        }
        Response::redirect('admin/products/');

    }

    public function phan_trang()
    {
        if(!isPost()){
            Response::redirect('admin/products');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $status = $_POST['status'];
        $type = $_POST['type'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $sort_by = $_POST['sort_by'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $per_page = _PER_PAGE_ADMIN;
        $indexPage = ($page - 1) * $per_page;

        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
        }

        if (!empty($category_id)) {
            if (!empty($condition)) {
                $condition .= " and id_category = $category_id";
            } else {
                $condition = "id_category = $category_id";
            }
        }

        if (!empty($brand_id)) {
            if (!empty($condition)) {
                $condition .= " and id_brand = $brand_id";
            } else {
                $condition = "id_brand = $brand_id";
            }
        }

        if (!empty($status)) {
            if (!empty($condition)) {
                $condition .= " and status = $status";
            } else {
                $condition = "status = $status";
            }
        }

        if (!empty($type)) {
            if (!empty($condition)) {
                $condition .= " and type = '$type'";
            } else {
                $condition = "type = '$type'";
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

        if (!empty($conditionBill)) {
            $conditionBill = " and $conditionBill";
        }

        $sortBy = "";
        if (!empty($sort_by)) {
            if ($sort_by == 1) {
                $sortBy = "name asc,";
            } else if ($sort_by == 2) {
                $sortBy = "name desc,";
            } else if ($sort_by == 3) {
                $sortBy = "temp2.da_ban desc,";
            } else if ($sort_by == 4) {
                $sortBy = "temp.con_hang desc,";
            }
        }

        if (!empty($condition)) {
            $condition = " having $condition";
        }
        $sql = "SELECT * FROM products LEFT JOIN (SELECT id_product,SUM(quantity) AS con_hang FROM products_size GROUP BY id_product) AS temp 
        ON products.id = temp.id_product LEFT JOIN (SELECT product_id,SUM(quantity) AS da_ban FROM bill_detail,bill where bill.id = bill_detail.bill_id $conditionBill
        and bill.id_order_status <> 4 GROUP BY product_id) AS temp2
        ON products.id = temp2.product_id $condition order by $sortBy create_at desc  limit $indexPage,$per_page";

        $products = $this->__model->getRawModel("SELECT * FROM products LEFT JOIN (SELECT id_product,SUM(quantity) AS con_hang FROM products_size GROUP BY id_product) AS temp 
        ON products.id = temp.id_product LEFT JOIN (SELECT product_id,SUM(quantity) AS da_ban FROM bill_detail,bill where bill.id = bill_detail.bill_id $conditionBill
        and bill.id_order_status <> 4 GROUP BY product_id) AS temp2
        ON products.id = temp2.product_id $condition order by $sortBy create_at desc  limit $indexPage,$per_page");

        $data = "";
        $i = 1;
        foreach ($products as $key => $product) {
            $id = $product['id'];
            $name = $product['name'];
            $img = $product['img'];
            $price = $product['price'];
            $sale = $product['sale'];

            $linkChangeStatus = _WEB_HOST_ROOT_ADMIN . '/products/change_status/' . $id;
            if (!isPermission('products', 'update')) {
                $linkChangeStatus = "";
            }
            $status = $product['status'] == 1 ? "<a href='$linkChangeStatus' class='btn btn-primary'>Mở bán</a>" : "<a href='$linkChangeStatus' class='btn btn-danger'>Ẩn</a>";

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

            $data .= "<tr>
          <td>$i</td>
            <td>$name</td>
            <td><img src='$linkImage' width='50' /></td>
            <td>$price</td>
            <td>$sale</td>
            <td>$category</td>
            <td>$brand</td>
            <td>$status</td>
            <td>$type</td>
            <td>$da_ban</td>
            <td>$so_luong</td>
            <td>$create_at</td>
            <td>$sql</td>
            <td>
            ";
            $i++;

            if (isPermission('products', 'add') || isPermission('products', 'update') || isPermission('products', 'delete')) {
                $data .= "<a href='$linkDetail' class='btn btn-primary btn-sm'>Chi tiết</a>";
            }

            if (isPermission('products', 'update')) {
                $data .= "<a href='$linkUpdate' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i> Sửa</a>";
            }
            $data .= "</td></tr>";

            // <td><a href='$linkDelete' onclick=\"return confirm('Bạn có thật sự muốn xóa!') \" class=\"btn btn-danger
            //     btn-sm\"><i class=\"fa fa-trash\"></i>
            //     Xóa</a></td>

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
            Response::redirect('admin/products');
            return;
        }
        $page = $_POST['page'];
        $keyword = $_POST['keyword'];
        $status = $_POST['status'];
        $type = $_POST['type'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];

        $condition = "";
        if (!empty($keyword)) {
            $condition = "name like '%$keyword%'";
        }

        if (!empty($category_id)) {
            if (!empty($condition)) {
                $condition .= " and id_category = $category_id";
            } else {
                $condition = "id_category = $category_id";
            }
        }

        if (!empty($brand_id)) {
            if (!empty($condition)) {
                $condition .= " and id_brand = $brand_id";
            } else {
                $condition = "id_brand = $brand_id";
            }
        }

        if (!empty($status)) {
            if (!empty($condition)) {
                $condition .= " and status = $status";
            } else {
                $condition = "status = $status";
            }
        }

        if (!empty($type)) {
            if (!empty($condition)) {
                $condition .= " and type = '$type'";
            } else {
                $condition = "type = '$type'";
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