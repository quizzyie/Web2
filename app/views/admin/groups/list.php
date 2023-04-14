<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),'success') ?>
        <?php 
        if(isPermission('groups','add')){
            ?>
        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/groups/add' ?>" class="btn btn-primary"><i
                class="fa fa-plus"></i>Thêm nhóm
            mới</a>
        <?php
        }
        ?>
        <hr>
        <div class="row">
            <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/groups' ?>">
            <div class="col-9">
                <input type="search" class="form-control keyword" placeholder="Nhập vào tên nhóm cần tìm kiếm..">
            </div>
            <div class="col-3">
                <button class="btn btn-primary btn-block btn-search">Tìm kiếm</button>
            </div>
        </div>

        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên</th>
                    <th>Thời gian</th>
                    <?php 
                    if(isPermission('groups','permission')){
                        echo '<th width="15%">Phân quyền</th>';
                    }
                    if(isPermission('groups','update')){
                        echo '<th width="10%">Sửa</th>';
                    }
                    if(isPermission('groups','delete')){
                        echo '<th width="10%">Xóa</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="fetch-data-table">
                <!-- render data -->
            </tbody>
        </table>
        <div class="fetch-pagination">
            <!-- render pagination -->
        </div>
    </div>
</section>