<!-- Breadcrumb Section Begin -->
<style>

</style>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">

                        <div style="position:relative;">
                            <input id="search" type="text" placeholder="Search..." style="width: 100%;
    font-size: 15px;
    color: black;
    padding-left: 20px;
    border: 1px solid black;
    height: 42px;">
                            <button onclick="filter(event)" type="button" style="color: black;
    font-size: 15px;
    border: none;
    background: transparent;
    position: absolute;
    right: 0;
    padding: 0 15px;
    top: 0;
    height: 100%;"><span class="icon_search"></span></button>
                        </div>

                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading active">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div id="CategoryList" class="shop__sidebar__categories">

                                            <?php foreach ($dsCategories as $l) : ?>

                                            <input id="loai<?php echo $l['id'] ?>" type="checkbox" name="categories"
                                                value="<?php echo $l['id'] ?>">
                                            <label for="loai<?php echo $l['id'] ?>"><?php echo $l['name'] ?></label>
                                            <br>
                                            <?php endforeach ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading active">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div id="BrandList" class="shop__sidebar__brand">
                                            <?php foreach($dsBrands as $th): ?>
                                            <input id="brand<?php  echo $th['id'] ?>" type="checkbox" name="brands"
                                                value="<?php echo $th['id'] ?>">
                                            <label for="brand<?php echo $th['id'] ?>"><?php echo $th['name'] ?></label>
                                            <br>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading active">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price" style="display: flex;
                                                            width: 100%;  justify-content: center;
                                                                align-items: center;">

                                            <div class="field">

                                                <input type="number" class="input-min" value="0">
                                            </div>
                                            <div class="separator"></div>
                                            <div class="field">
                                                <input type="number" class="input-max" value="10000">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="10000" value="0" step="100">
                                        <input type="range" class="range-max" min="0" max="10000" value="10000"
                                            step="100">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading active">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div id="SizeList" class="shop__sidebar__size">
                                            <?php foreach ($dsSizes as $s) : ?>
                                            <label class="lblSize"><?php echo $s['name'] ?>
                                                <input type="checkbox" name="sizes" value="<?php echo $s['id'] ?>">
                                            </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p id="showslg">Showing 1 – 2 of <?php echo $tongSp ?> results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">



                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select id="sort" onchange="filter(0)">
                                    <option value="1">Low To High</option>
                                    <option value="2">High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dsProducts" class="row">
                    <?php 
                    
                        $i = 0;
                        foreach($dsProducts as $sp): 
                        $linkImage = HOST_ROOT .'/uploads/'.$sp['img'];
                    ?>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <a href="detail?idsp=<?php echo $sp['id'] ?>" data-product-id="<?php echo $sp['id'] ?>">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo $linkImage ?>"
                                    style="background-image: url('<?php echo $linkImage ?>');">
                                    <?php if ($sp["type"] != "normal") {  ?>
                                    <span class="label"><?php echo $sp["type"]  ?></span>

                                    <?php }  ?>

                                </div>
                            </a>
                            <div class="product__item__text">
                                <h6><?php echo $sp['name'] ?></h6>
                                <a href="detail?idsp=<?php echo $sp['id'] ?>"
                                    data-product-id="<?php echo $sp['id'] ?>">+ SEE DETAIL</a>
                                <div class="rating">
                                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                                    <?php if ($j <= $dsStar[$i]) { ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php } else { ?>
                                    <i class="fa fa-star-o"></i>
                                    <?php } ?>
                                    <?php }  ?>
                                    <?php $i++ ?>

                                </div>
                                <div class="product-price">
                                    <?php if ($sp['sale'] < $sp['price']) {  ?>
                                    <del class="del-product"><?php echo $sp['price'] ?></del>

                                    <span>
                                        <h5> <?php echo $sp['sale'] ?></h5>
                                    </span>
                                    <?php } else {   ?>
                                    <h5>$<?php echo $sp['sale'] ?></h5>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="soTrang" class="product__pagination">
                            <?php for ($i = 1; $i <= $soTrang; $i++) :
                                $vt = $i - 1; ?>
                            <?php if ($vt == 0) : ?>
                            <a onclick="filter( <?php echo $vt ?>)" class="active">
                                <?php echo $i ?> </a>
                            <?php endif ?>
                            <?php if ($vt != 0) : ?>
                            <a onclick="filter(<?php echo $vt ?>)"> <?php echo $i ?>
                            </a>
                            <?php endif ?>
                            <?php endfor ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
<!-- Shop Section End -->
<script>

</script>