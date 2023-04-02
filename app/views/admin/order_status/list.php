<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>
        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/order_status/add' ?>" class="btn btn-primary"><i
                class="fa fa-plus"></i>Thêm
            trạng thái</a>
        <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/order_status' ?>">
        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="">Trạng thái</th>
                    <th width="">Mô tả</th>
                    <th width="">Thời gian</th>
                    <th width="8%">Sửa</th>
                    <!-- <th width="8%">Xóa</th> -->
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