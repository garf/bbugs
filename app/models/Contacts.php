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
            SELECT co.id as coid, co.title, co.is_email, co.is_phone, co.is_skype, co.notes, co.created, u.*
            FROM lb_contacts co
            LEFT JOIN lb_users u
            ON co.contact_id=u.id
            WHERE co.user_id=?
            ORDER BY co.title ASC
            LIMIT 100
        ', array($user_id));
    }

    public function getUserProjectContacts($user_id, $project_id)
    {
        return DB::select('
            SELECT co.id as coid, co.title, co.is_email, co.is_phone, co.is_skype, co.notes, co.created, u.*, pu.id as puid
            FROM lb_contacts co
            LEFT JOIN lb_users u
            ON co.contact_id=u.id
            LEFT JOIN lb_project_user pu
            ON pu.user_id=u.id AND pu.project_id=?
            WHERE co.user_id=?
            ORDER BY co.title ASC
            LIMIT 100
        ', array($user_id, $project_id));
    }

    public function addContact($params)
    {
        DB::insert('
            INSERT INTO lb_contacts
            (user_id, contact_id, title, is_email, is_phone, notes, created)
            VALUES
            (?, ?, ?, ?, ?, ?, ?)
        ',
            array(
                $params['user_id'],
                $params['contact_id'],
                $params['title'],
                true,
                true,
                $params['notes'],
                time(),
            )
        );
        return DB::getPdo()->lastInsertId();
    }

    public function isContactExists($user_id, $contact_id)
    {
        $result = DB::selectOne('
            SELECT id
            FROM lb_contacts
            WHERE user_id=? AND contact_id=?
            LIMIT 1
        ', array($user_id, $contact_id));
        return !empty($result);
    }

}