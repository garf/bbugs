<?php

class site_PagesController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'page_corrector' => 'page1',
            'title' => 'Главная',
        );
        return View::make('site.main-empty', $data)->nest('body', 'site.pages.index', $data);
    }


    public function contactsPost()
    {
        $validator = $this->_validateContacts(Input::all());
        if ($validator->fails()) {
            $m = $validator->messages();
            foreach ($m->all() as $message)
            {
                MiscModel::getInstance()->setSystemMessage($message, 'danger');
            }
            return Redirect::to('/contacts')->withInput(Input::except('captcha'));
        }
        $params = array(
            'name' => e(Input::get('name')),
            'email' => Input::get('email'),
            'message' => nl2br(e(Input::get('message'))),
        );
        $result = EmailModel::getInstance()->contacts($params);
        if($result['error']) {
            MiscModel::getInstance()->setSystemMessage('Ошибка отправки сообщения. ' . $result['message'], 'danger');
            return Redirect::to('/contacts')->withInput(Input::except('captcha'));
        }
        Session::flash('done', true);
        return Redirect::to('/contacts');

    }

    private function _validateContacts($input)
    {
        $messages = array(
            'name.required' => 'Вы не заполнили Имя',
            'email.required' => 'Вы не заполнили Email',
            'email.email' => 'Вы указали некорректный Email',
            'message.required' => 'Вы не ввели сообщение',
            'message.min' => 'Ваше сообщение содержит меньше 10 знаков',
            'captcha.required' => 'Вы не ввели проверочный код, указанный на картинке',
            'captcha.captcha' => 'Вы ввели неверный проверочный код, указанный на картинке',
        );

        return Validator::make(
            $input,
            array(
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:10',
                'captcha' => 'required|captcha',
            ),
            $messages
        );
    }

    public function partnersPost()
    {
        $email = Input::get('email');
        $exists = AgentsModel::getInstance()->getAgentByEmail($email);
        if(!empty($exists)) {
            if($exists->status == '0') {
                $role = 'partner';
            } else {
                $role = 'agent|partner';
            }
        } else {
            $role = 'partner';
        }
        $validator = $this->_validatePartners(Input::all());
        if ($validator->fails()) {
            $m = $validator->messages();
            foreach ($m->all() as $message)
            {
                MiscModel::getInstance()->setSystemMessage($message, 'danger');
            }
            return Redirect::to('/partners#register-form')->withInput(Input::except('captcha'));
        }
        $phone = str_replace('+7', '7', e(Input::get('phone')));
        $newpass = MiscModel::getInstance()->generatePassword(8);
        $params = array(
            'first_name' => e(Input::get('first_name')),
            'last_name' => e(Input::get('last_name')),
            'middle_name' => e(Input::get('middle_name')),
            'parent_id' => intval(Input::get('parent', 0)),
            'role' => $role,
            'email' => e(Input::get('email')),
            'phone' => $phone,
            'password' => $newpass,
            'x_referal' => e(Session::get('x_referal', '')),
            'x_url' => e(Session::get('x_url', '')),
            'status' => '1',
        );

        if(!empty($exists)) {
            AgentsModel::getInstance()->updateAgent($exists->id, $params);
            $agent_id = $exists->id;
        } else {
            $agent_id = AgentsModel::getInstance()->addAgent($params);
        }

        $sponsor = AgentsModel::getInstance()->getAgentById($params['parent_id']);
        $params['agent_id'] = $agent_id;
        $params['name'] = Input::get('first_name') . ' ' . Input::get('middle_name');
        $params['full_name'] = $params['last_name'] . ' ' . $params['first_name'] . ' ' . $params['middle_name'];
        $params['reflink'] = MiscModel::getInstance()->generateReflink($agent_id);
        $params['parent_name'] = $sponsor->last_name . ' ' . $sponsor->first_name . ' ' . $sponsor->middle_name;

        EmailModel::getInstance()->registrationPartner($params);
        EmailModel::getInstance()->registrationRoot($params);

        MiscModel::getInstance()->setSystemMessage('
            Благодарим вас за регистрацию в качестве партнера!
            В течение 10 минут на указанный вами e-mail придет письмо с параметрами доступа в кабинет.
            Если этого не произошло, проверьте папку "Спам".',
            'success');
        Session::flash('done', true);
        return Redirect::to('/partners?done=true#register-form');
    }


    private function _validatePartners($input)
    {
        $messages = array(
            'first_name.required' => 'Вы не заполнили Имя',
            'last_name.required' => 'Вы не заполнили Фамилию',
            'middle_name.required' => 'Вы не заполнили Отчество',
            'phone.required' => 'Вы не указали Номер телефона',
            'phone.regex' => 'Вы указали неверный номер телефона',
            'email.email' => 'E-mail указан неверно',
            'email.required' => 'Вы не указали E-mail',
            'agree.accepted' => 'Вы не согласились с договором-офертой',
            'captcha.required' => 'Вы не ввели проверочный код, указанный на картинке',
            'captcha.captcha' => 'Вы ввели неверный проверочный код, указанный на картинке',
        );

        return Validator::make(
            $input,
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'middle_name' => 'required',
                'phone' => 'required|regex:#^\+[0-9]{11,11}$#i',
                'email' => 'required|email',
                'agree' => 'accepted',
                'captcha' => 'required|captcha',
            ),
            $messages
        );
    }

}
