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

    public function addProject($params)
    {
        DB::insert("
            INSERT INTO lb_projects
            (parent_id, creator, title, description, created, status)
            VALUES
            (?, ?, ?, ?, ?, ?)
        ", array(
            '0',
            $params['user_id'],
            $params['title'],
            $params['description'],
            time(),
            '1'
        ));

        return DB::getPdo()->lastInsertId();
    }

    public function addProjectUser($params)
    {
        DB::insert("
            INSERT INTO lb_project_user
            (project_id, user_id, role)
            VALUES
            (?, ?, ?)
        ", array(
            $params['project_id'],
            $params['user_id'],
            $params['role']
        ));

        return DB::getPdo()->lastInsertId();
    }

    public function getUserProjects($user_id)
    {
        return DB::select("
            SELECT pu.id as puid, pu.role, p.*
            FROM lb_project_user pu
            LEFT JOIN
            lb_projects p
            ON pu.project_id=p.id
            WHERE pu.user_id=? AND p.status='1'
            ORDER BY pu.role ASC, p.title ASC
            LIMIT 50
        ", array($user_id));
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

    public function isProjectCreator($user_id, $project_id)
    {
        $result = DB::selectOne('
            SELECT *
            FROM lb_projects
            WHERE creator=? AND id=?
            LIMIT 1
        ', array($user_id, $project_id));

        return !empty($result);
    }

    public function isProjectTeamlead($user_id, $project_id)
    {
        $result = DB::selectOne("
            SELECT *
            FROM lb_project_user
            WHERE user_id=?
            AND project_id=?
            AND role='teamlead'
            LIMIT 1
        ", array($user_id, $project_id));

        return !empty($result);
    }

    public function setDeleted($project_id)
    {
        return DB::update("
            UPDATE lb_projects
            SET status=?
            WHERE id=?
            LIMIT 1
        ", array(
            '0',
            $project_id
        ));
    }

}