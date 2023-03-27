<?php
class BillModel extends Model {
    protected $_table = 'bill';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'bill';
    }

    function fieldFill(){
        return "*";
    }
}