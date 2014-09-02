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

    public function changeParams($id, $params)
    {
        $priorities = array('1','2','3','4','5');
        $statuses = array('opened', 'in_work', 'need_feedback', 'closed', 'not_actual');
        $types = array('bug', 'task', 'research');

        $issue = Issues::find($id);

        if(isset($params['assigned']) && $this->isUserIssue($params['assigned'], $id)) {
            $issue->assigned = intval($params['assigned']);
        }

        if(isset($params['priority']) && in_array($params['priority'], $priorities)) {
            $issue->priority = intval($params['priority']);
        }

        if(isset($params['status']) && in_array($params['status'], $statuses)) {
            $issue->status = e($params['status']);
        }

        if(isset($params['issue_type']) && in_array($params['issue_type'], $types)) {
            $issue->status = e($params['status']);
        }

        $issue->save();
    }

    public function isUserIssue($user_id, $issue_id)
    {
        $issue = self::find($issue_id);
        return Projects::getInstance()->isUserProject($user_id, $issue->project_id);
    }
}