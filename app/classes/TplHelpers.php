<?php

class TplHelpers
{
    public static function addJs($files = array())
    {
        $str = '';
        if(is_array($files))
        {
            foreach($files as $file)
            {
                $str .= '<script type="text/javascript" src="' . $file . '"></script>
';
            }
        } else if(trim($files) != '') {
            $str .= '<script type="text/javascript" src="'. $files .'"></script>
';
        }
        return $str;
    }

    public static function addCss($files = array())
    {
        $str = '';
        if(is_array($files))
        {
            foreach($files as $file)
            {
                $str .= '<link rel="stylesheet" type="text/css" href="'.$file.'" />
';
            }
        } else if(trim($files) != '') {
            $str .= '<link rel="stylesheet" type="text/css" href="'.$files.'" />
';
        }
        return $str;
    }

    public static function systemMessagesFormatted()
    {
        $errors = '';

        if(Session::has('system.messages')) {
            $messages = Session::get('system.messages');
            foreach ($messages as $message) {
                $errors .= '
                <div class="alert alert-' . $message['type'] . ' alert-dismissable" style="margin-bottom: 1px;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  ' . $message['message'] . '
                </div>';
            }
        }
        return $errors;
    }
    public static function systemMessagesFormattedNc()
    {
        $errors = '';

        if(Session::has('system.messages')) {
            $messages = Session::get('system.messages');
            foreach ($messages as $message) {
                $errors .= '
                <div class="alert alert-' . $message['type'] . '" style="margin-bottom: 1px;">
                  ' . $message['message'] . '
                </div>';
            }
        }
        return $errors;
    }

    public static function getWord($number, $suffix)
    {
        $keys = array(2, 0, 1, 1, 1, 2);
        $mod = $number % 100;
        $suffix_key = ($mod > 7 && $mod < 20) ? 2 : $keys[min($mod % 10, 5)];
        return $suffix[$suffix_key];
    }
}