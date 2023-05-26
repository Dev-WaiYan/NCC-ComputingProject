<?php

header('Content-Type: application/json');
class PaymentController
{
    public static function updateForPayment()
    {
        try {
            $decision = $_POST['decision'];
            PaymentService::updatePaymentVerifyStatus($_POST['paymentId'], ['status' => $decision]);
            if ($decision === "0") {
                OrderService::updateDeliveryStatus($_POST['orderId'],['status' => 0]);
            }
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}
