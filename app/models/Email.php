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
            $params['body'] = View::make('emails.agents.registration', $params);
            Mail::send('emails.agents.main', $params, function($message) use ($params) {
//                var_dump($params);
                $message->to($params['email'], $params['name'])->subject('Регистрация на ' . Config::get('app.sitename'));
            });
            return array('error' => false, 'message' => 'Отправлено успешно!');
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
            return array('error' => false, 'message' => 'Отправлено успешно!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

    public function registrationPartner($params)
    {
        try
        {
            $params['body'] = View::make('emails.agents.registration-partner', $params);
            Mail::send('emails.agents.main', $params, function($message) use ($params) {
//                var_dump($params);
                $message->to($params['email'], $params['name'])->subject('Регистрация на ' . Config::get('app.sitename'));
            });
            return array('error' => false, 'message' => 'Отправлено успешно!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

    public function recoverPassword($params)
    {
        try
        {
            $params['body'] = View::make('emails.agents.recover-password', $params);
            Mail::send('emails.agents.main', $params, function($message) use ($params) {
//                var_dump($params);
                $message->to($params['email'], $params['name'])->subject('Новый пароль для ' . Config::get('app.sitename'));
            });
            return array('error' => false, 'message' => 'Отправлено успешно!');
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
            return array('error' => false, 'message' => 'Отправлено успешно!');
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

}