<?php
class SubcribesModel extends Model {
    protected $_table = 'subcribes';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'subcribes';
    }

    function fieldFill(){
        return "*";
    }
}