<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>SIZE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dsgh">
                            <?php 
                            if(!empty($dsgh)){
                            foreach($dsgh as $sp): ?>
                            <tr class="ghsp">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="<?php echo HOST_ROOT ?>/uploads/<?php  echo $sp['image'] ?>" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6><?php echo $sp['tenSp']." - ".$sp['tenSize'] ?></h6>
                                        <h5>$<?php echo $sp['giaSp'] ?></h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <span onclick="giamSlgMua(event)"
                                                class="fa fa-angle-left giam qtybtn "></span>
                                            <input class="slg" disabled="disabled" type="text" value="<?php echo $sp['slm'] ?>">
                                            <input class="giaSp" type="hidden" value="<?php echo $sp['giaSp'] ?>">
                                            <span onclick="tangSlgMua(event, <?php echo $sp['slgSp'] ?>)"
                                                class="fa fa-angle-right tang qtybtn"></span>
                                        </div>
                                        <input class="idsp" type="hidden" value="<?php echo $sp['idsp'] ?>">
                                        <input class="idsize" type="hidden" value="<?php echo $sp['idSize'] ?>">
                                    </div>
                                </td>

                                <td class="cart__price">$<?php echo ($sp['giaSp']*$sp['slm'])  ?></td>
                                <td><?php echo $sp["tenSize"]  ?></td>

                                <td onclick="remove(<?php echo $sp['idsp'] ?>,<?php echo $sp['idSize'] ?>)"
                                    class="cart__close"><i class="fa fa-close"></i></td>
                                    </tr>
                            <?php endforeach;} ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="<?php echo HOST_ROOT ?>/shop">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a onclick="updateCart()"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$ 169.50</span></li>
                        <li>Total <span id="tongTienGH">$ <?php echo $tongTien ?></span></li>
                    </ul>
                    <a href="<?php echo HOST_ROOT ?>/checkout" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->