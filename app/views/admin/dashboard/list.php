<?php 
if(isPermission('dashboard','view')){
    ?>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 class="bill_quantity">150</h3>

                        <p>Đơn đặt hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 class="bill_quantity_cancel">53<sup style="font-size: 20px">%</sup></h3>

                        <p>Tỷ lệ hủy đơn</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning" style="color: white !important">
                    <div class="inner">
                        <h3 class="new_users">44</h3>

                        <p>Đăng kí mới</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 class="total_revenue">65</h3>

                        <p>Doanh thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
        </div>
</section>
<!-- /.content -->
<div style="max-width: 1200px;margin:0 auto; ">


    <div class="row">
        <input type="hidden" class="url_hoot_root" value="<?php echo HOST_ROOT ?>">
        <div class="col-4">
            Tìm kiếm sản phẩm
            <select class="form-control category_id">
                <option value="0">Lựa chọn danh mục sản phẩm</option>
                <?php 
                foreach ($categories as $key => $cate) {
                    $id = $cate['id'];
                    $name = $cate['name'];
                    echo "<option value='$id'>$name</option>";
                }
                ?>
            </select>
        </div>
        <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/statistics' ?>">
        <div class="col-3">Từ ngày<input type="date" class="form-control fromDate"></div>
        <div class="col-3">Đến ngày<input type="date" class="form-control toDate"></div>
        <div class="col-2">
            Thống kê
            <button class="btn btn-primary btn-block  btn-thongke ">Thống kê</button>
        </div>
    </div>


    <div class="row">
        <div class="container-content col-6" style="margin: 0 auto;">
            <canvas id="myChart" style="width: 50%; max-width: 600px"></canvas>
            <!-- <div class="table-statistic"></div> -->
        </div>

        <div class="col-6 container-content-2">
            <canvas id="myChart2"></canvas>
        </div>
    </div>

    <table class="table table-bordered text-center mt-5">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="">Tên</th>
                <th width="">Ảnh</th>
                <th width="">Giá bán</th>
                <th width="">Danh mục</th>
                <th width="">Đã bán</th>
                <th width="">Hàng còn</th>
                <th width="">Tổng tiền</th>
            </tr>
        </thead>
        <tbody class="fetch-data-table">

        </tbody>
    </table>
    <div class="fetch-pagination">
        <!-- render pagination -->
    </div>
</div>
<?php
}
?>