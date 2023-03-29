<input type="hidden" class="url_module_size" value="<?php echo _WEB_HOST_ROOT_ADMIN . '/sizes/get_options' ?>">
<!-- đường dẫn để fetch data sizes -->
<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg, 'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN . '/products/post_update' ?>">
        <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <input class="form-control" type="text" name="name" placeholder="Nhập tên sản phẩm"
                value="<?php echo empty($dataForm['name']) ? false : $dataForm['name'] ?>">
            <?php empty($errors['name']) ? false : getMsgErr($errors, 'name') ?>
        </div>
        <div class="form-group">
            <label for="">Hình ảnh hiển thị</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="img" placeholder="Hình ảnh hiển thị ..." class="form-control image-render"
                        value="<?php echo empty($dataForm['img']) ? false : $dataForm['img'] ?>">
                    <?php empty($errors['img']) ? false : getMsgErr($errors, 'img') ?>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="">Giá sản phẩm</label>
                <input class="form-control" type="text" name="price" placeholder="Nhập giá sản phẩm"
                    value="<?php echo empty($dataForm['price']) ? false : $dataForm['price'] ?>">
                <?php empty($errors['price']) ? false : getMsgErr($errors, 'price') ?>
            </div>
            <div class="form-group col-6">
                <label for="">Giá KM sản phẩm</label>
                <input class="form-control" type="text" name="sale" placeholder="Nhập giá KM sản phẩm"
                    value="<?php echo empty($dataForm['sale']) ? false : $dataForm['sale'] ?>">
                <?php empty($errors['sale']) ? false : getMsgErr($errors, 'sale') ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="">Danh mục sản phẩm</label>
                <select class="form-control" name="id_category" id="">
                    <option value="0">Chọn danh mục sản phẩm</option>
                    <?php
                    foreach ($list_category as  $cate) {
                        $id = $cate['id'];
                        $name = $cate['name'];
                        $selected = !empty($dataForm['id_category']) && $dataForm['id_category'] == $id  ? "selected" : false;
                        echo "<option $selected value=" . $id . ">$name</option>";
                    }
                    ?>
                </select>
                <?php empty($errors['id_category']) ? false : getMsgErr($errors, 'id_category') ?>
            </div>
            <div class="form-group col-6">
                <label for="">Thương hiệu</label>
                <select class="form-control" name="id_brand" id="">
                    <option value="0">Chọn thương hiệu</option>
                    <?php
                    foreach ($list_brand as  $brand) {
                        $id = $brand['id'];
                        $name = $brand['name'];
                        $selected = !empty($dataForm['id_brand']) && $dataForm['id_brand'] == $id  ? "selected" : false;
                        echo "<option $selected value=" . $id . ">$name</option>";
                    }
                    ?>
                </select>
                <?php empty($errors['id_brand']) ? false : getMsgErr($errors, 'id_brand') ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="">Trạng thái</label>
                <select class="form-control" name="status" id="">
                    <option <?php echo !empty($dataForm['status']) && $dataForm['status'] == 1  ? "selected" : false ?>
                        value="1">Mở bán</option>
                    <option <?php echo !empty($dataForm['status']) && $dataForm['status'] == 2  ? "selected" : false ?>
                        value="2">Ẩn</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="">Tình trạng</label>
                <select class="form-control" name="type" id="">
                    <option
                        <?php echo !empty($dataForm['type']) && $dataForm['type'] == 'normal'  ? "selected" : false ?>
                        value="normal">Bình thường</option>
                    <option <?php echo !empty($dataForm['type']) && $dataForm['type'] == 'new'  ? "selected" : false ?>
                        value="new">Sản phẩm mới</option>
                    <option <?php echo !empty($dataForm['type']) && $dataForm['type'] == 'sale'  ? "selected" : false ?>
                        value="sale">Khuyến mãi</option>
                </select>
                <?php empty($errors['id_brand']) ? false : getMsgErr($errors, 'id_brand') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="">Mô tả sản phẩm</label>
            <textarea name="description" placeholder="Mô tả sản phẩm" class="editor" cols="30"
                rows="10"><?php echo empty($dataForm['description']) ? false : $dataForm['description'] ?></textarea>
            <?php empty($errors['description']) ? false : getMsgErr($errors, 'description') ?>
        </div>
        <h6>Danh sách hình ảnh</h6>

        <div class="group-image">
            <?php
            if (!empty($dataForm['image'])) {
                foreach ($dataForm['image'] as $key => $image) {
                    ?>
            <div class="image">
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">

                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                                        class="form-control image-render" value="<?php echo $image ?>">
                                    <?php echo !empty($errors_form['image']) && !empty($errors_form['image'][$key]) ?  getErrForm($errors_form['image'][$key]) : false ?>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-danger btn-block delete-image"><i class="fas fa-trash"></i></button>
                    </div>

                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-image">Thêm hình ảnh</button>
        <hr>
        <h6>Danh sách size và số lượng</h6>

        <div class="group-size">
            <?php
            if (!empty($dataForm['size'])) {
                foreach ($dataForm['size'] as $key => $size) {
                    $quantity = $dataForm['quantity'][$key];
            ?>
            <div class="size">
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <select name="size[]" class="select-form select-fill form-control">
                                        <option value='0'>Vui lòng chọn kích thước</option>
                                        <?php
                                                foreach ($group_size as $item) {
                                                    $id = $item['id'];
                                                    $name = $item['name'];
                                                    $checked = $id == $size ? 'selected' : false;
                                                    echo "<option $checked value='$id'>$name</option>";
                                                }
                                                ?>
                                    </select>
                                    <?php echo !empty($errors_form['size']) && !empty($errors_form['size'][$key]) ?  getErrForm($errors_form['size'][$key]) : false ?>
                                </div>
                                <div class="col-6">
                                    <input type="text" name="quantity[]" class="form-control"
                                        placeholder="Nhập vào số lượng" value="<?php echo $quantity ?>" />
                                    <?php echo !empty($errors_form['quantity']) && !empty($errors_form['quantity'][$key]) ?  getErrForm($errors_form['quantity'][$key]) : false ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-danger btn-block delete-size"><i class="fas fa-trash"></i></button>
                    </div>

                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-size">Thêm size</button>
        <hr>
        <button type="submit" class="btn btn-primary">Cập nhập sản phẩm</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/products' ?>">Quay lại</a></p>

    </form>
</div>