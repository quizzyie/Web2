<div style="max-width: 1200px;margin:0 auto; ">
    <?php empty($msg) ? false : getMsg($msg,'success') ?>
    <?php getMsg(Session::getFlashData('msg'),'success') ?>
    <form action="<?php echo _WEB_HOST_ROOT_ADMIN.'/groups/post_permission' ?>" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="20%">Nhóm</th>
                    <th>Quyền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($modules as $key => $module) {
                    $name = $module['name'];
                    $title = $module['title'];
                    $actions = json_decode($module['actions'],true);

                    $list_action = "";
                    foreach ($actions as $key => $action) {
                        $checked = "";
                        if(!empty($permission[$name])&&in_array($key,$permission[$name])){
                            $checked =  "checked";
                        }
                        $list_action .= "
                        <div class='col-2'>
                                <label for='$name-$key'><input class='checkbox-permission checkbox-$key' id='$name-$key' type='checkbox' name='permission[$name][]' value='$key' $checked>$action</label>
                            </div>
                        ";
                    }
                    
                    echo "
                    <tr>
                    <td>$title</td>
                    <td>
                        <div class='row check-permission'>
                            $list_action
                        </div>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <br>
        <button class="btn btn-warning btn-cancel-permission">Hủy tất cả</button>
        <button type="submit" class="btn btn-primary ">Phân quyền</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/groups' ?>">Quay lại</a></p>

    </form>
</div>

<script>
document.querySelector(".btn-cancel-permission").onclick = (e) => {
    e.preventDefault();
    document.querySelectorAll('.checkbox-permission').forEach(item => item.checked = false)
}
// arr_check = document.querySelectorAll(".check-permission");
// arr_check.forEach(element => {
//     element.onchange = () => {
//         const view = element.querySelector('.checkbox-view');
//         const update = element.querySelector('.checkbox-update');
//         const remove = element.querySelector('.checkbox-delete');
//         const permission = element.querySelector('.checkbox-permission');
//     };
// });
</script>