<?php

class UsersController extends BaseController {


    public function contactList()
    {
        $data = array(
            'css' => array(),
            'js' => array(
                '/template/cabinet/js/users/contacts.js'
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

    public function setLanguage($lang)
    {

        $cookie = Cookie::forever('lang', $lang);
        return Redirect::back()->withCookie($cookie);
    }
}
