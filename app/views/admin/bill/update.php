<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg, 'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN . '/bill/post_update' ?>">
        <div class="form-group">
            <?php 
            if($dataForm['id_order_status'] != 6){
                echo "<label for=''>Trạng thái</label>";
            }
            ?>

            <select class="form-control" name="id_order_status"
                style="display: <?php echo $dataForm['id_order_status'] == 6 ? 'none' : 'block' ?>;">
                <option value="0">Chọn trạng thái</option>
                <?php
                foreach ($order_status as $key => $value) {
                    $id = $value['id'];
                    $name = $value['name'];
                    $checked = !empty($dataForm['id_order_status']) && $id == $dataForm['id_order_status'] ? 'selected' : false;
                    echo "<option $checked value='$id'>$name</option>";
                }
                ?>
            </select>
            <?php empty($errors['id_order_status']) ? false : getMsgErr($errors, 'id_order_status') ?>
        </div>
        <div class="form-group">
            <label for="">Ghi chú</label>
            <textarea class="form-control" name="note" cols="30"
                rows="10"><?php echo empty($dataForm['note']) ? false : $dataForm['note'] ?></textarea>
            <?php empty($errors['note']) ? false : getMsgErr($errors, 'note') ?>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhập trạng thái</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN . '/bill' ?>">Quay lại</a></p>

    </form>
</div>