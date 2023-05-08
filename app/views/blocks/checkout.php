<!-- Breadcrumb Section End -->




<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>

                        <div class="alert alert-danger btn-block alert-checkout hidden">
                        </div>
                        <div class="checkout__input">
                            <p>Full Name<span>*</span></p>
                            <input type="text" name="fullname" value="<?php  echo $user["fullname"] ?>"
                                class="fullname-checkout">
                            <span class="error error-fullname-checkout">
                            </span>
                        </div>

                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address" placeholder="Address"
                                class="checkout__input__add address-checkout">
                            <span class="error error-address-checkout">
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone" value="<?php  echo $user['phone'] ?>"
                                        class="phone-checkout">
                                    <span class="error error-phone-checkout"></span>
                                </div>
                            </div>

                        </div>

                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input name="note" type="text" placeholder="Note..." class="note-checkout">
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
                                        style="display: flex; width: 80px;justify-content: end;padding: 0 0 0 20px;">$<?php echo $dsgh[$i]['totalSp'] ?></span>
                                </li>

                                <?php } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Total <span>$<?php echo $tongTien ?></span></li>
                            </ul>

                            <button class="site-btn" onclick="onCheckout(event)">PLACE ORDER</button>
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