<?php
class GroupsModel extends Model {
    protected $_table = 'groups';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'groups';
    }

    function fieldFill(){
        return "*";
    }
}