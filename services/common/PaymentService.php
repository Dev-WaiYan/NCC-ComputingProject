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

    public static function updatePaymentVerifyStatus($id, $data)
    {
        try {
            Db::updateOne('payments', $id, [
                'is_payment_verified' => $data['status'],
                'payment_verified_admin_id' => $_SESSION['adminId'],
                'payment_confirm_at' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            die('Error in Payment Service : ' . $e->getMessage());
        }

        return true;
    }
}
