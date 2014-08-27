<?php

class cabinet_AuthController extends BaseController {


    public function login()
    {
        if (Auth::user()->check())
        {
            return Redirect::to('/cabinet');
        }
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Авторизация'
        );
        return View::make('cabinet/main-empty', $data)->nest('body', 'cabinet/auth/login', $data);
    }

    public function loginPost()
    {
        $email = trim(Input::get('email', ''));
        $password = trim(Input::get('password', ''));
        $remember = (Input::get('remember', '0') == '1') ? true : false;
        if (Auth::user()->attempt(array('email' => $email, 'password' => $password, 'status' => '1'), $remember)) {
            $user = UsersModel::find(Auth::user()->get()->id);
            $user->last_login = time();
            $user->last_ip = Request::getClientIp();
            $user->save();

            return Redirect::intended('/cabinet');
        } else {
            MiscModel::getInstance()->setSystemMessage('Неверный логин/пароль', 'danger');
            return Redirect::to('/login');
        }
    }

    public function recover()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Восстановить пароль'
        );
        return View::make('cabinet/main-empty', $data)->nest('body', 'cabinet/auth/recover', $data);
    }

    public function recoverPost()
    {
        $agent = AgentsModel::getInstance()->getAgentByEmail(e(Input::get('email')));
        if (!empty($agent) && $agent->status == '1') {
            if(time() - 300 < $agent->recover_time) {
                MiscModel::getInstance()->setSystemMessage('Нельзя делать восстановление пароля так часто', 'danger');
                return Redirect::to('/recover');
            }
            $newpass = MiscModel::getInstance()->generatePassword(8);
            AgentsModel::getInstance()->setAgentPassword($agent->id, $newpass);
            $params = array(
                'email' => $agent->email,
                'password' => $newpass,
                'name' => $agent->first_name . ' ' . $agent->middle_name,
            );
            EmailModel::getInstance()->recoverPassword($params);
            Session::flash('done', true);
            return Redirect::to('/recover');
        } else {
            MiscModel::getInstance()->setSystemMessage('Такой e-mail не зарегистрирован в системе.', 'danger');
            return Redirect::to('/recover');
        }
    }

    public function logout()
    {
        Auth::user()->logout();
        return Redirect::to('/login');
    }
}
