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

    public static function getBgClass()
    {

        $bgs = array(
            'bg-brillant',
            'bg-always_grey',
            'bg-retina_wood',
            'bg-low_contrast_linen',
            'bg-egg_shell',
            'bg-cartographer',
            'bg-batthern',
            'bg-noisy_grid',
            'bg-diamond_upholstery',
            'bg-greyfloral',
            'bg-white_tiles',
            'bg-gplaypattern',
            'bg-arches',
            'bg-purty_wood',
            'bg-diagonal_striped_brick',
            'bg-large_leather',
            'bg-bo_play_pattern',
            'bg-irongrip wood_1',
            'bg-pool_table',
            'bg-crissXcross',
            'bg-rip_jobs',
            'bg-random_grey_variations',
            'bg-carbon_fibre',
        );
        return $bgs[17];
    }
}