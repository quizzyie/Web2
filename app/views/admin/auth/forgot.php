<?php
if (!defined('_INCODE')) die('Access Deined...');
?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đặt lại mật khẩu</h3>
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type'))?>
        <form action="<?php echo _WEB_HOST_ROOT_ADMIN.'/auth/post_forgot' ?>" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input name="email" class="form-control" placeholder="Địa chỉ email..."
                    value="<?php echo empty($dataForm['email']) ? false : $dataForm['email'] ?>">
                <?php empty($errors) ? false:  getMsgErr($errors,'email') ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
            <hr>
            <p class="text-center"><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/auth/login' ?>">Đăng nhập</a></p>
        </form>
    </div>
</div>