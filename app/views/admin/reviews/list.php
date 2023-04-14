<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>

        <hr>
        <div class=" row">
            <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/reviews' ?>">
            <div class="col-2">
                <select class="form-control status">
                    <option value="0">Chọn trạng thái</option>
                    <option value="1">
                        Ẩn</option>
                    <option value="2">
                        Hiển thị</option>
                    ?>
                </select>
            </div>
            <div class="col-2">
                <select class="form-control star">
                    <option value="0">Chọn số sao</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    ?>
                </select>
            </div>
            <div class="col-3">
                <select class="form-control product_id">
                    <option value="0">Chọn sản phẩm</option>
                    <?php 
                    foreach ($products as $key => $value) {
                        $id = $value['id'];
                        $name = $value['name'];
                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <input class="form-control email" placeholder="Nhập vào email khách hàng..">
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block btn-search">Tìm kiếm</button>
            </div>
        </div>

        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="">Họ tên</th>
                    <th width="">Email</th>
                    <th width="">Sản phẩm</th>
                    <th width="">Số sao</th>
                    <th width="">Bình luận</th>
                    <th width="">Trạng thái</th>
                    <th width="">Ghi chú</th>
                    <th width="">Thời gian</th>

                    <?php 
                    if(isPermission('reviews','update')){
                        echo '<th width="">Sửa</th>';
                    }
                    if(isPermission('reviews','delete')){
                        echo '<th width="">Xóa</th>';
                        
                    }
                    ?>

                </tr>
            </thead>
            <tbody class="fetch-data-table">

            </tbody>
        </table>
        <div class="fetch-pagination">
            <!-- render pagination -->
        </div>

    </div>
</section>