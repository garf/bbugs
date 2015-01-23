<?php

class IssuesController extends BaseController {


    public function index($stats='not_done')
    {
        View::share('menu_item', 'issues');

        $params = array(
            'assigned' => Auth::user()->id,
            'statuses' => Issues::getInstance()->statsMapper($stats),
        );

        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('issues.issues_to_me'),
            'issues' => Issues::getInstance()->getByAssignee($params),
            'token' => csrf_token(),
            'aprojects' => Projects::getInstance()->getEditableProjects(Auth::user()->id)
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.issues.index', $data);
    }

    public function edit($issue_id)
    {
        View::share('menu_item', 'issues');

        if(Issues::getInstance()->isIssueObserver(Auth::user()->id, $issue_id)) {
            Misc::getInstance()->setSystemMessage(trans('errors.not_permitted'), 'danger');
            return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id)));
        }

        $issue = Issues::find($issue_id);

        $data = array(
            'css' => array(
                '/template/common/js/metis/pagedown-bootstrap/css/jquery.pagedown-bootstrap.css',
            ),
            'js' => array(
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Sanitizer.js',
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Editor.js',
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Converter.js',
                '/template/common/js/metis/pagedown-bootstrap/js/jquery.pagedown-bootstrap.combined.min.js',
                '/template/cabinet/js/issues/edit.js',
            ),
            'title' => trans('issues.issue_edit'),
            'issue' => $issue,
            'contacts' => Users::getInstance()->getProjectContacts(Auth::user()->id, $issue->project_id),
            'token' => csrf_token(),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.issues.edit', $data);
    }

    public function save($issue_id)
    {
        if(Issues::getInstance()->isIssueObserver(Auth::user()->id, $issue_id)) {
            Misc::getInstance()->setSystemMessage(trans('errors.not_permitted'), 'danger');
            return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id)));
        }

        $issue = Issues::find($issue_id);

        $issue->title = e(Input::get('title', 'Untitled'));
        $issue->content = e(Input::get('content'));
        $issue->save();
        Issues::getInstance()->changeParams($issue_id, Input::all());

        Misc::getInstance()->setSystemMessage(trans('issues.issue_saved'), 'success');
        return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id)));
    }

    public function project($project_id, $stats='not_done')
    {
        View::share('menu_item', 'issues');
        $project = Projects::find($project_id);

        if(empty($project)) {
            return Redirect::to(URL::route('projects'));
        }

        $params = array(
            'project_id' => $project_id,
            'statuses' => $this->_statsMapper($stats),
            'user_id' => Auth::user()->id,
        );
        $issues = Issues::getInstance()->getProjectIssuesWithData($params);
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => $project->title,
            'project' => $project,
            'issues' => $issues,
            'is_observer' => Projects::getInstance()->isProjectObserver(Auth::user()->id, $project_id),
            'is_teamlead' => Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $project_id),
            'token' => csrf_token(),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.issues.project', $data);
    }

    public function view($issue_id)
    {
        View::share('menu_item', 'issues');

        $issue = Issues::find($issue_id);

        if(empty($issue)) {
            App::error('404');
        }

        $commentsParams = array(
            'issue_id' => $issue_id,
            'user_id' => Auth::user()->id,
        );

        $data = array(
            'css' => array(
                '/template/common/js/metis/pagedown-bootstrap/css/jquery.pagedown-bootstrap.css',
            ),
            'js' => array(
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Sanitizer.js',
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Editor.js',
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Converter.js',
                '/template/common/js/metis/pagedown-bootstrap/js/jquery.pagedown-bootstrap.combined.js',
                '/template/cabinet/js/issues/view.js',
            ),
            'title' => '#' . $issue->id . ' : ' . $issue->title,
            'issue' => $issue,
            'project' => Projects::find($issue->project_id),
            'creator' => Users::getInstance()->getContact(Auth::user()->id, $issue->creator),
            'assigned' => Users::getInstance()->getContact(Auth::user()->id, $issue->assigned),
            'comments' => Comments::getInstance()->getComments($commentsParams),
            'files' => Files::getInstance()->getByIssue(array('issue_id' => $issue_id)),
            'contacts' => Users::getInstance()->getProjectContacts(Auth::user()->id, $issue->project_id),
            'is_teamlead' => Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $issue->project_id),
            'is_observer' => Projects::getInstance()->isProjectObserver(Auth::user()->id, $issue->project_id),
            'token' => csrf_token(),
        );

        if($issue->status == 'new' && $issue->assigned == Auth::user()->id) {
            Issues::getInstance()->changeStatus($issue->id, 'opened');
        }

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.issues.view', $data);
    }

    public function newIssue($project_id)
    {
        View::share('menu_item', 'issues');

        $project = Projects::find($project_id);

        if(empty($project)) {
            return Redirect::to(URL::route('projects'));
        }

        $data = array(
            'css' => array(
                '/template/common/js/metis/pagedown-bootstrap/css/jquery.pagedown-bootstrap.css',
            ),
            'js' => array(
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Sanitizer.js',
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Editor.js',
//                '/template/common/js/metis/pagedown-bootstrap/js/Markdown.Converter.js',
                '/template/common/js/metis/pagedown-bootstrap/js/jquery.pagedown-bootstrap.combined.min.js',
                '/template/cabinet/js/issues/new.js',
            ),
            'title' => $project->title . ' : ' . trans('issues.new_issue'),
            'project' => $project,
            'contacts' => Users::getInstance()->getProjectContacts(Auth::user()->id, $project->id),
            'token' => csrf_token(),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.issues.new', $data);
    }

    public function addIssue($project_id)
    {
        View::share('menu_item', 'issues');

        if(Input::get('assigned') != '0' && !Projects::getInstance()->isUserProject(Input::get('assigned'), $project_id)) {
            return Redirect::to(URL::route('projects'));
        }

        $project = Projects::find($project_id);

        if(empty($project)) {
            return Redirect::to(URL::route('projects'));
        }

        $params = array(
            'project_id' => $project_id,
            'title' => e(Input::get('title', 'Untitled')),
            'content' => e(Input::get('content', '')),
            'issue_type' => Input::get('issue_type'),
            'priority' => Input::get('priority'),
            'status' => Input::get('status'),
            'assigned' => Input::get('assigned'),
            'creator' => Auth::user()->id,
        );

        $issue_id = Issues::getInstance()->addIssue($params);

        if(Input::hasFile('userfile')) {
            $params = array(
                'file_object' => Input::file('userfile'),
                'issue_id' => $issue_id,
                'comment_id' => null,
                'user_id' => Auth::user()->id,
            );
            Files::getInstance()->uploadCommentFiles($params);
        }
        return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id, '')));
    }

    public function myIssues($stats='not_done')
    {
        View::share('menu_item', 'issues');
    }

    public function updateIssue($issue_id)
    {
        if (Issues::getInstance()->isIssueObserver(Auth::user()->id, $issue_id)) {
            return Redirect::to(URL::route('index'));
        }
        $comment = Input::get('comment', '');

        $userfiles = Input::file('userfile');

        if(Input::hasFile('userfile') || $comment != '') {
            $params = array(
                'creator' => Auth::user()->id,
                'comment' => e($comment),
                'files_count' => (Input::hasFile('userfile')) ? count($userfiles) : 0,
                'issue_id' => intval($issue_id),
            );
            $commentId = Comments::getInstance()->addComment($params);
        } else {
            $commentId = null;
        }

        Issues::getInstance()->changeParams($issue_id, Input::all());

        if(Input::hasFile('userfile') && count($userfiles) <= Files::getInstance()->maxUserFiles(Auth::user()->id, 'comment')) {
            $params = array(
                'file_object' => $userfiles,
                'issue_id' => $issue_id,
                'comment_id' => $commentId,
                'user_id' => Auth::user()->id,
            );
            Files::getInstance()->uploadCommentFiles($params);
        }

        return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id, '#comment' . $commentId)));
    }

    public function deleteComment($comment_id)
    {
        $comment = Comments::find($comment_id);
        if($comment->creator != Auth::user()->id) {
            Misc::getInstance()->setSystemMessage(trans('issues.cant_delete_comment'), 'danger');
            return Redirect::to(URL::route('projects'));
        }
        $issue_id = $comment->issue_id;
        $comment->status = '0';
        $comment->save();
        Misc::getInstance()->setSystemMessage(trans('issues.comment_deleted'), 'success');
        return Redirect::to(URL::route('issue-view', array('issue_id' => $issue_id)));
    }

    private function _statsMapper($stats)
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
            'new' => array('new'),
            'opened' => array('opened'),
            'in_work' => array('in_work'),
            'need_feedback' => array('need_feedback'),
            'closed' => array('closed'),
            'not_actual' => array('not_actual'),
        );

        return (isset($statsArray[$stats]) ? $statsArray[$stats] : $statsArray['not_done']);
    }
}
