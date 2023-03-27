<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg,'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN.'/sizes/post_add' ?>">
        <div class="form-group">
            <label for="">Tên kích thước</label>
            <input class="form-control" type="text" name="name" placeholder="Nhập tên kích thước"
                value="<?php echo empty($dataForm['name']) ? false : $dataForm['name']?>">
            <?php empty($errors['name']) ? false : getMsgErr($errors,'name') ?>
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="form-control" name="description" cols="30"
                rows="5"><?php echo empty($dataForm['description']) ? false : $dataForm['description']?></textarea>
            <?php empty($errors['description']) ? false : getMsgErr($errors,'description') ?>
        </div>

        <button type="submit" class="btn btn-primary">Thêm kích thước</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/sizes' ?>">Quay lại</a></p>

    </form>
</div>