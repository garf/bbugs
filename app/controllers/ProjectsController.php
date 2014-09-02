<?php

class ProjectsController extends BaseController {

    public function index()
    {
        View::share('menu_item', 'projects');
        $data = array(
            'css' => array(),
            'js' => array(
                '/template/cabinet/js/projects/index.js'
            ),
            'title' => trans('projects.projects'),
            'projects' => Projects::getInstance()->getUserProjects(Auth::user()->id),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.index', $data);
    }

    public function create()
    {
        if(trim(Input::get('title', 'Untitled')) == '') {
            Misc::getInstance()->setSystemMessage(trans('validation.custom.title.required'), 'danger');
            return Redirect::to(URL::route('projects'))->withInput();
        }

        $params = array(
            'user_id' => Auth::user()->id,
            'title' => e(Input::get('title', 'Untitled')),
            'description' => e(Input::get('description', '')),
            'role' => 'teamlead',
        );
        $project_id = Projects::getInstance()->addProject($params);

        $params['project_id'] = $project_id;

        Projects::getInstance()->addProjectUser($params);

        return Redirect::to(URL::route('projects'));
    }

    public function delete($project_id)
    {
        if(Projects::getInstance()->isProjectCreator(Auth::user()->id, $project_id)) {
            $project = Projects::find($project_id);
            Misc::getInstance()->setSystemMessage(trans('projects.deleted', array('title' => $project->title)), 'success');
            Projects::getInstance()->setDeleted($project_id);
        }

        return Redirect::to(URL::route('projects'));
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

    public function addUser($project_id)
    {
        View::share('menu_item', 'projects');

        if(!Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $project_id)) {
            Misc::getInstance()->setSystemMessage(trans('projects.insufficient_privileges'), 'danger');
            return Redirect::to(URL::route('projects'));
        }

        $project = Projects::find($project_id);

        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('projects.add_user_to_project', array('title' => $project->title)),
            'project' => $project,
            'contacts' => Contacts::getInstance()->getUserProjectContacts(Auth::user()->id, $project->id),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.add-user-to-project', $data);
    }
}
