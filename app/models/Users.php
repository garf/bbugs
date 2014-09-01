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

    public function getByEmail($email)
    {
        return DB::selectOne("
            SELECT * FROM lb_users
            WHERE email=?
            LIMIT 1
        ", array(mb_strtolower($email)));
    }

    public function getContact($user_id, $contact_user_id)
    {
        return DB::selectOne("
            SELECT u.*, co.title, co.notes
            FROM lb_users u
            LEFT JOIN
            lb_contacts co
            ON u.id=co.contact_id AND co.user_id=?
            WHERE u.id=?
            LIMIT 1
        ", array($user_id, $contact_user_id));
    }

    public function getProjectContacts($user_id, $project_id)
    {
        return DB::select("
            SELECT u.*, co.title, co.notes
            FROM lb_project_user pu
            LEFT JOIN lb_users u
            ON pu.user_id=u.id
            LEFT JOIN lb_contacts co
            ON co.user_id=? AND pu.user_id=co.contact_id
            WHERE pu.project_id=?
            ORDER BY co.title ASC, u.name ASC
            LIMIT 50
        ", array($user_id, $project_id));
    }

    public function changePassword($user_id, $password)
    {
        return DB::update("
            UPDATE lb_users
            SET password=?, recover_time=?
            WHERE id=?
            LIMIT 1
        ", array(
            Hash::make($password),
            time(),
            $user_id
        ));
    }

    public function register($params)
    {
        DB::insert("
            INSERT INTO lb_users
            (name, email, password, reg_date, status)
            VALUES
            (?, ?, ?, ?, ?)
        ", array(
            $params['name'],
            mb_strtolower($params['email']),
            Hash::make($params['password']),
            time(),
            '1'
        ));
        return DB::getPdo()->lastInsertId();
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