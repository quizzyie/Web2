<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg(Session::getFlashData('msg'), Session::getFlashData('msg_type')) ?>
    <form action="<?php echo _WEB_HOST_ROOT_ADMIN.'/options/post_our_team' ?>" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề nhỏ</label>
                    <input type="text" name="heading_1" placeholder="Tiêu đề ..." class="form-control"
                        value="<?php echo empty($dataForm['heading_1']) ? false : $dataForm['heading_1'] ?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề lớn</label>
                    <input type="text" name="heading_2" placeholder="Tiêu đề nền..." class="form-control"
                        value="<?php echo empty($dataForm['heading_2']) ? false : $dataForm['heading_2'] ?>">
                </div>
            </div>
        </div>

        <h6>Danh sách đường dẫn</h6>




        <div class="group-ourteam">
            <?php
            if (!empty($dataForm['name'])) {
                foreach ($dataForm['name'] as $key => $value) {
            ?>

            <div class="ourteam">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên thành viên</label>
                            <input type="text" name="name[]" placeholder="Tên thành viên ..." class="form-control"
                                value="<?php echo $value ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" name="position[]" placeholder="Chức vụ ..." class="form-control"
                                value="<?php echo $dataForm['position'][$key] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                                        class="form-control image-render"
                                        value="<?php echo $dataForm['image'][$key] ?>">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-ourteam"><i class="fas fa-trash"></i></button>
                </div>

                <hr>
            </div>


            <?php
                }
            }

            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-ourteam">Thêm thành viên</button>


        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập thành viên</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>">Quay lại</a></p>

    </form>
</div>