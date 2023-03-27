<?php
class AuthModel extends Model {
    protected $_table = 'users';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'users';
    }

    function fieldFill(){
        return "*";
    }
}