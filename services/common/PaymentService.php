<?php

class PaymentService
{
    public static function addPayment($data)
    {
        $lastInsertId = 0;
        try {
            $lastInsertId = Db::insert('payments', $data);
        } catch (Exception $e) {
            die('Error in Payment Service : ' . $e->getMessage());
        }

        return $lastInsertId;
    }


    public static function getPaymentByOrderId($orderId)
    {
        $result = null;
        try {
            $result = Db::selectOne('payments', ['where' => ['order_id' => $orderId]]);
        } catch (Exception $e) {
            die('Error in Order Service : ' . $e->getMessage());
        }

        return $result;
    }
}
