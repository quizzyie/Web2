<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <td width="25%">Tiêu đề</td>
                <td width="">Nội dung</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Tên sản phẩm: </b></td>
                <td><?php echo $product_detail['name'] ?></td>
            </tr>
            <tr>
                <td><b>Hình ảnh: </b></td>
                <td><img src="<?php echo HOST_ROOT.'/uploads/'.$product_detail['img'] ?>" style="width:100px" alt="">
                </td>
            </tr>
            <tr>
                <td><b>Mô tả : </b></td>
                <td><?php echo html_entity_decode($product_detail['description']) ?></td>
            </tr>
            <tr>
                <td><b>Giá : </b></td>
                <td><?php echo $product_detail['price'] ?></td>
            </tr>
            <tr>
                <td><b>Giá giảm : </b></td>
                <td><?php echo $product_detail['sale'] ?></td>
            </tr>
            <tr>
                <td><b>Danh mục : </b></td>
                <td><?php echo $product_detail['cate_name'] ?></td>
            </tr>
            <tr>
                <td><b>Thương hiệu : </b></td>
                <td><?php echo $product_detail['brand_name'] ?></td>
            </tr>
            <tr>
                <td><b>Trạng thái : </b></td>
                <td><?php echo $product_detail['status'] == 1 ? "Mở bán" : "Ẩn" ?></td>
            </tr>
            <tr>
                <td><b>Loại : </b></td>
                <td><?php echo $product_detail['type'] ?></td>
            </tr>
            <tr>
                <td><b>Đã bán : </b></td>
                <td><?php echo !empty($product_detail['da_ban']) ? $product_detail['da_ban'] : 0 ?></td>
            </tr>
            <tr>
                <td><b>Còn hàng : </b></td>
                <td><?php echo !empty($product_detail['con_hang']) ? $product_detail['con_hang'] : 0 ?></td>
            </tr>
            <tr>
                <td><b>Thời gian : </b></td>
                <td><?php echo $product_detail['create_at'] ?></td>
            </tr>
        </tbody>
    </table>

    <hr>
    <h5>Hình ảnh bổ sung</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>STT</td>
                <td>Hình ảnh</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($list_img as $key => $value) {
                ?>
            <tr>
                <td><?php echo $key +1 ?></td>
                <td><img src="<?php echo HOST_ROOT.'/uploads/'.$value['image'] ?>" style="width:100px" alt=""></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <hr>
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/products' ?>" class="btn btn-primary btn-sm mb-5">Quay lại</a>
    <br>
</div>