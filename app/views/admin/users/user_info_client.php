<div style="max-width: 600px;margin:0 auto; " class="mt-5 mb-5">
    <?php getMsg(Session::getFlashData('msg_form_client'),Session::getFlashData('msg_type')) ?>
    <form method="POST" action="<?php echo HOST_ROOT.'/auth/post_user_info/' ?>">
        <div class="row">
            <div class="col-12 form-group">
                <label for="">Họ tên</label>
                <input class="form-control" type="text" name="fullname" placeholder="Nhập họ tên"
                    value="<?php echo empty($dataForm['fullname']) ? false : $dataForm['fullname']?>">
                <?php empty($errors['fullname']) ? false : getMsgErr($errors,'fullname') ?>
            </div>


            <div class="col-12 form-group">
                <label for="">Email</label>
                <input class="form-control" type="text" name="email" placeholder="Nhập email..."
                    value="<?php echo empty($dataForm['email']) ? false : $dataForm['email']?>">
                <?php empty($errors['email']) ? false : getMsgErr($errors,'email') ?>
            </div>

            <div class="col-12 form-group">
                <label for="">Số điện thoại</label>
                <input class="form-control" type="text" name="phone" placeholder="Nhập số điện thoại..."
                    value="<?php echo empty($dataForm['phone']) ? false : $dataForm['phone']?>">
                <?php empty($errors['phone']) ? false : getMsgErr($errors,'phone') ?>
            </div>



        </div>
        <button type="submit" class="btn btn-primary">Cập nhập </button>

    </form>
</div>