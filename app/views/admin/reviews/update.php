<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg, 'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN . '/reviews/post_update' ?>">
        <div class="form-group">
            <label for="">Trạng thái</label>
            <select class="form-control" name="status">
                <option value="0">Chọn trạng thái</option>
                <option <?php echo !empty($dataForm['status']) && $dataForm['status'] == 1 ? "selected" :false ?>
                    value="1">
                    Ẩn</option>
                <option <?php echo !empty($dataForm['status']) && $dataForm['status'] == 2 ? "selected" :false ?>
                    value="2">
                    Hiển thị</option>
                ?>
            </select>
            <?php empty($errors['status']) ? false : getMsgErr($errors, 'status') ?>
        </div>
        <div class="form-group">
            <label for="">Ghi chú</label>
            <textarea class="form-control" name="note" cols="30"
                rows="10"><?php echo empty($dataForm['note']) ? false : $dataForm['note'] ?></textarea>
            <?php empty($errors['note']) ? false : getMsgErr($errors, 'note') ?>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhập trạng thái</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/reviews' ?>">Quay lại</a></p>

    </form>
</div>