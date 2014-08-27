<?php

class Users extends Eloquent {

    public static $_instance = null;
    protected $table = 'lb_users';

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function isRole($user_id, $role)
    {
        $user = $this->find($user_id);
        return $this->inRole($role, $user->role);
    }

    public function inRole($role, $roles)
    {
        $roles = explode('|', $roles);
        return in_array($role, $roles);
    }

    public function getRole($role, $default=false)
    {
        $roles = array(
            'developer' => array(
                'title' => trans('users.roles.developer')
            ),
            'teamlead' => array(
                'title' => trans('users.roles.teamlead')
            ),
            'observer' => array(
                'title' => trans('users.roles.observer')
            ),
        );

        if(isset($roles[$role])) {
            return $roles[$role];
        } else {
            return $default;
        }
    }

}