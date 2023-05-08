<div class="row">
    <div class="form-group col-6">
        <label for="">Danh mục the loai</label>
        <select class="form-control" name="id_category" id="">
            <option value="0">Chọn ma the loai</option>
            <?php
                    foreach ($list_category as  $cate) {
                        $id = $cate['id'];
                        $name = $cate['name'];
                        $selected = !empty($dataForm['id_category']) && $dataForm['id_category'] == $id  ? "selected" : false;
                        echo "<option $selected value=" . $id . ">$id</option>";
                    }
                    ?>
        </select>
        <?php empty($errors['id_category']) ? false : getMsgErr($errors, 'id_category') ?>
    </div>
    <div class="form-group col-6">
        <label for="">Danh mục the loai</label>
        <select class="form-control" name="id_category" id="">
            <option value="0">Chọn ten the loai</option>
            <?php
                    foreach ($list_category as  $cate) {
                        $id = $cate['id'];
                        $name = $cate['name'];
                        $selected = !empty($dataForm['id_category']) && $dataForm['id_category'] == $id  ? "selected" : false;
                        echo "<option $selected value=" . $id . ">$name</option>";
                    }
                    ?>
        </select>
        <?php empty($errors['id_category']) ? false : getMsgErr($errors, 'id_category') ?>
    </div>
</div>