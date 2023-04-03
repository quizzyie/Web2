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
    <link rel="stylesheet" href="<?php echo HOST_ROOT ?>/public/assets/client/css/custom.css?ver=<?php echo rand() ?>"
        type="text/css">
    <script src="<?php echo HOST_ROOT ?>/public/assets/client/js/custom.js?ver=<?php echo rand() ?>" defer></script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>

    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->

    <!-- Header Section End -->


    <header class="header trans_300">

        <!-- Top Navigation -->

        <div class="top_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top_nav_left"><?php
                                                    $msgAlert = Session::getFlashData('msg');
                                                    echo !empty($msgAlert) ? $msgAlert : "free shipping on all u.s orders over $50";
                                                    ?></div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="top_nav_right">
                            <ul class="top_nav_menu">

                                <!-- Currency / Language / My Account -->
                                <li class="account">
                                    <a href="#">
                                        <?php
                                        if (isLogin()) {
                                            echo "Hi, " . getNameLogin();
                                        } else {
                                            echo "My Account";
                                        }
                                        ?>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <?php
                                    if (isLogin()) {
                                    ?>
                                    <ul class="account_selection">
                                        <li><a href="<?php echo HOST_ROOT . '/auth/user_info' ?>"><i class=" fa fa-user"
                                                    aria-hidden="true"></i>Thông tin</a>
                                        </li>
                                        <li><a href="<?php echo HOST_ROOT . '/auth/change_password' ?>"><i
                                                    class=" fa fa-user" aria-hidden="true"></i>Đổi mật khẩu</a>
                                        </li>
                                        <li><a href="#" onclick="onLogout()"><i class="fa fa-arrow-left"
                                                    aria-hidden="true"></i>Đăng xuất</a>
                                        </li>
                                    </ul>
                                    <?php
                                    } else {
                                    ?>
                                    <ul class="account_selection">
                                        <li><a href="#" onclick="onLogin()"><i class="fa fa-sign-in"
                                                    aria-hidden="true"></i>Đăng nhập</a></li>
                                        <li><a href="#" onclick="onRegister()"><i class="fa fa-user-plus"
                                                    aria-hidden="true"></i>Đăng kí</a>
                                        </li>
                                    </ul>
                                    <?php
                                    }
                                    ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->

        <div class="main_nav_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <div class="logo_container">
                            <a href="<?php echo HOST_ROOT ?>">colo<span>shop</span></a>
                        </div>
                        <nav class="navbar">
                            <ul class="navbar_menu">
                                <li><a href="#">home page</a></li>
                                <li><a href="#">shop</a></li>
                                <li><a href="#">promotion</a></li>
                                <li><a href="#">pages</a></li>
                                <li><a href="#">blog</a></li>
                                <li><a href="contact.html">contact</a></li>
                            </ul>
                            <ul class="navbar_user">
                                <li><a href="#"><i class="fa fa-search search-switch" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                                <li class="checkout">
                                    <a href="<?php echo HOST_ROOT ?>/cartController">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="hamburger_container">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

    </header>

    <div class="fs_menu_overlay"></div>
    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">


                <li class="menu_item has-children">
                    <a href="#">
                        <?php
                        if (isLogin()) {
                            echo "Hi, <span>" . getNameLogin() . '</span>';
                        } else {
                            echo "My Account";
                        }
                        ?>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <?php
                    if (isLogin()) {
                    ?>
                    <ul class="menu_selection">
                        <li class=""><a href="<?php echo HOST_ROOT . '/auth/user_info' ?>"><i class=" fa fa-user"
                                    aria-hidden="true"></i>Thông tin</a>
                        <li class=""><a href="<?php echo HOST_ROOT . '/auth/change_password' ?>"><i class=" fa fa-user"
                                    aria-hidden="true"></i>Đổi mật khẩu</a>
                        </li>
                        <li class=""><a href="#" onclick="onLogout()"><i class="fa fa-arrow-left"
                                    aria-hidden="true"></i>Đăng
                                xuất</a>
                        </li>
                    </ul>
                    <?php
                    } else {
                    ?>
                    <ul class="menu_selection">
                        <li class=""><a href="#" onclick="onLogin()"><i class="fa fa-sign-in"
                                    aria-hidden="true"></i>Đăng
                                nhập</a></li>
                        <li class=""><a href="#" onclick="onRegister()"><i class="fa fa-user-plus"
                                    aria-hidden="true"></i>Đăng
                                kí</a>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                </li>

                <li class="menu_item"><a href="#">home</a></li>
                <li class="menu_item"><a href="#">shop</a></li>
                <li class="menu_item"><a href="#">promotion</a></li>
                <li class="menu_item"><a href="#">pages</a></li>
                <li class="menu_item"><a href="#">blog</a></li>
                <li class="menu_item"><a href="#">contact</a></li>
            </ul>
        </div>
    </div>
    <!-- Deal of the week -->

    <!-- link host root -->
    <input type="hidden" class="url_hoot_root" value="<?php echo HOST_ROOT ?>">
    <!-- form login register -->
    <div class="container-form container-form-login" onclick="onOutsideLogin(event)">
        <div class="container form-main-login border"
            style="max-width: 600px; padding: 30px 20px; border-radius: 20px; margin: 0 auto;background-color: white;">
            <div class="form">
                <h3 class="text-center">Đăng nhập</h3>
                <div class="alert alert-danger mt-1 hidden"></div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input spellcheck="false" type="text" class="form-control email">
                    <span class="error error-email"></span>

                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input spellcheck="false" type="password" class="form-control password">
                    <span class="error error-password"></span>
                </div>
                <div class="">
                    <button class="btn btn-primary btn-block" onclick="checkLogin()">Đăng nhập</button>
                </div>
                <div class="text-center">
                    <a href="#" onclick="onForgot()" class="center-block">Quên mật khẩu</a>
                </div>
                <hr>
                <div>
                    <button class="btn btn-success btn-sm" onclick="onRegister()">Đăng kí</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-form container-form-register" onclick="onOutsideRegister(event)">
        <div class="container form-main-register border"
            style="max-width: 600px; padding: 30px 20px; border-radius: 20px; margin: 0 auto;background-color: white;">
            <div class="form">
                <h3 class="text-center">Đăng kí</h3>
                <div class="alert alert-danger mt-1 hidden"></div>
                <div class="form-group">
                    <label for="">Họ tên</label>
                    <input spellcheck="false" type="text" class="form-control fullname">
                    <span class="error error-fullname"></span>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input spellcheck="false" type="text" class="form-control email">
                    <span class="error error-email"></span>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input spellcheck="false" type="text" class="form-control phone">
                    <span class="error error-phone"></span>
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input spellcheck="false" type="password" class="form-control password">
                    <span class="error error-password"></span>
                </div>
                <div class="form-group">
                    <label for="">Nhập lại mật khẩu</label>
                    <input spellcheck="false" type="password" class="form-control confirm_password">
                    <span class="error error-confirm_password"></span>
                </div>

                <div>
                    <button class="btn btn-primary btn-block" onclick="checkRegister()">Đăng kí</button>
                </div>
                <hr>
                <div class="">
                    <button class="btn btn-success btn-sm" onclick="onLogin()">Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-form container-form-forgot" onclick="onOutsideForgot(event)">
        <div class="container form-main-forgot border"
            style="max-width: 600px; padding: 30px 20px; border-radius: 20px; margin: 0 auto;background-color: white;">
            <div class="form">
                <h3 class="text-center">Đặt lại mật khẩu</h3>
                <div class="alert alert-danger mt-1 hidden"></div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input spellcheck="false" type="text" class="form-control email">
                    <span class="error error-email"></span>
                </div>

                <div class="centered">
                    <button class="btn btn-primary btn-block" onclick="checkForgot()">Xác nhận</button>
                </div>
                <hr>
                <div class="">
                    <button class="btn btn-success btn-sm" onclick="onLogin()">Đăng nhập</button>
                    <button class="btn btn-danger btn-sm" onclick="onRegister()">Đăng kí</button>
                </div>
            </div>
        </div>
    </div>