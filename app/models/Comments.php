<?php

class Comments extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_comments';

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getComments($params=array())
    {
        return DB::select("
            SELECT com.*, u.name, u.email, co.title, co.notes
            FROM lb_comments com
            LEFT JOIN
            lb_users u
            ON com.creator=u.id
            LEFT JOIN
            lb_contacts co
            ON u.id=co.contact_id AND co.user_id=?
            WHERE com.issue_id=?
        ", array($params['user_id'], $params['issue_id']));
    }

    public function addComment($params)
    {
        DB::insert("
            INSERT INTO lb_comments
            (issue_id, comment, creator, created)
            VALUES
            (?, ?, ?, ?)
        ",
            array(
                $params['issue_id'],
                $params['comment'],
                $params['creator'],
                time(),
            )
        );
        return DB::getPdo()->lastInsertId();
    }

}