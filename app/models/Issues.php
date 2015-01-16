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
            LIMIT 100
        ", $where);
    }

    public function getProjectIssuesWithData($params)
    {
        $in = trim(str_repeat('?, ', count($params['statuses'])), ', ');
        $where = array();
        $where[] = $params['user_id'];
        $where = array_merge($where, $params['statuses']);
        $where[] = $params['project_id'];
        return DB::select("
            SELECT i.*, u.name as uname, con.title as utitle
            FROM lb_issues i
            LEFT JOIN lb_users u
            ON i.assigned=u.id
            LEFT JOIN lb_contacts con
            ON con.contact_id=u.id AND con.user_id=?
            WHERE i.status IN (" . $in . ")
            AND i.project_id=?
            ORDER BY i.priority ASC
            LIMIT 100
        ", $where);
    }

    public function getByAssignee($params)
    {
        $in = trim(str_repeat('?, ', count($params['statuses'])), ', ');
        $where = $params['statuses'];
        $where[] = $params['assigned'];
        return DB::select("
            SELECT i.*, p.title as ptitle
            FROM lb_issues i
            LEFT JOIN lb_projects p
            ON i.project_id=p.id
            WHERE i.status IN (" . $in . ")
            AND i.assigned=?
            ORDER BY i.priority ASC, i.updated DESC
            LIMIT 100
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

    public function changeStatus($id, $status)
    {
        return DB::update("
            UPDATE lb_issues
            SET status=?, updated=?
            WHERE id=?
            LIMIT 1
        ", array(
            $status,
            time(),
            $id
        ));
    }

    public function changeParams($id, $params)
    {
        $priorities = array('1','2','3','4','5');
        $statuses = array('new', 'opened', 'in_work', 'need_feedback', 'closed', 'not_actual');
        $types = array('bug', 'task', 'research');

        $issue = Issues::find($id);

        if(isset($params['assigned']) && ($params['assigned'] == '0' || $this->isUserIssue($params['assigned'], $id))) {
            $issue->assigned = intval($params['assigned']);
        }

        if(isset($params['priority']) && in_array($params['priority'], $priorities)) {
            $issue->priority = intval($params['priority']);
        }

        if(isset($params['status']) && in_array($params['status'], $statuses)) {
            $issue->status = e($params['status']);
        }

        if(isset($params['issue_type']) && in_array($params['issue_type'], $types)) {
            $issue->issue_type = e($params['issue_type']);
        }

        if(isset($params['hours_spent'])) {
            $issue->hours_spent = floatval($params['hours_spent']);
        }

        $issue->save();
    }

    public function addIssue($params)
    {
        DB::insert("
            INSERT INTO lb_issues
            (project_id, title, content, status, issue_type, priority, creator, assigned, created, updated)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ", array(
            $params['project_id'],
            $params['title'],
            $params['content'],
            $params['status'],
            $params['issue_type'],
            $params['priority'],
            $params['creator'],
            $params['assigned'],
            time(),
            time()
        ));

        return DB::getPdo()->lastInsertId();
    }

    public function isUserIssue($user_id, $issue_id)
    {
        $issue = self::find($issue_id);
        if(empty($issue)) {
            return false;
        }
        return Projects::getInstance()->isUserProject($user_id, $issue->project_id);
    }

    public function isIssueTeamlead($user_id, $issue_id)
    {
        $issue = self::find($issue_id);
        if(empty($issue)) {
            return false;
        }
        return Projects::getInstance()->isProjectTeamlead($user_id, $issue->project_id);
    }

    public function isIssueObserver($user_id, $issue_id)
    {
        $issue = self::find($issue_id);
        if(empty($issue)) {
            return false;
        }
        return Projects::getInstance()->isProjectObserver($user_id, $issue->project_id);
    }

    public function statsMapper($stats)
    {
        $statsArray = array(
            'done' => array(
                'closed',
                'not_actual'
            ),
            'not_done' => array(
                'new',
                'opened',
                'in_work',
                'need_feedback',
            ),
            'all' => array(
                'new',
                'opened',
                'in_work',
                'need_feedback',
                'closed',
                'not_actual'
            ),
            'new' => array('new'),
            'opened' => array('opened'),
            'in_work' => array('in_work'),
            'need_feedback' => array('need_feedback'),
            'closed' => array('closed'),
            'not_actual' => array('not_actual'),
        );

        return (isset($statsArray[$stats]) ? $statsArray[$stats] : 'not_done');
    }

}