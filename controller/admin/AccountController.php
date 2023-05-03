<?php

class AccountController
{
    public static function view()
    {
        return "/admin/account/index.php";
    }

    public static function getData() {
        require_once 'services/admin/RoleService.php';
        $roles = RoleService::getRoles();
        return (object)['roles' => $roles];
    }
    
}
