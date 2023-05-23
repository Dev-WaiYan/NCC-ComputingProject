<?php

class OrderService
{
    public static function addOrder($data)
    {
        $lastInsertId = 0;
        try {
            $lastInsertId = Db::insert('orders', $data);
        } catch (Exception $e) {
            die('Error in Order Service : ' . $e->getMessage());
        }

        return $lastInsertId;
    }


    public static function addOrderDetails($data)
    {
        $lastInsertId = 0;
        try {
            $lastInsertId = Db::insert('order_details', $data);
        } catch (Exception $e) {
            die('Error in OrderDetail Service : ' . $e->getMessage());
        }

        return $lastInsertId;
    }


    public static function getOrdersByUserId($userId)
    {

        $result = null;
        try {
            $result = Db::select('orders', ['where' => ['customer_id' => $userId]]);
        } catch (Exception $e) {
            die('Error in Order Service : ' . $e->getMessage());
        }

        return $result;
    }
}
