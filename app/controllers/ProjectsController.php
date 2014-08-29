<?php

class ProjectsController extends BaseController {


    public function index()
    {
        View::share('menu_item', 'projects');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('projects.projects'),
            'projects' => Projects::getInstance()->getUserProjects(Auth::user()->id),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.index', $data);
    }

    public function view($id)
    {
        View::share('menu_item', 'projects');

        $project = Projects::find($id);

        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => $project->title,
            'project' => $project,
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.view', $data);
    }
}
