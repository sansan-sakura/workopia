<?php
namespace Framework;

use Framework\Session;


class Authorization{


    public static function  isOwnere($resouceId){
        $sessionUser=Session::get('user');

        if($sessionUser!==null && isset($sessionUser['id'])){
            $sessionUserId=(int) $sessionUser['id'];
            return $sessionUserId===$resouceId;
        }

        return false;
    }
}