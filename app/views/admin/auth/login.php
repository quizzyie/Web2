<?php
if (!defined('_INCODE')) die('Access Deined...');
?>

<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>
        <?php empty($msg) ? false : getMsg($msg,'danger') ?>
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type'))?>
        <form action="<?php echo HOST_ROOT.'/admin/auth/post_login' ?>" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Địa chỉ email..."
                    value="<?php empty($dataForm) ? false : getValueInput($dataForm,'email') ?>">
                <?php empty($errors) ? false : getMsgErr($errors,'email') ?>
            </div>

            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
                <?php empty($errors) ? false : getMsgErr($errors,'password') ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/auth/forgot' ?>">Quên mật khẩu</a></p>
        </form>
    </div>
</div>