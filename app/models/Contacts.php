<?php

class Contacts extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_contacts';

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getUserContacts($user_id)
    {
        return DB::select('
            SELECT co.id as coid, co.title, co.is_email, co.is_phone, co.notes, co.created, u.*
            FROM lb_contacts co
            LEFT JOIN lb_users u
            ON co.contact_id=u.id
            ORDER BY co.created ASC
            LIMIT 100
        ');
    }

}