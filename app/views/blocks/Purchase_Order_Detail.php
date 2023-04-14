<h1 style="text-align:center">DETAIL ORDER</h1>
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                                          
                                            <input class="slg" disabled="disabled" type="text" value="<?php echo $sp['slm'] ?>">
                                            <input class="giaSp" type="hidden" value="<?php echo $sp['giaSp'] ?>">
                                           
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
                
            </div>
           
        </div>
    </div>
</section>