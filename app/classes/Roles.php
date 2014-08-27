<?php

class Roles
{
    public static function is($role)
    {
        return AgentsModel::getInstance()->inRole($role, Auth::user()->get()->role);
    }

    public static function isNot($role)
    {
        return !AgentsModel::getInstance()->inRole($role, Auth::user()->get()->role);
    }
}