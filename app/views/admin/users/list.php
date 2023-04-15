<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>
        <?php 
        if(isPermission('users','add')){
            ?>
        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/users/add' ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm
            người dùng</a>
        <?php
        }
        ?>

        <hr>
        <div class="row">
            <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/users' ?>">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control status">
                        <option value="0">Chọn trạng thái</option>
                        <option value="1">Kích hoạt</option>
                        <option value="2">Chưa kích hoạt</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control group_id">
                        <option value="0">Chọn nhóm</option>
                        <?php 
                        foreach ($group_list as  $group) {
                            echo "<option value=".$group['id'].">".$group['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control type">
                        <option value="0">Chọn loại</option>
                        <option value="user">Người dùng</option>
                        <option value="member">Thành viên </option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <input class="form-control keyword" placeholder="Nhập vào tên nhóm cần tìm kiếm..">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block btn-search">Tìm kiếm</button>
            </div>
        </div>
        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="15%">Họ tên</th>
                    <th width="">Email</th>
                    <th width="">Điện thoại</th>
                    <th width="">Nhóm</th>
                    <th width="">Loại</th>
                    <th width="10%">Thời gian</th>
                    <th width="12%">Trạng thái</th>

                    <?php  
                    if(isPermission('users','update')){
                        echo '<th width="8%">Sửa</th>';
                    }
                    if(isPermission('users','delete')){
                        echo '<th width="8%">Xóa</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="fetch-data-table">

            </tbody>
        </table>
        <div class="fetch-pagination">
            <!-- render pagination -->
        </div>

    </div>
</section>