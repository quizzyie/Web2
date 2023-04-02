<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg,'danger') ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN.'/users/post_add' ?>">
        <div class="row">
            <div class="col-12 form-group">
                <label for="">Họ tên</label>
                <input class="form-control" type="text" name="fullname" placeholder="Nhập họ tên"
                    value="<?php echo empty($dataForm['fullname']) ? false : $dataForm['fullname']?>">
                <?php empty($errors['fullname']) ? false : getMsgErr($errors,'fullname') ?>
            </div>
            <div class="col-12 form-group">
                <label for="">Mật khẩu</label>
                <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu" value="">
                <?php empty($errors['password']) ? false : getMsgErr($errors,'password') ?>
            </div>
            <div class="col-12 form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input class="form-control" type="password" name="repeat_password" placeholder="Nhập lại mật khẩu"
                    value="">
                <?php empty($errors['repeat_password']) ? false : getMsgErr($errors,'repeat_password') ?>
            </div>


            <div class="col-6 form-group">
                <label for="">Email</label>
                <input class="form-control" type="text" name="email" placeholder="Nhập email..."
                    value="<?php echo empty($dataForm['email']) ? false : $dataForm['email']?>">
                <?php empty($errors['email']) ? false : getMsgErr($errors,'email') ?>
            </div>

            <div class="col-6 form-group">
                <label for="">Số điện thoại</label>
                <input class="form-control" type="text" name="phone" placeholder="Nhập số điện thoại..."
                    value="<?php echo empty($dataForm['phone']) ? false : $dataForm['phone']?>">
                <?php empty($errors['phone']) ? false : getMsgErr($errors,'phone') ?>
            </div>

            <div class="col-6 form-group">
                <label for="">Nhóm người dùng</label>
                <select class="form-control" name="group_id" id="">
                    <option value="0">Chọn nhóm người dùng</option>
                    <?php 
                        foreach ($group_list as  $group) {
                            $id = $group['id'];
                            $name = $group['name'];
                            $selected = !empty($dataForm['group_id']) && $dataForm['group_id'] == $id  ? "selected" : false;
                            echo "<option $selected value=".$id.">$name</option>";
                        }
                    ?>
                </select>
                <?php empty($errors['group_id']) ? false : getMsgErr($errors,'group_id') ?>
            </div>
            <div class="col-6 form-group">
                <label for="">Trạng thái người dùng</label>
                <select class="form-control" name="status" id="">
                    <option <?php echo !empty($dataForm['status']) && $dataForm['status'] == 0  ? "selected" : false; ?>
                        value="0">Chưa kích
                        hoạt
                    </option>
                    <option <?php echo !empty($dataForm['status']) && $dataForm['status'] == 1  ? "selected" : false; ?>
                        value="1">Kích hoạt
                    </option>
                </select>
            </div>
            <div class="col-6 form-group">
                <label for="">Kiểu người dùng</label>
                <select class="form-control" name="type" id="">
                    <option
                        <?php echo !empty($dataForm['type']) && $dataForm['type'] == 'user'  ? "selected" : false; ?>
                        value="user">Người dùng
                    </option>
                    <option
                        <?php echo !empty($dataForm['type']) && $dataForm['type'] == 'member'  ? "selected" : false; ?>
                        value="member">Thành viên
                    </option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/users' ?>">Quay lại</a></p>

    </form>
</div>