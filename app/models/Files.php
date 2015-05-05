<?php

class Files extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_files';

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
            AND status=?
            ORDER BY uploaded ASC
            LIMIT 100
        ", array(
            $params['issue_id'],
            '1'
        ));
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
        try {
            $uploadPath = base_path() . '/files/';
            foreach($params['file_object'] as $index=>$file) {
                if($index > ($this->maxUserFiles($params['user_id'], 'comment') - 1)) {
                    break;
                }
                $extension = $file->getClientOriginalExtension();
                $file_title = str_replace('%', '', $file->getClientOriginalName());
                $size = $file->getSize()/1024;
                if($size * 1024 > Config::get('files.max_size')) {
                    Misc::getInstance()->setSystemMessage(trans('files.file_size_more', array(
                        'name' => e($file_title),
                        'size' => $size
                    )), 'warning');
                    continue;
                }
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
        } catch (Exception $e) {
            Misc::getInstance()->setSystemMessage(trans('files.file_size_exceeds'), 'warning');
        }

    }
}