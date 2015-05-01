<?php

namespace Kamran\UtilBundle\Base;


class Util{


    //array function
    public static function value($value){
        return ($value != '') ? trim($value) : '';
    }

    //String functions
    public static function randString( $length ) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

}//@