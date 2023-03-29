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


    <div class="container-content mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>
                        STT
                    </td>
                    <td>
                        Tên sản phẩm
                    </td>
                    <td>
                        Giá tiền
                    </td>
                    <td>
                        Số lượng đã bán
                    </td>
                    <td>
                        Tổng tiền
                    </td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>