<?php
if (!defined('_INCODE')) die('Access Deined...');
/*Chứa các hàm liên quan đến thao tác session*/


class Session{
    static public function data($key,$value=''){
        global $config;
        echo "<pre>";
        print_r($config);
        echo "</pre>";
    }

    //Hàm gán session
    static function setSession($key, $value){
        if (!empty(session_id())){
            $_SESSION[$key] = $value;
            return true;
        }
    
        return false;
    }
 
 //Hàm đọc session
    static public function getSession($key=''){
        if (empty($key)){
            return $_SESSION;
        }else{
            if (isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
        }
    
        return false;
    }
 
    //Hàm xoá session
    static public function removeSession($key=''){
        if (empty($key)){
            session_destroy();
            return true;
        }else{
            if (isset($_SESSION[$key])){
                unset($_SESSION[$key]);
                return true;
            }
        }
    
        return false;
    }
    
    //Hàm gán flash data
    static public function setFlashData($key, $value){
        $key = 'flash_'.$key;
        return Session::setSession($key, $value);
    }
    
    //Hàm đọc flash data
    static public function getFlashData($key){
        $key = 'flash_'.$key;
        $data = Session::getSession($key);
    
        Session::removeSession($key);
    
        return $data;
    }
}