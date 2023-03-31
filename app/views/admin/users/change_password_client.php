<div style="max-width: 600px;margin:0 auto; " class="mt-5 mb-5">
    <?php getMsg(Session::getFlashData('msg_form_client'),Session::getFlashData('msg_type')) ?>
    <form method="POST" action="<?php echo HOST_ROOT.'/auth/post_change_password' ?>">
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

    </form>
</div>