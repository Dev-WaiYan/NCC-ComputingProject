<?php

header('Content-Type: application/json');
class ReportController
{
    public static function report()
    {
        try {
            $result = [];
            $conditions = [];
            if(!empty($_POST['orderStartDate']) && !empty($_POST['orderEndDate'])) {
                $conditions = array(
                    'where' => array(
                        'created_at' => array($_POST['orderStartDate'], $_POST['orderEndDate'])
                    ),
                );
            }
           
            $orders = OrderService::getOrders($conditions);
            $orders = $orders ? $orders : [];
            $totalCalculatedIncome = 0;

            foreach ($orders as $order) {
                $conditions = [];
                if ($_POST['paymentStatus'] !== "") {
                    $conditions = [
                        'is_payment_verified' => $_POST['paymentStatus'] === "null" ? null : intval($_POST['paymentStatus'])
                    ];
                }
                $payment = PaymentService::getPaymentByOrderId($order['id'], 
                     $conditions
                );
              
                if (isset($payment)) {
                    array_push($result, (object)[
                        "order" => (object)$order,
                        "payment" => (object)$payment,
                    ]);
                    $totalCalculatedIncome += $payment['totalCheckoutAmount'];
                }
            }

            echo json_encode(array('status' => 'ok', 'error' => '', 'result' => (object)['orders' => $result, 'totalCalculatedIncome' => $totalCalculatedIncome]));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}
