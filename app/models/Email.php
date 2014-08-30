<?php

class Email extends Eloquent {

    public static $_instance = null;

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    public function registration($params)
    {
        try
        {
            $params['body'] = View::make('emails.users.registration', $params);
            Mail::send('emails.users.main', $params, function($message) use ($params) {
                $message->to($params['email'], $params['name'])->subject(
                    trans('email.registration_subject',
                        array(
                            'sitename' => Config::get('app.sitename')
                        )
                    )
                );
            });
            return array('error' => false, 'message' => 'SEND OK!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

    public function registrationRoot($params)
    {
        try
        {
            $params['body'] = View::make('emails.root.registration', $params);
            $emails = Config::get('emails.root', array());

            foreach ($emails as $email) {
                if(!$email['active']) {
                    continue;
                }
                $params['admin_email'] = $email['email'];
                $params['admin_name'] = $email['name'];
                Mail::send('emails.root.main', $params, function($message) use ($params) {
                    $message->to($params['admin_email'], $params['admin_name'])->subject('Новый пользователь на ' . Config::get('app.sitename'));
                });
            }
            return array('error' => false, 'message' => 'SEND OK!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }


    public function recoverPassword($params)
    {
        try
        {
            $params['body'] = View::make('emails.users.recover-password', $params);
            Mail::send('emails.users.main', $params, function($message) use ($params) {
                $message->to($params['email'], $params['name'])->subject(
                    trans('email.recover_subject',
                        array(
                            'sitename' => Config::get('app.sitename')
                        )
                    )
                );
            });
            return array('error' => false, 'message' => 'SEND OK!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

    public function contacts($params)
    {
        try
        {
            $params['body'] = View::make('emails.root.contacts', $params);
            $emails = Config::get('emails.root', array());

            foreach ($emails as $email) {
                if(!$email['active']) {
                    continue;
                }
                $params['admin_email'] = $email['email'];
                $params['admin_name'] = $email['name'];
                Mail::send('emails.root.main', $params, function($message) use ($params) {
//                var_dump($params);
                    $message->to($params['admin_email'], $params['admin_name'])->subject('Сообщение с ' . Config::get('app.sitename'));
                });
            }
            return array('error' => false, 'message' => 'SEND OK!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

}