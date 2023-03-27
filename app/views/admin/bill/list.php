<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>

        <hr>
        <div class="row">
            <div class="col-6">
                Từ ngày
                <input class="form-control fromDate" type="date">
            </div>
            <div class=" col-6">
                Đến ngày
                <input class="form-control toDate" type="date">
            </div>
        </div>
        <br>
        <div class=" row">
            <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/bill' ?>">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control status">
                        <option value="0">Chọn trạng thái</option>
                        <?php 
                foreach ($order_status as $key => $value) {
                    $id = $value['id'];
                    $name = $value['name'];
                    echo "<option value='$id'>$name</option>";
                }
                ?>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <input class="form-control keyword" placeholder="Nhập vào tên khách hàng..">

            </div>
            <div class="col-4">
                <input class="form-control phone" placeholder="Nhập vào sdt khách hàng..">
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
                    <th width="">Điện thoại</th>
                    <th width="">Địa chỉ</th>
                    <th width="">Ghi chú</th>
                    <th width="">Tổng tiền</th>
                    <th width="">Trạng thái</th>
                    <th width="">Thời gian</th>
                    <th width="">Chi tiết</th>
                    <th width="">Sửa</th>
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