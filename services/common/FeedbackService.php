<?php

class FeedbackService
{
    public static function addFeedback($data)
    {
        $lastInsertId = 0;
        try {
            $lastInsertId = Db::insert('customer_product_reviews', $data);
        } catch (Exception $e) {
            die('Error in Feedback Service : ' . $e->getMessage());
        }

        return $lastInsertId;
    }


    // public static function getPaymentByOrderId($orderId)
    // {
    //     $result = null;
    //     try {
    //         $result = Db::selectOne('payments', ['where' => ['order_id' => $orderId]]);
    //     } catch (Exception $e) {
    //         die('Error in Order Service : ' . $e->getMessage());
    //     }

    //     return $result;
    // }
}
