<?php
class SizesModel extends Model {
    protected $_table = 'sizes';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'sizes';
    }

    function fieldFill(){
        return "*";
    }
}