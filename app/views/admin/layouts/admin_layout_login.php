<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo empty($title) ?  "Website" : $title ?></title>
    <link rel="stylesheet" href="<?php echo HOST_ROOT ?>/public/assets/client/css/style.css">
</head>

<body>
    <?php 
        $this->renderView('admin/layouts/header-login');
        $this->renderView(empty($content) ? '/admin/auth/login' : $content,empty($sub_data) ? [] : $sub_data);
        $this->renderView('admin/layouts/footer-login');
        ?>
</body>
<script src="<?php echo HOST_ROOT ?>/public/assets/client/js/script.js"></script>

</html>