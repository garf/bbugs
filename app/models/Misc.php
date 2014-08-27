<?php

class Misc extends Eloquent {

    public static $_instance = null;

    protected $system_messages = array();

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function setSystemMessage($message, $type='info')
    {
        $this->system_messages[] = array('message' => $message, 'type' => $type);
        Session::flash('system.messages', $this->system_messages);
    }

    public function getCountriesList()
    {
        return DB::select("
            SELECT *
            FROM bb_country
            ORDER BY title ASC
        ");
    }

    public function makeShortName($last_name, $first_name, $middle_name=null)
    {
        $middle = (!empty($middle_name)) ? mb_substr($middle_name,0,1).'.' : '';
        return $last_name . ' '
            . mb_substr($first_name,0,1) . '. '
            . $middle;
    }

    public function numSuffix($numberof, $value, $suffix)
    {
        // не будем склонять отрицательные числа
        $numberof = abs($numberof);
        $keys = array(2, 0, 1, 1, 1, 2);
        $mod = $numberof % 100;
        $suffix_key = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)];

        return $value . $suffix[$suffix_key];
    }

    public function publicId($str, $length=7, $symbols='0', $prefix='', $suffix='')
    {
        return $prefix . str_pad($str, $length, $symbols, STR_PAD_LEFT) . $suffix;
    }

    public function moneyFormat($amount)
    {
        return number_format($amount, 2, '.', ' ')  . ' р.';
    }

    public function moneyFormatForex($amount, $currency='USD')
    {
        if($currency == 'RUR') {
            return number_format($amount, 2, '.', ' ') . trans('common.rub');
        } else {
            return '$' . number_format($amount, 2, '.', ' ');
        }
    }

    public function getBrokerInfo($name=null)
    {
        $name = mb_strtolower($name);
        $brokers = array(
            'insta' => array(
                'logo' => 'instaforex.png',
                'title' => 'Insta Forex',
            ),
            'instaforex' => array(
                'logo' => 'instaforex.png',
                'title' => 'Insta Forex',
            ),
            'alfaforex' => array(
                'logo' => 'alfaforex.png',
                'title' => 'Alfa-Forex',
            ),
            'default' => array(
                'logo' => 'default.png',
                'title' => 'Неизвестный',
            ),
        );
        if(empty($name)) {
            return $brokers;
        } else {
            return (isset($brokers[$name])) ? $brokers[$name] : $brokers['default'];
        }

    }

    public function getHttpResponseArray()
    {
        $request = Request::instance();
        $str = $request->getContent();
        if (trim($str) == '') {
            return array();
        }
        $nodes = explode('&', $str);

        $arr = array();


        foreach($nodes as $node)
        {
            $part = explode('=', $node);

            $arr[$part[0]] = $part[1];
        }

        return $arr;
    }

    public function generateReflink($agent_id=null)
    {
        if(!empty($agent_id)) {
            $url = Config::get('app.url') . '/?x=' . intval($agent_id);
        } else {
            $url = Config::get('app.url') . '/?x=' . Auth::user()->get()->id;
        }

        return $url;
    }

    public function generateUniqueFilename($path, $ext)
    {
        do {
            $filename = md5(rand(1, 102030921) . microtime()) . '.' . $ext;
        } while (file_exists($path.$filename));
        return $filename;
    }

    public function generatePassword($length, $type = 'alphanumeric')
    {
        $numbers = array('1','2','3','4','5','6','7','8','9');
        $alpha = array(
            'a','A','b','B','d',
            'D','e','E','f','F',
            'g','G','h','H','j',
            'J','k','K','L','m',
            'M','n','N','p','P',
            'q','r','R','s','S',
            't','T','u','U','V',
            'v','w','W','x','X',
            'y','Y','z','Z');
        if($type == 'numeric')
        {
            $symbols = $numbers;
        }
        else if($type == 'alpha')
        {
            $symbols = $alpha;
        }
        else if($type == 'alphanumeric')
        {
            $more_nums = array_merge($numbers, $numbers);
            $symbols = array_merge($alpha, $more_nums);
        }
        shuffle($symbols);
        $password = '';
        for($i = 0; $i < $length; $i++)
        {
            $index = mt_rand(0, (count($symbols) - 1));
            $password .= $symbols[$index];
        }
        return $password;
    }
}