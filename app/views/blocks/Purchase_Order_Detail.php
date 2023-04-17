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
                                <th>SIZE</th>
                                <th>QUANTITY</th>
                                <th>Total</th>


                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dsgh">
                            <?php 
                            if(!empty($dsCthd)){
                            foreach($dsCthd as $hd): ?>
                            <tr class="ghsp">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="<?php echo HOST_ROOT ?>/uploads/<?php  echo $hd['img'] ?>" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6><?php echo $hd['tenSP'] ?></h6>
                                    </div>
                                </td>
                                <td><?php echo $hd["tenSize"]  ?></td>

                                <td class="cart__price"><?php echo ($hd['quantity'])  ?></td>
                                <td class="cart__price">$<?php echo ($hd['total'])  ?></td>


                                <td> <a href="detail?idsp=<?php echo $hd['idSp'] ?>"><button class="btn btn-primary">Xem
                                            Chi tiet</button></a>
                                </td>
                            </tr>
                            <?php endforeach;} ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</section>