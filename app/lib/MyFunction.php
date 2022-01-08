<?php 

namespace App\Lib;

class MyFunction
{
    public static function sanitize_br($str)
    {
        return nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], htmlspecialchars($str, ENT_QUOTES, 'UTF-8')));
    }

}