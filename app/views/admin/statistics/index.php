<div style="max-width: 1200px;margin:0 auto; ">
    <div class="title-container text-center">
        <h1>Thống kế sản phẩm bán chạy</h1>
    </div>

    <div class="row">
        <div class="col-4">
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
        <div class="col-3"><input type="date" class="form-control"></div>
        <div class="col-3"><input type="date" class="form-control"></div>
        <div class="col-2">
            <button class="btn btn-primary btn-block  btn-thongke">Thống kê</button>
        </div>
    </div>


    <div class="container-content" style="margin: 0 auto;">
        <canvas id="myChart" style="width: 50%; max-width: 600px"></canvas>
        <div class="table-statistic"></div>
    </div>

    <div>
        <canvas id="myChart2"></canvas>
    </div>
</div>


<script>
async function fetchChartCircle() {

    let data = new URLSearchParams();
    data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id')
        .value :
        "");
    let response = await fetch('http://localhost:81/php/mvc_training/admin/statistics/fetchData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    })
    let jsonData = await response.json();
    var barColors = [];
    var xValues = [];
    var yValues = [];
    console.log(jsonData);
    jsonData.forEach(element => {
        barColors.push(generateRandomColor());
        xValues.push(element['name']);
        yValues.push(element['so_luong'] ? element['so_luong'] : 0);
    });

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues,
            }, ],
        },
        options: {
            title: {
                display: true,
                text: "Theo danh mục sản phẩm",
            },
        },
    });
}

fetchChartCircle();

document.querySelector(".btn-thongke").onclick = () => {
    fetchChartCircle();
}


// const ctx = document.getElementById('myChart2');

// new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Red', 'Blue', 'Yellow', 'Green',
//             'Purple', ''
//         ],
//         datasets: [{
//             label: '# of Votes',
//             data: [20, 30, 66, 44, 33, 55, 30, 30, 66, 44, 33, 0],
//             borderWidth: 1,
//             min: 0,
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });
</script>