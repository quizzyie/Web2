<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg,'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN.'/brands/post_update' ?>">
        <div class="form-group">
            <label for="">Tên thương hiệu</label>
            <input class="form-control" type="text" name="name" placeholder="Nhập tên thương hiệu"
                value="<?php echo empty($dataForm['name']) ? false : $dataForm['name']?>">
            <?php empty($errors['name']) ? false : getMsgErr($errors,'name') ?>
        </div>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="image" placeholder="Hình ảnh ..." class="form-control image-render"
                        value="<?php echo empty($dataForm['image']) ? false : $dataForm['image']?>">
                    <?php empty($errors['image']) ? false : getMsgErr($errors,'image') ?>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhập thương hiệu</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/brands' ?>">Quay lại</a></p>

    </form>
</div>