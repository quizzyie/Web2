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
    public function getGeneralCountry(){
        $sql = "select opt_value from options where opt_key = 'general_country'";
        return intval($this->getFirstRaw($sql)["opt_value"]) ;
    }
    public function getTotalCategory(){
        $sql = "SELECT COUNT(categories.id) as slg FROM `categories` ";
        return intval($this->getFirstRaw($sql)["slg"]) ;
    }
    public function getHappyCustomer(){
        $sql = "select opt_value from options where opt_key = 'general_happy_customer'";
        return intval($this->getFirstRaw($sql)["opt_value"]) ;
    }
    public function getOurClients(){
        $sql = "select opt_value from options where opt_key = 'general_clients'";
        return intval($this->getFirstRaw($sql)["opt_value"]) ;
    }
    public function getOurTeam(){
        $sql = "select opt_value from options where opt_key = 'general_our_team'";
        return json_decode($this->getFirstRaw($sql)["opt_value"],1) ;
    }
    public function getPartner(){
        $sql = "select opt_value from options where opt_key = 'general_partner'";
        return json_decode($this->getFirstRaw($sql)["opt_value"],1) ;
    }
    public function getHotline(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_hotline'");
    }
    public function getAddress(){
        return $this->getFirstRaw("SELECT * FROM `options` WHERE opt_key = 'general_address'");

    }
}