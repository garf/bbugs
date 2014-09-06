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
            return Redirect::to(URL::route('index'));
        }
    }

    public function deleteFile($id)
    {
        $part = explode('-', $id);
        $file = Files::getInstance()->getWithSalt($part[1], $part[0]);
        if(!Issues::getInstance()->isIssueTeamlead(Auth::user()->id, $file->issue_id)) {
            Misc::getInstance()->setSystemMessage(trans('files.cant_delete_files'), 'danger');
            return Redirect::to(URL::route('index'));
        } else {
            $issue_id = $file->issue_id;
            $f = Files::find($file->id);
            $f->status = '0';
            $f->save();
            Misc::getInstance()->setSystemMessage(trans('files.file_deleted'), 'success');
            return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id)));
        }
    }
}
