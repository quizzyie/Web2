<?php
class ContactsModel extends Model {
    protected $_table = 'contacts';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'contacts';
    }

    function fieldFill(){
        return "*";
    }
}