<?php 
    $this->renderView('layouts/header',['title'=>$title]);
    $this->renderView($content);
    $this->renderView('layouts/footer');
?>