<div class="container" style="min-height:80vh; margin:0 auto; min-width:1300px">
    <h1 style="text-align: center;
    margin: 20px;
}">Purchase Order</h1>
    <div class="scrolltable">
    <table class="table align-middle mb-0 bg-white" style="min-height:60vh">
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

            

           
            <tr style="width:100%">
                <td style="width:30%">
                    <div class="d-flex align-items-center">
                        <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt=""
                            style="width: 45px; height: 45px; margin-right:10px;" />
                        <div class="ms-3">
                            <p class="fw-bold mb-1"><?php echo $hd["resipient_name"] ?></p>
                            <p class="text-muted mb-0"><?php  echo $hd["resipient_phonenumber"] ?></p>
                        </div>
                    </div>
                </td>
                <td style="width:30%">
                    <p class="fw-normal mb-1"><?php echo $hd["delivery_address"] ?></p>
                </td>
                <td style="width:20%">
                    <p class="mb-1"><?php echo $hd["create_at"]  ?></p>
                </td>
                <td style="width:10%">$<?php echo $hd["total_bill"] ?></td>
                <td style="width:10%;display:flex;" >
                <button type="button" class="btn btn-primary" style="margin-right:12px">Hủy đơn hàng</button>
                    <a href="#" style="margin:10px;">Detail</a>
                   
                </td>
            </tr>
            <?php endforeach  ?>
          
        </tbody>
    </table>
    </div>
</div>