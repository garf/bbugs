<?php

class Issues extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_issues';

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getProjectIssues($project_id)
    {
        return DB::select('
            SELECT *
            FROM lb_issues
            WHERE project_id=?
            ORDER BY priority ASC
            LIMIT 50
        ', array($project_id));
    }

}