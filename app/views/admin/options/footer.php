<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg(Session::getFlashData('msg'), Session::getFlashData('msg_type')) ?>
    <form action="<?php echo _WEB_HOST_ROOT_ADMIN . '/options/post_footer' ?>" method="POST">
        <hr>
        <h5>Footer 1</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_1" placeholder="Tiêu đề ..." class="form-control"
                value="<?php echo empty($dataForm['title_1']) ? false : $dataForm['title_1']?>">
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <input type="text" name="des_1" placeholder="Mô tả..." class="form-control"
                value="<?php echo empty($dataForm['des_1']) ? false : $dataForm['des_1']?>">
        </div>
        <hr>
        <h5>Footer 2</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_2" placeholder="Tiêu đề ..." class="form-control"
                value="<?php echo empty($dataForm['title_2']) ? false : $dataForm['title_2']?>">
        </div>

        <h6>Danh sách đường dẫn</h6>

        <div class="group-quicklink">
            <?php
            if (!empty($dataForm['name_quicklink'])) {
                foreach ($dataForm['name_quicklink'] as $key => $value) {
            ?>


            <div class="row quicklink">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name_quicklink[]" placeholder="Tên đường dẫn ..." class="form-control"
                            value="<?php echo $value
                                                                                                                                        ?>">
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" name="link_quicklink[]" placeholder="Đường dẫn ..." class="form-control"
                            value="<?php echo $dataForm['link_quicklink'][$key] ?>">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-quicklink"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <?php
                }
            }

            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-quicklink">Thêm đường dẫn</button>

        <hr>
        <h5>Footer 3</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_3" placeholder="Tiêu đề ..." class="form-control"
                value="<?php echo empty($dataForm['title_3']) ? false : $dataForm['title_3']?>">
        </div>
        <h6>Danh sách đường dẫn</h6>

        <div class="group-quicklink2">
            <?php
            if (!empty($dataForm['name_quicklink2'])) {
                foreach ($dataForm['name_quicklink2'] as $key => $value) {
            ?>


            <div class="row quicklink2">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name_quicklink2[]" placeholder="Tên đường dẫn ..." class="form-control"
                            value="<?php echo $value
                                                                                                                                        ?>">
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" name="link_quicklink2[]" placeholder="Đường dẫn ..." class="form-control"
                            value="<?php echo $dataForm['link_quicklink2'][$key] ?>">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-quicklink2"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <?php
                }
            }

            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-quicklink2">Thêm đường dẫn</button>

        <hr>
        <h5>Footer 4</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_4" placeholder="Tiêu đề ..." class="form-control"
                value="<?php echo empty($dataForm['title_4']) ? false : $dataForm['title_4']?>">
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <input type="text" name="des_4" placeholder="Mô tả..." class="form-control"
                value="<?php echo empty($dataForm['des_4']) ? false : $dataForm['des_4']?>">
        </div>
        <hr>
        <h5>Copyright</h5>
        <div class="form-group">
            <label for="">Nội dung</label>
            <input type="text" name="copy_right" placeholder="Nội dung..." class="form-control"
                value="<?php echo empty($dataForm['copy_right']) ? false : $dataForm['copy_right']?>">
        </div>
        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập Footer</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>">Quay lại</a></p>

    </form>
</div>