<section class="content">
    <div class="container-fluid">
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>
        <?php 
        if(isPermission('products','add')){
            ?>
        <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/sizes/add' ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm
            size</a>
        <?php
        }
        ?>

        <input type="hidden" class="url_module" value="<?php echo _WEB_HOST_ROOT_ADMIN.'/sizes' ?>">
        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="">Size</th>
                    <th width="">Mô tả</th>
                    <th width="">Thời gian</th>
                    <?php 
                    if(isPermission('products','update')){
                        echo '<th width="8%">Sửa</th>';
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