<?php

header('Content-Type: application/json');
class OrderController
{
    public static function deliComplete()
    {
        try {
            OrderService::updateDeliveryStatus($_POST['orderId'], ['status' => 1]);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}
