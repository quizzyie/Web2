<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg(Session::getFlashData('msg'), Session::getFlashData('msg_type')) ?>
    <form action="<?php echo _WEB_HOST_ROOT_ADMIN . '/options/post_advertise' ?>" method="POST">

        <h6>Danh sách quảng cáo</h6>

        <div class="group-advertise">
            <?php
            if (!empty($dataForm['title'])) {
                foreach ($dataForm['title'] as $key => $value) {
            ?>

            <div class="advertise">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tiêu đề nhỏ</label>
                            <input type="text" name="title[]" placeholder="Tiêu đề nhỏ ..." class="form-control"
                                value="<?php echo !empty($dataForm['title']) && !empty($dataForm['title'][$key]) ?  $dataForm['title'][$key] : false ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tiêu để lớn</label>
                            <input type="text" name="header[]" placeholder="Tiêu để lớn ..." class="form-control"
                                value="<?php echo !empty($dataForm['header']) && !empty($dataForm['header'][$key]) ?  $dataForm['header'][$key] : false ?>">
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
                                        value="<?php echo !empty($dataForm['image']) && !empty($dataForm['image'][$key]) ?  $dataForm['image'][$key] : false ?>">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả quảng cáo</label>
                    <textarea name="description[]" placeholder="Mô tả sản phẩm" class="editor" cols="30"
                        rows="10"><?php echo !empty($dataForm['description']) && !empty($dataForm['description'][$key]) ?  $dataForm['description'][$key] : false ?></textarea>
                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-advertise"><i class="fas fa-trash"></i></button>
                </div>

                <hr>
            </div>


            <?php
                }
            }

            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-advertise">Thêm quảng cáo</button>


        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập quảng cáo</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>">Quay lại</a></p>

    </form>
</div>