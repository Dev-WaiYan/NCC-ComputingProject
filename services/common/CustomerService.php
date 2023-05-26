<?php

class CustomerService
{
    public static function getCustomerById($id)
    {
        $result = null;
        try {
            $result = Db::selectOne('customers', ['where' => ['id' => $id]]);
        } catch (Exception $e) {
            die('Error in Customer Service : ' . $e->getMessage());
        }

        return $result;
    }
}
