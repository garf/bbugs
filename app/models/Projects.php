<?php

class Projects extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_projects';

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getUserProjects($user_id)
    {
        return DB::select('
            SELECT pu.id as puid, pu.role, p.*
            FROM lb_project_user pu
            LEFT JOIN
            lb_projects p
            ON pu.project_id=p.id
            WHERE pu.user_id=?
            LIMIT 50
        ', array($user_id));
    }

    public function isUserProject($user_id, $project_id)
    {
        $result = DB::selectOne('
            SELECT *
            FROM lb_project_user
            WHERE user_id=? AND project_id=?
            LIMIT 1
        ', array($user_id, $project_id));

        return !empty($result);
    }

}