<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="checkout/themHoaDon" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                        <h6 class="checkout__title">Billing Details</h6>

                        <div class="checkout__input">
                            <p>Full Name<span>*</span></p>
                            <input required type="text" name="fullname" value="<?php  echo $user["fullname"] ?>">
                        </div>

                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input required type="text" name="address" placeholder="Address"
                                class="checkout__input__add">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input pattern="^(03[2-9]|05[689]|07[06789]|08[1-9]|09[0-9]|01[2-9])+([0-9]{7})$"
                                        required type="text" name="phone" value="<?php  echo $user['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input required type="email" name="email" value="<?php echo $user['email']  ?>">
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input name="note" type="text"
                                placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                <?php for($i=0;$i<count($dsgh);$i++){  ?>
                                <li style="display: flex;">
                                    <?php echo ($i+1).". ".$dsgh[$i]["tenSp"]." - ".$dsgh[$i]["tenSize"]  ?>
                                    <span
                                        style="display: flex; width: 59px;padding: 0 0 0 20px;">$<?php echo $dsgh[$i]['totalSp'] ?></span>
                                </li>

                                <?php } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Total <span>$<?php echo $tongTien ?></span></li>
                            </ul>

                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- Footer Section Begin -->

<!-- Footer Section End -->

<!-- Search Begin -->

<!-- Search End -->