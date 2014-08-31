<?php

class AuthController extends BaseController {


    public function login()
    {
        if (Auth::check())
        {
            return Redirect::to(URL::route('index'));
        }
        $data = array(
            'css' => array(
                '/template/common/js/metis/animate.css/animate.min.css'
            ),
            'js' => array(
                '/template/cabinet/js/auth/login.js'
            ),
            'body_class' => 'login',
            'title' => trans('auth.authorization'),
        );
        return View::make('cabinet/auth/login', $data);
    }

    public function loginPost()
    {
        $email = trim(mb_strtolower(Input::get('email', '')));
        $password = trim(Input::get('password', ''));
        $remember = (Input::get('remember', '0') == '1') ? true : false;
        if (Auth::attempt(array('email' => $email, 'password' => $password, 'status' => '1'), $remember)) {
            $user = Users::find(Auth::user()->id);
            $user->last_access = time();
            $user->last_ip = Request::getClientIp();
            $user->save();

            return Redirect::intended(URL::route('index'));
        } else {
            Misc::getInstance()->setSystemMessage(trans('auth.wrong_credentials'), 'danger');
            return Redirect::to(URL::route('login'))->withInput();
        }
    }

    public function recoverPost()
    {
        $user = Users::getInstance()->getByEmail(e(Input::get('email')));
        if (!empty($user) && $user->status == '1') {
            if(time() - 300 < $user->recover_time) {
                Misc::getInstance()->setSystemMessage(trans('auth.recover_time_fast'), 'danger');
                return Redirect::to(URL::route('login', ['#recover']));
            }
            $newpass = Misc::getInstance()->generatePassword(8);
            //Users::getInstance()->setAgentPassword($user->id, $newpass);
            $params = array(
                'email' => $user->email,
                'password' => $newpass,
                'name' => $user->name,
            );
            Email::getInstance()->recoverPassword($params);
            Misc::getInstance()->setSystemMessage(trans('auth.recover_success'), 'success');
            return Redirect::to(URL::route('login'));
        } else {
            Misc::getInstance()->setSystemMessage(trans('auth.no_such_email'), 'danger');
            return Redirect::to(URL::route('login', ['#recover']));
        }
    }

    public function registerPost()
    {
        $input = Input::all();

        $validator = $this->_registerValidation($input);

        if($validator->fails()) {

            foreach($validator->messages()->all() as $message) {
                Misc::getInstance()->setSystemMessage($message, 'danger');
            }
            return Redirect::to(URL::route('login', ['#signup']))->withInput();

        } else {

            $input['password'] = Misc::getInstance()->generatePassword(8);
            Users::getInstance()->register($input);

            Email::getInstance()->registration($input);

            Misc::getInstance()->setSystemMessage(trans('auth.register_success'), 'success');
            return Redirect::to(URL::route('login'));

        }
    }

    private function _registerValidation($input)
    {
        $validator = Validator::make(
            $input,
            array(
                'name' => array('required', 'max:25'),
                'email' => array('required', 'email', 'unique:lb_users,email', 'confirmed'),
            )
        );

        return $validator;
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to(URL::route('login'));
    }
}
