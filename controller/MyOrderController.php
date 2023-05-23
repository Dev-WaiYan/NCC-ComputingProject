<?php

class MyOrderController
{
    public static function view()
    {
        return "/myorder/index.php";
    }


    public static function getData()
    {
        require_once 'services/common/OrderService.php';
        require_once 'services/common/PaymentService.php';
        $result = [];
        $myOrders = OrderService::getOrdersByUserId($_SESSION['userId']);

        foreach ($myOrders as $order) {
            $payment = PaymentService::getPaymentByOrderId($order['id']);
            array_push($result, (object)[
                "order" => $order,
                "payment" => $payment
            ]);
        }

        return (object)['myOrders' => $result];
    }
}
