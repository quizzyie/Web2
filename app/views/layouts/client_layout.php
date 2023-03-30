<?php 
    $this->renderView('layouts/header',['title'=>$title]);
    $this->renderView('layouts/breadcrumb',['title'=>$title]);
    $this->renderView($content,empty($sub_data) ? [] : $sub_data);
    $this->renderView('layouts/footer',empty($sub_data) ? [] : $sub_data);
?>