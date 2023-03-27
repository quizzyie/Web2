<?php
class CategoriesModel extends Model {
    protected $_table = 'categories';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'categories';
    }

    function fieldFill(){
        return "*";
    }
    
}