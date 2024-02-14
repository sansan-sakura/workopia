<?php

namespace Framework;

class Session {

    public static function start (){
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function set($key, $value){
        $_SESSION[$key]=$value;
    }

    public static function get($key, $default=null)
{
    return isset($_SESSION[$key])?$_SESSION[$key]:$default;
}

    public static function has($key){
        return isset($_SESSION[$key]);
    }

    public static function claer($key){
        unset($_SESSION[$key]);
    }

    public static function claerAll(){
      session_unset();
      session_destroy();
    }

}