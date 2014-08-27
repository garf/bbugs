<?php

class Helpers
{
    public static function isValidEmail($email)
    {
        if(!is_array($email))
        {
            return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? false : true;
        } else {
            return false;
        }
    }

    public static function nameize($str)
    {
        return mb_convert_case(mb_strtolower(htmlspecialchars($str)), MB_CASE_TITLE);
    }

}