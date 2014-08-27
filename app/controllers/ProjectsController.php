<?php

class ProjectsController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('projects.projects'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.dashboard.index', $data);
    }
}
