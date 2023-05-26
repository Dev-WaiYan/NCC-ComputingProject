<?php

class OrderController
{
    public static function view()
    {
        return "/admin/order/index.php";
    }

    public static function getData()
    {
        require_once 'services/common/OrderService.php';
        require_once 'services/common/PaymentService.php';
        require_once 'services/common/CustomerService.php';

        $result = [];
        $orders = OrderService::getOrders();

        foreach ($orders as $order) {
            $payment = PaymentService::getPaymentByOrderId($order['id']);
            $customer = CustomerService::getCustomerById($order['customer_id']);
            array_push($result, (object)[
                "order" => (object)$order,
                "payment" => (object)$payment,
                "customer" => (object)$customer
            ]);
        }

        return (object)['orders' => $result];
    }
}
