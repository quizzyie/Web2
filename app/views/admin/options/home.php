<?php 
foreach ($dataOption as $key => $value) {
    $dataForm[$value['opt_key']]= $value['opt_value'];
}
?>
<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type')) ?>
    <form method="POST" action="<?php echo _WEB_HOST_ROOT_ADMIN.'/options/post_home' ?>">
        <div class="form-group">
            <label for="">Hotline</label>
            <input class="form-control" type="text" name="general_hotline" placeholder="Hotline..."
                value="<?php echo empty($dataForm['general_hotline']) ? false : $dataForm['general_hotline']?>">
            <?php empty($errors['general_hotline']) ? false : getMsgErr($errors,'general_hotline') ?>
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input class="form-control" type="text" name="general_address" placeholder="Địa chỉ..."
                value="<?php echo empty($dataForm['general_address']) ? false : $dataForm['general_address']?>">
            <?php empty($errors['general_address']) ? false : getMsgErr($errors,'general_address') ?>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" type="text" name="general_address" placeholder="Email..."
                value="<?php echo empty($dataForm['general_email']) ? false : $dataForm['general_email']?>">
            <?php empty($errors['general_email']) ? false : getMsgErr($errors,'general_email') ?>
        </div>
        <div class="form-group">
            <label for="">Facebook</label>
            <input class="form-control" type="text" name="general_facebook" placeholder="Facebook..."
                value="<?php echo empty($dataForm['general_facebook']) ? false : $dataForm['general_facebook']?>">
            <?php empty($errors['general_facebook']) ? false : getMsgErr($errors,'general_facebook') ?>
        </div>
        <div class="form-group">
            <label for="">Twitter</label>
            <input class="form-control" type="text" name="general_twitter" placeholder="Twitter..."
                value="<?php echo empty($dataForm['general_twitter']) ? false : $dataForm['general_twitter']?>">
            <?php empty($errors['general_twitter']) ? false : getMsgErr($errors,'general_twitter') ?>
        </div>
        <div class="form-group">
            <label for="">Youtube</label>
            <input class="form-control" type="text" name="general_youtube" placeholder="Youtube..."
                value="<?php echo empty($dataForm['general_youtube']) ? false : $dataForm['general_youtube']?>">
            <?php empty($errors['general_youtube']) ? false : getMsgErr($errors,'general_youtube') ?>
        </div>
        <div class="form-group">
            <label for="">Instagram</label>
            <input class="form-control" type="text" name="general_instagram" placeholder="Instagram..."
                value="<?php echo empty($dataForm['general_instagram']) ? false : $dataForm['general_instagram']?>">
            <?php empty($errors['general_instagram']) ? false : getMsgErr($errors,'general_instagram') ?>
        </div>
        <div class="form-group">
            <label for="">Chiến dịch giao hàng</label>
            <input class="form-control" type="text" name="general_delivery" placeholder="Chiến dịch giao hàng..."
                value="<?php echo empty($dataForm['general_delivery']) ? false : $dataForm['general_delivery']?>">
            <?php empty($errors['general_delivery']) ? false : getMsgErr($errors,'general_delivery') ?>
        </div>
        <div class="form-group">
            <label for="">Số lượng khách hàng</label>
            <input class="form-control" type="text" name="general_clients" placeholder="Số lượng khách hàng..."
                value="<?php echo empty($dataForm['general_clients']) ? false : $dataForm['general_clients']?>">
            <?php empty($errors['general_clients']) ? false : getMsgErr($errors,'general_clients') ?>
        </div>
        <div class="form-group">
            <label for="">Số quốc gia</label>
            <input class="form-control" type="text" name="general_country" placeholder="Số quốc gia..."
                value="<?php echo empty($dataForm['general_country']) ? false : $dataForm['general_country']?>">
            <?php empty($errors['general_country']) ? false : getMsgErr($errors,'general_country') ?>
        </div>
        <div class="form-group">
            <label for="">Tỷ lệ hài lòng của khách hàng</label>
            <input class="form-control" type="text" name="general_happy_customer"
                placeholder="Tỷ lệ hài lòng của khách hàng..."
                value="<?php echo empty($dataForm['general_happy_customer']) ? false : $dataForm['general_happy_customer']?>">
            <?php empty($errors['general_happy_customer']) ? false : getMsgErr($errors,'general_happy_customer') ?>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <p><a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>">Quay lại</a></p>

    </form>
</div>