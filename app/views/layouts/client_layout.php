<?php 
    $this->renderView('layouts/header',empty($sub_data) ? [] : $sub_data);
    $this->renderView('layouts/breadcrumb',empty($sub_data) ? [] : $sub_data);
    $this->renderView($content,empty($sub_data) ? [] : $sub_data);
    $this->renderView('layouts/footer',empty($sub_data) ? [] : $sub_data);
?>