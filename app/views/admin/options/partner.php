<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg(Session::getFlashData('msg'), Session::getFlashData('msg_type')) ?>
    <form action="<?php echo _WEB_HOST_ROOT_ADMIN.'/options/post_partner' ?>" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề nhỏ</label>
                    <input type="text" name="heading_1" placeholder="Tiêu đề ..." class="form-control"
                        value="<?php echo empty($dataForm['heading_1']) ? false : $dataForm['heading_1']?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề lớn</label>
                    <input type="text" name="heading_2" placeholder="Tiêu đề nền..." class="form-control"
                        value="<?php echo empty($dataForm['heading_2']) ? false : $dataForm['heading_2']?>">
                </div>
            </div>
        </div>


        <hr>
        <h5>Danh sách đối tác</h5>

        <div class="group-partner">
            <?php
            if(!empty($dataForm['image'])){
                ?>

            <?php
            foreach ($dataForm['image'] as $key => $value) {
               ?>

            <div class="row partner">

                <div class="col-6">
                    <div class="form-group">
                        <div class="row ckfinder-group">
                            <div class="col-10">
                                <input type="text" name="image[]" placeholder="Logo..."
                                    class="form-control image-render" value="<?php echo $value ?>">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-success btn-block choose-image"><i
                                        class="fas fa-upload"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" name="link[]" placeholder="Link ..." class="form-control"
                            value="<?php echo $dataForm['link'][$key] ?>">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-partner"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <?php
            }
            }
            
            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-partner">Thêm đối tác</button>
        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập đối tác</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>">Quay lại</a></p>

    </form>
</div>