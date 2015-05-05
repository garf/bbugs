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
            (parent_id, creator, title, description, budget, created, status)
            VALUES
            (?, ?, ?, ?, ?, ?, ?)
        ", array(
            '0',
            $params['user_id'],
            $params['title'],
            $params['description'],
            $params['budget'],
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
            SELECT pu.id as puid, pu.role, pu.user_id, p.*
            FROM lb_project_user pu
            LEFT JOIN
            lb_projects p
            ON pu.project_id=p.id
            WHERE pu.user_id=? AND p.status='1'
            ORDER BY pu.role ASC, p.title ASC
            LIMIT 50
        ", array($user_id));
    }

    public function getProjectUsers($project_id)
    {
        return DB::select("
            SELECT u.*, pu.role, pu.hour_cost, pu.id as puid
            FROM lb_project_user pu
            LEFT JOIN lb_users u
            ON pu.user_id=u.id
            WHERE pu.project_id=?
            ORDER BY u.name ASC
            LIMIT 50
        ", array($project_id));
    }

    public function getProjectUser($project_id, $user_id)
    {
        return DB::selectOne("
            SELECT u.*, pu.role, pu.hour_cost, pu.id as puid
            FROM lb_project_user pu
            LEFT JOIN lb_users u
            ON pu.user_id=u.id
            WHERE pu.project_id=? AND pu.user_id=?
            LIMIT 1
        ", array($project_id));
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

    public function getEditableProjects($user_id)
    {
        return DB::select('
            SELECT *
            FROM lb_project_user pu
            LEFT JOIN lb_projects p
            ON pu.project_id=p.id
            WHERE pu.user_id=? AND pu.role IN (?, ?)
            ORDER BY p.title ASC
        ', array($user_id, 'developer', 'teamlead'));

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

    public function removeProjectUser($user_id, $project_id)
    {
        return DB::delete('
            DELETE FROM lb_project_user
            WHERE user_id=? AND project_id=?
            LIMIT 1
        ', array($user_id, $project_id));
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

    public function isProjectObserver($user_id, $project_id)
    {
        $result = DB::selectOne("
            SELECT *
            FROM lb_project_user
            WHERE user_id=?
            AND project_id=?
            AND role='observer'
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

    public function setHourCost($params)
    {
        return DB::update("
            UPDATE lb_project_user
            SET hour_cost=?
            WHERE project_id=? AND user_id=?
            LIMIT 1
        ", array(
            $params['hour_cost'],
            $params['project_id'],
            $params['user_id'],
        ));
    }

}