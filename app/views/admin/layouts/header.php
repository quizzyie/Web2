<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo !empty($title) ? $title : false ?> - Quản trị website</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="http://code.jquery.com/jquery-3.6.3.min.js" />
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> -->

    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/fontawesome.min.css?ver=<?php echo rand(); ?>" /> -->
    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=<?php echo rand(); ?>" /> -->

    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/css/style.css?ver=<?php echo rand(); ?>">

    <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/ckfinder/ckfinder.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <!-- ChartJS -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/chart.js/Chart.min.js" defer></script>
    <!-- Sparkline -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/sparklines/sparkline.js" defer></script>
    <!-- JQVMap -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/jqvmap/jquery.vmap.min.js" defer></script>
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/jqvmap/maps/jquery.vmap.usa.js" defer></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/jquery-knob/jquery.knob.min.js" defer></script>
    <!-- daterangepicker -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/moment/moment.min.js" defer></script>
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/daterangepicker/daterangepicker.js" defer></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/summernote/summernote-bs4.min.js" defer></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
    </script>
    <!-- AdminLTE App -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/js/adminlte.js" defer></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/js/pages/dashboard.js" defer></script>
    <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/ckeditor/ckeditor.js" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript">

    </script>
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/plugins/ion-rangeslider/js/ion.rangeSlider.min.js" defer>
    </script>
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/js/demo.js" defer></script>
    <script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/js/custom.js?ver=<?php echo rand() ?>" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- user -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        Hi, <?php echo empty(_NAME_USER_LOGIN)?false : _NAME_USER_LOGIN ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/users/user_info/' ?>" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Thông tin cá nhân
                        </a>
                        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/users/change_password/' ?>" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Đổi mật khẩu
                        </a>
                        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/auth/logout' ?>" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Đăng xuất
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <div class="content-wrapper" style="min-height: 458px;">
            <!-- /.navbar -->