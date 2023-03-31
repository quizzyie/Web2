<?php
if (!defined('_INCODE')) die('Access Deined...');
/*File này chứa chức năng đặt lại mật khẩu*/
?>
<div class="row text-left">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đặt lại mật khẩu</h3>
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type'))?>
        <form action="<?php echo HOST_ROOT.'/auth/post_reset' ?>" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class="form-group">
                <label for="">Mật khẩu mới</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới...">
                <?php empty($errors) ? false:  getMsgErr($errors,'password') ?>
            </div>

            <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" name="confirm_password" class="form-control"
                    placeholder="Nhập lại mật khẩu mới...">
                <?php empty($errors) ? false:  getMsgErr($errors,'confirm_password') ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
        </form>
    </div>
</div>