<?php

class RoleService
{

    public static function getRoles()
    {

        $result = [];

        try {
            $result = Db::select('admin_roles');
        } catch (Exception $e) {
            die('Error in Role Service : ' . $e->getMessage());
        }

        return $result;
    }
}
