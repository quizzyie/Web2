<?php
class BrandsModel extends Model {
    protected $_table = 'brands';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'brands';
    }

    function fieldFill(){
        return "*";
    }
}