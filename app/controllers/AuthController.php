<?php

class AuthController extends BaseController {


    public function login()
    {
        if (Auth::check())
        {
            return Redirect::to(URL::route('index'));
        }
        $data = array(
            'css' => array(),
            'js' => array(),
            'body_class' => 'login',
            'title' => trans('auth.authorization'),
        );
        return View::make('cabinet/main-empty', $data)->nest('body', 'cabinet/auth/login', $data);
    }

    public function loginPost()
    {
        $email = trim(Input::get('email', ''));
        $password = trim(Input::get('password', ''));
        $remember = (Input::get('remember', '0') == '1') ? true : false;
        if (Auth::attempt(array('email' => $email, 'password' => $password, 'status' => '1'), $remember)) {
            $user = Users::find(Auth::user()->id);
            $user->last_access = time();
            $user->last_ip = Request::getClientIp();
            $user->save();

            return Redirect::intended(URL::route('index'));
        } else {
            Misc::getInstance()->setSystemMessage('Неверный логин/пароль', 'danger');
            return Redirect::to(URL::route('login'));
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
        $agent = Users::getInstance()->getByEmail(e(Input::get('email')));
        if (!empty($agent) && $agent->status == '1') {
            if(time() - 300 < $agent->recover_time) {
                Misc::getInstance()->setSystemMessage('Нельзя делать восстановление пароля так часто', 'danger');
                return Redirect::to('/recover');
            }
            $newpass = Misc::getInstance()->generatePassword(8);
            Users::getInstance()->setAgentPassword($agent->id, $newpass);
            $params = array(
                'email' => $agent->email,
                'password' => $newpass,
                'name' => $agent->first_name . ' ' . $agent->middle_name,
            );
            Email::getInstance()->recoverPassword($params);
            Session::flash('done', true);
            return Redirect::to('/recover');
        } else {
            Misc::getInstance()->setSystemMessage('Такой e-mail не зарегистрирован в системе.', 'danger');
            return Redirect::to('/recover');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }
}
