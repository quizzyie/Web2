<div class="container">
    <h1>Purchase Order</h1>
    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Delivery Address</th>
                <th>Date Order</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dshd as $hd):  ?>
            <?php  ?>


            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt=""
                            style="width: 45px; height: 45px" />
                        <div class="ms-3">
                            <p class="fw-bold mb-1"><?php echo $hd["resipient_name"] ?></p>
                            <p class="text-muted mb-0"><?php  echo $hd["resipient_phonenumber"] ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1"><?php echo $hd["delivery_address"] ?></p>
                </td>
                <td>
                    <p class="mb-1"><?php echo $hd["create_at"]  ?></p>
                </td>
                <td>$<?php echo $hd["total_bill"] ?></td>
                <td>
                    <a href="#">Detail</a>
                    <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">

                    </button>
                </td>
            </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
</div>