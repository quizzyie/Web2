<?php
class OrderStatusModel extends Model {
    protected $_table = 'order_status';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'order_status';
    }

    function fieldFill(){
        return "*";
    }
}