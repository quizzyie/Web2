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
                <div class="small-box bg-warning">
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


<script>
// async function fetchChartCircle() {

//     let data = new URLSearchParams();
//     data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id')
//         .value :
//         "");
//     data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate')
//         .value :
//         "");
//     data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate')
//         .value :
//         "");
//     let response = await fetch('http://localhost:81/php/mvc_training/admin/statistics/fetchData', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: data.toString()
//     })
//     let jsonData = await response.json();
//     var barColors = [];
//     var xValues = [];
//     var yValues = [];
//     console.log(jsonData);
//     let total = 0;
//     jsonData.forEach(element => {
//         barColors.push(generateRandomColor());
//         xValues.push(element['name']);
//         yValues.push(element['so_luong'] ? element['so_luong'] : 0);
//         total += element['so_luong'] ? parseInt(element['so_luong']) : 0;
//     });

//     new Chart("myChart", {
//         type: "pie",
//         data: {
//             labels: xValues,
//             datasets: [{
//                 backgroundColor: barColors,
//                 data: yValues,
//             }, ],
//         },
//         options: {
//             title: {
//                 display: true,
//                 text: "Theo danh mục sản phẩm : " + total,
//             },
//         },
//     });
// }

// fetchChartCircle();

// var resetCanvas = function() {
//     $('#myChart').remove(); // this is my <canvas> element
//     $('.container-content').append(
//         '<canvas id="myChart" style="width: 50%; max-width: 600px"></canvas>'
//     );
//     $('#myChart2').remove(); // this is my <canvas> element
//     $('.container-content-2').append(
//         '<canvas id="myChart2"></canvas>'
//     );
// };

// document.querySelector(".btn-thongke").onclick = () => {
//     resetCanvas();
//     fetchChartCircle();
//     fetchChartBar();
//     fetchPagination(1)
//     fetchData(1)
// }



// async function fetchChartBar() {
//     let data = new URLSearchParams();
//     data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id')
//         .value :
//         "");
//     data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate')
//         .value :
//         "");
//     data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate')
//         .value :
//         "");


//     let response = await fetch('http://localhost:81/php/mvc_training/admin/statistics/fetchDataChartBar', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: data.toString()
//     })
//     let jsonData = await response.json();
//     console.log(jsonData);
//     const ctx = document.getElementById('myChart2');

//     let arrLabel = [];
//     let arrData = [];
//     let total = 0;
//     jsonData['arr_month'].forEach(element => {
//         arrLabel.push(element['col']);
//         arrData.push(element['value'] ? element['value'] : 0);
//         total += parseInt(element['value']);
//     });

//     new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: arrLabel,
//             datasets: [{
//                 label: '# quantity products : ' + total,
//                 data: arrData,
//                 borderWidth: 1,
//                 min: 0,
//             }]
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });
// }

// fetchChartBar();
</script>