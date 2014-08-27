<?php

class PagesModel extends Eloquent {

    public static $_instance = null;
    public $agentData = array();

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getPageByUrl($url)
    {
        return DB::selectOne("
            SELECT *
            FROM sat_pages
            WHERE url=?
            LIMIT 1
        ", array($url));
    }
}