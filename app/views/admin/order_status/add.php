<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg,'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN.'/order_status/post_add' ?>">
        <div class="form-group">
            <label for="">Tên trạng thái</label>
            <input class="form-control" type="text" name="name" placeholder="Nhập tên trạng thái"
                value="<?php echo empty($dataForm['name']) ? false : $dataForm['name']?>">
            <?php empty($errors['name']) ? false : getMsgErr($errors,'name') ?>
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="form-control" name="description" cols="30"
                rows="5"><?php echo empty($dataForm['description']) ? false : $dataForm['description']?></textarea>
            <?php empty($errors['description']) ? false : getMsgErr($errors,'description') ?>
        </div>

        <button type="submit" class="btn btn-primary">Thêm trạng thái</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/order_status' ?>">Quay lại</a></p>

    </form>
</div>