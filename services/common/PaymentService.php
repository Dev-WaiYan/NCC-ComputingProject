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
}
