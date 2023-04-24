  <!-- Hero Section Begin -->
  <section class="hero">
      <div class="hero__slider owl-carousel">
          <?php  foreach ($advertises as $ad): ?>
          <div class="hero__items set-bg" data-setbg="<?php echo HOST_ROOT ?>/uploads/<?php echo $ad["image"] ?>">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-5 col-lg-7 col-md-8">
                          <div class="hero__text">
                              <h6>Summer Collection</h6>
                              <h2>Fall - Winter Collections 2030</h2>
                              <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                  commitment to exceptional quality.</p>
                              <a href="shop" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                              <div class="hero__social">
                                  <a href="<?php echo $facebook["opt_value"] ?>"><i class="fa fa-facebook"></i></a>
                                  <a href="<?php echo $twitter["opt_value"] ?>"><i class="fa fa-twitter"></i></a>
                                  <a href="<?php echo $youtube["opt_value"] ?>"><i class="fa fa-youtube"></i></a>
                                  <a href="<?php echo $instagram["opt_value"] ?>"><i class="fa fa-instagram"></i></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php  endforeach ?>
      </div>
  </section>
  <!-- Hero Section End -->


  <section class="product spad banner spad" style="margin-top: 50px;">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <ul class="filter__controls">
                      <li class="active" data-filter="*">Best Sellers</li>
                      <li data-filter=".new-arrivals">New Arrivals</li>
                      <li data-filter=".hot-sales">Hot Sales</li>
                  </ul>
              </div>
          </div>


          <div class="row product__filter">
              <?php foreach($dsBSeller as $sp){  ?>
              <?php if (in_array($sp["id"], array_column($dsNewArrival, "id")) &&in_array($sp["id"],array_column($dsBSale, "id")) ) {?>
              <?php echo "<div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals hot-sales'>" ?>
              <?php  }else if(in_array($sp["id"], array_column($dsNewArrival, "id"))){?>
              <?php echo "<div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals '>" ?>
              <?php   }else if(in_array($sp["id"], array_column($dsBSale, "id"))){ ?>
              <?php echo "<div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales'>" ?>
              <?php  }else{?>
              <?php echo "<div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix '>" ?>
              <?php  } ?>

              <div class="product__item">
                  <div class="product__item__pic set-bg"
                      data-setbg="<?php echo HOST_ROOT ?>/uploads/<?php echo $sp["img"]  ?>">
 <?php if($sp["type"]!="normal"){  ?>
                      <span class="label"><?php echo $sp["type"]  ?></span>

                      <?php }  ?>
                  </div>
                  <div class="product__item__text">
                      <h6><?php echo $sp["name"]  ?></h6>
                      <a href="detail?idsp=<?php echo $sp['id'] ?>" data-product-id="<?php echo $sp['id'] ?>">+ SEE
                          DETAIL</a>
                      <div class="rating">
                          <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                      </div>
                      <?php if( $sp["price"] -  $sp["sale"] == 0 ){?>
                      <h5>$<?php echo $sp["price"]  ?></h5>
                      <?php   }else{ ?>
                      <div style="display: flex;">
                          <del class="del-product">$<?php echo $sp["price"]  ?></del>
                          <h5>$<?php echo $sp["sale"]  ?></h5>
                      </div>

                      <?php   } ?>

                  </div>
              </div>
          </div>
          <?php  } ?>
      </div>
      </div>
  </section>

  <!-- Categories Section Begin -->

  <!-- Categories Section End -->

  <!-- Instagram Section Begin -->
  <section class="instagram latest spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-8">
                  <div class="instagram__pic">
                      <div class="instagram__pic__item set-bg"
                          data-setbg="<?php echo HOST_ROOT ?>/public/assets/client/img/instagram/instagram-1.jpg"></div>
                      <div class="instagram__pic__item set-bg"
                          data-setbg="<?php echo HOST_ROOT ?>/public/assets/client/img/instagram/instagram-2.jpg"></div>
                      <div class="instagram__pic__item set-bg"
                          data-setbg="<?php echo HOST_ROOT ?>/public/assets/client/img/instagram/instagram-3.jpg"></div>
                      <div class="instagram__pic__item set-bg"
                          data-setbg="<?php echo HOST_ROOT ?>/public/assets/client/img/instagram/instagram-4.jpg"></div>
                      <div class="instagram__pic__item set-bg"
                          data-setbg="<?php echo HOST_ROOT ?>/public/assets/client/img/instagram/instagram-5.jpg"></div>
                      <div class="instagram__pic__item set-bg"
                          data-setbg="<?php echo HOST_ROOT ?>/public/assets/client/img/instagram/instagram-6.jpg"></div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="instagram__text">
                      <h2>Instagram</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                          labore et dolore magna aliqua.</p>
                      <h3>#Male_Fashion</h3>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Instagram Section End -->