<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="<?php echo HOST_ROOT.'/public/assets/client/' ?>img/about/about-us.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Are ?</h4>
                    <p>Contextual advertising programs sometimes have strict policies that need to be adhered too.
                        Let’s take Google as an example.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Do ?</h4>
                    <p>In this digital generation where information can be easily obtained within seconds, business
                        cards still have retained their importance.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Why Choose Us</h4>
                    <p>A two or three storey house is the ideal way to maximise the piece of earth on which our home
                        sits, but for older or infirm people.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Testimonial Section End -->

<!-- Counter Section Begin -->
<section class="counter spad">
    <div class="container">
        <div class="row">
            <?php  if(!empty($ourClients)){ ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num"><?php echo $ourClients  ?></h2>
                    </div>
                    <span>Our <br />Clients</span>
                </div>
            </div>
            <?php  } ?>
            <?php  if(!empty($totalCategory)){ ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num"><?php  echo $totalCategory ?></h2>
                    </div>
                    <span>Total <br />Categories</span>
                </div>
            </div>
            <?php  } ?>
            <?php  if(!empty($generalCountry)){ ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num"><?php  echo $generalCountry ?></h2>
                    </div>
                    <span>In <br />Country</span>
                </div>
            </div>
            <?php  } ?>
            <?php  if(!empty($happyCustomer)){ ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <div class="counter__item__number">
                        <h2 class="cn_num"><?php  echo $happyCustomer ?></h2>
                        <strong>%</strong>
                    </div>
                    <span>Happy <br />Customer</span>
                </div>
            </div>
            <?php  } ?>
        </div>
    </div>
</section>
<!-- Counter Section End -->

<!-- Team Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <?php  if(!empty($ourTeam["heading_1"])){ ?>
                    <span><?php echo $ourTeam["heading_1"]  ?></span>
                    <?php  } ?>
                    <?php  if(!empty($ourTeam["heading_2"])){ ?>
                    <h2><?php echo $ourTeam["heading_2"]  ?></h2>
                    <?php  } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php  if(!empty($ourTeam["name"])){ ?>
            <?php for($i=0;$i<count($ourTeam["name"]);$i++) { ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="<?php echo HOST_ROOT ?>/uploads/<?php  echo $ourTeam["image"][$i] ?>" alt="">
                    <h4><?php echo $ourTeam["name"][$i]  ?></h4>
                    <span><?php echo $ourTeam["position"][$i]  ?></span>
                </div>
            </div>
            <?php } ?>
            <?php  } ?>
        </div>
    </div>
</section>
<!-- Team Section End -->

<!-- Client Section Begin -->
<section class="clients spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <?php  if(!empty($partner["heading_1"])){ ?>
                    <span><?php echo $partner["heading_1"] ?></span>
                    <?php  } ?>
                    <?php  if(!empty($partner["heading_2"])){ ?>
                    <h2><?php echo $partner["heading_2"] ?></h2>
                    <?php  } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php  if(!empty($partner["image"]) && !empty($partner["link"])){ ?>
            <?php for($i=0;$i<count($partner["image"]);$i++){  ?>
            <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                <a href="<?php echo $partner["link"][$i] ?>" class="client__item"><img
                        src="<?php echo HOST_ROOT ?>/uploads/<?php echo  $partner["image"][$i] ?>" alt=""></a>
            </div>
            <?php  } ?>
            <?php  } ?>
        </div>
    </div>
</section>