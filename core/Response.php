<?php
class Response{
    public static function redirect($uri=""){
        if(preg_match('~http|https.+~',$uri)){
            $url = $uri;
        }else {
            $url = HOST_ROOT.'/'.$uri;
        }
        header("Location: $url");
    }
}