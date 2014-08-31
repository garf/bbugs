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
    public function uploadCommentFiles($params)
    {
        $uploadPath = base_path() . '/files/';
        foreach($params['file_object'] as $file) {
            $extension = $file->getClientOriginalExtension();
            $file_title = $file->getClientOriginalName();
            $size = $file->getSize()/1024;
            $filename = Misc::getInstance()->generateUniqueFilename($uploadPath, $extension);
            $file->move($uploadPath, $filename);
            DB::insert("
                INSERT INTO lb_files
                (issue_id, comment_id, filename, file_title, file_size, creator, uploaded)
                VALUES
                (?, ?, ?, ?, ?, ?, ?)
            ", array(
                $params['issue_id'],
                $params['comment_id'],
                $filename,
                $file_title,
                $size,
                Auth::user()->id,
                time()
            ));
        }
    }
}