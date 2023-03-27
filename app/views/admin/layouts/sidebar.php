<?php
//   $userId = isLogin()['user_id'];
//   $userDetail = getUserInfo($userId);
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// die();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>" class="brand-link">
        <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-uppercase">Radix Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">

                    <?php echo empty(_NAME_USER_LOGIN) ? false : _NAME_USER_LOGIN ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview <?php echo getActiveSidebar('index') ? 'menu-open' : false ?>">
                    <a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>"
                        class="nav-link <?php echo getActiveSidebar('index') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview <?php echo getActiveSidebar('groups') ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('groups') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Nhóm người dùng
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php
                        if (isPermission('groups', 'view')) {
                        ?>
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/groups' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php
                        }
                        ?>


                        <?php
                        if (isPermission('groups', 'add')) {
                        ?>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/groups/add' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php
                        }
                        ?>


                    </ul>
                </li>



                <li class="nav-item has-treeview <?php echo getActiveSidebar('users') ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('users') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Quản lý người dùng
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/users/' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/users/add' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview <?php echo getActiveSidebar('products') || getActiveSidebar('sizes') || getActiveSidebar('brands') || getActiveSidebar('categories') ? 'menu-open' : false ?>">
                    <a href="#"
                        class="nav-link <?php echo getActiveSidebar('products') || getActiveSidebar('sizes') || getActiveSidebar('brands') || getActiveSidebar('categories') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            Quản lý sản phẩm
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/products' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/products/add' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/brands/' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách thương hiệu</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/categories/' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/sizes/' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách size</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview <?php echo getActiveSidebar('bill') || getActiveSidebar('order_status') ? 'menu-open' : false ?>">
                    <a href="#"
                        class="nav-link <?php echo getActiveSidebar('bill') || getActiveSidebar('order_status') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Quản lý hóa đơn
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/bill/' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/order_status' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Trạng thái hóa đơn</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview <?php echo getActiveSidebar('options') ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('options') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Thiết lập trang
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/options' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập chung</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/options/footer' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Footer</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/options/our_team' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách thành viên</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/options/partner' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Partner</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li
                    class="nav-item has-treeview <?php echo getActiveSidebar('contacts') || getActiveSidebar('subcribes') ? 'menu-open' : false ?>">
                    <a href="#"
                        class="nav-link <?php echo getActiveSidebar('contacts') || getActiveSidebar('subcribes') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-phone-alt"></i>
                        <p>
                            <p>Quản lý liên hệ <span class="badge badge-danger"></span></p>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/contacts' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/subcribes' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách nhận thông báo</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo getActiveSidebar('reviews') ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('reviews') ? 'active' : false ?>">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            <p>Quản lý đánh giá <span class="badge badge-danger"></span></p>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/reviews' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách </p>
                            </a>
                        </li>


                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>