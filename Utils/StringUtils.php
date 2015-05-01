<?php

namespace Cogilent\BaseBundle\Utils;

class StringUtils
{
    /**
     * Camelize string
     */
    public static function camelize($string)
    {
        return preg_replace_callback('/(^|_|\.)+(.)/', function ($match) { return ('.' === $match[1] ? '_' : '').strtoupper($match[2]); }, $string);
    }

    /**
     * is string a regular expression
     */
    public static function isRegex($str) {
        $regex = "/^\/[\s\S]+\/$/";
        return preg_match($regex, $str);
    }

}
