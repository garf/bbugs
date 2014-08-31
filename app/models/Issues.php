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

    public function getProjectIssues($params)
    {
        $in = trim(str_repeat('?, ', count($params['statuses'])), ', ');
        $where = $params['statuses'];
        $where[] = $params['project_id'];
        return DB::select("
            SELECT *
            FROM lb_issues
            WHERE status IN (" . $in . ")
            AND project_id=?
            ORDER BY priority ASC
            LIMIT 50
        ", $where);
    }

    public function changeAssignee($id, $user_id)
    {
        return DB::update("
            UPDATE lb_issues
            SET assigned=?, updated=?
            WHERE id=?
            LIMIT 1
        ", array(
            $user_id,
            time(),
            $id
        ));
    }

    public function isUserIssue($user_id, $issue_id)
    {
        $issue = self::find($issue_id);
        return Projects::getInstance()->isUserProject($user_id, $issue->project_id);
    }
}