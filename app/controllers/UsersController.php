<?php

class UsersController extends BaseController {


    public function settings()
    {

        View::share('menu_item', 'settings');
        $data = array(
            'css' => array(),
            'js' => array(
                '/template/cabinet/js/users/settings.js',
            ),
            'title' => trans('users.settings'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.users.settings', $data);
    }


    public function settingsPasswordSave()
    {
        $validator = $this->_changePasswordValidation(Input::all());

        if($validator->fails()) {
            foreach($validator->messages()->all() as $message) {
                Misc::getInstance()->setSystemMessage($message, 'danger');
            }
            return Redirect::to(URL::route('settings'));

        } else {

            $old_password = trim(Input::get('old_password'));

            if(!Hash::check($old_password, Auth::user()->password)) {
                Misc::getInstance()->setSystemMessage(trans('validation.custom.old_password.wrong'), 'danger');
                return Redirect::to(URL::route('settings'));
            }

            $new_password = trim(Input::get('password'));
            Users::getInstance()->changePassword(Auth::user()->id, $new_password);
            Misc::getInstance()->setSystemMessage(trans('users.password_changed'), 'success');
            return Redirect::to(URL::route('settings'));

        }

    }

    public function settingsProfileSave()
    {
        Misc::getInstance()->setSystemMessage('Not available', 'danger');
        return Redirect::to(URL::route('settings'));
    }


    private function _changePasswordValidation($input)
    {
        $validator = Validator::make(
            $input,
            array(
                'old_password' => array('required'),
                'password' => array('required', 'min:6', 'confirmed'),
            )
        );

        return $validator;
    }


    public function contactList()
    {
        View::share('menu_item', 'contacts');
        $data = array(
            'css' => array(),
            'js' => array(
                '/template/cabinet/js/users/contacts.js',
            ),
            'contacts' => Contacts::getInstance()->getUserContacts(Auth::user()->id),
            'title' => trans('users.contact_list'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.users.contact-list', $data);
    }

    public function contactDelete($id)
    {
        $contact = Contacts::findOrFail($id);

        if($contact->user_id != Auth::user()->id) {
            $params = array(
                'error' => true,
                'message' => trans('users.please_dont'),
            );
        } else {
            $contact->delete();
            $params = array(
                'error' => false,
                'message' => trans('users.contact_deleted'),
            );
        }

        if(Request::isXmlHttpRequest()) {
            return json_encode($params);
        } else {
            if($params['error']) {
                Misc::getInstance()->setSystemMessage($params['message'], 'danger');
            } else {
                Misc::getInstance()->setSystemMessage($params['message'], 'success');
            }

            return Redirect::to(URL::route('contacts'));
        }

    }

    public function contactAdd()
    {
        sleep(2);
        $request = json_decode(Request::instance()->getContent(), true);
        $user = Users::getInstance()->getByEmail($request['email']);

        if(empty($user) || $user->id == Auth::user()->id) {
            $response = array(
                'error' => true,
                'message' => trans('users.user_not_found'),
                'user' => null,
            );
            return json_encode($response);
        }

        if($user->status != '1') {
            $response = array(
                'error' => true,
                'message' => trans('users.user_not_available'),
                'user' => null,
            );
            return json_encode($response);
        }

        if(Contacts::getInstance()->isContactExists(Auth::user()->id, $user->id)) {
            $response = array(
                'error' => true,
                'message' => trans('users.already_exists'),
                'user' => null,
            );
            return json_encode($response);
        }

        $params = array(
            'user_id' => Auth::user()->id,
            'contact_id' => $user->id,
            'title' => e(Str::limit($request['title'], 150)),
            'notes' => e(Str::limit($request['notes'], 250)),
        );
        Contacts::getInstance()->addContact($params);

        Misc::getInstance()->setSystemMessage(trans('users.added'), 'success');
        $response = array(
            'error' => false,
            'message' => trans('users.added'),
            'user' => null,
        );
        return json_encode($response);
    }

    public function contactAddSearch()
    {
        sleep(1);
        $request = json_decode(Request::instance()->getContent(), true);
        $user = Users::getInstance()->getByEmail($request['email']);

        if(empty($user) || $user->id == Auth::user()->id) {
            $response = array(
                'error' => true,
                'message' => trans('users.user_not_found'),
                'user' => null,
            );
            return json_encode($response);
        }

        if($user->status != '1') {
            $response = array(
                'error' => true,
                'message' => trans('users.user_not_available'),
                'user' => null,
            );
            return json_encode($response);
        }

        if(Contacts::getInstance()->isContactExists(Auth::user()->id, $user->id)) {
            $response = array(
                'error' => true,
                'message' => trans('users.already_exists'),
                'user' => null,
            );
            return json_encode($response);
        }

        $userData = array(
            'id' => $user->id,
            'name' => e($user->name),
            'email' => e($user->email),
            'phone' => e($user->phone),
            'gravatar' => Gravatar::src($user->email, 64),
        );

        $response = array(
            'error' => false,
            'message' => '',
            'user' => $userData,
        );
        return json_encode($response);
    }

    public function setLanguage($lang)
    {
        $cookie = Cookie::forever('lang', $lang);
        return Redirect::back()->withCookie($cookie);
    }
}
