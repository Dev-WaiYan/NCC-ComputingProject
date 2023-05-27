<?php

class ReportController
{
    public static function view()
    {
        return "/admin/report/index.php";
    }

    public static function getData()
    {
        require_once 'services/common/OrderService.php';
        require_once 'services/common/PaymentService.php';

        $result = [];
        $orders = OrderService::getOrders();
        $totalCalculatedIncome = 0;

        foreach ($orders as $order) {
            $payment = PaymentService::getPaymentByOrderId($order['id']);
            $totalCalculatedIncome += $payment['totalCheckoutAmount'];
            array_push($result, (object)[
                "order" => (object)$order,
                "payment" => (object)$payment,
            ]);
        }

        return (object)['orders' => $result, 'totalCalculatedIncome' => $totalCalculatedIncome];
    }
}
