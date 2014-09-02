<?php

class FilesController extends BaseController {

    public function d($id)
    {

    }

    public function download($id)
    {
        $part = explode('-', $id);
        $file = Files::getInstance()->getWithSalt($part[1], $part[0]);
        if(Issues::getInstance()->isUserIssue(Auth::user()->id, $file->issue_id)) {
            return Response::download(base_path() . '/files/' . $file->filename, $file->file_title);
        } else {
            return Redirect::to('index');
        }
    }
}
