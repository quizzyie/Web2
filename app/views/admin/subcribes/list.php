<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>

        <hr>
        <div class=" row">
            <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/subcribes' ?>">
            <div class="col-5">
                <select class="form-control status">
                    <option value="0">Chọn trạng thái</option>
                    <option value="1">Chưa xử lý</option>
                    <option value="2">Đang xử lý</option>
                    <option value="3">Đã xử lý</option>
                </select>
            </div>
            <div class="col-5">
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
                    <th width="">Email</th>
                    <th width="">Trạng thái</th>
                    <th width="">Ghi chú</th>
                    <th width="">Thời gian</th>
                    <?php 
                    if(isPermission('contacts','update')){
                        echo '<th width="">Sửa</th>';
                    }
                    if(isPermission('contacts','delete')){
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