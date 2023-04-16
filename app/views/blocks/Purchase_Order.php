<div class="container" style="min-height:80vh; margin:0 auto; min-width:1300px">
    <h1 style="text-align: center;
    margin: 20px;
">Purchase Order</h1>
    <div class="scrolltable">
        <table class="table align-middle mb-0 bg-white" style="min-height:60vh; width: 100%;">
            <thead class="bg-light">
                <tr>
                    <th class="w-20">Name</th>
                    <th class="w-20">Delivery Address</th>
                    <th class="w-10">Date Order</th>
                    <th class="w-20">Trang thai DH </th>
                    <th class="w-10">Total</th>
                    <th class="w-20">Actions</th>
                </tr>
            </thead>
            <tbody id="xemLaiHoaDon">
                <?php foreach($dshd as $hd):  ?>
                <?php  ?>




                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt=""
                                style="width: 45px; height: 45px; margin-right:10px;" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?php echo $hd["tenNN"] ?></p>
                                <p class="text-muted mb-0"><?php  echo $hd["sdt"] ?></p>
                            </div>
                        </div>
                    </td>
                    <td>

                        <p class="fw-normal mb-1"><?php echo $hd["diaChi"] ?></p>
                    </td>
                    <td>
                        <p class="mb-1"><?php echo $hd["dateOrder"]  ?></p>
                    </td>
                    <td><?php echo $hd["tt"]  ?></td>
                    <td>$<?php echo $hd["tongBill"] ?>
                    </td>
                    <td style="display:flex;">
                        <button onclick="huyDonHang(event)" type="button" class="btn btn-primary"
                            style="margin-right:12px">Hủy đơn hàng</button>
                        <a href="#" style="margin:10px;">Detail</a>
                        <input class="idDH" style="display:none;" type="text" value="<?php echo $hd["idDH"]  ?>">

                    </td>
                </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>