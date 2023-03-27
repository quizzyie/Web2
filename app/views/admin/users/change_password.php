<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN.'/users/post_change_password' ?>">
        <div class="form-group">
            <label for="">Nhập mật khẩu hiện tại</label>
            <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu hiện tại" value="">
            <?php empty($errors['password']) ? false : getMsgErr($errors,'password') ?>
        </div>
        <div class="form-group">
            <label for="">Mật khẩu mới</label>
            <input class="form-control" type="password" name="new_password" placeholder="Nhập mật khẩu mới" value="">
            <?php empty($errors['new_password']) ? false : getMsgErr($errors,'new_password') ?>
        </div>
        <div class="form-group">
            <label for="">Nhập lại mật khẩu mới</label>
            <input class="form-control" type="password" name="repeat_password" placeholder="Nhập lại mật khẩu mới"
                value="">
            <?php empty($errors['repeat_password']) ? false : getMsgErr($errors,'repeat_password') ?>
        </div>
        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/dashboard' ?>">Quay lại</a></p>

    </form>
</div>