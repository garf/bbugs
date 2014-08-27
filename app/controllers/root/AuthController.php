<?php

class root_AuthController extends BaseController {


    public function loginPost()
    {
        $email = trim(Input::get('email', ''));
        $password = trim(Input::get('password', ''));
        $remember = (Input::get('remember', '0') == '1') ? true : false;
        if (Auth::root()->attempt(array('email' => $email, 'password' => $password, 'status' => '1'), $remember)) {
            RootsModel::getInstance()->setEnterTime(Auth::root()->get()->id);
            return Redirect::intended('/root');
        } else {
            MiscModel::getInstance()->setSystemMessage('Неверный логин/пароль', 'danger');
            return Redirect::intended('/login-root');
        }
    }

    public function login()
    {
        if (Auth::root()->check())
        {
            return Redirect::to('/root');
        }
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Авторизация'
        );
        return View::make('root/main-empty', $data)->nest('body', 'root/auth/login', $data);
    }

    public function loginAgent($id)
    {
        Auth::user()->logout();
        Auth::user()->loginUsingId($id);
        return Redirect::to('/cabinet');
    }

    public function logout()
    {
        Auth::root()->logout();
        return Redirect::to('/login-root');
    }
}
