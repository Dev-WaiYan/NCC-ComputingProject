<?php

header('Content-Type: application/json');
require_once './utils/FileUploader.php';
class OrderController
{
    public static function checkout()
    {
        try {
            $uploader = new FileUploader('./storage/paid_receipts');
            $fileName = $uploader->uploadFile($_FILES['paidReceipt']);
            $data = array(
                'customer_id' => $_SESSION['userId'],
                'deli_address' => $_POST['deliAddress'],
            );
            $orderId = OrderService::addOrder($data);

            $orderProducts = json_decode($_POST['cartItems']);
            // var_dump($orderProducts);
            
            // die("DIE");

            foreach ($orderProducts as $value) {
                $data = array(
                    'order_id' => $orderId,
                    'product_id' => $value->productId,
                    'quantity' => $value->quantity,
                );
                OrderService::addOrderDetails($data);
            }

            $data = array(
                'order_id' => $orderId,
                'payment_screen_shot' => $fileName,
                'totalCheckoutAmount' => $_POST['totalCheckoutPrice']
            );
            PaymentService::addPayment($data);

            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}
