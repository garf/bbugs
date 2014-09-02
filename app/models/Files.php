<?php

class Files extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_issues';

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getWithSalt($id, $salt)
    {
        return DB::selectOne("
            SELECT *
            FROM lb_files
            WHERE id=? AND salt=?
            LIMIT 1
        ", array(
            $id,
            $salt
        ));
    }

    public function getByIssue($params)
    {
        return DB::select("
            SELECT *
            FROM lb_files
            WHERE issue_id=?
            ORDER BY uploaded ASC
            LIMIT 100
        ", array($params['issue_id']));
    }

    public function maxUserFiles($user_id, $type='comment')
    {
        if ($type == 'comment') {
            return Config::get('files.per_comment');
        }
        if ($type == 'new_issue') {
            return Config::get('files.per_new_issue');
        }
    }

    public function uploadCommentFiles($params)
    {
        $uploadPath = base_path() . '/files/';
        foreach($params['file_object'] as $index=>$file) {
            if($index > ($this->maxUserFiles($params['user_id'], 'comment') - 2)) {
                break;
            }
            $extension = $file->getClientOriginalExtension();
            $file_title = $file->getClientOriginalName();
            $size = $file->getSize()/1024;
            $filename = Misc::getInstance()->generateUniqueFilename($uploadPath, $extension);
            $file->move($uploadPath, $filename);
            DB::insert("
                INSERT INTO lb_files
                (issue_id, comment_id, filename, file_title, file_size, salt, creator, uploaded)
                VALUES
                (?, ?, ?, ?, ?, ?, ?, ?)
            ", array(
                $params['issue_id'],
                $params['comment_id'],
                $filename,
                $file_title,
                $size,
                Misc::getInstance()->generateFileSalt($file_title),
                $params['user_id'],
                time()
            ));
        }
    }
}