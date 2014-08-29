<?php

class IssuesController extends BaseController {


    public function index()
    {
        View::share('menu_item', 'issues');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('issues.issues'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.dashboard.index', $data);
    }

    public function project($project_id)
    {
        View::share('menu_item', 'issues');
        $project = Projects::find($project_id);
        $issues = Issues::getInstance()->getProjectIssues($project_id);
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => $project->title,
            'project' => $project,
            'issues' => $issues,
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.issues.project', $data);
    }
}
