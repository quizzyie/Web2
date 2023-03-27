<?php 
    $this->renderView('admin/layouts/header',['title'=>$title]);
    $this->renderView('admin/layouts/sidebar',empty($sub_data) ? [] : $sub_data);
    $this->renderView('admin/layouts/breadcrumb',['breadcrumb'=>$title]);
    $this->renderView(empty($content) ? '/admin/dashboard/list' : $content,empty($sub_data) ? [] : $sub_data);
    $this->renderView('admin/layouts/footer');
?>