<?php

class root_RootsController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Администраторы',
            'roots' => RootsModel::all()
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.roots.index', $data);
    }

    public function edit($id)
    {
        $root = RootsModel::getInstance()->getRootById($id);
        if(empty($root)) {
            MiscModel::getInstance()->setSystemMessage('Пользователя не существует', 'danger');
            return Redirect::to('/root/roots');
        }
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Изменить администратора ' . $root->name,
            'root' => $root,
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.roots.edit', $data);
    }

    public function create()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Добавить администратора',
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.roots.new', $data);
    }

    public function save($id=null)
    {
        $params = array(
            'email' => Input::get('email'),
            'name' => Input::get('name'),
            'role' => Input::get('role'),
            'status' => Input::get('status', '0'),
        );
        if(empty($id)) {
            $params['password'] = trim(Input::get('password'));
            RootsModel::getInstance()->addRoot($params);
        } else {
            if(trim(Input::get('password', '')) != '') {
                $params['password'] = trim(Input::get('password'));
                MiscModel::getInstance()->setSystemMessage('Пароль изменен','warning');
            }
            RootsModel::getInstance()->updateRoot($id, $params);
        }
        MiscModel::getInstance()->setSystemMessage('Администратор сохранен','success');
        return Redirect::to('/root/roots');
    }
}
