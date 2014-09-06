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
            'budget' => floatval(Input::get('budget', 0)),
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
            'js' => array(
                '/template/cabinet/js/projects/add_user.js'
            ),
            'title' => trans('projects.add_user_to_project', array('title' => $project->title)),
            'project' => $project,
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.add-user-to-project', $data);
    }

    public function projectUsersList($project_id)
    {
//        sleep(1);
        if(!Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $project_id)) {
            $response = array(
                'error' => true,
                'message' => trans('projects.only_teamlead_can_manage_users'),
                'users' => array(),
            );

            return json_encode($response);
        }

        $contacts = Contacts::getInstance()->getUserContacts(Auth::user()->id);
        $projects = Projects::getInstance()->getProjectUsers($project_id);
        foreach($contacts as $index=>$contact) {
            $contacts[$index]->avatar = Gravatar::src($contact->email, 64);
        }

        $response = array(
            'error' => false,
            'message' => '',
            'contacts' => $contacts,
            'projects' => $projects,
        );

        return json_encode($response);
    }

    public function projectAddUser()
    {
        sleep(2);
        $request = Request::instance();
        $content = $request->getContent();

        $post = json_decode($content, true);

        if (!Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $post['project_id'])) {
            $response = array(
                'error' => true,
                'message' => trans('projects.only_teamlead_can_manage_users'),
            );

            return json_encode($response);
        }

        if (Projects::getInstance()->isUserProject($post['user_id'], $post['project_id'])) {
            $response = array(
                'error' => false,
                'message' => trans('projects.user_already_in_project'),
            );

            return json_encode($response);
        }

        $params = array(
            'project_id' => $post['project_id'],
            'user_id' => $post['user_id'],
            'role' => $post['role']
        );

        Projects::getInstance()->addProjectUser($params);

        $response = array(
            'error' => false,
            'message' => trans('project.user_added'),
        );

        return json_encode($response);
    }

    public function projectRemoveUser()
    {
        sleep(1);
        $request = Request::instance();
        $content = $request->getContent();

        $post = json_decode($content, true);

        if (!Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $post['project_id'])) {
            $response = array(
                'error' => true,
                'message' => trans('projects.only_teamlead_can_manage_users'),
            );

            return json_encode($response);
        }

        Projects::getInstance()->removeProjectUser($post['user_id'], $post['project_id']);

        $response = array(
            'error' => false,
            'message' => trans('project.user_removed'),
        );

        return json_encode($response);
    }

    public function info($project_id)
    {
        View::share('menu_item', 'projects');

        $project = Projects::find($project_id);

        $params = array(
            'project_id' => $project_id,
        );

        $params['statuses'] = Issues::getInstance()->statsMapper('not_done');
        $opened = Issues::getInstance()->getProjectIssues($params);
        $params['statuses'] = Issues::getInstance()->statsMapper('done');
        $closed = Issues::getInstance()->getProjectIssues($params);

        $opened_count = count($opened);
        $closed_count = count($closed);
        $all_count = $opened_count + $closed_count;
        $opened_percent = ($all_count != 0) ? round($opened_count * 100 /$all_count, 2) : 0;
        $closed_percent = round(100 - $opened_percent, 2);

        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('projects.info', array('title' => $project->title)),
            'project' => $project,
            'opened' => $opened,
            'closed' => $closed,
            'opened_count' => $opened_count,
            'closed_count' => $closed_count,
            'all_count' => $all_count,
            'opened_percent' => $opened_percent,
            'closed_percent' => $closed_percent,
            'contacts' => Projects::getInstance()->getProjectUsers($project_id),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.info', $data);
    }

    public function edit($project_id)
    {
        View::share('menu_item', 'projects');

        if (!Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $project_id)) {
            Misc::getInstance()->setSystemMessage(trans('projects.no_access'), 'danger');
            return Redirect::to(URL::route('index'));
        }

        $project = Projects::find($project_id);

        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('projects.edit_project_title', array('title' => $project->title)),
            'project' => $project,
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.projects.edit', $data);
    }

    public function save($project_id)
    {
        if (!Projects::getInstance()->isProjectTeamlead(Auth::user()->id, $project_id)) {
            Misc::getInstance()->setSystemMessage(trans('projects.no_access'), 'danger');
            return Redirect::to(URL::route('index'));
        }

        $project = Projects::find($project_id);

        $project->title = e(Input::get('title', 'Untitled'));
        $project->description = e(Input::get('description', ''));
        $project->budget = floatval(Input::get('budget', 0));
        $project->save();
        return Redirect::to(URL::route('projects'));
    }
}
