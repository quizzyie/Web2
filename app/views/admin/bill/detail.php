<?php
$total = 0;
foreach ($bill_detail as $key => $value) {
    $total += $value['total'];
}
?>

<div class="container">
    <div><b>Họ tên: </b><?php echo $bill['resipient_name'] ?></div>
    <div><b>Số điện thoại: </b><?php echo $bill['resipient_phonenumber'] ?></div>
    <div><b>Địa chỉ: </b><?php echo $bill['delivery_address'] ?></div>
    <div><b>Ghi chú: </b><?php echo $bill['note'] ?></div>
    <div><b>Trạng thái: </b><?php echo $bill['status_name'] ?></div>
    <div><b>Tổng tiền: </b><?php echo $total ?></div>
    <div><b>Thời gian: </b><?php echo $bill['create_at'] ?></div>

    <hr>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Kích thước</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($bill_detail as $key => $value) {
                $product_name = $value['product_name'];
                $size_name = $value['size_name'];
                $sale = $value['sale'];
                $img = $value['img'];
                $quantity = $value['quantity'];
                $total = $value['total'];
                $linkImg = HOST_ROOT.'/uploads/'.$img;
                echo "<tr>
                <td>$i</td>
                <td>$product_name</td>
                <td><img src='$linkImg' style='width:60px'/></td>
                <td>$size_name</td>
                <td>$sale</td>
                <td>$quantity</td>
                <td>$total</td>
                </tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
    <hr>
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/bill' ?>" class="btn btn-primary btn-sm">Quay lại</a>
</div>