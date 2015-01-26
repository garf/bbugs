<?php

class History extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_history';
    public $timestamps = false;

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    public function getByUser($user_id) {
//        return DB::select("
//            SELECT h.issue_id, h.to_id, h.comment_id, h.act_type, h.act_time,
//            p.title as project_title, u.name as user_name,
//            a.name as assignee_name
//            FROM lb_history h
//            LEFT JOIN lb_projects p
//            ON h.project_id = p.id
//            LEFT JOIN lb_users u
//            ON h.user_id = u.id
//            LEFT JOIN lb_users a
//            ON h.to_id = a.id
//            LEFT JOIN lb_project_user pu
//            ON h.project_id=pu.project_id
//            WHERE pu.user_id=?
//            ORDER BY h.act_time DESC
//            LIMIT 15
//        ", array($user_id));

        return DB::table('lb_history AS h')
            ->select('h.issue_id', 'h.to_id', 'h.comment_id', 'h.act_type', 'h.act_time',
            'p.title as project_title', 'u.name as user_name', 'a.name as assignee_name')
            ->leftJoin('lb_projects AS p', 'h.project_id', '=', 'p.id')
            ->leftJoin('lb_users AS u', 'h.user_id', '=', 'u.id')
            ->leftJoin('lb_users AS a', 'h.to_id', '=', 'a.id')
            ->leftJoin('lb_project_user AS pu', 'h.project_id', '=', 'pu.project_id')
            ->where('pu.user_id', '=', $user_id)
            ->orderBy('h.act_time', 'desc')
            ->paginate(20);

    }

    public function add($params = array())
    {
        $history = new History;
        $history->user_id = $params['user_id'];
        $history->to_id = isset($params['to_id']) ? $params['to_id'] : null;
        $history->project_id = $params['project_id'];
        $history->issue_id = isset($params['issue_id']) ? $params['issue_id'] : null;
        $history->comment_id = isset($params['comment_id']) ? $params['comment_id'] : null;
        $history->act_type = isset($params['act_type']) ? $params['act_type'] : null;
        $history->act_time = time();
        $history->save();
    }

    public function historyTypeText($type) {
        $types = array(
            'new_issue' => 'history.type_text.new_issue',
            'new_file' => 'history.type_text.new_file',
            'new_comment' => 'history.type_text.new_comment',
            'issue_update' => 'history.type_text.issue_update',
            'issue_edit' => 'history.type_text.issue_edit',
        );

        return $types[$type];

    }

}