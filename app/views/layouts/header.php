<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo !empty($title) ? $title : false ?></title>


    <!-- danh cho header slide vs single -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/styles/bootstrap4/bootstrap.min.css?ver=<?php echo rand() ?>">
    <link href="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/font-awesome-4.7.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/OwlCarousel2-2.2.1/owl.carousel.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/OwlCarousel2-2.2.1/owl.theme.default.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/OwlCarousel2-2.2.1/animate.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/themify-icons/themify-icons.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/jquery-ui-1.12.1.custom/jquery-ui.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/styles/single_styles.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo HOST_ROOT ?>/public/assets/client/single/styles/single_responsive.css?ver=<?php echo rand() ?>">
    <script defer
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/js/jquery-3.2.1.min.js?ver=<?php echo rand() ?>">
    </script>
    <script
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/styles/bootstrap4/popper.js?ver=<?php echo rand() ?>">
    </script>
    <script
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/styles/bootstrap4/bootstrap.min.js?ver=<?php echo rand() ?>">
    </script>
    <script
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/Isotope/isotope.pkgd.min.js?ver=<?php echo rand() ?>">
    </script>
    <script defer src="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/OwlCarousel2-2.2.1/owl.carousel.js">
    </script>
    <script defer
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/easing/easing.js?ver=<?php echo rand() ?>">
    </script>
    <script defer
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/plugins/jquery-ui-1.12.1.custom/jquery-ui.js">
    </script>
    <script defer
        src="<?php echo HOST_ROOT ?>/public/assets/client/single/js/single_custom.js?ver=<?php echo rand() ?>">
    </script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/bootstrap.min.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/font-awesome.min.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/elegant-icons.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/magnific-popup.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/nice-select.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/owl.carousel.min.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo HOST_ROOT ?>/public/assets/client/css/slicknav.min.css?ver=<?php echo rand() ?>"
        type="text/css">
    <link rel="stylesheet" href="<?php echo HOST_ROOT ?>/public/assets/client/css/style.css?ver=<?php echo rand() ?>"
        type="text/css">


</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img
                    src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/search.png" alt=""></a>
            <a href="#"><img src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/cart.png" alt="">
                <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <!-- <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#">Sign in</a>
                                <a href="#">FAQs</a>
                            </div>
                            <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>USD</li>
                                    <li>EUR</li>
                                    <li>USD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="top_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top_nav_left">free shipping on all u.s orders over $50</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="top_nav_right">
                            <ul class="top_nav_menu">

                                <!-- Currency / Language / My Account -->


                                <li class="account">
                                    <a href="#">
                                        <?php 
                                            if(Session::getSession("id_user")){
                                                $id = Session::getSession("id_user");
                                                $userQuery = $this->__model->getFirstRaw("select * from users where id = ".$id);
                                                echo "Hello ".$userQuery['fullname'];
                                            }
                                        ?>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="account_selection">
                                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="<?php echo HOST_ROOT ?>/public/assets/client/img/logo.png"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shop.html">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img
                                src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/heart.png"
                                alt=""></a>
                        <a href="#"><img src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/cart.png" alt="">
                            <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->