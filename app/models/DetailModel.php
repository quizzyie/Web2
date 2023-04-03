<?php
class DetailModel extends Model {
    public $category = null;
    public $brand = null;
    protected $_table = 'products';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'products';
    }

    function fieldFill(){
        return "*";
    }
    public function getCategories(){
        
    }
}