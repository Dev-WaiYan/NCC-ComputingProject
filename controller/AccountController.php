<?php

class AccountController
{
    public static function loginView()
    {
        return "/login/index.php";
    }

    public static function registerView()
    {
        return "/register/index.php";
    }

    // public static function getData() {
    //     require_once 'services/admin/RoleService.php';
    //     $roles = RoleService::getRoles();
    //     return (object)['roles' => $roles];
    // }
    
}
