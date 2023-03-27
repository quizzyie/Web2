<?php
class OptionsModel extends Model {
    protected $_table = 'options';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'options';
    }

    function fieldFill(){
        return "*";
    }
}