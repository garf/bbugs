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
            SELECT com.*, u.name, u.email, con.title, con.notes
            FROM lb_comments com
            LEFT JOIN
            lb_users u
            ON com.creator=u.id
            LEFT JOIN
            lb_contacts con
            ON u.id=con.contact_id AND con.user_id=?
            WHERE com.issue_id=? AND com.status='1'
        ", array($params['user_id'], $params['issue_id']));
    }

    public function addComment($params)
    {
        DB::insert("
            INSERT INTO lb_comments
            (issue_id, comment, files_count, creator, created)
            VALUES
            (?, ?, ?, ?, ?)
        ",
            array(
                $params['issue_id'],
                $params['comment'],
                $params['files_count'],
                $params['creator'],
                time(),
            )
        );
        return DB::getPdo()->lastInsertId();
    }

}