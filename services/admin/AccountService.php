<?php

class AccountService
{
    public static function updateAccount($id, $data)
    {
        try {
            Db::updateOne('admins', $id, [
                'password' => $data['password']
            ]);
        } catch (Exception $e) {
            die('Error in Account Service : ' . $e->getMessage());
        }

        return true;
    }
    
}
